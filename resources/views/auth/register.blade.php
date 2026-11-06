@extends('layouts.guest')

@section('title', 'Register | UCMS')

@section('content')
    <div class="mx-auto grid max-w-6xl gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:gap-12">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-900/5 lg:p-10">
            <div class="mb-8 text-sm text-slate-500">
                <nav class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="transition hover:text-slate-900">Home</a>
                    <span>/</span>
                    <span class="font-medium text-slate-900">Register</span>
                </nav>
            </div>

            <div class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-700">
                <span class="h-2 w-2 rounded-full bg-indigo-600"></span>
                Create a student account
            </div>

            <h1 class="mt-5 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Join the university community.</h1>
            <p class="mt-3 max-w-lg text-slate-600">Register once and use UCMS to find clubs, join activities, and keep your certificates in one secure place.</p>

            <div class="mt-8 rounded-3xl bg-slate-50 p-5">
                <p class="text-sm font-semibold text-slate-700">Who should register here?</p>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Students can self-register. Club leaders and administrators are provisioned by the university and receive elevated access after approval.
                </p>
            </div>
        </section>

        <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-900/5 lg:p-10">
            <div class="mb-6 flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-600">Register</p>
                    <h2 class="mt-2 text-2xl font-bold text-slate-950">Create your account</h2>
                </div>
                <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-blue-700">Student</span>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Full name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10" placeholder="Your full name">
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10" placeholder="name@university.edu">
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                        <input id="password" type="password" name="password" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10" placeholder="Create a password">
                    </div>
                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Confirm password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10" placeholder="Repeat password">
                    </div>
                </div>

                <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-500">
                    Create account
                </button>
            </form>
        </section>
    </div>
@endsection