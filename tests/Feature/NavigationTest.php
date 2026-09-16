<?php

use App\Models\Space;
use App\Models\User;

it('keeps the Spaces tab active on space sub-pages', function (string $routeName) {
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

    $this->actingAs($user)->get(route($routeName, $space->id))
        ->assertOk()
        ->assertSee('href="'.route('spaces').'"', false)
        ->assertSee('bg-teal-500', false);
})->with([
    'review page' => 'space.review',
    'settings page' => 'space.settings',
]);
