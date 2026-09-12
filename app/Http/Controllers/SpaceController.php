<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpaceRequest;
use App\Http\Requests\UpdateSpaceRequest;
use App\Models\Review;
use App\Models\Space;
use Carbon\CarbonPeriod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SpaceController extends Controller
{
    public function show()
    {
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
            ->mapWithKeys(fn($date) => [
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
    }
    public function store(SpaceRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $logoPath = $request->file('logo_path')->store('uploads', 'public');
        $token = Str::random(16);

        Space::create([
            ...$validated,
            'space_id' => $token,
            'user_id' => $request->user()->id,
            'logo_path' => $logoPath,
            'public_link' => route('review.post', ['id' => $token]),
        ]);

        return redirect()->back();
    }

    public function showSettings(int $id): View
    {
        $spaceInfo = $this->ownedSpace($id);

        return view('spaces.setting', compact('spaceInfo'));
    }

    public function update(UpdateSpaceRequest $request, int $id): RedirectResponse
    {
        $space = $this->ownedSpace($id);
        $validated = $request->validated();

        if ($request->hasFile('logo_path')) {
            $validated['logo_path'] = $request->file('logo_path')->store('uploads', 'public');
        } else {
            unset($validated['logo_path']);
        }

        $space->update($validated);

        return redirect()->route('space.settings', $space)->with('status', 'space-updated');
    }

    public function showReviews(Request $request, int $id): View
    {
        $space = $this->ownedSpace($id);
        $reviewsQuery = $space->reviews()->latest();

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $reviewsQuery->where(function ($query) use ($search): void {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->filled('sentiment')) {
            $reviewsQuery->where('ai_sentiment', $request->string('sentiment')->toString());
        }

        if ($request->filled('status') && in_array($request->string('status')->toString(), ['approved', 'pending'], true)) {
            $reviewsQuery->where('status', $request->string('status')->toString() === 'approved');
        }

        $reviews = $reviewsQuery->with('insight')->paginate(10)->withQueryString();
        $totalReviews = $space->reviews()->count();
        $approvedReviews = $space->reviews()->where('status', true)->count();
        $pendingReviews = $totalReviews - $approvedReviews;
        $positiveReviews = $space->reviews()->where('ai_sentiment', 'positive')->count();

        return view('spaces.review', compact(
            'approvedReviews',
            'pendingReviews',
            'positiveReviews',
            'reviews',
            'space',
            'totalReviews'
        ));
    }

    public function destroy(int $id): RedirectResponse
    {
        $space = $this->ownedSpace($id);
        $space->reviews()->delete();
        $space->delete();

        return redirect()->route('spaces')->with('status', 'space-deleted');
    }

    private function ownedSpace(int $id): Space
    {
        return Space::where('user_id', auth()->id())->findOrFail($id);
    }
}
