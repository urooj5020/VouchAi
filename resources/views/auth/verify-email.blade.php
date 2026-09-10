<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-teal-600 dark:text-teal-300">Verify email</p>
        <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Almost there</h2>
    </div>

    <div class="mb-4 text-sm leading-6 text-gray-600 dark:text-slate-300">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-sm font-medium text-emerald-700">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full">
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:border-teal-300 hover:text-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:border-teal-500/50 dark:hover:text-teal-300 dark:focus:ring-offset-slate-900">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>