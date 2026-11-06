@extends('layouts.app')
@section('title', 'Edit Club | UCMS')
@section('page-title', 'Edit Club')
@section('eyebrow', 'Club management')

@section('content')
    <form method="POST" action="{{ route('clubs.update', $club) }}" enctype="multipart/form-data" class="space-y-6 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
        @csrf
        @method('PUT')
        @include('clubs.form', ['club' => $club])
    </form>
@endsection