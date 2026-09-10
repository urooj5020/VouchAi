<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SpaceController;
use App\Models\Review;
use App\Models\Space;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $spaces = Space::where('user_id', auth()->id())->get();
    $spaceIds = $spaces->pluck('space_id');
    $reviewData = Review::whereIn('space_id', $spaceIds)
        ->latest()
        ->get();
    $reviewCount = $reviewData->count();
    $positiveCount = $reviewData->where('ai_sentiment', 'positive')->count();
    $neutralCount = $reviewData->where('ai_sentiment', 'neutral')->count();
    $negativeCount = $reviewData->where('ai_sentiment', 'negative')->count();
    $positivePercentage = $reviewCount > 0 ? round(($positiveCount / $reviewCount) * 100) : 0;
    $profileCompletion = round(collect([
        auth()->user()->name,
        auth()->user()->email,
        auth()->user()->email_verified_at,
    ])->filter()->count() / 3 * 100);
    $dailyReviewCounts = collect(CarbonPeriod::create(now()->subDays(6), now()))
        ->mapWithKeys(fn ($date) => [
            $date->format('M d') => $reviewData->where('created_at', '>=', $date->copy()->startOfDay())
                ->where('created_at', '<=', $date->copy()->endOfDay())
                ->count(),
        ]);

    return view('dashboard', compact(
        'dailyReviewCounts',
        'negativeCount',
        'neutralCount',
        'positiveCount',
        'positivePercentage',
        'profileCompletion',
        'reviewCount',
        'reviewData',
        'spaces'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('post-a-review/{id}', [ReviewController::class, 'create'])->name('review.post');
Route::post('submit-review/{space}', [ReviewController::class, 'store'])->name('review.store');

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
    Route::get('/space/reviews/{id}', [SpaceController::class, 'showReviews'])->name('spaces.review');
    Route::patch('/space/reviews/{id}/review/{review}/status', [ReviewController::class, 'toggleStatus'])->name('review.status');
    Route::delete('/space/reviews/{id}/review/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');
});

require __DIR__.'/auth.php';
