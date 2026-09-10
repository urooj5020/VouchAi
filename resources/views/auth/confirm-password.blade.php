<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-300">Confirm access</p>
        <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Secure area</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-slate-300">
            {{ __('Please confirm your password before continuing.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1 block" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">
            {{ __('Confirm') }}
        </x-primary-button>
    </form>
</x-guest-layout>