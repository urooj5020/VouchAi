<x-app-layout>
    <div x-data="{
        open: false,
        isSubmitting: false,
        accent: '#78350F',
        presets: ['#78350F', '#92400E', '#F43F5E', '#F59E0B'],
        logoPreview: '',
        errors: {},
        error: '',
        previewLogo(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => this.logoPreview = e.target.result;
            reader.readAsDataURL(file);
        },
        async submitForm(event) {
            this.errors = {};
            this.error = '';
            this.isSubmitting = true;

            const token = document.querySelector('meta[name=\'csrf-token\']')?.content || '';

            try {
                const response = await fetch(event.target.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                    },
                    body: new FormData(event.target),
                });

                if (response.status === 422) {
                    const data = await response.json();
                    for (const [field, messages] of Object.entries(data.errors || {})) {
                        this.errors[field] = messages[0];
                    }
                    return;
                }

                if (!response.ok) {
                    this.error = 'Something went wrong. Please try again.';
                    return;
                }

                window.location.reload();
            } catch (e) {
                this.error = 'Something went wrong. Please try again.';
            } finally {
                this.isSubmitting = false;
            }
        },
        openModal() {
            this.open = true;
            this.errors = {};
            this.error = '';
            this.isSubmitting = false;
            this.logoPreview = '';
        }
    }">
        <div class="space-y-6">
            <header
                class="card-lift flex flex-col gap-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-900 sm:flex-row sm:items-center sm:justify-between animate-fade-up">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-300">
                        Workspace</p>
                    <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Workspace
                        Spaces</h1>
                    <p class="mt-2 max-w-2xl text-sm text-gray-600 dark:text-slate-300 sm:text-base">
                        Manage your brand spaces, customize public forms, and generate review widgets.
                    </p>
                </div>

                <button type="button" @click="openModal()"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-teal-500/20 transition hover:from-teal-700 hover:to-cyan-700 active:scale-95">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14" stroke-linecap="round" />
                    </svg>
                    Create New Space
                </button>
            </header>

            <div
                class="rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-teal-700 shadow-sm dark:border-slate-700 dark:bg-slate-900 dark:!text-teal-200">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div class="font-medium">{{ $SpacesData->count() }}
                        {{ $SpacesData->count() === 1 ? 'space' : 'spaces' }} created
                    </div>
                    <button
                        class="text-sm font-semibold text-teal-700 underline-offset-2 hover:underline dark:text-teal-300">Upgrade</button>
                </div>
            </div>

            <main class="grid gap-6 md:grid-cols-2 xl:grid-cols-3 animate-fade-up delay-100">
                @foreach ($SpacesData as $data)

                    <article
                        class="card-lift group flex flex-col rounded-2xl border border-gray-200 bg-white p-5 shadow-sm hover:border-teal-200 dark:border-slate-700 dark:bg-slate-900 dark:hover:border-teal-500/30">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-teal-50 p-1 transition group-hover:scale-105 dark:bg-teal-500/10">
                                    <img src="{{ asset('storage/' . $data->logo_path) }}" alt="{{ $data->name }} logo"
                                        class="max-h-full w-full rounded-lg object-contain">
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ $data->name }}</h2>
                                </div>
                            </div>
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.18em] text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Live
                            </span>
                        </div>

                        <div
                            class="mt-4 rounded-lg bg-gray-50 px-3 py-2 text-sm text-gray-500 dark:bg-slate-800 dark:text-slate-400">
                            Public slug: <span
                                class="font-semibold text-teal-600 dark:text-teal-300">{{ $data->slug }}</span>
                        </div>

                        <div class="mt-5 grid grid-cols-3 gap-3 border-t border-gray-100 pt-4 dark:border-slate-800">
                            <div>
                                <div class="text-xs uppercase tracking-[0.15em] text-gray-500 dark:text-slate-400">Reviews
                                </div>
                                <div class="mt-1 text-xl font-extrabold text-gray-900 dark:text-white">
                                    {{ $data->reviews_count }}
                                </div>
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-[0.15em] text-gray-500 dark:text-slate-400">Rating
                                </div>
                                <div class="mt-1 text-xl font-extrabold text-gray-900 dark:text-white">
                                    {{ $data->reviews_count > 0 ? round(($data->positive_reviews / $data->reviews_count) * 100) : 0 }}%
                                </div>
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-[0.15em] text-gray-500 dark:text-slate-400">Pending
                                </div>
                                <div class="mt-1 text-xl font-extrabold text-gray-900 dark:text-white">
                                    {{ $data->pending_reviews }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 grid grid-cols-2 gap-2">
                            <a href="{{ route('space.review', $data->id) }}"
                                class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-semibold text-gray-700 transition hover:border-teal-300 hover:bg-teal-50 hover:text-teal-700 dark:!border-slate-700 dark:bg-slate-800 dark:!text-white dark:hover:!border-teal-500/50 dark:hover:bg-slate-900 dark:hover:text-teal-300">
                                View Reviews
                            </a>
                            <a href="{{ route('space.settings', $data->id) }}"
                                class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-semibold text-gray-700 transition hover:border-teal-300 hover:bg-teal-50 hover:text-teal-700 dark:!border-slate-700 dark:bg-slate-800 dark:!text-white dark:hover:!border-teal-500/50 dark:hover:bg-slate-900 dark:hover:text-teal-300">
                                Settings
                            </a>
                            <a href="{{ route('review.post', $data->space_id) }}"
                                class="col-span-2 inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-semibold text-gray-700 transition hover:border-teal-300 hover:bg-teal-50 hover:text-teal-700 dark:!border-slate-700 dark:bg-slate-800 dark:!text-white dark:hover:!border-teal-500/50 dark:hover:bg-slate-900 dark:hover:text-teal-300">
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

                @endforeach


                <button type="button" @click="openModal()"
                    class="card-lift flex min-h-[320px] flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50/50 p-6 text-center text-gray-500 transition hover:border-teal-400 hover:bg-teal-50/60 hover:text-teal-600 dark:border-slate-700 dark:!bg-slate-800/50 dark:text-slate-400 dark:hover:border-teal-500/60 dark:hover:bg-teal-500/10 dark:hover:text-teal-300">
                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-full border-2 border-dashed border-current text-3xl font-light transition group-hover:rotate-90">
                        +</div>
                    <div class="mt-4 text-lg font-semibold">Create New Space</div>
                    <div class="mt-1 text-sm text-gray-500 dark:text-slate-400">Add a new workspace for a brand or
                        product.</div>
                </button>
            </main>
        </div>

        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="!isSubmitting && (open = false)"
            class="fixed inset-0 z-50 flex items-center justify-center overflow-hidden bg-slate-900/35 px-4 py-6 backdrop-blur-[2px]"
            aria-modal="true" role="dialog">
            <div @click.stop
                class="theme-scrollbar max-h-[calc(100vh-3rem)] w-full max-w-[520px] overflow-y-auto rounded-[28px] border border-slate-200 bg-white/95 p-5 shadow-[0_28px_80px_rgba(15,23,42,0.22)] ring-1 ring-slate-200/70 dark:border-slate-700 dark:bg-slate-800/95 dark:ring-slate-700/80 sm:p-6">
                <div
                    class="mb-5 overflow-hidden rounded-[22px] border border-slate-200 bg-gradient-to-r from-slate-50 via-white to-teal-50 shadow-sm dark:border-slate-700 dark:from-slate-900 dark:via-slate-900 dark:to-teal-950/60">
                    <div class="flex items-center justify-between gap-3 px-3 py-2.5">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-teal-500 via-teal-600 to-cyan-600 text-white shadow-md shadow-teal-500/30 ring-4 ring-white/70 dark:shadow-teal-950/40 dark:ring-slate-900/60">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M12 5v14M5 12h14" stroke-linecap="round" />
                                </svg>
                            </div>

                            <div>
                                <div
                                    class="text-[10px] font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-300">
                                    Workspace
                                </div>
                                <h2 class="text-sm font-semibold text-slate-800 dark:text-slate-100">Create New Space
                                </h2>
                            </div>
                        </div>

                        <button type="button" @click="!isSubmitting && (open = false)" :disabled="isSubmitting"
                            class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 transition hover:border-slate-300 hover:text-slate-700 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:border-slate-600 dark:hover:text-slate-100"
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

                <form enctype="multipart/form-data" class="mt-6 space-y-4" method="POST"
                    action="{{ route('upload.space') }}" @submit.prevent="submitForm($event)">
                    @csrf

                    <p x-cloak x-show="error" x-text="error"
                        class="rounded-lg bg-red-50 px-3 py-2 text-sm font-medium text-red-600 dark:bg-red-900/20 dark:text-red-400">
                    </p>

                    <div>
                        <label for="space_name"
                            class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-200">Space Name</label>
                        <input name="name" id="space_name" type="text" value="{{ old('name') }}" required
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-teal-500 focus:bg-white focus:ring-3 focus:ring-teal-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white dark:placeholder:text-slate-500" />
                        @error('name')
                            <p x-cloak x-show="errors.name"
                                class="mt-2 flex items-center gap-1.5 text-sm font-medium text-red-600 dark:text-red-400">
                                <span aria-hidden="true">!</span>
                                <span x-text="errors.name"></span>
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="space_slug"
                            class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-200">Public URL
                            Slug</label>
                        <div
                            class="flex items-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50 transition focus-within:border-teal-500 focus-within:bg-white focus-within:ring-3 focus-within:ring-teal-500/10 dark:border-slate-700 dark:bg-slate-900">
                            <span
                                class="flex items-center border-r border-slate-200 bg-slate-100 px-3 py-2.5 text-sm text-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">vouchai.com/review/</span>
                            <input id="space_slug" type="text" name="slug" value="{{ old('slug') }}" required
                                class="w-full border-0 bg-transparent px-3.5 py-2.5 text-sm text-slate-900 outline-none placeholder:text-slate-400 dark:text-white dark:placeholder:text-slate-500" />
                        </div>
                        @error('slug')
                            <p x-cloak x-show="errors.slug"
                                class="mt-2 flex items-center gap-1.5 text-sm font-medium text-red-600 dark:text-red-400">
                                <span aria-hidden="true">!</span>
                                <span x-text="errors.slug"></span>
                            </p>
                        @enderror
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">This is the unique link you will send
                            to
                            clients.</p>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-200">Accent
                            Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" x-model="accent" name="accent_color"
                                value="{{ old('accent_color', '#14B8A6') }}"
                                class="h-11 w-14 cursor-pointer rounded-lg border border-slate-200 bg-white p-1 shadow-sm dark:border-slate-700 dark:bg-slate-900"
                                aria-label="Accent color picker" />
                            <div class="flex items-center gap-2">
                                <template x-for="color in presets" :key="color">
                                    <button type="button" @click="accent = color" :style="'background-color: ' + color"
                                        :class="{ 'ring-2 ring-teal-500 ring-offset-2 dark:ring-offset-slate-800': accent === color }"
                                        class="h-7 w-7 rounded-full border border-white shadow-sm transition hover:scale-105"
                                        aria-label="Choose accent color"></button>
                                </template>
                            </div>
                        </div>
                        @error('accent_color')
                            <p x-cloak x-show="errors.accent_color"
                                class="mt-2 flex items-center gap-1.5 text-sm font-medium text-red-600 dark:text-red-400">
                                <span aria-hidden="true">!</span>
                                <span x-text="errors.accent_color"></span>
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="space_title"
                            class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-200">Header
                            Title</label>
                        <input id="space_title" name="header_title" type="text"
                            value="{{ old('header_title', 'Share your experience with us') }}"
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-teal-500 focus:bg-white focus:ring-3 focus:ring-teal-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white dark:placeholder:text-slate-500" />
                        @error('header_title')
                            <p x-cloak x-show="errors.header_title"
                                class="mt-2 flex items-center gap-1.5 text-sm font-medium text-red-600 dark:text-red-400">
                                <span aria-hidden="true">!</span>
                                <span x-text="errors.header_title"></span>
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="logo_upload"
                            class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-200">Logo
                            Upload</label>
                        <label for="logo_upload"
                            class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 px-4 py-8 text-center transition hover:border-teal-300 hover:bg-teal-50 dark:border-slate-700 dark:bg-slate-900/70 dark:hover:border-teal-500/50 dark:hover:bg-teal-500/10">
                            <template x-if="logoPreview">
                                <img :src="logoPreview" alt="Logo preview"
                                    class="max-h-28 max-w-full rounded-xl object-contain shadow-sm" />
                            </template>
                            <template x-if="!logoPreview">
                                <div class="flex flex-col items-center">
                                    <svg class="h-8 w-8 text-slate-400 dark:text-slate-500" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path
                                            d="M7 16.5A3.5 3.5 0 0 1 10.5 13h4A3.5 3.5 0 1 1 17 19.5H7A3.5 3.5 0 0 1 7 16.5z"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12 13V5m0 0l-2.5 2.5M12 5l2.5 2.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <span class="mt-3 text-sm font-medium text-slate-700 dark:text-slate-200">Upload
                                        logo</span>
                                    <span class="mt-1 text-xs text-slate-500 dark:text-slate-400">PNG, JPG up to
                                        2MB</span>
                                </div>
                            </template>
                            <input id="logo_upload" @change="previewLogo($event)" type="file" class="sr-only"
                                name="logo_path" />
                        </label>
                        @error('logo_path')
                            <p x-cloak x-show="errors.logo_path"
                                class="mt-2 flex items-center gap-1.5 text-sm font-medium text-red-600 dark:text-red-400">
                                <span aria-hidden="true">!</span>
                                <span x-text="errors.logo_path"></span>
                            </p>
                        @enderror
                    </div>

                    <div
                        class="flex items-center justify-end gap-3 border-t border-slate-200 pt-4 dark:border-slate-700">
                        <button type="button" @click="!isSubmitting && (open = false)" :disabled="isSubmitting"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                            Cancel
                        </button>

                        <button type="submit" :disabled="isSubmitting"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-teal-500/20 transition hover:from-teal-700 hover:to-cyan-700 disabled:cursor-not-allowed disabled:opacity-75 dark:shadow-teal-500/20">
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