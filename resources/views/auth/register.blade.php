<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600">Get started</p>
        <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900">Create your account</h2>
        <p class="mt-2 text-sm text-gray-600">Start collecting and showcasing client reviews in minutes.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="mt-1 block" type="text" name="name" :value="old('name')" required autofocus
                autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Work Email')" />
            <x-text-input id="email" class="mt-1 block" type="email" name="email" :value="old('email')" required
                autocomplete="username" placeholder="john@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1 block" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="mt-1 block" type="password" name="password_confirmation"
                required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Get Started') }}
            </x-primary-button>
        </div>

        <p class="text-center text-sm text-gray-600">
            {{ __('Already registered?') }}
            <a href="{{ route('login') }}"
                class="font-semibold text-indigo-600 hover:text-indigo-700">{{ __('Log in') }}</a>
        </p>
    </form>
</x-guest-layout>