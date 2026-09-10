<x-app-layout>
    <div class="mx-auto max-w-8xl space-y-6 py-3">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <nav class="mb-2 flex text-sm font-medium text-gray-500" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center gap-2">
                        <li><a href="{{ route('spaces') }}" class="transition hover:text-indigo-600">Spaces</a></li>
                        <li>/</li>
                        <li><a href="{{ route('spaces') }}" class="transition hover:text-indigo-600">{{ $space->name }}</a></li>
                        <li>/</li>
                        <li class="font-semibold text-gray-900 dark:text-gray-200">Reviews</li>
                    </ol>
                </nav>
                <h2 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-200">Review Moderation</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Approve and inspect reviews collected for {{ $space->name }}.</p>
            </div>

            <a href="{{ route('review.post', ['id' => $space->space_id]) }}" target="_blank"
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                Public Form Link
            </a>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Reviews</p>
                <p class="mt-1 text-2xl font-extrabold text-gray-900 dark:text-gray-100">{{ $totalReviews }}</p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Positive Sentiment</p>
                <p class="mt-1 text-2xl font-extrabold text-emerald-600">{{ $totalReviews > 0 ? round(($positiveReviews / $totalReviews) * 100) : 0 }}%</p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Approved</p>
                <p class="mt-1 text-2xl font-extrabold text-emerald-600">{{ $approvedReviews }}</p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Pending Approval</p>
                <p class="mt-1 text-2xl font-extrabold text-indigo-600">{{ $pendingReviews }}</p>
            </div>
        </div>

        <form method="GET" action="{{ route('spaces.review', $space) }}"
            class="flex flex-col gap-4 rounded-xl border border-gray-100 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:flex-row md:items-center md:justify-between">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search by name or content..."
                class="w-full rounded-lg border-gray-300 text-sm dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200 md:w-80">
            <div class="flex flex-wrap items-center gap-2">
                <select name="sentiment" class="rounded-lg border-gray-300 text-sm dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200">
                    <option value="">All sentiments</option>
                    @foreach (['positive', 'neutral', 'negative'] as $sentiment)
                        <option value="{{ $sentiment }}" @selected(request('sentiment') === $sentiment)>{{ ucfirst($sentiment) }}</option>
                    @endforeach
                </select>
                <select name="status" class="rounded-lg border-gray-300 text-sm dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200">
                    <option value="">All statuses</option>
                    <option value="approved" @selected(request('status') === 'approved')>Approved</option>
                    <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                </select>
                <button type="submit" class="rounded-lg bg-indigo-600 px-3 py-2 text-xs font-semibold text-white hover:bg-indigo-700">Filter</button>
                <a href="{{ route('spaces.review', $space) }}" class="rounded-lg px-3 py-2 text-xs font-semibold text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">Reset</a>
            </div>
        </form>

        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead class="border-b border-gray-100 bg-gray-50 text-xs uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-6 py-4">Client</th>
                            <th class="px-6 py-4">Review</th>
                            <th class="px-6 py-4">AI Sentiment</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($reviews as $review)
                            <tr class="transition hover:bg-gray-50/50 dark:hover:bg-gray-700/30">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-bold text-indigo-700">
                                            {{ strtoupper(substr($review->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $review->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $review->designation }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="max-w-xs px-6 py-4">
                                    <p class="line-clamp-3 text-xs text-gray-600 dark:text-gray-400">{{ $review->content }}</p>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $review->ai_sentiment === 'positive' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400' : ($review->ai_sentiment === 'negative' ? 'bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300') }}">
                                        {{ ucfirst($review->ai_sentiment) }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <form method="POST" action="{{ route('review.status', ['id' => $space->id, 'review' => $review->id]) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-xs font-medium {{ $review->status ? 'text-emerald-600' : 'text-indigo-600' }}">
                                            {{ $review->status ? 'Approved' : 'Approve' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    <form method="POST" action="{{ route('review.destroy', ['id' => $space->id, 'review' => $review->id]) }}" onsubmit="return confirm('Delete this review?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-gray-400 hover:text-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500 dark:text-gray-400">No reviews match your filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($reviews->hasPages())
                <div class="border-t border-gray-100 px-6 py-4 dark:border-gray-700">{{ $reviews->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>