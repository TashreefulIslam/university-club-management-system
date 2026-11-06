@extends('layouts.app')
@section('title', 'Search | UCMS')
@section('page-title', 'Search')
@section('eyebrow', 'Global search')

@section('content')
    <div class="space-y-6">
        <form class="rounded-[2rem] border border-slate-200 bg-white p-4 shadow-sm"><input type="search" name="q" value="{{ $term }}" placeholder="Search clubs, events, and students" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></form>
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm"><h2 class="text-lg font-bold">Clubs</h2><div class="mt-4 space-y-3">@forelse($clubs as $club)<div class="rounded-2xl bg-slate-50 p-4"><p class="font-semibold">{{ $club->name }}</p><p class="text-sm text-slate-500">{{ $club->short_name }}</p></div>@empty<p class="text-sm text-slate-500">No clubs found.</p>@endforelse</div></div>
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm"><h2 class="text-lg font-bold">Events</h2><div class="mt-4 space-y-3">@forelse($events as $event)<div class="rounded-2xl bg-slate-50 p-4"><p class="font-semibold">{{ $event->title }}</p><p class="text-sm text-slate-500">{{ $event->venue }}</p></div>@empty<p class="text-sm text-slate-500">No events found.</p>@endforelse</div></div>
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm"><h2 class="text-lg font-bold">Students</h2><div class="mt-4 space-y-3">@forelse($students as $student)<div class="rounded-2xl bg-slate-50 p-4"><p class="font-semibold">{{ $student->name }}</p><p class="text-sm text-slate-500">{{ $student->email }}</p></div>@empty<p class="text-sm text-slate-500">No students found.</p>@endforelse</div></div>
        </div>
    </div>
@endsection