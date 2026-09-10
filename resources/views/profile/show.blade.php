<x-app-layout>
    <div class="space-y-6">
        <header
            class="card-lift flex flex-col gap-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:flex-row sm:items-end sm:justify-between animate-fade-up">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-300">Account
                </p>
                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Your profile</h1>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Manage your identity and account preferences
                    in one place.</p>
            </div>
            <a href="{{ route('profile.edit') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-teal-500/20 transition hover:from-teal-700 hover:to-cyan-700 active:scale-95">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m15.5 5.5 3 3M4 20l4.5-1 10-10a2.12 2.12 0 0 0-3-3l-10 10L4 20Z" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Edit profile
            </a>
        </header>

        <section
            class="card-lift rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:p-6 animate-fade-up delay-100">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-teal-500 via-teal-600 to-cyan-600 text-2xl font-bold text-white shadow-md shadow-teal-500/25 dark:shadow-teal-950/40">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-300">
                            Member profile</p>
                        <h2 class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">{{ $user->name }}</h2>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">VouchAI member</p>
                    </div>
                </div>
                <span
                    class="inline-flex w-fit items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-500 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                    </span>
                    Active account
                </span>
            </div>
        </section>

        <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr] animate-fade-up delay-200">
            <section
                class="card-lift rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-300">
                            Personal details</p>
                        <h2 class="mt-2 text-xl font-bold text-slate-900 dark:text-white">Account information</h2>
                    </div>
                    <svg class="h-6 w-6 text-slate-300 dark:text-slate-600" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 10v6M12 7.5v.1" stroke-linecap="round" />
                    </svg>
                </div>
                <dl class="mt-8 divide-y divide-slate-100 dark:divide-slate-800">
                    <div class="flex flex-col gap-1 py-4 first:pt-0 sm:flex-row sm:items-center sm:justify-between">
                        <dt class="text-sm text-slate-500 dark:text-slate-400">Full name</dt>
                        <dd class="text-sm font-semibold text-slate-900 dark:text-slate-100">{{ $user->name }}</dd>
                    </div>
                    <div class="flex flex-col gap-1 py-4 sm:flex-row sm:items-center sm:justify-between">
                        <dt class="text-sm text-slate-500 dark:text-slate-400">Email address</dt>
                        <dd class="text-sm font-semibold text-slate-900 dark:text-slate-100">{{ $user->email }}</dd>
                    </div>
                    <div class="flex flex-col gap-1 py-4 last:pb-0 sm:flex-row sm:items-center sm:justify-between">
                        <dt class="text-sm text-slate-500 dark:text-slate-400">Member since</dt>
                        <dd class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                            {{ $user->created_at?->format('F j, Y') ?? 'Recently joined' }}
                        </dd>
                    </div>
                </dl>
            </section>

            <section
                class="card-lift rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-300">Account
                    health</p>
                <h2 class="mt-2 text-xl font-bold text-slate-900 dark:text-white">You are all set</h2>
                <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">Your account is ready to collect
                    feedback and turn it into growth.</p>

                <div class="mt-8 space-y-5">
                    <div class="flex items-center justify-between text-sm"><span
                            class="text-slate-500 dark:text-slate-400">Profile completeness</span><span
                            class="font-bold text-slate-900 dark:text-white">{{ $profileCompletion }}%</span></div>
                    <div class="h-2 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800">
                        <div class="progress-shimmer h-full rounded-full" style="width: {{ $profileCompletion }}%">
                        </div>
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl bg-emerald-50 p-4 dark:bg-emerald-500/10">
                        <span
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-sm font-bold text-white">✓</span>
                        <div>
                            <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-200">Email verified</p>
                            <p class="mt-0.5 text-xs text-emerald-700 dark:text-emerald-300">Your account is protected.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section
            class="relative overflow-hidden flex flex-col gap-4 rounded-2xl border border-teal-100 bg-white p-5 dark:border-teal-500/20 dark:bg-slate-900 sm:flex-row sm:items-center sm:justify-between sm:p-6 animate-fade-up delay-300">
            <div class="orb h-32 w-32 -right-6 -top-6 bg-teal-200/40 dark:bg-teal-500/10"></div>
            <div class="relative">
                <h2 class="font-bold text-teal-950 dark:text-teal-100">Want to update something?</h2>
                <p class="mt-1 text-sm text-teal-700 dark:text-teal-300">Edit your personal details, password, or
                    account settings.</p>
            </div>
            <a href="{{ route('profile.edit') }}"
                class="relative inline-flex items-center justify-center rounded-xl border border-teal-200 bg-white px-4 py-2.5 text-sm font-semibold text-teal-700 transition hover:bg-teal-50 active:scale-95 dark:border-teal-500/30 dark:bg-teal-950/40 dark:text-teal-200 dark:hover:bg-teal-900/50">Open
                settings</a>
        </section>
    </div>
</x-app-layout>