@extends('layouts.guest')

@section('title', 'Login | UCMS')

@section('content')
    <div class="mx-auto grid max-w-6xl gap-8 lg:grid-cols-[0.95fr_1.05fr] lg:gap-12">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-900/5 lg:p-10">
            <div class="mb-8 text-sm text-slate-500">
                <nav class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="transition hover:text-slate-900">Home</a>
                    <span>/</span>
                    <span class="font-medium text-slate-900">Login</span>
                </nav>
            </div>

            <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-4 py-2 text-sm font-medium text-blue-700">
                <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                Secure sign in for university members
            </div>

            <h1 class="mt-5 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Welcome back.</h1>
            <p class="mt-3 max-w-lg text-slate-600">Use your UCMS account to continue to your dashboard, review club activity, and manage permissions.</p>

            <div class="mt-8 space-y-4">
                <div class="rounded-3xl bg-slate-50 p-5">
                    <p class="text-sm font-semibold text-slate-700">What you can do here</p>
                    <ul class="mt-3 space-y-2 text-sm text-slate-600">
                        <li>• Access your personalized dashboard</li>
                        <li>• Register for clubs and events</li>
                        <li>• Recover access with password reset</li>
                    </ul>
                </div>
                <div class="rounded-3xl border border-slate-200 p-5">
                    <p class="text-sm font-semibold text-slate-700">Need an account?</p>
                    <p class="mt-2 text-sm text-slate-500">Student registration is open. Admin and club leader accounts are managed by the university.</p>
                    <a href="{{ route('register') }}" class="mt-4 inline-flex rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Create student account</a>
                </div>
            </div>
        </section>

        <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-900/5 lg:p-10">
            <div class="mb-6 flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600">Sign In</p>
                    <h2 class="mt-2 text-2xl font-bold text-slate-950">Access UCMS</h2>
                </div>
                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">Active</span>
            </div>

            @if (session('status'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10" placeholder="name@university.edu">
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                    <input id="password" type="password" name="password" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10" placeholder="Your password">
                </div>

                <div class="flex items-center justify-between gap-4">
                    <label class="inline-flex items-center gap-3 text-sm text-slate-600">
                        <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-blue-600 transition hover:text-blue-700">Forgot password?</a>
                </div>

                <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:bg-blue-500">
                    Sign in
                </button>
            </form>
        </section>
    </div>
@endsection