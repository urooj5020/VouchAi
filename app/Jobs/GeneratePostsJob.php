<?php

namespace App\Jobs;

use App\Models\Review;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class GeneratePostsJob implements ShouldQueue
{
    use Queueable;

    private const LINKEDIN_CHARACTERS = 3000;

    private const X_CHARACTERS = 280;

    public function __construct(public int $reviewId) {}

    public function handle(): void
    {
        $review = Review::with('space')->findOrFail($this->reviewId);

        $response = Http::withToken(config('services.groq.key'))
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => config('services.groq.model'),
                'response_format' => [
                    'type' => 'json_object',
                ],
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Return only valid JSON with these exact keys: sentiment, headline_quote, linkedin_post, x_post, suggested_reply.
- sentiment: one of "positive", "neutral", or "negative".
- headline_quote: the single most compelling 1-2 sentence quote from the review, written verbatim as the client wrote it.
- linkedin_post: a polished, professional LinkedIn post (120-160 words) in the voice of the business. Open with a hook, tell the client story with the review as the centerpiece, and end with a light, authentic call to action. Do NOT add a signature, name, or attribution line — one will be appended automatically.
- x_post: a punchy, concise X/Twitter post, at most 250 characters, that leads with the testimonial. Do NOT add a signature, name, or attribution line — one will be appended automatically.
- suggested_reply: a warm, brief reply from the business thanking the reviewer personally.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $this->buildPrompt($review),
                    ],
                ],
            ])
            ->throw();

        $insights = json_decode(
            $response->json('choices.0.message.content'),
            true,
            flags: JSON_THROW_ON_ERROR
        );

        $attribution = $this->reviewerAttribution($review);

        $review->insight()->create([
            'sentiment' => $insights['sentiment'],
            'headline_quote' => $insights['headline_quote'],
            'linkedin_post' => $this->linkedinPost($insights['linkedin_post'], $attribution),
            'x_post' => $this->xPost($insights['x_post'], $attribution),
            'suggested_reply' => $insights['suggested_reply'],
        ]);

        $review->update([
            'ai_sentiment' => strtolower($insights['sentiment']),
        ]);
    }

    private function buildPrompt(Review $review): string
    {
        $designation = trim($review->designation);
        $spaceName = $review->space?->name;
        $email = trim($review->email);

        return implode("\n", array_filter([
            'The reviewer is '.$review->name.($designation !== '' ? ', '.$designation : '').($email !== '' ? " ({$email})" : '').'.',
            $spaceName !== null ? "The business that received the review is {$spaceName}." : null,
            'Write the social posts from the perspective of this business.',
            '',
            'Here is the review:',
            $review->content,
        ]));
    }

    private function reviewerAttribution(Review $review): string
    {
        $identity = trim($review->name);
        $email = trim($review->email);

        if ($email !== '') {
            $identity .= " ({$email})";
        }

        return implode(', ', array_filter([
            trim($identity),
            trim($review->designation),
            trim((string) $review->space?->name),
        ]));
    }

    private function linkedinPost(string $body, string $attribution): string
    {
        $post = rtrim($body)."\n\n— {$attribution}";

        return mb_strlen($post) > self::LINKEDIN_CHARACTERS
            ? mb_substr($post, 0, self::LINKEDIN_CHARACTERS)
            : $post;
    }

    private function xPost(string $body, string $attribution): string
    {
        $post = rtrim($body)."\n— {$attribution}";

        if (mb_strlen($post) <= self::X_CHARACTERS) {
            return $post;
        }

        $cut = mb_substr($post, 0, self::X_CHARACTERS - 3);
        $lastSpace = mb_strrpos($cut, ' ');

        if ($lastSpace !== false && $lastSpace > 80) {
            $cut = mb_substr($cut, 0, $lastSpace);
        }

        return rtrim($cut).'…';
    }
}
