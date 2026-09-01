<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VouchAI - AI-Powered Testimonials</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-50 text-gray-800 font-sans dark:bg-slate-950 dark:text-slate-100">
    <div
        class="min-h-screen flex flex-col justify-between bg-[radial-gradient(circle_at_top,_rgba(99,102,241,0.12),transparent_35%),linear-gradient(to_bottom,_#f8fafc_0%,_#eef2ff_100%)] dark:bg-[radial-gradient(circle_at_top,_rgba(99,102,241,0.18),transparent_30%),linear-gradient(to_bottom,_#020617_0%,_#0f172a_100%)]">
        <header
            class="sticky top-0 z-50 w-full border-b border-slate-200/80 bg-white/75 backdrop-blur-md transition-colors duration-200 dark:border-slate-800/80 dark:bg-slate-900/75">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3.5 sm:px-6 lg:px-8">

                <!-- Brand Logo -->
                <a href="/"
                    class="group flex items-center gap-2.5 text-xl font-black tracking-tight text-slate-900 transition hover:opacity-90 dark:text-white">
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 text-white shadow-md shadow-indigo-500/20 transition group-hover:scale-105">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span>Vouch<span class="text-indigo-600 dark:text-indigo-400">AI</span></span>
                </a>

                <!-- Navigation Links & Theme Control -->
                <nav class="flex items-center gap-2 sm:gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="rounded-full px-4 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-indigo-400">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="rounded-full px-4 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-indigo-400">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="inline-flex items-center gap-1.5 rounded-full bg-indigo-600 px-4 py-1.5 text-xs font-semibold text-white shadow-md shadow-indigo-500/20 transition hover:bg-indigo-700 active:scale-95 dark:shadow-indigo-500/10">
                                    <span>Get Started</span>
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            @endif
                        @endauth
                    @endif

                    <!-- Theme Toggle Button -->
                    <button type="button" data-theme-toggle
                        class="inline-flex h-8 items-center gap-1.5 rounded-full border border-slate-200/80 bg-slate-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-slate-600 shadow-xs transition hover:border-slate-300 hover:bg-white hover:text-slate-900 active:scale-95 dark:border-slate-800 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-700 dark:hover:bg-slate-700 dark:hover:text-slate-200"
                        aria-label="Toggle theme">
                        <!-- Theme Mode Label -->
                        <span data-theme-label>Dark</span>

                        <!-- Theme Toggle Icon Indicator -->
                        <svg data-theme-icon-light class="hidden h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v2.25m0 13.5V21m8.966-8.966h-2.25m-13.5 0H3m15.364 6.364l-1.591-1.591M6.758 6.758L5.167 5.167m12.879 0l-1.591 1.591M6.758 17.242l-1.591 1.591M12 18a6 6 0 100-12 6 6 0 000 12z" />
                        </svg>
                        <svg data-theme-icon-dark class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                        </svg>
                    </button>
                </nav>

            </div>
        </header>
        <main class="my-auto">
            <div class="max-w-4xl mx-auto text-center px-6 py-12">
                <span
                    class="inline-block px-3 py-1 text-xs font-semibold text-indigo-700 bg-indigo-100 rounded-full uppercase tracking-wider mb-4 dark:bg-indigo-500/10 dark:text-indigo-300">
                    AI-Powered Social Proof
                </span>
                <h1
                    class="text-4xl sm:text-6xl font-extrabold text-gray-900 tracking-tight leading-tight mb-6 dark:text-white">
                    Turn Client Reviews into High-Converting Marketing Content
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto mb-8 dark:text-slate-300">
                    Collect testimonials seamlessly, let AI extract catchy pull-quotes and social media drafts, and
                    embed customizable widgets anywhere on your website.
                </p>

                <div class="flex justify-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg rounded-xl shadow-lg transition">Go
                            to Dashboard</a>
                    @else
                        <a href="{{ route('register') }}"
                            class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg rounded-xl shadow-lg transition">Start
                            Free Trial</a>
                        <a href="#features"
                            class="px-6 py-3 bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-bold text-lg rounded-xl shadow transition dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">Learn
                            More</a>
                    @endauth
                </div>
            </div>

            <div id="features" class="max-w-7xl mx-auto px-6 py-16">
                <div class="grid md:grid-cols-3 gap-8">
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 dark:bg-slate-900/80">
                        <div
                            class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center font-bold text-xl mb-4 dark:bg-indigo-500/10 dark:text-indigo-300">
                            1</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 dark:text-white">Dedicated Form Links</h3>
                        <p class="text-gray-600 text-sm dark:text-slate-300">Send clients a branded public page to leave
                            verified star ratings, text, and photos quickly.</p>
                    </div>

                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 dark:bg-slate-900/80">
                        <div
                            class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center font-bold text-xl mb-4 dark:bg-indigo-500/10 dark:text-indigo-300">
                            2</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 dark:text-white">AI Insights Engine</h3>
                        <p class="text-gray-600 text-sm dark:text-slate-300">Automated sentiment tagging, 1-line quote
                            highlights, and pre-written posts for LinkedIn and X.</p>
                    </div>

                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 dark:bg-slate-900/80">
                        <div
                            class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center font-bold text-xl mb-4 dark:bg-indigo-500/10 dark:text-indigo-300">
                            3</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 dark:text-white">Embed Anywhere</h3>
                        <p class="text-gray-600 text-sm dark:text-slate-300">Generate copy-paste iframe code to display
                            your best reviews on your website as grids or carousels.</p>
                    </div>
                </div>
            </div>
        </main>

        <footer
            class="w-full max-w-7xl mx-auto px-6 py-6 border-t border-gray-200 text-center text-sm text-gray-500 dark:border-slate-700 dark:text-slate-400">
            <p>&copy; {{ date('Y') }} VouchAI. Built with Laravel Breeze.</p>
        </footer>
    </div>
</body>

</html>