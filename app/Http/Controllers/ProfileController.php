<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Space;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function showSpaces()
    {
        $SpacesData = Space::where('user_id', auth()->id())
            ->withCount([
                'reviews',
                'reviews as positive_reviews' => fn ($query) => $query->where('ai_sentiment', 'positive'),
                'reviews as pending_reviews' => fn ($query) => $query->where('status', false),
            ])
            ->get();

        return view('spaces.space', compact('SpacesData'));
    }

    public function show(Request $request): View
    {
        $profileCompletion = round(collect([
            $request->user()->name,
            $request->user()->email,
            $request->user()->email_verified_at,
        ])->filter()->count() / 3 * 100);

        return view('profile.show', [
            'profileCompletion' => $profileCompletion,
            'user' => $request->user(),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
