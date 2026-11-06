@extends('layouts.app')
@section('title', 'Gallery | UCMS')
@section('page-title', 'Club Gallery')
@section('eyebrow', 'Gallery management')

@section('content')
    <div class="space-y-6">
        <form method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data" class="space-y-4 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">@csrf<div class="grid gap-4 lg:grid-cols-3"><div><label class="mb-2 block text-sm font-semibold">Club</label><select name="club_id" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3">@foreach($clubs as $club)<option value="{{ $club->id }}">{{ $club->name }}</option>@endforeach</select></div><div><label class="mb-2 block text-sm font-semibold">Caption</label><input name="caption" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div><div><label class="mb-2 block text-sm font-semibold">Image</label><input type="file" name="image" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div></div><button class="rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white">Upload</button></form>
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse($galleries as $gallery)
                <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($gallery->image_path) }}" alt="{{ $gallery->caption }}" class="h-56 w-full object-cover">
                    <div class="p-5">
                        <p class="font-semibold">{{ $gallery->caption ?? 'Untitled' }}</p>
                        <p class="text-sm text-slate-500">{{ $gallery->club->name }}</p>
                    </div>
                </div>
            @empty
                <div class="rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center shadow-sm md:col-span-2 xl:col-span-3">No gallery items yet.</div>
            @endforelse
        </div>
        {{ $galleries->links() }}
    </div>
@endsection