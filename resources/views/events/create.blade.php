@extends('layouts.app')
@section('title', 'Create Event | UCMS')
@section('page-title', 'Create Event')
@section('eyebrow', 'Event management')

@section('content')
    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="space-y-6 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
        @csrf
        @include('events.form', ['event' => null])
    </form>
@endsection