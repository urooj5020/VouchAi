<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Space;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function create(string $id): View
    {
        $space = Space::where('space_id', $id)->firstOrFail();

        return view('reviews.reviewsInput', compact('space'));
    }

    public function store(string $id, ReviewRequest $request): RedirectResponse
    {
        $space = Space::where('space_id', $id)->firstOrFail();
        $validated = $request->validated();
        $sentiment = $this->analyzeSentiment($request->review_content);
        $created = Review::create([
            ...$validated,
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'content' => $request->review_content,
            'ai_sentiment' => $sentiment,
            'space_id' => $space->space_id,
        ]);

        return redirect()->back();
    }

    public function toggleStatus(Request $request, int $id, int $review): RedirectResponse
    {
        $space = Space::where('user_id', $request->user()->id)->findOrFail($id);
        $reviewModel = $space->reviews()->findOrFail($review);
        $reviewModel->update(['status' => !$reviewModel->status]);

        return redirect()->back();
    }

    public function destroy(Request $request, int $id, int $review): RedirectResponse
    {
        $space = Space::where('user_id', $request->user()->id)->findOrFail($id);
        $space->reviews()->findOrFail($review)->delete();

        return redirect()->back();
    }
}
