<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'VouchAI') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-50 text-gray-900 dark:bg-slate-950 dark:text-slate-100">
    <div
        class="min-h-screen bg-[radial-gradient(ellipse_at_top,_rgba(20,184,166,0.10),transparent_40%),linear-gradient(to_bottom,_#f8fafc_0%,_#f0fdf9_100%)] dark:bg-[radial-gradient(ellipse_at_top,_rgba(13,148,136,0.18),transparent_40%),linear-gradient(160deg,_#020617_0%,_#042f2e_100%)]">
        @include('layouts.navigation')

        @isset($header)
            <header
                class="border-b border-gray-200 bg-white/80 backdrop-blur-sm dark:border-slate-700 dark:bg-slate-900/80">
                <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
    </div>
</body>

</html>