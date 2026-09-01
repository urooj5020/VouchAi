<x-app-layout>
    <div x-data="{
        open: false,
        isSubmitting: false,
        accent: '#4F46E5',
        presets: ['#4F46E5', '#10B981', '#F43F5E', '#F59E0B']
    }">
        <div class="space-y-6">
            <header
                class="flex flex-col gap-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600">Workspace</p>
                    <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-gray-900">Workspace Spaces</h1>
                    <p class="mt-2 max-w-2xl text-sm text-gray-600 sm:text-base">
                        Manage your brand spaces, customize public forms, and generate review widgets.
                    </p>
                </div>

                <button type="button" @click="open = true"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-200 transition hover:bg-indigo-700">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14" stroke-linecap="round" />
                    </svg>
                    Create New Space
                </button>
            </header>

            <div class="rounded-2xl border border-indigo-100 bg-indigo-50 px-4 py-3 text-sm text-indigo-700 shadow-sm">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div class="font-medium">Free Plan: Using 2 of 1 Space</div>
                    <button
                        class="text-sm font-semibold text-indigo-700 underline-offset-2 hover:underline">Upgrade</button>
                </div>
            </div>

            <main class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                <article
                    class="flex flex-col rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 text-lg font-bold text-white shadow-md shadow-indigo-200">
                                P
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Pixel Craft Studio</h2>
                            </div>
                        </div>
                        <span
                            class="rounded-full border border-gray-200 bg-gray-50 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.18em] text-gray-600">
                            Live
                        </span>
                    </div>

                    <div class="mt-4 rounded-lg bg-gray-50 px-3 py-2 text-sm text-gray-500">
                        Public slug: <span class="font-semibold text-indigo-600">/review/pixel-craft</span>
                    </div>

                    <div class="mt-5 grid grid-cols-3 gap-3 border-t border-gray-100 pt-4">
                        <div>
                            <div class="text-xs uppercase tracking-[0.15em] text-gray-500">Reviews</div>
                            <div class="mt-1 text-xl font-extrabold text-gray-900">24</div>
                        </div>
                        <div>
                            <div class="text-xs uppercase tracking-[0.15em] text-gray-500">Rating</div>
                            <div class="mt-1 text-xl font-extrabold text-gray-900">4.8 ★</div>
                        </div>
                        <div>
                            <div class="text-xs uppercase tracking-[0.15em] text-gray-500">Pending</div>
                            <div class="mt-1 text-xl font-extrabold text-gray-900">3</div>
                        </div>
                    </div>

                    <div class="mt-5 grid grid-cols-2 gap-2">
                        <button
                            class="rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm font-semibold text-gray-700 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700">
                            View Reviews
                        </button>
                        <button
                            class="rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm font-semibold text-gray-700 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700">
                            Settings
                        </button>
                        <button
                            class="col-span-2 rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm font-semibold text-gray-700 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700">
                            Widget Builder
                        </button>
                        <a href="#"
                            class="col-span-2 inline-flex items-center justify-center gap-2 rounded-lg border border-indigo-100 bg-indigo-50 px-3 py-2 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100">
                            Public Link
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 5h5v5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10 14 19 5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M19 13v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </article>

                <article
                    class="flex flex-col rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-sky-500 to-cyan-500 text-lg font-bold text-white shadow-md shadow-sky-200">
                                A
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">AlphaTech Solutions</h2>
                            </div>
                        </div>
                        <span
                            class="rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.18em] text-emerald-700">
                            Active
                        </span>
                    </div>

                    <div class="mt-4 rounded-lg bg-gray-50 px-3 py-2 text-sm text-gray-500">
                        Public slug: <span class="font-semibold text-indigo-600">/review/alphatech</span>
                    </div>

                    <div class="mt-5 grid grid-cols-3 gap-3 border-t border-gray-100 pt-4">
                        <div>
                            <div class="text-xs uppercase tracking-[0.15em] text-gray-500">Reviews</div>
                            <div class="mt-1 text-xl font-extrabold text-gray-900">10</div>
                        </div>
                        <div>
                            <div class="text-xs uppercase tracking-[0.15em] text-gray-500">Rating</div>
                            <div class="mt-1 text-xl font-extrabold text-gray-900">5.0 ★</div>
                        </div>
                        <div>
                            <div class="text-xs uppercase tracking-[0.15em] text-gray-500">Pending</div>
                            <div class="mt-1 text-xl font-extrabold text-gray-900">0</div>
                        </div>
                    </div>

                    <div class="mt-5 grid grid-cols-2 gap-2">
                        <button
                            class="rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm font-semibold text-gray-700 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700">
                            View Reviews
                        </button>
                        <button
                            class="rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm font-semibold text-gray-700 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700">
                            Settings
                        </button>
                        <button
                            class="col-span-2 rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm font-semibold text-gray-700 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700">
                            Widget Builder
                        </button>
                        <a href="#"
                            class="col-span-2 inline-flex items-center justify-center gap-2 rounded-lg border border-indigo-100 bg-indigo-50 px-3 py-2 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100">
                            Public Link
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 5h5v5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10 14 19 5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M19 13v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </article>

                <button type="button" @click="open = true"
                    class="flex min-h-[320px] flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 p-6 text-center text-gray-500 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600">
                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-full border-2 border-dashed border-current text-3xl font-light">
                        +</div>
                    <div class="mt-4 text-lg font-semibold">Create New Space</div>
                    <div class="mt-1 text-sm text-gray-500">Add a new workspace for a brand or product.</div>
                </button>
            </main>
        </div>

        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="open = false"
            class="fixed inset-0 z-50 flex items-center justify-center overflow-hidden bg-slate-900/35 px-4 py-6 backdrop-blur-[2px]"
            aria-modal="true" role="dialog">
            <div @click.stop
                class="max-h-[calc(100vh-3rem)] w-full max-w-[520px] overflow-y-auto rounded-[28px] border border-slate-200 bg-white/95 p-5 shadow-[0_28px_80px_rgba(15,23,42,0.22)] ring-1 ring-slate-200/70 dark:border-slate-700 dark:bg-slate-800/95 dark:ring-slate-700/80 sm:p-6">
                <div
                    class="mb-5 overflow-hidden rounded-[22px] border border-slate-200 bg-gradient-to-r from-slate-50 via-white to-indigo-50 shadow-sm dark:border-slate-700 dark:from-slate-900 dark:via-slate-900 dark:to-indigo-950/60">
                    <div class="flex items-center justify-between gap-3 px-3 py-2.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-500 text-white shadow-md shadow-indigo-200/80 ring-4 ring-white/70 dark:shadow-indigo-950/40 dark:ring-slate-900/60">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M12 5v14M5 12h14" stroke-linecap="round" />
                                </svg>
                            </div>

                            <div>
                                <div
                                    class="text-[10px] font-semibold uppercase tracking-[0.2em] text-indigo-600 dark:text-indigo-400">
                                    Workspace
                                </div>
                                <h2 class="text-sm font-semibold text-slate-800 dark:text-slate-100">Create New Space
                                </h2>
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
                </div>

                <div class="mb-5">
                    <h2 class="text-[1.7rem] font-bold tracking-[-0.04em] text-slate-900 dark:text-white">Create New
                        Space</h2>
                    <p class="mt-1.5 text-sm text-slate-500 dark:text-slate-300">Set up a brand workspace to collect and
                        manage client reviews.</p>
                </div>

                <form class="mt-6 space-y-4" method="POST" action="#">
                    @csrf

                    <div>
                        <label for="space_name"
                            class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-200">Space Name</label>
                        <input id="space_name" type="text" value="Pixel Craft Studio" required
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-3 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white dark:placeholder:text-slate-500" />
                    </div>

                    <div>
                        <label for="space_slug"
                            class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-200">Public URL
                            Slug</label>
                        <div
                            class="flex items-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50 transition focus-within:border-indigo-500 focus-within:bg-white focus-within:ring-3 focus-within:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-900">
                            <span
                                class="flex items-center border-r border-slate-200 bg-slate-100 px-3 py-2.5 text-sm text-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">vouchai.com/review/</span>
                            <input id="space_slug" type="text" value="pixel-craft" required
                                class="w-full border-0 bg-transparent px-3.5 py-2.5 text-sm text-slate-900 outline-none placeholder:text-slate-400 dark:text-white dark:placeholder:text-slate-500" />
                        </div>
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">This is the unique link you will send
                            to
                            clients.</p>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-200">Accent
                            Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" x-model="accent" value="#4F46E5"
                                class="h-11 w-14 cursor-pointer rounded-lg border border-slate-200 bg-white p-1 shadow-sm dark:border-slate-700 dark:bg-slate-900"
                                aria-label="Accent color picker" />
                            <div class="flex items-center gap-2">
                                <template x-for="color in presets" :key="color">
                                    <button type="button" @click="accent = color" :style="'background-color: ' + color"
                                        :class="{ 'ring-2 ring-indigo-500 ring-offset-2 dark:ring-offset-slate-800': accent === color }"
                                        class="h-7 w-7 rounded-full border border-white shadow-sm transition hover:scale-105"
                                        aria-label="Choose accent color"></button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="space_title"
                            class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-200">Header
                            Title</label>
                        <input id="space_title" type="text" value="Share your experience with us"
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-3 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white dark:placeholder:text-slate-500" />
                    </div>

                    <div>
                        <label for="logo_upload"
                            class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-200">Logo
                            Upload</label>
                        <label for="logo_upload"
                            class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 px-4 py-8 text-center transition hover:border-indigo-300 hover:bg-indigo-50 dark:border-slate-700 dark:bg-slate-900/70 dark:hover:border-indigo-500 dark:hover:bg-indigo-500/10">
                            <svg class="h-8 w-8 text-slate-400 dark:text-slate-500" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <path d="M7 16.5A3.5 3.5 0 0 1 10.5 13h4A3.5 3.5 0 1 1 17 19.5H7A3.5 3.5 0 0 1 7 16.5z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 13V5m0 0l-2.5 2.5M12 5l2.5 2.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span class="mt-3 text-sm font-medium text-slate-700 dark:text-slate-200">Upload logo</span>
                            <span class="mt-1 text-xs text-slate-500 dark:text-slate-400">PNG, JPG up to 2MB</span>
                            <input id="logo_upload" type="file" class="sr-only" />
                        </label>
                    </div>

                    <div
                        class="flex items-center justify-end gap-3 border-t border-slate-200 pt-4 dark:border-slate-700">
                        <button type="button" @click="open = false"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                            Cancel
                        </button>

                        <button type="submit" :disabled="isSubmitting"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-200 transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-75 dark:shadow-indigo-500/20">
                            <svg x-show="isSubmitting" x-cloak class="h-4 w-4 animate-spin" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"
                                    stroke-linecap="round" />
                            </svg>
                            <span x-text="isSubmitting ? 'Creating...' : 'Create Space'" aria-live="polite"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>