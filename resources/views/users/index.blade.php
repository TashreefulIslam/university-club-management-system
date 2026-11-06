@extends('layouts.app')
@section('title', 'Users | UCMS')
@section('page-title', 'Manage Users')
@section('eyebrow', 'User management')

@section('content')
    <div class="space-y-6">
        <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500">
                    <tr>
                        <th class="px-5 py-4">Name</th>
                        <th class="px-5 py-4">Email</th>
                        <th class="px-5 py-4">Role</th>
                        <th class="px-5 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($users as $user)
                        <tr>
                            <td class="px-5 py-4 font-semibold">{{ $user->name }}</td>
                            <td class="px-5 py-4">{{ $user->email }}</td>
                            <td class="px-5 py-4">
                                <form method="POST" action="{{ route('users.role', $user) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" class="rounded-2xl border border-slate-300 bg-slate-50 px-3 py-2">
                                        <option value="{{ \App\Models\User::ROLE_STUDENT }}" @selected($user->role === \App\Models\User::ROLE_STUDENT)>Student</option>
                                        <option value="{{ \App\Models\User::ROLE_CLUB_LEADER }}" @selected($user->role === \App\Models\User::ROLE_CLUB_LEADER)>Club Leader</option>
                                        <option value="{{ \App\Models\User::ROLE_SUPER_ADMIN }}" @selected($user->role === \App\Models\User::ROLE_SUPER_ADMIN)>Super Admin</option>
                                    </select>
                                    <button class="ml-2 rounded-2xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white">Save</button>
                                </form>
                            </td>
                            <td class="px-5 py-4">
                                @if(auth()->user()->id !== $user->id)
                                    <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-2xl bg-rose-600 px-4 py-2 text-sm font-semibold text-white">Delete</button>
                                    </form>
                                @else
                                    <button class="rounded-2xl bg-slate-200 px-4 py-2 text-sm font-semibold text-slate-700" disabled>Cannot delete self</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-5 py-16 text-center">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $users->links() }}
    </div>
@endsection
