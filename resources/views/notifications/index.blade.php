@extends('layouts.app')
@section('title', 'Notifications | UCMS')
@section('page-title', 'Notifications')
@section('eyebrow', 'System notifications')

@section('content')
    <div class="space-y-6">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm text-slate-500">Unread</p>
            <p class="mt-2 text-3xl font-black text-slate-950">{{ $unreadCount }}</p>
        </div>
        <div class="space-y-4">
            @forelse($notifications as $notification)
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="font-semibold text-slate-950">{{ $notification->data['title'] ?? 'Notification' }}</p>
                            <p class="mt-1 text-sm text-slate-500">{{ $notification->data['message'] ?? '' }}</p>
                        </div>
                        @if(is_null($notification->read_at))
                            <form method="POST" action="{{ route('notifications.read', $notification->id) }}">@csrf @method('PATCH')<button class="rounded-full bg-blue-600 px-4 py-2 text-xs font-semibold text-white">Mark read</button></form>
                        @else
                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">Read</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center shadow-sm">
                    <p class="text-lg font-semibold text-slate-900">No notifications yet</p>
                </div>
            @endforelse
        </div>
        {{ $notifications->links() }}
    </div>
@endsection