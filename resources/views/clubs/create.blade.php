@extends('layouts.app')
@section('title', 'Create Club | UCMS')
@section('page-title', 'Create Club')
@section('eyebrow', 'Club management')

@section('content')
    <form method="POST" action="{{ route('clubs.store') }}" enctype="multipart/form-data" class="space-y-6 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
        @csrf
        @include('clubs.form', ['club' => null])
    </form>
@endsection