<x-app-layout>
    <div class="space-y-6">
        <header
            class="card-lift flex flex-col gap-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:flex-row sm:items-end sm:justify-between animate-fade-up">
            <div>
                <p
                    class="text-xs font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-300">Account
                    settings</p>
                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Edit your profile
                </h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-600 dark:text-slate-300">Keep your personal details and
                    security preferences up to date.</p>
            </div>
            <a href="{{ route('profile') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-teal-400 hover:bg-teal-50 hover:text-teal-700 dark:border-slate-700 dark:!bg-slate-900 dark:!text-white dark:hover:border-teal-400 dark:hover:text-teal-300">
                <span aria-hidden="true">&larr;</span>
                {{ __('Back to profile') }}
            </a>
        </header>

        <section
            class="relative overflow-hidden rounded-2xl border border-teal-100 bg-white p-5 dark:!border-teal-500/20 dark:!bg-slate-900 sm:p-6 animate-fade-up delay-100">
            <div class="orb h-40 w-40 -right-8 -top-8 bg-teal-200/40 dark:bg-teal-500/10"></div>
            <div class="relative flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-300">
                        Account settings</p>
                    <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-teal-950 dark:text-teal-100">Keep
                        your profile current</h2>
                    <p class="mt-1.5 text-sm text-teal-700 dark:text-teal-300">Update your details and security
                        preferences from one place.</p>
                </div>
                <div
                    class="hidden h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-teal-500 to-cyan-600 text-white shadow-md shadow-teal-500/25 dark:shadow-teal-950/40 sm:flex">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z" />
                        <path
                            d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.7 1.7-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56v.08h-2.4v-.08a1.7 1.7 0 0 0-1.03-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.7-1.7.06-.06A1.7 1.7 0 0 0 8.46 15a1.7 1.7 0 0 0-1.56-1.03h-.08v-2.4h.08A1.7 1.7 0 0 0 8.46 10a1.7 1.7 0 0 0-.34-1.88l-.06-.06 1.7-1.7.06.06a1.7 1.7 0 0 0 1.88.34 1.7 1.7 0 0 0 1.03-1.56v-.08h2.4v.08a1.7 1.7 0 0 0 1.03 1.56 1.7 1.7 0 0 0 1.88-.34l.06-.06 1.7 1.7-.06.06A1.7 1.7 0 0 0 19.4 10a1.7 1.7 0 0 0 1.56 1.03h.08v2.4h-.08A1.7 1.7 0 0 0 19.4 15Z"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </section>

        <div class="grid gap-6 xl:grid-cols-[1.2fr_0.8fr] animate-fade-up delay-200">
            <section
                class="card-lift rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:p-7">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </section>

            <section
                class="card-lift rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:p-7">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </section>
        </div>

        <section
            class="card-lift rounded-2xl border border-rose-200 bg-rose-50/40 p-5 shadow-sm dark:border-rose-500/20 dark:bg-rose-950/20 sm:p-7 animate-fade-up delay-300">
            <div class="max-w-2xl">
                @include('profile.partials.delete-user-form')
            </div>
        </section>
    </div>
</x-app-layout>
