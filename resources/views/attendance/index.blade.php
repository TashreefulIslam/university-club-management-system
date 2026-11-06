@extends('layouts.app')
@section('title', 'Attendance | UCMS')
@section('page-title', 'Attendance')
@section('eyebrow', 'Attendance management')

@section('content')
    <form method="POST" action="{{ route('attendance.store', $event) }}" class="space-y-6 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        <div class="overflow-hidden rounded-3xl border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500"><tr><th class="px-5 py-4">Student</th><th class="px-5 py-4">Status</th></tr></thead>
                <tbody class="divide-y divide-slate-200 bg-white">@forelse($registrations as $registration)<tr><td class="px-5 py-4 font-semibold">{{ $registration->user->name }}</td><td class="px-5 py-4"><select name="attendance[{{ $registration->id }}]" class="rounded-2xl border border-slate-300 bg-slate-50 px-4 py-2"><option value="present">Present</option><option value="absent">Absent</option><option value="late">Late</option></select></td></tr>@empty<tr><td colspan="2" class="px-5 py-16 text-center">No approved registrations found.</td></tr>@endforelse</tbody>
            </table>
        </div>
        <button class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white">Save Attendance</button>
    </form>
@endsection