<div {{ $attributes->merge(['class' => 'space-y-5']) }}>
    <a href="{{ route('auth.google') }}"
        class="flex w-full items-center justify-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:shadow active:scale-[0.99] dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
        <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" aria-hidden="true">
            <path fill="#4285F4"
                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.36 5.36 0 0 1-2.33 3.52v2.9h3.78c2.08-1.92 3.19-4.74 3.19-8.43z" />
            <path fill="#34A853"
                d="M12 23.33c2.97 0 5.46-.98 7.28-2.66l-3.77-2.9c-1.06.71-2.42 1.13-3.5 1.13-2.69 0-4.97-1.82-5.78-4.26H2.38v3a10.66 10.66 0 0 0 9.62 5.69z" />
            <path fill="#FBBC05"
                d="M6.23 14.64a6.32 6.32 0 0 1 0-4.04v-3H2.38a10.67 10.67 0 0 0 0 9.57l3.85-2.53z" />
            <path fill="#EA4335"
                d="M12 5.51c1.63 0 3.1.56 4.25 1.66l3.37-3.37A10.64 10.64 0 0 0 12 .67 10.66 10.66 0 0 0 2.38 6.37l3.85 3a6.39 6.39 0 0 1 5.77-3.86z" />
        </svg>
        Continue with Google
</a>

    <div class="relative">
        <div class="absolute inset-0 flex items-center">
            <span class="w-full border-t border-slate-200 dark:border-slate-700"></span>
        </div>
        <div class="relative flex justify-center">
            <span class="bg-white/90 px-3 text-xs font-medium uppercase tracking-wider text-slate-400 dark:bg-slate-900/85 dark:text-slate-500">or</span>
        </div>
    </div>
</div>