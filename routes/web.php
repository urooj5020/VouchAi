<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SpaceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [SpaceController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('post-a-review/{slug}/{id}', [ReviewController::class, 'create'])->name('review.post');
Route::post('submit-review/{space}', [ReviewController::class, 'store'])->name('review.store');
Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/spaces', [ProfileController::class, 'showSpaces'])->name('spaces');
    Route::post('/upload-space', [SpaceController::class, 'store'])->name('upload.space');
    Route::get('/space/settings/{id}', [SpaceController::class, 'showSettings'])->name('space.settings');
    Route::patch('/space/settings/{id}', [SpaceController::class, 'update'])->name('space.settings.update');
    Route::delete('/space/settings/{id}', [SpaceController::class, 'destroy'])->name('space.destroy');
    Route::get('/space/reviews/{id}', [SpaceController::class, 'showReviews'])->name('space.review');
    Route::patch('/space/reviews/{id}/review/{review}/status', [ReviewController::class, 'updateStatus'])->name('review.status');
    Route::delete('/space/reviews/{id}/review/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');
});

require __DIR__.'/auth.php';
