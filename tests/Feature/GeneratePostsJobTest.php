<?php

use App\Jobs\GeneratePostsJob;
use App\Models\Review;
use App\Models\Space;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::preventStrayRequests();
});

function reviewForPosts(array $overrides = []): Review
{
    $user = User::factory()->create();
    $space = Space::create([
        'space_id' => 'h80kZtml6InGDf8p',
        'user_id' => $user->id,
        'name' => 'Test Space',
        'slug' => 'test-space',
        'logo_path' => 'logos/test.png',
        'accent_color' => '#000000',
        'header_title' => 'Test reviews',
        'public_link' => 'http://localhost/post-a-review/h80kZtml6InGDf8p',
    ]);

    return $space->reviews()->create([
        'name' => 'Emma Watson',
        'email' => 'emma@example.com',
        'designation' => 'Product Designer at Acme',
        'content' => 'Working with Acme Studio was a dream from start to finish.',
        ...$overrides,
    ]);
}

function fakeGroqInsights(array $insights): void
{
    Http::fake([
        'api.groq.com/*' => Http::response([
            'choices' => [[
                'message' => ['content' => json_encode($insights)],
            ]],
        ], 200),
    ]);
}

it('sends the reviewer details and business name to the AI', function () {
    $review = reviewForPosts();
    fakeGroqInsights([
        'sentiment' => 'positive',
        'headline_quote' => 'Working with Acme Studio was a dream.',
        'linkedin_post' => 'Our client walked away thrilled with the work we delivered.',
        'x_post' => 'That moment a client calls the experience a dream come true.',
        'suggested_reply' => 'Thank you Emma, it was a pleasure working with you!',
    ]);

    (new GeneratePostsJob($review->id))->handle();

    Http::assertSent(function (Request $request): bool {
        $prompt = $request->data()['messages'][1]['content'];

        return str_contains($prompt, 'Emma Watson')
            && str_contains($prompt, 'emma@example.com')
            && str_contains($prompt, 'Product Designer at Acme')
            && str_contains($prompt, 'Test Space');
    });
});

it('appends the client details and space name to the generated posts', function () {
    $review = reviewForPosts();
    fakeGroqInsights([
        'sentiment' => 'positive',
        'headline_quote' => 'Working with Acme Studio was a dream.',
        'linkedin_post' => 'A client recently told us their experience was a dream come true.',
        'x_post' => 'That moment a client calls the experience a dream come true',
        'suggested_reply' => 'Thank you Emma, it was a pleasure working with you!',
    ]);

    (new GeneratePostsJob($review->id))->handle();

    $insight = $review->fresh()->insight;

    $attribution = 'Emma Watson (emma@example.com), Product Designer at Acme, Test Space';

    expect($insight->linkedin_post)
        ->toBe('A client recently told us their experience was a dream come true.'."\n\n".'— '.$attribution);
    expect($insight->x_post)
        ->toBe('That moment a client calls the experience a dream come true'."\n".'— '.$attribution);
    expect($review->fresh()->ai_sentiment)->toBe('positive');
});

it('keeps the X post within the platform character limit', function () {
    $review = reviewForPosts();
    fakeGroqInsights([
        'sentiment' => 'positive',
        'headline_quote' => 'Working with Acme Studio was a dream.',
        'linkedin_post' => 'Our client loved the experience.',
        'x_post' => str_repeat('Amazing work. ', 30),
        'suggested_reply' => 'Thank you Emma, it was a pleasure working with you!',
    ]);

    (new GeneratePostsJob($review->id))->handle();

    $insight = $review->fresh()->insight;

    expect(mb_strlen($insight->x_post))->toBeLessThanOrEqual(280)
        ->and($insight->x_post)->toEndWith('…');
});
