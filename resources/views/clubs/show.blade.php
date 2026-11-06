@extends('layouts.app')
@section('title', $club->name.' | UCMS')
@section('page-title', $club->name)
@section('eyebrow', 'Club details')

@section('content')
    <div class="space-y-6">
        <nav class="text-sm text-slate-500"><ol class="flex flex-wrap items-center gap-2"><li><a href="{{ route('clubs.index') }}" class="transition hover:text-slate-900">Clubs</a></li><li>/</li><li class="font-medium text-slate-900">{{ $club->short_name }}</li></ol></nav>

        <section class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600">{{ $club->category }}</p>
                <h2 class="mt-2 text-3xl font-black text-slate-950">{{ $club->name }}</h2>
                <p class="mt-4 text-slate-600">{{ $club->description }}</p>
                <div class="mt-6 rounded-3xl bg-slate-50 p-5">
                    <p class="text-sm font-semibold text-slate-700">Mission</p>
                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ $club->mission }}</p>
                </div>
            </div>
            <div class="space-y-4">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold text-slate-500">Advisor</p>
                    <p class="mt-2 text-xl font-bold text-slate-950">{{ $club->advisor?->name ?? 'Not assigned' }}</p>
                    <p class="mt-4 text-sm text-slate-500">Members: {{ $club->members->count() }}</p>
                    <p class="text-sm text-slate-500">Events: {{ $club->events->count() }}</p>
                </div>
                @if(auth()->user()->isStudent())
                    <form method="POST" action="{{ route('clubs.join', $club) }}">
                        @csrf
                        <button class="w-full rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white">Join Club</button>
                    </form>
                @endif
            </div>
        </section>
    </div>
@endsection