@extends('layouts.app')
@section('title', 'Edit Event | UCMS')
@section('page-title', 'Edit Event')
@section('eyebrow', 'Event management')

@section('content')
    <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data" class="space-y-6 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
        @csrf @method('PUT')
        @include('events.form', ['event' => $event])
    </form>
@endsection