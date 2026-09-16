<x-app-layout>


    <div class=" max-w-9xl mx-auto space-y-6">
        <!-- header  -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <nav class="flex text-sm font-medium text-gray-500 mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2">
                        <li>
                            <a href="{{ route('spaces') }}" class="hover:text-teal-600 transition">Spaces</a>
                        </li>
                        <li>/</li>
                        <li>
                            <a href="{{ route('spaces') }}"
                                class="hover:text-teal-600 transition">{{ $spaceInfo->name }}</a>
                        </li>
                        <li>/</li>
                        <li class="text-gray-900 font-semibold dark:text-gray-200">Settings</li>
                    </ol>
                </nav>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    Space Settings
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Customize your public review collection page branding, copy, and visual identity.
                </p>
            </div>

            <!-- Header Action -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('review.post', ['slug' => $spaceInfo->slug, 'id' => $spaceInfo->space_id]) }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition shadow-sm">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Public Form Link
                </a>
                <x-share-button :name="$spaceInfo->name"
                    :url="route('review.post', ['slug' => $spaceInfo->slug, 'id' => $spaceInfo->space_id])" />
            </div>
        </div>
        <!-- Form Section 1: General Branding -->
        <div
            class="card-lift bg-white dark:bg-gray-800 shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700 p-6">
            <div class="flex items-center gap-3 mb-1">
                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-teal-500 to-cyan-600 text-white shadow-md shadow-teal-500/25">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                        General Branding
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Manage how your workspace identity appears across public review forms and widgets.
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('space.settings.update', $spaceInfo) }}" enctype="multipart/form-data"
                class="mt-6 space-y-6">
                @csrf
                @method('PATCH')
                <!-- Space Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        {{ $spaceInfo->name }}
                    </label>
                    <input type="text" id="name" name="name" value="{{ $spaceInfo->name }}"
                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200 focus:border-teal-500 focus:ring-teal-500/30 shadow-sm text-sm transition"
                        placeholder="e.g. Pixel Craft Studio">
                </div>

                <!-- Public Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Public Form Link
                    </label>
                    <div class="flex rounded-xl shadow-sm overflow-hidden">
                        <span
                            class="inline-flex items-center px-3 border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-sm">
                            vouchai.com/review/
                        </span>
                        <input type="text" id="slug" name="slug" value="{{ $spaceInfo->slug }}"
                            class="flex-1 min-w-0 block w-full rounded-none border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200 focus:border-teal-500 focus:ring-teal-500/30 text-sm">
                    </div>
                </div>

                <!-- Logo Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Brand Logo
                    </label>
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-16 h-16 rounded-xl bg-teal-50 dark:bg-gray-700 flex items-center justify-center border border-gray-200 dark:border-gray-600 overflow-hidden">
                            <img src="{{ asset('storage/' . $spaceInfo->logo_path) }}" alt="{{ $spaceInfo->name }} logo"
                                class="max-h-full w-full rounded-lg object-cover">
                        </div>
                        <div class="flex items-center space-x-3">
                            <label
                                class="cursor-pointer bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium py-2 px-3 rounded-lg text-sm shadow-sm transition inline-flex items-center gap-2">
                                <svg class="h-4 w-4 text-teal-600 dark:text-teal-300" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 9.75 9.75 3H15l6 6v9A2.25 2.25 0 0 1 18.75 21H5.25A2.25 2.25 0 0 1 3 18.75V9.75Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 9.75h6V3M14.25 21 12 15.75 9.75 21M12 15.75V12" />
                                </svg>
                                Change Logo
                                <input type="file" name="logo_path" class="hidden">
                            </label>
                            <button type="button" class="text-sm text-red-600 hover:text-red-700 font-medium">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Accent Color Picker -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Accent Color
                    </label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="accent_color" value="{{ $spaceInfo->accent_color }}"
                            class="h-10 w-14 rounded-lg border border-gray-300 cursor-pointer bg-transparent transition hover:border-teal-400">
                        <div class="flex space-x-2">
                            <button type="button"
                                class="w-7 h-7 rounded-full bg-teal-500 ring-2 ring-offset-2 ring-teal-500 transition hover:scale-110"></button>
                            <button type="button"
                                class="w-7 h-7 rounded-full bg-emerald-500 transition hover:scale-110 hover:opacity-80"></button>
                            <button type="button"
                                class="w-7 h-7 rounded-full bg-rose-500 transition hover:scale-110 hover:opacity-80"></button>
                            <button type="button"
                                class="w-7 h-7 rounded-full bg-amber-500 transition hover:scale-110 hover:opacity-80"></button>
                            <button type="button"
                                class="w-7 h-7 rounded-full bg-cyan-500 transition hover:scale-110 hover:opacity-80"></button>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Form Section 2: Public Review Form Copy -->
        <div
            class="card-lift bg-white dark:bg-gray-800 shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700 p-6">
            <div class="flex items-center gap-3 mb-1">
                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-500 to-teal-600 text-white shadow-md shadow-cyan-500/25">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                        Review Collection Page Copy
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Customize the main headings and instructions shown to your clients when leaving feedback.
                    </p>
                </div>
            </div>

            <div class="mt-6 space-y-6">
                <!-- Header Title -->
                <div>
                    <label for="header_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Page Title
                    </label>
                    <input type="text" id="header_title" name="header_title" value="{{ $spaceInfo->header_title }}"
                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200 focus:border-teal-500 focus:ring-teal-500/30 shadow-sm text-sm transition">
                </div>

                <!-- Header Subtitle -->
                <div>
                    <label for="header_subtitle"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Custom Subtitle / Instructions
                    </label>
                    <textarea id="header_subtitle" rows="3"
                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200 focus:border-teal-500 focus:ring-teal-500/30 shadow-sm text-sm transition">Your feedback helps us grow and improve our services. Please take a minute to let us know how we did!</textarea>
                </div>
            </div>
        </div>

        <!-- Sticky Save Action Bar -->
        <div
            class="flex items-center justify-end space-x-4 bg-white dark:bg-gray-800 p-4 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
            <a href="{{ route('spaces') }}"
                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 transition">
                Cancel
            </a>
            <button type="submit"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 text-white font-semibold rounded-xl shadow-md shadow-teal-500/20 transition active:scale-95 text-sm">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                Save Changes
            </button>
        </div>
        </form>

        <!-- Section 3: Danger Zone -->
        <div class="bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-800 sm:rounded-2xl p-6">
            <div class="flex items-center gap-3 mb-1">
                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-300">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-red-700 dark:text-red-400">
                        Danger Zone
                    </h3>
                    <p class="text-sm text-red-600 dark:text-red-300">
                        Permanently remove this space and all associated testimonials, ratings, and AI insights. This
                        action cannot be undone.
                    </p>
                </div>
            </div>
            <form method="POST" action="{{ route('space.destroy', $spaceInfo) }}"
                onsubmit="return confirm('Delete this space and its reviews?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg text-sm shadow-sm shadow-red-500/20 transition active:scale-95">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    Delete Space
                </button>
            </form>
        </div>

    </div>
</x-app-layout>