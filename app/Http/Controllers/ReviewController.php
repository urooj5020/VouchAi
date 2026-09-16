<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Jobs\GeneratePostsJob;
use App\Models\Review;
use App\Models\Space;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Sentiment\Analyzer;

class ReviewController extends Controller
{
    private function analyzeSentiment(string $text): string
    {
        $analyzer = new Analyzer;
        $output = $analyzer->getSentiment($text);
        $score = $output['compound'];
        if ($score >= 0.05) {
            return 'positive';
        } elseif ($score <= -0.05) {
            return 'negative';
        } else {
            return 'neutral';
        }
    }

    public function create(string $slug, $id): View
    {
        $space = Space::where('space_id', $id)->firstOrFail();

        return view('reviews.reviewsInput', compact('space'));
    }

    public function store(string $id, ReviewRequest $request): RedirectResponse
    {
        $space = Space::where('space_id', $id)->firstOrFail();
        $validated = $request->validated();

        $review = Review::create([
            ...$validated,
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'content' => $request->review_content,
            'ai_sentiment' => null,
            'space_id' => $space->space_id,
        ]);
        GeneratePostsJob::dispatch($review->id);

        return redirect()->back();

    }

    public function updateStatus(Request $request, int $id, int $review): RedirectResponse
    {
        $space = Space::where('user_id', $request->user()->id)->findOrFail($id);
        $reviewModel = $space->reviews()->findOrFail($review);

        $allowedStatuses = in_array($reviewModel->status, ['approved', 'rejected'], true)
            ? ['approved', 'rejected']
            : ['pending', 'approved', 'rejected'];

        $validated = $request->validate([
            'status' => ['required', Rule::in($allowedStatuses)],
        ]);

        $reviewModel->update(['status' => $validated['status']]);

        return redirect()->back();
    }

    public function destroy(Request $request, int $id, int $review): RedirectResponse
    {
        $space = Space::where('user_id', $request->user()->id)->findOrFail($id);
        $space->reviews()->findOrFail($review)->delete();

        return redirect()->back();
    }
}
