@extends('layouts.app')
@section('title', 'Members | UCMS')
@section('page-title', 'Manage Members')
@section('eyebrow', 'Membership management')

@section('content')
    <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500"><tr><th class="px-5 py-4">Student</th><th class="px-5 py-4">Club</th><th class="px-5 py-4">Role</th><th class="px-5 py-4">Status</th><th class="px-5 py-4">Join date</th><th class="px-5 py-4">Action</th></tr></thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse($members as $member)
                    <tr>
                        <td class="px-5 py-4 font-semibold">{{ $member->user->name }}</td>
                        <td class="px-5 py-4">{{ $member->club->name }}</td>
                        <td class="px-5 py-4">{{ str_replace('_', ' ', $member->role) }}</td>
                        <td class="px-5 py-4">{{ ucfirst($member->status) }}</td>
                        <td class="px-5 py-4">{{ $member->joined_at?->format('d M Y') }}</td>
                        <td class="px-5 py-4">
                            @if(auth()->user()->isSuperAdmin() || (auth()->user()->isClubLeader() && auth()->user()->id === $member->club->advisor_id))
                                <form method="POST" action="{{ route('members.review', $member) }}" class="inline-flex gap-2">
                                    @csrf
                                    <input type="hidden" name="remarks" value="" />
                                    <button name="status" value="approved" class="rounded-2xl bg-emerald-600 px-3 py-2 text-sm font-semibold text-white">Approve</button>
                                    <button name="status" value="declined" class="rounded-2xl bg-rose-600 px-3 py-2 text-sm font-semibold text-white">Decline</button>
                                </form>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-16 text-center">No members found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $members->links() }}
@endsection