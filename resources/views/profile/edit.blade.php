@extends('layouts.app')
@section('title', 'Profile | UCMS')
@section('page-title', 'Edit Profile')
@section('eyebrow', 'Student profile')

@section('content')
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
        @csrf @method('PUT')
        <div class="grid gap-5 lg:grid-cols-2">
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Name</label><input name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Email</label><input name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Phone</label><input name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Department</label><input name="department" value="{{ old('department', auth()->user()->department) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Batch</label><input name="batch" value="{{ old('batch', auth()->user()->batch) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
            <!-- <div><label class="mb-2 block text-sm font-semibold text-slate-700">Profile photo</label><input type="file" name="profile_photo" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div> -->
        </div>
        <div><label class="mb-2 block text-sm font-semibold text-slate-700">Bio</label><textarea name="bio" rows="5" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3">{{ old('bio', auth()->user()->bio) }}</textarea></div>
        <div class="grid gap-5 lg:grid-cols-2">
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">New password</label><input type="password" name="password" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
            <div><label class="mb-2 block text-sm font-semibold text-slate-700">Confirm password</label><input type="password" name="password_confirmation" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
        </div>
        <button class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white">Save Profile</button>
    </form>
@endsection