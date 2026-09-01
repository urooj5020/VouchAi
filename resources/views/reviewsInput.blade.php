<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600 dark:text-indigo-400">Customer
            feedback</p>
        <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Leave a review</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-slate-300">We’d love to hear how your experience went.</p>
    </div>

    <form method="POST" action="#" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" class="dark:text-slate-200" />
            <x-text-input id="name"
                class="mt-1 block dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-400"
                type="text" name="name" placeholder="Your full name" required />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="dark:text-slate-200" />
            <x-text-input id="email"
                class="mt-1 block dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-400"
                type="email" name="email" placeholder="you@example.com" required />
        </div>

        <div>
            <x-input-label for="review" :value="__('Review')" class="dark:text-slate-200" />
            <textarea id="review" name="review" rows="5" placeholder="Write your review here..."
                class="mt-1 block w-full rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-400 dark:focus:border-indigo-500 dark:focus:ring-indigo-900"
                required></textarea>
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Submit Review') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>