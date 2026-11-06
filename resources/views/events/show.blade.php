@extends('layouts.app')
@section('title', $event->title.' | UCMS')
@section('page-title', $event->title)
@section('eyebrow', 'Event details')

@section('content')
    <div class="space-y-6">
        <nav class="text-sm text-slate-500"><ol class="flex flex-wrap items-center gap-2"><li><a href="{{ route('events.index') }}" class="transition hover:text-slate-900">Events</a></li><li>/</li><li class="font-medium text-slate-900">{{ $event->title }}</li></ol></nav>

        <section class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-600">{{ $event->club?->name }}</p>
                <h2 class="mt-2 text-3xl font-black text-slate-950">{{ $event->title }}</h2>
                <p class="mt-4 text-slate-600">{{ $event->description }}</p>
            </div>
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm space-y-3">
                <p class="text-sm text-slate-500">Venue: <span class="font-semibold text-slate-900">{{ $event->venue }}</span></p>
                <p class="text-sm text-slate-500">Date: <span class="font-semibold text-slate-900">{{ $event->event_date?->format('d M Y') }}</span></p>
                <p class="text-sm text-slate-500">Time: <span class="font-semibold text-slate-900">{{ $event->start_time?->format('H:i') }} - {{ $event->end_time?->format('H:i') }}</span></p>
                <p class="text-sm text-slate-500">Status: <span class="font-semibold text-slate-900">{{ ucfirst($event->status) }}</span></p>
                @if(auth()->user()->isStudent())
                    <form method="POST" action="{{ route('events.register', $event) }}">@csrf<button class="w-full rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white">Register for Event</button></form>
                @endif
            </div>
        </section>
    </div>
@endsection