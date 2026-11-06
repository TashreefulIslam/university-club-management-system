@extends('layouts.app')

@section('title', 'Dashboard | UCMS')
@section('page-title', 'Dashboard')
@section('eyebrow', 'Authenticated area')

@section('content')
    <div class="space-y-6">
        <nav class="text-sm text-slate-500">
            <ol class="flex flex-wrap items-center gap-2">
                <li><a href="{{ route('home') }}" class="transition hover:text-slate-900">Home</a></li>
                <li>/</li>
                <li class="font-medium text-slate-900">Dashboard</li>
            </ol>
        </nav>

        <section class="grid gap-4 lg:grid-cols-4">
            @foreach ($cards as $card)
                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-semibold text-slate-500">{{ $card['label'] }}</p>
                    <p class="mt-2 text-2xl font-bold text-slate-950">{{ $card['value'] }}</p>
                </div>
            @endforeach
        </section>

        <section class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600">Account overview</p>
                        <h2 class="mt-2 text-2xl font-bold text-slate-950">{{ $user->name }}</h2>
                    </div>
                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-blue-700">{{ $user->roleLabel() }}</span>
                </div>

                <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                        <tbody class="divide-y divide-slate-200 bg-white">
                            <tr>
                                <th class="w-48 px-5 py-4 font-semibold text-slate-600">Name</th>
                                <td class="px-5 py-4 text-slate-900">{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th class="px-5 py-4 font-semibold text-slate-600">Email</th>
                                <td class="px-5 py-4 text-slate-900">{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th class="px-5 py-4 font-semibold text-slate-600">Role</th>
                                <td class="px-5 py-4 text-slate-900">{{ $user->roleLabel() }}</td>
                            </tr>
                            <tr>
                                <th class="px-5 py-4 font-semibold text-slate-600">Account created</th>
                                <td class="px-5 py-4 text-slate-900">{{ $user->created_at?->format('d M Y, h:i A') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-600">Quick actions</p>
                    <h3 class="mt-2 text-xl font-bold text-slate-950">What you can do</h3>
                    
                    @if($user->isSuperAdmin())
                        <div class="mt-4 space-y-3">
                            <a href="{{ route('clubs.create') }}" class="block rounded-lg bg-blue-50 px-4 py-3 text-sm font-medium text-blue-700 hover:bg-blue-100 transition">
                                ➕ Create a new club
                            </a>
                            <a href="{{ route('events.create') }}" class="block rounded-lg bg-indigo-50 px-4 py-3 text-sm font-medium text-indigo-700 hover:bg-indigo-100 transition">
                                ➕ Create an event
                            </a>
                            <a href="{{ route('clubs.index') }}" class="block rounded-lg bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 hover:bg-emerald-100 transition">
                                👥 Manage all clubs
                            </a>
                        </div>
                    @elseif($user->isClubLeader())
                        <div class="mt-4 space-y-3">
                            <a href="{{ route('events.create') }}" class="block rounded-lg bg-indigo-50 px-4 py-3 text-sm font-medium text-indigo-700 hover:bg-indigo-100 transition">
                                ➕ Create event for your club
                            </a>
                            <a href="{{ route('registrations.index') }}" class="block rounded-lg bg-amber-50 px-4 py-3 text-sm font-medium text-amber-700 hover:bg-amber-100 transition">
                                📋 Review registrations
                            </a>
                            <a href="{{ route('galleries.index') }}" class="block rounded-lg bg-pink-50 px-4 py-3 text-sm font-medium text-pink-700 hover:bg-pink-100 transition">
                                📸 Upload media
                            </a>
                        </div>
                    @else
                        <div class="mt-4 space-y-3">
                            <a href="{{ route('clubs.index') }}" class="block rounded-lg bg-blue-50 px-4 py-3 text-sm font-medium text-blue-700 hover:bg-blue-100 transition">
                                🔍 Browse clubs
                            </a>
                            <a href="{{ route('events.index') }}" class="block rounded-lg bg-indigo-50 px-4 py-3 text-sm font-medium text-indigo-700 hover:bg-indigo-100 transition">
                                📅 Browse events
                            </a>
                            <a href="{{ route('certificates.index') }}" class="block rounded-lg bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700 hover:bg-rose-100 transition">
                                🏆 View my certificates
                            </a>
                        </div>
                    @endif
                </div>

                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-600">Profile status</p>
                    <h3 class="mt-2 text-xl font-bold text-slate-950">Complete your profile</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        Add a phone number, department, batch, and bio to complete your profile.
                    </p>

                    <div class="mt-6 rounded-3xl bg-slate-50 p-5">
                        <div class="flex items-center justify-between text-sm">
                            <span class="font-semibold text-slate-700">Current completion</span>
                            <span class="font-bold text-slate-950">{{ $profileCompletion }}%</span>
                        </div>
                        <div class="mt-3 h-3 overflow-hidden rounded-full bg-slate-200">
                            <div class="h-full rounded-full bg-gradient-to-r from-blue-600 to-emerald-500 transition-[width] duration-500" data-width="{{ $profileCompletion }}"></div>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="mt-4 inline-block rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500 transition">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection