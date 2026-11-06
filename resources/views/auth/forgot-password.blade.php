@extends('layouts.guest')

@section('title', 'Forgot Password | UCMS')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-2xl shadow-slate-900/5 lg:p-10">
            <div class="mb-8 text-sm text-slate-500">
                <nav class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="transition hover:text-slate-900">Home</a>
                    <span>/</span>
                    <a href="{{ route('login') }}" class="transition hover:text-slate-900">Login</a>
                    <span>/</span>
                    <span class="font-medium text-slate-900">Forgot password</span>
                </nav>
            </div>

            <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-4 py-2 text-sm font-medium text-emerald-700">
                <span class="h-2 w-2 rounded-full bg-emerald-600"></span>
                Reset access with your university email
            </div>

            <h1 class="mt-5 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Forgot your password?</h1>
            <p class="mt-3 max-w-xl text-slate-600">Enter your email address and we will send you a secure reset link.</p>

            @if (session('status'))
                <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mt-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-5">
                @csrf

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10" placeholder="name@university.edu">
                </div>

                <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-500/20 transition hover:bg-emerald-500">
                    Send reset link
                </button>
            </form>
        </div>
    </div>
@endsection