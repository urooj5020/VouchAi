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
    <div class="relative min-h-screen flex flex-col justify-between overflow-hidden
        bg-[radial-gradient(ellipse_at_top,_rgba(20,184,166,0.12),transparent_45%),linear-gradient(to_bottom,_#f8fafc_0%,_#f0fdf9_100%)]
        dark:bg-[radial-gradient(ellipse_at_top,_rgba(13,148,136,0.20),transparent_45%),linear-gradient(160deg,_#020617_0%,_#042f2e_100%)]">

        <!-- Ambient floating gradient orbs -->
        <div class="orb animate-float-slow h-72 w-72 -left-16 top-24 bg-teal-300/50 dark:bg-teal-500/20"></div>
        <div class="orb h-80 w-80 -right-20 top-1/3 bg-cyan-300/50 dark:bg-cyan-500/20"
            style="animation: float-slow 16s ease-in-out infinite reverse;"></div>
        <div class="orb h-64 w-64 left-1/3 bottom-10 bg-emerald-300/40 dark:bg-emerald-500/15 animate-float-slow"
            style="animation-delay: 3s;"></div>
        <header
            class="sticky top-0 z-50 w-full border-b border-slate-200/80 bg-white/75 backdrop-blur-md transition-colors duration-200 dark:border-slate-800/80 dark:bg-slate-900/75">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3.5 sm:px-6 lg:px-8">

                <!-- Brand Logo -->
                <a href="/"
                    class="group flex items-center gap-2.5 text-xl font-black tracking-tight text-slate-900 transition hover:opacity-90 dark:text-white">
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tr from-teal-600 to-cyan-600 text-white shadow-md shadow-teal-500/20 transition group-hover:scale-105">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span>Vouch<span class="text-teal-600 dark:text-teal-300">AI</span></span>
                </a>

                <!-- Navigation Links & Theme Control -->
                <nav class="flex items-center gap-2 sm:gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="rounded-full px-4 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100 hover:text-teal-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-teal-300">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="rounded-full px-4 py-2 text-xs font-semibold dark:!text-white text-slate-700 transition hover:bg-slate-100 hover:text-teal-600 dark:hover:bg-slate-800 dark:hover:text-teal-300">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="inline-flex items-center gap-1.5 rounded-full bg-gradient-to-r from-teal-600 to-cyan-600 px-4 py-2 text-xs font-semibold text-white shadow-md shadow-teal-500/20 transition hover:from-teal-700 hover:to-cyan-700 active:scale-95 dark:shadow-teal-500/10">
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
                        <!-- <span data-theme-label>Dark</span> -->

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
        <main class="my-auto relative">
            <div class="max-w-4xl mx-auto text-center px-6 py-12">
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold text-teal-700 bg-teal-100 rounded-full uppercase tracking-wider mb-4 shadow-sm dark:bg-teal-500/15 dark:text-teal-300 animate-fade-up">
                    <span class="relative flex h-2 w-2">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-teal-500 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-teal-500"></span>
                    </span>
                    AI-Powered Social Proof
                </span>
                <h1
                    class="text-4xl sm:text-6xl font-extrabold text-gray-900 tracking-tight leading-tight mb-6 dark:text-white animate-fade-up delay-100">
                    Turn Client Reviews into <span
                        class="bg-gradient-to-r from-teal-600 via-cyan-600 to-emerald-600 bg-clip-text text-transparent dark:from-teal-300 dark:via-cyan-300 dark:to-emerald-300">High-Converting</span>
                    Marketing Content
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto mb-8 dark:text-slate-300 animate-fade-up delay-200">
                    Collect testimonials seamlessly, let AI extract catchy pull-quotes and social media drafts, and
                    embed customizable widgets anywhere on your website.
                </p>

                <div class="flex justify-center gap-4 animate-fade-up delay-300">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 text-white font-bold text-lg rounded-xl shadow-lg shadow-teal-500/20 transition active:scale-95 hover:shadow-xl hover:shadow-teal-500/30 animate-pulse-glow">
                            Go to Dashboard
                            <svg class="h-5 w-5 transition group-hover:translate-x-1" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 text-white font-bold text-lg rounded-xl shadow-lg shadow-teal-500/20 transition active:scale-95 hover:shadow-xl hover:shadow-teal-500/30 animate-pulse-glow">
                            Start Free Trial
                            <svg class="h-5 w-5 transition group-hover:translate-x-1" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                        <a href="#features"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-gray-300 hover:border-teal-300 hover:bg-gray-50 text-gray-700 font-bold text-lg rounded-xl shadow transition active:scale-95 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                            Learn More</a>
                    @endauth
                </div>
            </div>

            <div id="features" class="max-w-7xl mx-auto px-6 py-16">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span
                        class="inline-block px-3 py-1 text-xs font-semibold text-teal-700 bg-teal-100 rounded-full uppercase tracking-wider mb-3 dark:bg-teal-500/15 dark:text-teal-300">Why VouchAI</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight dark:text-white">Everything you need to turn feedback into growth</h2>
                    <p class="mt-3 text-gray-600 dark:text-slate-300">Three simple steps from collecting reviews to publishing beautiful social proof.</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div
                        class="card-lift group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 dark:bg-slate-900/80 animate-fade-up">
                        <div
                            class="relative w-12 h-12 bg-gradient-to-br from-teal-500 to-cyan-600 text-white rounded-xl flex items-center justify-center font-bold text-xl mb-4 shadow-md shadow-teal-500/25 transition group-hover:scale-110 group-hover:-rotate-6">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 dark:text-white">Dedicated Form Links</h3>
                        <p class="text-gray-600 text-sm dark:text-slate-300">Send clients a branded public page to leave
                            verified star ratings, text, and photos quickly.</p>
                    </div>

                    <div
                        class="card-lift group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 dark:bg-slate-900/80 animate-fade-up delay-100">
                        <div
                            class="relative w-12 h-12 bg-gradient-to-br from-cyan-500 to-teal-600 text-white rounded-xl flex items-center justify-center font-bold text-xl mb-4 shadow-md shadow-cyan-500/25 transition group-hover:scale-110 group-hover:-rotate-6">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423L16.5 15.75l.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 dark:text-white">AI Insights Engine</h3>
                        <p class="text-gray-600 text-sm dark:text-slate-300">Automated sentiment tagging, 1-line quote
                            highlights, and pre-written posts for LinkedIn and X.</p>
                    </div>

                    <div
                        class="card-lift group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 dark:bg-slate-900/80 animate-fade-up delay-200">
                        <div
                            class="relative w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 text-white rounded-xl flex items-center justify-center font-bold text-xl mb-4 shadow-md shadow-emerald-500/25 transition group-hover:scale-110 group-hover:-rotate-6">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 dark:text-white">Embed Anywhere</h3>
                        <p class="text-gray-600 text-sm dark:text-slate-300">Generate copy-paste iframe code to display
                            your best reviews on your website as grids or carousels.</p>
                    </div>
                </div>
            </div>

            <!-- CTA Banner -->
            <div class="max-w-5xl mx-auto px-6 pb-16">
                <div
                    class="card-lift relative overflow-hidden rounded-3xl bg-gradient-to-br from-teal-600 via-cyan-600 to-emerald-600 p-10 text-center shadow-2xl shadow-teal-500/30 animate-fade-up">
                    <div class="orb h-40 w-40 -right-10 -top-10 bg-white/20"></div>
                    <div class="orb h-40 w-40 -left-10 -bottom-10 bg-white/10"></div>
                    <div class="relative">
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Ready to turn reviews into revenue?</h2>
                        <p class="mt-3 text-lg text-teal-50/90 max-w-xl mx-auto">Join businesses collecting verified testimonials and publishing them with AI-powered polish.</p>
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="mt-8 inline-flex items-center gap-2 rounded-xl bg-white px-7 py-3 text-base font-bold text-teal-700 shadow-lg transition hover:bg-teal-50 active:scale-95">
                                Open Dashboard
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                                class="mt-8 inline-flex items-center gap-2 rounded-xl bg-white px-7 py-3 text-base font-bold text-teal-700 shadow-lg transition hover:bg-teal-50 active:scale-95">
                                Get Started Free
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </main>

        <footer
            class="w-full max-w-7xl mx-auto px-6 py-8 border-t border-gray-200 text-center text-sm text-gray-500 dark:border-slate-700 dark:text-slate-400">
            <p>&copy; {{ date('Y') }} VouchAI. Built with Laravel Breeze.</p>
        </footer>
    </div>
</body>

</html>