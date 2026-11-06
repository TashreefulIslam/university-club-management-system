@extends('layouts.app')
@section('title', 'Registrations | UCMS')
@section('page-title', 'Event Registrations')
@section('eyebrow', 'Registration workflow')

@section('content')
    <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500"><tr><th class="px-5 py-4">Student</th><th class="px-5 py-4">Event</th><th class="px-5 py-4">Status</th><th class="px-5 py-4">Registered</th><th class="px-5 py-4">Remarks</th><th class="px-5 py-4">Action</th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse($registrations as $registration)
                    <tr>
                        <td class="px-5 py-4 font-semibold">{{ $registration->user->name }}</td>
                        <td class="px-5 py-4">{{ $registration->event->title }}</td>
                        <td class="px-5 py-4">{{ ucfirst($registration->status) }}</td>
                        <td class="px-5 py-4">{{ $registration->registered_at?->format('d M Y, h:i A') }}</td>
                        <td class="px-5 py-4">{{ $registration->remarks ?? '-' }}</td>
                        <td class="px-5 py-4">
                            @if(auth()->user()->isSuperAdmin() || (auth()->user()->isClubLeader() && auth()->user()->id === $registration->event->club->advisor_id))
                                <form method="POST" action="{{ route('registrations.review', ['event' => $registration->event, 'registration' => $registration]) }}" class="inline-flex flex-wrap items-center gap-2">
                                    @csrf
                                    <select name="remarks" class="rounded-2xl border border-slate-300 bg-slate-50 px-3 py-2 text-sm">
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                        <option value="late">Late</option>
                                    </select>
                                    <button name="status" value="approved" class="rounded-2xl bg-emerald-600 px-3 py-2 text-sm font-semibold text-white">Approve</button>
                                    <button name="status" value="declined" class="rounded-2xl bg-rose-600 px-3 py-2 text-sm font-semibold text-white">Decline</button>
                                </form>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-16 text-center">No registrations found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $registrations->links() }}
@endsection