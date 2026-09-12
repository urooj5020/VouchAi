<?php

use App\Models\Review;
use App\Models\Space;
use App\Models\User;

test('a review can be submitted using a space token', function () {
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

    $response = $this->post(route('review.store', ['space' => $space->space_id]), [
        'name' => 'Urooj',
        'email' => 'urooj@example.com',
        'designation' => 'Founder',
        'review_content' => 'A thoughtful review.',
    ]);

    $response->assertSessionHasNoErrors()->assertRedirect();
    expect(Review::where('space_id', $space->space_id)->value('content'))
        ->toBe('A thoughtful review.');
});

test('space reviews display generated social posts', function () {
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
    $review = $space->reviews()->create([
        'name' => 'Urooj',
        'email' => 'urooj@example.com',
        'designation' => 'Founder',
        'content' => 'A thoughtful review.',
        'ai_sentiment' => 'positive',
    ]);
    $review->insight()->create([
        'sentiment' => 'positive',
        'headline_quote' => 'A thoughtful client experience',
        'linkedin_post' => 'LinkedIn post text',
        'x_post' => 'X post text',
        'suggested_reply' => 'Thank you for your kind words.',
    ]);

    $response = $this->actingAs($user)->get(route('space.review', $space->id));

    $response->assertOk()
        ->assertSee('LinkedIn')
        ->assertSee('Suggested reply')
        ->assertSee('AI Generated')
        ->assertSee('Copy');
});

test('review status can be updated by selecting a status', function () {
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
    $review = $space->reviews()->create([
        'name' => 'Urooj',
        'email' => 'urooj@example.com',
        'designation' => 'Founder',
        'content' => 'A thoughtful review.',
        'status' => 'pending',
    ]);

    $response = $this->actingAs($user)->patch(route('review.status', ['id' => $space->id, 'review' => $review->id]), [
        'status' => 'approved',
    ]);

    $response->assertSessionHasNoErrors()->assertRedirect();
    expect($review->fresh()->status)->toBe('approved');
});

test('review status rejects invalid values', function () {
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
    $review = $space->reviews()->create([
        'name' => 'Urooj',
        'email' => 'urooj@example.com',
        'designation' => 'Founder',
        'content' => 'A thoughtful review.',
        'status' => 'pending',
    ]);

    $response = $this->actingAs($user)->patch(route('review.status', ['id' => $space->id, 'review' => $review->id]), [
        'status' => 'published',
    ]);

    $response->assertSessionHasErrors(['status']);
    expect($review->fresh()->status)->toBe('pending');
});

test('approved or rejected reviews cannot be set back to pending', function () {
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
    $approved = $space->reviews()->create([
        'name' => 'Urooj',
        'email' => 'urooj@example.com',
        'designation' => 'Founder',
        'content' => 'A thoughtful review.',
        'status' => 'approved',
    ]);
    $rejected = $space->reviews()->create([
        'name' => 'Ali',
        'email' => 'ali@example.com',
        'designation' => 'CTO',
        'content' => 'Could be better.',
        'status' => 'rejected',
    ]);

    $this->actingAs($user)->patch(route('review.status', ['id' => $space->id, 'review' => $approved->id]), [
        'status' => 'pending',
    ])->assertSessionHasErrors(['status']);
    $this->actingAs($user)->patch(route('review.status', ['id' => $space->id, 'review' => $rejected->id]), [
        'status' => 'pending',
    ])->assertSessionHasErrors(['status']);

    expect($approved->fresh()->status)->toBe('approved');
    expect($rejected->fresh()->status)->toBe('rejected');
});
