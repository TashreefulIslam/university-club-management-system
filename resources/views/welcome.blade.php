@extends('layouts.guest')

@section('title', 'UCMS | University Club Management System')

@section('content')
    <div class="grid items-center gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:gap-14">
        <section>
            <div class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-white px-4 py-2 text-sm font-medium text-blue-700 shadow-sm">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                Production-ready student engagement platform
            </div>

            <h2 class="mt-6 max-w-3xl text-4xl font-black leading-tight tracking-tight text-slate-950 sm:text-5xl lg:text-6xl">
                Centralize clubs, events, attendance, and certificates for your university.
            </h2>

            <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-600">
                UCMS gives administrators, club leaders, and students a single secure portal to manage club membership,
                event registrations, attendance tracking, gallery media, and certificate issuance.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:bg-blue-500">
                    Register as Student
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-800 shadow-sm transition hover:border-slate-400 hover:text-slate-950">
                    Sign in
                </a>
            </div>

            <div class="mt-10 grid gap-4 sm:grid-cols-3">
                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-semibold text-blue-700">Clubs</p>
                    <p class="mt-2 text-2xl font-bold text-slate-950">Browse</p>
                    <p class="mt-1 text-sm text-slate-500">Discover campus communities in one place.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-semibold text-indigo-700">Events</p>
                    <p class="mt-2 text-2xl font-bold text-slate-950">Register</p>
                    <p class="mt-1 text-sm text-slate-500">Join workshops, meetings, and university events.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-semibold text-emerald-700">Certificates</p>
                    <p class="mt-2 text-2xl font-bold text-slate-950">Download</p>
                    <p class="mt-1 text-sm text-slate-500">Issue verified PDFs after attendance is confirmed.</p>
                </div>
            </div>
        </section>

        <aside class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-2xl shadow-slate-900/5 lg:p-8">
            <div class="rounded-3xl bg-gradient-to-br from-slate-950 to-slate-800 p-6 text-white shadow-lg">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">System overview</p>
                        <h3 class="mt-2 text-2xl font-bold">Built for a real university workflow</h3>
                    </div>
                    <div class="rounded-2xl bg-white/10 p-3">
                        <svg class="h-6 w-6 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M5 12l4 4L19 6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>

                <div class="mt-6 space-y-4 text-sm text-slate-300">
                    <div class="flex items-center justify-between rounded-2xl bg-white/5 px-4 py-3">
                        <span>Role-based access control</span>
                        <span class="rounded-full bg-emerald-400/15 px-3 py-1 text-emerald-300">Enabled</span>
                    </div>
                    <div class="flex items-center justify-between rounded-2xl bg-white/5 px-4 py-3">
                        <span>Secure password recovery</span>
                        <span class="rounded-full bg-blue-400/15 px-3 py-1 text-blue-300">Ready</span>
                    </div>
                    <div class="flex items-center justify-between rounded-2xl bg-white/5 px-4 py-3">
                        <span>PDF certificate generation</span>
                        <span class="rounded-full bg-indigo-400/15 px-3 py-1 text-indigo-300">Ready</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm font-semibold text-slate-600">Super Admin</p>
                    <p class="mt-2 text-lg font-bold text-slate-950">Govern the platform</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm font-semibold text-slate-600">Club Leader</p>
                    <p class="mt-2 text-lg font-bold text-slate-950">Manage one club</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5 sm:col-span-2">
                    <p class="text-sm font-semibold text-slate-600">Student</p>
                    <p class="mt-2 text-lg font-bold text-slate-950">Join clubs and register for events</p>
                </div>
            </div>
        </aside>
    </div>
@endsection

                
