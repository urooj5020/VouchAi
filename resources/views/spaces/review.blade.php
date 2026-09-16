<x-app-layout>
    <div x-data="{
        open: false,
        title: '',
        content: '',
        copied: false,
        openPost(title, content) {
            this.title = title;
            this.content = content;
            this.copied = false;
            this.open = true;
        },
        async copyPost() {
            await navigator.clipboard.writeText(this.content);
            this.copied = true;
            setTimeout(() => this.copied = false, 1500);
        }
    }" class="mx-auto max-w-8xl space-y-6 py-3">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <nav class="mb-2 flex text-sm font-medium text-gray-500" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center gap-2">
                        <li><a href="{{ route('spaces') }}" class="transition hover:text-indigo-600">Spaces</a></li>
                        <li>/</li>
                        <li><a href="{{ route('spaces') }}"
                                class="transition hover:text-indigo-600">{{ $space->name }}</a></li>
                        <li>/</li>
                        <li class="font-semibold text-gray-900 dark:text-gray-200">Reviews</li>
                    </ol>
                </nav>
                <h2 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-200">Review Moderation</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Approve and inspect reviews collected for
                    {{ $space->name }}.</p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('review.post', ['slug' => $space->slug, 'id' => $space->space_id]) }}" target="_blank"
                    class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Public Form Link
                </a>
                <x-share-button :name="$space->name"
                    :url="route('review.post', ['slug' => $space->slug, 'id' => $space->space_id])" />
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Reviews
                </p>
                <p class="mt-1 text-2xl font-extrabold text-gray-900 dark:text-gray-100">{{ $totalReviews }}</p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Positive
                    Sentiment</p>
                <p class="mt-1 text-2xl font-extrabold text-emerald-600">
                    {{ $totalReviews > 0 ? round(($positiveReviews / $totalReviews) * 100) : 0 }}%</p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Approved</p>
                <p class="mt-1 text-2xl font-extrabold text-emerald-600">{{ $approvedReviews }}</p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Pending
                    Approval</p>
                <p class="mt-1 text-2xl font-extrabold text-indigo-600">{{ $pendingReviews }}</p>
            </div>
        </div>

        <form method="GET" action="{{ route('space.review', $space) }}"
            class="flex flex-col gap-4 rounded-xl border border-gray-100 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:flex-row md:items-center md:justify-between">
            <input type="search" name="search" value="{{ request('search') }}"
                placeholder="Search by name or content..."
                class="w-full rounded-lg border-gray-300 text-sm dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200 md:w-80">
            <div class="flex flex-wrap items-center gap-2">
                <select name="sentiment"
                    class="rounded-lg border-gray-300 text-sm dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200">
                    <option value="">All sentiments</option>
                    @foreach (['positive', 'neutral', 'negative'] as $sentiment)
                        <option value="{{ $sentiment }}" @selected(request('sentiment') === $sentiment)>
                            {{ ucfirst($sentiment) }}</option>
                    @endforeach
                </select>
                <select name="status"
                    class="rounded-lg border-gray-300 text-sm dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200">
                    <option value="">All statuses</option>
                    <option value="approved" @selected(request('status') === 'approved')>Approved</option>
                    <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                </select>
                <button type="submit"
                    class="rounded-lg bg-indigo-600 px-3 py-2 text-xs font-semibold text-white hover:bg-indigo-700">Filter</button>
                <a href="{{ route('space.review', $space) }}"
                    class="rounded-lg px-3 py-2 text-xs font-semibold text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">Reset</a>
            </div>
        </form>

        @php
            $statusMap = [
                'approved' => 'border-emerald-200 bg-emerald-50 text-emerald-800 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-300',
                'pending' => 'border-amber-200 bg-amber-50 text-amber-800 dark:border-amber-500/30 dark:bg-amber-500/10 dark:text-amber-300',
                'rejected' => 'border-rose-200 bg-rose-50 text-rose-800 dark:border-rose-500/30 dark:bg-rose-500/10 dark:text-rose-300',
            ];
        @endphp

        <div
            class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead
                        class="border-b border-gray-100 bg-gray-50/75 text-xs uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:bg-gray-700/40">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Client</th>
                            <th class="px-6 py-4 font-semibold">Review</th>
                            <th class="px-6 py-4 font-semibold">AI Sentiment</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($reviews as $review)
                            <tr class="transition hover:bg-teal-50/40 dark:hover:bg-teal-500/5">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-teal-500 to-cyan-600 text-xs font-bold uppercase text-white shadow-sm shadow-teal-500/20">
                                            {{ strtoupper(substr($review->name, 0, 2)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="truncate font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $review->name }}</p>
                                            <p class="truncate text-xs text-gray-500 dark:text-gray-400">
                                                {{ $review->designation }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="max-w-md px-6 py-4 align-top">
                                    <p class="line-clamp-3 text-xs leading-relaxed text-gray-600 dark:text-gray-400">
                                        {{ $review->content }}</p>
                                    @if ($review->insight)
                                        <div class="mt-3 flex flex-wrap items-center gap-2">
                                            <button type="button"
                                                @click="openPost('LinkedIn post', $event.currentTarget.dataset.content)"
                                                data-content="{{ $review->insight->linkedin_post }}"
                                                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-xs font-semibold text-slate-600 transition hover:border-teal-300 hover:bg-teal-50 hover:text-teal-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:border-teal-500/50 dark:hover:bg-teal-500/10 dark:hover:text-teal-300"
                                                title="View LinkedIn post">
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
                                                    <path
                                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 1 1 0-4.125 2.062 2.062 0 0 1 0 4.125zM7.119 20.452H3.553V9h3.566v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                                </svg>
                                                LinkedIn
                                            </button>
                                            <button type="button"
                                                @click="openPost('X post', $event.currentTarget.dataset.content)"
                                                data-content="{{ $review->insight->x_post }}"
                                                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-xs font-semibold text-slate-600 transition hover:border-teal-300 hover:bg-teal-50 hover:text-teal-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:border-teal-500/50 dark:hover:bg-teal-500/10 dark:hover:text-teal-300"
                                                title="View X post">
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
                                                    <path
                                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                                </svg>
                                                X
                                            </button>
                                            <button type="button"
                                                @click="openPost('Suggested reply', $event.currentTarget.dataset.content)"
                                                data-content="{{ $review->insight->suggested_reply }}"
                                                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-xs font-semibold text-slate-600 transition hover:border-teal-300 hover:bg-teal-50 hover:text-teal-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:border-teal-500/50 dark:hover:bg-teal-500/10 dark:hover:text-teal-300"
                                                title="View suggested reply">
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path
                                                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                Suggested reply
                                            </button>
                                        </div>
                                    @else
                                        <p
                                            class="mt-3 inline-flex items-center gap-1.5 text-xs italic text-gray-500 dark:text-gray-400">
                                            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-teal-500"></span>
                                            Generating social posts...
                                        </p>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @if ($review->ai_sentiment)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium {{ $review->ai_sentiment === 'positive' ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20 dark:bg-emerald-500/10 dark:text-emerald-400 dark:ring-emerald-500/20' : ($review->ai_sentiment === 'negative' ? 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20 dark:bg-rose-500/10 dark:text-rose-400 dark:ring-rose-500/20' : 'bg-gray-100 text-gray-700 ring-1 ring-inset ring-gray-500/10 dark:bg-gray-700 dark:text-gray-300 dark:ring-gray-500/20') }}">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            {{ ucfirst($review->ai_sentiment) }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-500 ring-1 ring-inset ring-gray-500/10 dark:bg-gray-700 dark:text-gray-400 dark:ring-gray-500/20">
                                            <span
                                                class="h-1.5 w-1.5 animate-pulse rounded-full bg-gray-400 dark:bg-gray-500"></span>
                                            Processing
                                        </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <form method="POST"
                                        action="{{ route('review.status', ['id' => $space->id, 'review' => $review->id]) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" title="Update status"
                                            class="cursor-pointer rounded-lg border py-1.5 pl-2.5 pr-8 text-xs font-semibold shadow-sm transition focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500 dark:bg-gray-900 {{ $statusMap[$review->status] ?? $statusMap['pending'] }}">
                                            @foreach (['pending', 'approved', 'rejected'] as $status)
                                                @continue($review->status !== 'pending' && $status === 'pending')
                                                <option value="{{ $status }}" class="font-medium text-gray-900"
                                                    @selected($review->status === $status)>{{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    <form method="POST"
                                        action="{{ route('review.destroy', ['id' => $space->id, 'review' => $review->id]) }}"
                                        onsubmit="return confirm('Delete this review?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-gray-400 transition hover:bg-rose-50 hover:text-rose-600 dark:hover:bg-rose-500/10 dark:hover:text-rose-400"
                                            title="Delete review">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6h14M10 11v6M14 11v6" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-sm text-gray-500 dark:text-gray-400">
                                    <svg class="mx-auto mb-3 h-10 w-10 text-gray-300 dark:text-gray-600" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M18 20V10M12 20V4M6 20v-6" />
                                    </svg>
                                    <p class="font-medium text-gray-700 dark:text-gray-200">No reviews found</p>
                                    <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Try adjusting your filters or
                                        check back later.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($reviews->hasPages())
                <div class="border-t border-gray-100 px-6 py-4 dark:border-gray-700">{{ $reviews->links() }}</div>
            @endif
        </div>

        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="open = false"
            class="fixed inset-0 z-50 flex items-center justify-center overflow-hidden bg-slate-900/35 px-4 py-6 backdrop-blur-[2px]"
            aria-modal="true" role="dialog">
            <div @click.stop
                class="theme-scrollbar max-h-[calc(100vh-3rem)] w-full max-w-[560px] overflow-y-auto rounded-[28px] border border-slate-200 bg-white/95 p-5 shadow-[0_28px_80px_rgba(15,23,42,0.22)] ring-1 ring-slate-200/70 dark:border-slate-700 dark:bg-slate-800/95 dark:ring-slate-700/80 sm:p-6">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-teal-500 to-cyan-600 text-white shadow-md shadow-teal-500/30">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M12 3v3m0 4v3m0 4v3m-6.4-9h12.8M6 9a6 6 0 0 1 12 0c0 3-1.5 5-3 6.5a2 2 0 0 1-1.5.7h-3a2 2 0 0 1-1.5-.7C7.5 14 6 12 6 9z"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <div>
                            <p
                                class="text-[10px] font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-300">
                                AI Generated</p>
                            <h2 class="text-sm font-semibold text-slate-800 dark:text-slate-100" x-text="title"></h2>
                        </div>
                    </div>
                    <button type="button" @click="open = false"
                        class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 transition hover:border-slate-300 hover:text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-600 dark:hover:text-slate-100"
                        aria-label="Close dialog">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="theme-scrollbar mt-4 max-h-[55vh] overflow-y-auto whitespace-pre-wrap rounded-xl border border-slate-200 bg-slate-50 p-4 text-sm leading-relaxed text-slate-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300"
                    x-text="content"></div>

                <div class="mt-5 flex items-center justify-end gap-3">
                    <button type="button" @click="open = false"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                        Close
                    </button>
                    <button type="button" @click="copyPost()"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-teal-500/20 transition hover:from-teal-700 hover:to-cyan-700">
                        <svg x-show="!copied" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2" />
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                        </svg>
                        <svg x-show="copied" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M20 6 9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span x-text="copied ? 'Copied' : 'Copy'" aria-live="polite"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>