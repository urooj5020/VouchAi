<?php

namespace App\Jobs;

use App\Models\Review;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class GeneratePostsJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public int $reviewId) {}

    public function handle(): void
    {
        $review = Review::findOrFail($this->reviewId);

        $response = Http::withToken(config('services.groq.key'))
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => config('services.groq.model'),
                'response_format' => [
                    'type' => 'json_object',
                ],
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Return only valid JSON with these keys: sentiment, headline_quote, linkedin_post, x_post, suggested_reply.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $review->content,
                    ],
                ],
            ])
            ->throw();

        $insights = json_decode(
            $response->json('choices.0.message.content'),
            true,
            flags: JSON_THROW_ON_ERROR
        );

        $review->insight()->create([
            'sentiment' => $insights['sentiment'],
            'headline_quote' => $insights['headline_quote'],
            'linkedin_post' => $insights['linkedin_post'],
            'x_post' => $insights['x_post'],
            'suggested_reply' => $insights['suggested_reply'],
        ]);

        $review->update([
            'ai_sentiment' => strtolower($insights['sentiment']),
        ]);
    }
}
