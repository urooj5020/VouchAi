<x-app-layout>
    <div class="space-y-6">
        <header
            class="card-lift flex flex-col gap-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:flex-row sm:items-end sm:justify-between animate-fade-up">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-300">
                    Overview</p>
                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Good evening,
                    {{ Auth::user()->name }}
                </h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-600 dark:text-slate-300">Here is a quick look at your
                    VouchAI workspace performance.</p>
            </div>

            <div class="flex items-center gap-3">
                <span
                    class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-500 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                    </span>
                    All systems healthy
                </span>
            </div>
        </header>

        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4 animate-fade-up delay-100"
            aria-label="Account statistics">
            <article
                class="card-lift group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total reviews</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900 dark:text-white">{{ $reviewCount }}</p>
                    </div>
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-50 text-teal-600 transition group-hover:scale-110 dark:!bg-teal-500/10 dark:!text-teal-300">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path
                                d="M4 5.5A2.5 2.5 0 0 1 6.5 3h11A2.5 2.5 0 0 1 20 5.5v8a2.5 2.5 0 0 1-2.5 2.5H12l-4.5 4v-4h-1A2.5 2.5 0 0 1 4 13.5v-8Z"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </div>
                <p class="mt-4 text-xs font-semibold text-emerald-600 dark:text-emerald-400">{{ $positiveCount }}
                    positive <span class="font-medium text-slate-500 dark:text-slate-400">reviews</span></p>
            </article>

            <article
                class="card-lift group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Average rating</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900 dark:text-white">
                            {{ $positivePercentage }}% <span class="text-xl text-amber-400">positive</span>
                        </p>
                    </div>
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-500 transition group-hover:scale-110 dark:!bg-amber-500/10 dark:text-amber-300">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="m12 3 2.8 5.67 6.26.91-4.53 4.42 1.07 6.24L12 17.3l-5.6 2.94 1.07-6.24-4.53-4.42 6.26-.91L12 3Z" />
                        </svg>
                    </span>
                </div>
                <p class="mt-4 text-xs font-semibold text-slate-500 dark:text-slate-400">{{ $neutralCount }} neutral,
                    {{ $negativeCount }} negative
                </p>
            </article>

            <article
                class="card-lift group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Reviews this week</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900 dark:text-white">
                            {{ $reviewData->where('created_at', '>=', now()->subDays(7))->count() }}
                        </p>
                    </div>
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 transition group-hover:scale-110 dark:!bg-cyan-500/10 dark:!text-cyan-300">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" />
                            <circle cx="12" cy="12" r="2.5" />
                        </svg>
                    </span>
                </div>
                <p class="mt-4 text-xs font-semibold text-emerald-600 dark:text-emerald-400">Reviews <span
                        class="font-medium text-slate-500 dark:text-slate-400">this week</span></p>
            </article>

            <article
                class="card-lift group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Active spaces</p>
                        <p class="mt-3 text-3xl font-extrabold text-slate-900 dark:text-white">{{ $spaces->count() }}
                        </p>
                    </div>
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition group-hover:scale-110 dark:!bg-emerald-500/10 dark:!text-emerald-300">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path
                                d="M4 6.5A2.5 2.5 0 0 1 6.5 4h11A2.5 2.5 0 0 1 20 6.5v11a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 17.5v-11Z" />
                            <path d="M8 8h8M8 12h8M8 16h4" />
                        </svg>
                    </span>
                </div>
                <p class="mt-4 text-xs font-semibold text-slate-500 dark:text-slate-400">
                    {{ $spaces->count() === 1 ? 'space' : 'spaces' }} available
                </p>
            </article>
        </section>

        <section class="grid gap-6 xl:grid-cols-[1.5fr_1fr] animate-fade-up delay-200">
            <article
                class="card-lift rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">Review activity</h2>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Reviews collected over the last 7
                            days</p>
                    </div>
                    <span
                        class="rounded-full bg-teal-50 px-3 py-1.5 text-xs font-semibold text-teal-700 dark:!bg-teal-500/10 dark:!text-teal-300">This
                        week</span>
                </div>

                <div
                    class="mt-8 flex h-48 items-end gap-3 border-b border-slate-200 pb-0 dark:border-slate-700 sm:gap-5">
                    @foreach ($dailyReviewCounts as $date => $count)
                    @php($height = $reviewCount > 0 ? min(100, max(8, round(($count / $reviewCount) * 100))) : 8)
                    <div class="group flex h-full flex-1 flex-col items-center justify-end gap-2">
                        <span
                            class="opacity-0 text-xs font-bold text-teal-700 transition group-hover:opacity-100 dark:text-teal-300">{{ $count }}</span>
                        <div class="w-full rounded-t-lg bg-gradient-to-t from-teal-600 to-cyan-500 opacity-80 transition-all group-hover:opacity-100 group-hover:brightness-110 dark:from-teal-500 dark:to-cyan-400"
                            style="height: {{ $height }}%"></div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-3 flex justify-between text-xs font-medium text-slate-400">
                    @foreach ($dailyReviewCounts as $date => $count)
                        <span>{{ \Carbon\Carbon::parse($date)->format('D') }}</span>
                    @endforeach
                </div>
            </article>

            <article
                class="card-lift rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">Recent activity</h2>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Latest account updates</p>
                    </div>
                    <a href="#" class="text-xs font-semibold text-teal-600 hover:text-teal-500 dark:text-teal-400">View
                        all</a>
                </div>

                <div class="mt-6 space-y-5">
                    @forelse ($reviewData->take(3) as $review)
                        <div class="flex gap-3">
                            <span
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-600 transition dark:bg-emerald-500/10 dark:text-emerald-300">✓</span>
                            <div>
                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">New review from
                                    {{ $review->name }}
                                </p>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ $review->ai_sentiment }} ·
                                    {{ $review->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">No reviews yet.</p>
                    @endforelse
                </div>
            </article>
        </section>

        <section
            class="card-lift relative overflow-hidden rounded-2xl border border-teal-100 bg-white p-6 dark:border-teal-500/20 dark:bg-slate-900 animate-fade-up delay-300">
            <div class="orb h-40 w-40 -right-8 -top-8 bg-teal-200/40 dark:bg-teal-500/10"></div>
            <div class="relative flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-teal-950 dark:!text-white">Your profile is looking great
                    </h2>
                    <p class="mt-1 text-sm text-teal-700 dark:!text-white">Complete your profile to unlock better
                        insights and higher trust.</p>
                </div>
                <a href="{{ route('profile.edit') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-teal-500/20 transition hover:from-teal-700 hover:to-cyan-700 active:scale-95">Complete
                    profile</a>
            </div>
            <div class="mt-5 h-2 overflow-hidden rounded-full bg-teal-100 dark:bg-teal-900/40">
                <div class="progress-shimmer h-full w-[78%] rounded-full dark:brightness-90"></div>
            </div>
            <p class="mt-2 text-right text-xs font-semibold text-teal-700 dark:!text-white">{{ $profileCompletion }}%
                complete</p>
        </section>
    </div>
</x-app-layout>