<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'UCMS'))</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <div class="relative isolate overflow-hidden">
        <div class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-[32rem] bg-gradient-to-br from-blue-50 via-white to-indigo-50"></div>
        <div class="pointer-events-none absolute -top-24 right-0 -z-10 h-72 w-72 rounded-full bg-emerald-200/40 blur-3xl"></div>
        <div class="pointer-events-none absolute top-40 left-0 -z-10 h-72 w-72 rounded-full bg-blue-200/50 blur-3xl"></div>

        <header class="mx-auto flex w-full max-w-7xl items-center justify-between px-4 py-6 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 text-lg font-bold text-white shadow-lg shadow-blue-500/25">U</span>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-blue-600">UCMS</p>
                    <p class="text-sm text-slate-500">University Club Management System</p>
                </div>
            </a>

            <nav class="flex items-center gap-3 text-sm font-medium">
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-full bg-slate-900 px-4 py-2 text-white shadow-sm transition hover:bg-slate-800">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-full px-4 py-2 text-slate-700 transition hover:bg-white hover:text-slate-900 hover:shadow-sm">Login</a>
                    <a href="{{ route('register') }}" class="rounded-full bg-blue-600 px-4 py-2 text-white shadow-sm transition hover:bg-blue-500">Register</a>
                @endauth
            </nav>
        </header>

        <main class="mx-auto w-full max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>