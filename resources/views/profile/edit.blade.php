<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-600">Account</p>
            <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                {{ __('Profile') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-6 py-6">
        <div class="rounded-3xl border border-gray-200 bg-white p-4 shadow-sm sm:p-8">
            <div class="max-w-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="rounded-3xl border border-gray-200 bg-white p-4 shadow-sm sm:p-8">
            <div class="max-w-2xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="rounded-3xl border border-gray-200 bg-white p-4 shadow-sm sm:p-8">
            <div class="max-w-2xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>