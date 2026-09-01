<nav x-data="{ open: false, profileOpen: false }" @click.outside="open = false; profileOpen = false"
    class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/75 backdrop-blur-md transition-colors duration-200 dark:border-slate-800/80 dark:bg-slate-900/75">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4">
            <div class="flex items-center gap-6">
                <a href="{{ route('dashboard') }}"
                    class="group flex items-center gap-2 rounded-xl text-xl font-black tracking-tight text-slate-900 transition hover:opacity-90 dark:text-white">
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 text-white shadow-md shadow-indigo-500/20 transition group-hover:scale-105">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span>Vouch<span class="text-indigo-600 dark:text-indigo-400">AI</span></span>
                </a>
            </div>

            <div class="hidden items-center gap-2 rounded-full border border-gray-200 bg-gray-50 p-1 md:flex">
                <a href="#"
                    class="rounded-full px-3 py-1.5 text-sm font-medium text-gray-600 transition hover:bg-white hover:text-gray-900">Dashboard</a>
                <a href="#"
                    class="rounded-full bg-indigo-50 px-3 py-1.5 text-sm font-semibold text-indigo-700 shadow-sm">Spaces</a>
                <a href="#"
                    class="rounded-full px-3 py-1.5 text-sm font-medium text-gray-600 transition hover:bg-white hover:text-gray-900">Settings</a>
            </div>

            <div class="hidden items-center gap-3 sm:flex">
                <button type="button" data-theme-toggle
                    class="relative inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200/80 bg-white text-slate-600 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-900 active:scale-95 dark:border-slate-800 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-700 dark:hover:bg-slate-700 dark:hover:text-slate-200"
                    aria-label="Toggle theme">
                    <svg data-theme-icon class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v2.25m0 13.5V21m8.966-8.966h-2.25m-13.5 0H3m15.364 6.364l-1.591-1.591M6.758 6.758L5.167 5.167m12.879 0l-1.591 1.591M6.758 17.242l-1.591 1.591M12 18a6 6 0 100-12 6 6 0 000 12z" />
                    </svg>
                </button>

                <span
                    class="inline-flex items-center gap-1.5 rounded-full border border-indigo-200/60 bg-indigo-50/50 px-3 py-1 text-[11px] font-bold tracking-wider uppercase text-indigo-700 dark:border-indigo-500/20 dark:bg-indigo-500/10 dark:text-indigo-300">
                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                    Pro Workspace
                </span>

                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center gap-2.5 rounded-full border border-slate-200/80 bg-white p-1 pr-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-800 dark:bg-slate-800 dark:text-slate-200 dark:hover:border-slate-700 dark:hover:bg-slate-700/50">
                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-full bg-gradient-to-tr from-indigo-600 to-violet-600 text-xs font-bold text-white shadow-xs">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                                <span class="max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="border-b border-slate-100 px-4 py-2 dark:border-slate-800">
                                <p class="text-xs text-slate-500 dark:text-slate-400">Signed in as</p>
                                <p class="truncate text-sm font-semibold text-slate-900 dark:text-white">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>

                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    class="flex items-center gap-2 text-rose-600 hover:text-rose-700 dark:text-rose-400 dark:hover:text-rose-300"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12" />
                                    </svg>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="flex items-center gap-2 sm:hidden">
                <button type="button" data-theme-toggle
                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200/80 bg-white text-slate-600 shadow-sm transition active:scale-95 dark:border-slate-800 dark:bg-slate-800 dark:text-slate-300"
                    aria-label="Toggle theme">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v2.25m0 13.5V21m8.966-8.966h-2.25m-13.5 0H3m15.364 6.364l-1.591-1.591M6.758 6.758L5.167 5.167m12.879 0l-1.591 1.591M6.758 17.242l-1.591 1.591M12 18a6 6 0 100-12 6 6 0 000 12z" />
                    </svg>
                </button>

                <button @click="open = ! open"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200/80 bg-white text-slate-600 shadow-sm transition active:scale-95 dark:border-slate-800 dark:bg-slate-800 dark:text-slate-300">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open}" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="border-b border-slate-200 bg-white/95 px-4 pt-2 pb-4 shadow-lg sm:hidden dark:border-slate-800 dark:bg-slate-900/95">
        <div class="mb-3 flex items-center gap-3 border-b border-slate-100 px-2 pb-3 dark:border-slate-800">
            <span
                class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </span>
            <div class="overflow-hidden">
                <p class="truncate text-sm font-semibold text-slate-900 dark:text-white">{{ Auth::user()->name }}</p>
                <p class="truncate text-xs text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}"
                class="mt-2 border-t border-slate-100 pt-2 dark:border-slate-800">
                @csrf
                <x-responsive-nav-link :href="route('logout')" class="text-rose-600 dark:text-rose-400"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>