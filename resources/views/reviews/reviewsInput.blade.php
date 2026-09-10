<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leave a Review - {{ $space->name }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts / Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="min-h-screen bg-slate-950 text-slate-100 font-sans antialiased flex items-center justify-center p-4 sm:p-6 lg:p-8 relative overflow-x-hidden">

    <!-- Background Radial Glow Effect -->
    <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-600/15 rounded-full blur-3xl pointer-events-none">
    </div>

    <!-- Wide Full Card Container -->
    <div
        class="relative w-full max-w-2xl bg-slate-900/90 backdrop-blur-2xl border border-slate-800 rounded-3xl p-8 sm:p-10 shadow-2xl shadow-indigo-950/80">

        <!-- Header Section -->
        <div class="text-center mb-8">
            <div
                class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl border border-indigo-500/20 bg-indigo-500/10 text-indigo-400 shadow-inner">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
            </div>
            <p class="text-xs font-extrabold uppercase tracking-widest text-indigo-400">{{ $space->name }}</p>
            <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">{{ $space->header_title }}
            </h1>
            <p class="mt-2 text-sm text-slate-400">Share your experience with {{ $space->name }}.</p>
        </div>

        <!-- Form Matching Your Migration (name, email, designation, content) -->
        <form method="POST" action="{{ route('review.store', ['space' => $space->space_id]) }}" class="space-y-6">
            @csrf

            <!-- Grid Row: Name & Email Side-by-Side on Desktop -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-200 mb-2">Name <span
                            class="text-indigo-400">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your full name"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-slate-700/80 bg-slate-950/70 text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 focus:outline-none transition text-sm">
                    @error('name')
                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-200 mb-2">Email <span
                            class="text-indigo-400">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-slate-700/80 bg-slate-950/70 text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 focus:outline-none transition text-sm">
                    @error('email')
                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Designation -->
            <div>
                <label for="designation" class="block text-sm font-semibold text-slate-200 mb-2">Designation <span
                        class="text-indigo-400">*</span></label>
                <input type="text" id="designation" name="designation" value="{{ old('designation') }}"
                    placeholder="e.g. Founder at AlphaTech" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-700/80 bg-slate-950/70 text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 focus:outline-none transition text-sm">
                @error('designation')
                    <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-semibold text-slate-200 mb-2">Review <span
                        class="text-indigo-400">*</span></label>
                <textarea id="content" name="review_content" rows="5" placeholder="Write your detailed feedback here..."
                    required
                    class="w-full px-4 py-3 rounded-xl border border-slate-700/80 bg-slate-950/70 text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 focus:outline-none transition text-sm">{{ old('review_content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Vibrant Gradient Submit Button -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-indigo-600 via-indigo-500 to-violet-600 hover:from-indigo-500 hover:to-violet-500 active:scale-[0.99] text-white font-bold text-base rounded-xl shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 transition-all duration-200 cursor-pointer">
                    <span>Submit Review</span>
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </form>

        <!-- Footer Branding -->
        <div class="mt-8 pt-6 border-t border-slate-800 text-center">
            <p class="text-xs text-slate-500">
                Powered by <a href="/" class="font-bold text-indigo-400 hover:text-indigo-300 transition">VouchAI</a>
            </p>
        </div>
    </div>

</body>

</html>