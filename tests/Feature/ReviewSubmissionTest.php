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
