<?php

use App\Models\Space;
use App\Models\User;

it('renders the ready-made share message and share buttons on the spaces page', function () {
    $user = User::factory()->create();
    $space = Space::create([
        'space_id' => 'h80kZtml6InGDf8p',
        'user_id' => $user->id,
        'name' => 'Test Space',
        'slug' => 'test-space',
        'logo_path' => 'logos/test.png',
        'accent_color' => '#000000',
        'header_title' => 'Test reviews',
        'public_link' => 'http://localhost/post-a-review/test-space/h80kZtml6InGDf8p',
    ]);

    $this->actingAs($user)->get(route('spaces'))
        ->assertOk()
        ->assertSee('Share', false)
        ->assertSee('I recently had a great experience with ', false)
        ->assertSee('this.name !==', false)
        ->assertSee('https://api.whatsapp.com/send?text=', false)
        ->assertSee('https://twitter.com/intent/tweet?text=', false)
        ->assertSee('https://t.me/share/url?url=', false)
        ->assertSee('https://www.linkedin.com/sharing/share-offsite/?url=', false);
});
