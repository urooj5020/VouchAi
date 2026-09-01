<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'VouchAI') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-50 text-gray-900 dark:bg-slate-950 dark:text-slate-100">
    <div
        class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(99,102,241,0.12),transparent_35%),linear-gradient(to_bottom,_#f8fafc_0%,_#eef2ff_100%)] dark:bg-[radial-gradient(circle_at_top,_rgba(99,102,241,0.18),transparent_30%),linear-gradient(to_bottom,_#020617_0%,_#0f172a_100%)]">
        <div class="mx-auto flex min-h-screen max-w-md flex-col justify-center px-4 py-10 sm:px-6">
            <div
                class="mb-6 flex items-center justify-between gap-4 rounded-full border border-slate-200/80 bg-white/75 p-2 pr-2.5 shadow-sm backdrop-blur-md transition-all duration-200 dark:border-slate-800/80 dark:bg-slate-900/75">
                <!-- Brand Logo -->
                <a href="/"
                    class="group flex items-center gap-2.5 pl-2 text-xl font-black tracking-tight text-slate-900 transition hover:opacity-90 dark:text-white">
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-tr from-indigo-600 to-violet-500 text-white shadow-md shadow-indigo-500/20 transition group-hover:scale-105">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span>Vouch<span class="text-indigo-600 dark:text-indigo-400">AI</span></span>
                </a>

                <!-- Actions & Controls -->
                <div class="flex items-center gap-1.5 sm:gap-2">
                    <!-- Log in Link -->
                    <a href="{{ route('login') }}"
                        class="rounded-full px-4 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-indigo-400">
                        Log in
                    </a>

                    <!-- Get Started CTA Button -->
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-1.5 rounded-full bg-indigo-600 px-4 py-1.5 text-xs font-semibold text-white shadow-md shadow-indigo-500/20 transition hover:bg-indigo-700 active:scale-95 dark:shadow-indigo-500/10">
                        <span>Get started</span>
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>

                    <!-- Dark Mode Toggle Button -->
                    <button type="button" data-theme-toggle
                        class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-slate-200/80 bg-white text-slate-600 shadow-xs transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-900 active:scale-95 dark:border-slate-800 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-700 dark:hover:bg-slate-700 dark:hover:text-slate-200"
                        aria-label="Toggle theme">
                        <!-- Sun Icon (Dark Mode View) -->
                        <svg data-theme-icon-light class="hidden h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v2.25m0 13.5V21m8.966-8.966h-2.25m-13.5 0H3m15.364 6.364l-1.591-1.591M6.758 6.758L5.167 5.167m12.879 0l-1.591 1.591M6.758 17.242l-1.591 1.591M12 18a6 6 0 100-12 6 6 0 000 12z" />
                        </svg>
                        <!-- Moon Icon (Light Mode View) -->
                        <svg data-theme-icon-dark class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div
                class="overflow-hidden rounded-3xl border border-indigo-100 bg-white/90 p-6 shadow-[0_20px_60px_-20px_rgba(79,70,229,0.35)] backdrop-blur-sm dark:border-slate-700 dark:bg-slate-900/85 dark:shadow-[0_20px_60px_-20px_rgba(15,23,42,0.9)] sm:p-8">
                {{ $slot }}
            </div>

            <p class="mt-6 text-center text-xs font-medium text-gray-500 dark:text-slate-400">
                &copy; {{ date('Y') }} VouchAI. All rights reserved.
            </p>
        </div>
    </div>
</body>

</html>