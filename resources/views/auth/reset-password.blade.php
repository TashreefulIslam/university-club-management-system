@extends('layouts.guest')

@section('title', 'Reset Password | UCMS')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-900/5 lg:p-10">
            <div class="mb-8 text-sm text-slate-500">
                <nav class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="transition hover:text-slate-900">Home</a>
                    <span>/</span>
                    <a href="{{ route('login') }}" class="transition hover:text-slate-900">Login</a>
                    <span>/</span>
                    <span class="font-medium text-slate-900">Reset password</span>
                </nav>
            </div>

            <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-4 py-2 text-sm font-medium text-blue-700">
                <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                Set a new secure password
            </div>

            <h1 class="mt-5 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Choose a new password.</h1>

            @if ($errors->any())
                <div class="mt-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="mt-8 space-y-5">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">New password</label>
                        <input id="password" type="password" name="password" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                    </div>
                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Confirm password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                    </div>
                </div>

                <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:bg-blue-500">
                    Reset password
                </button>
            </form>
        </div>
    </div>
@endsection