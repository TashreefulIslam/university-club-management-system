@extends('layouts.app')
@section('title', 'Certificates | UCMS')
@section('page-title', 'Certificates')
@section('eyebrow', 'Certificate generation')

@section('content')
    <div class="space-y-6">
        @if($eligibleRegistrations->isNotEmpty())
            <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
                    <h3 class="text-lg font-semibold text-slate-900">Eligible for certificate</h3>
                    <p class="text-sm text-slate-600">Approved registrations marked as present and not yet issued.</p>
                </div>
                <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                    <thead class="bg-white text-xs uppercase tracking-[0.2em] text-slate-500">
                        <tr>
                            <th class="px-5 py-4">Student</th>
                            <th class="px-5 py-4">Event</th>
                            <th class="px-5 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @foreach($eligibleRegistrations as $registration)
                            <tr>
                                <td class="px-5 py-4 font-semibold">{{ $registration->user->name }}</td>
                                <td class="px-5 py-4">{{ $registration->event->title }}</td>
                                <td class="px-5 py-4">
                                    <form method="POST" action="{{ route('certificates.issue', ['event' => $registration->event, 'registration' => $registration]) }}">
                                        @csrf
                                        <button class="rounded-full bg-emerald-600 px-4 py-2 text-xs font-semibold text-white">Issue certificate</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
                <h3 class="text-lg font-semibold text-slate-900">Issued certificates</h3>
            </div>
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-white text-xs uppercase tracking-[0.2em] text-slate-500">
                    <tr>
                        <th class="px-5 py-4">Certificate #</th>
                        <th class="px-5 py-4">Student</th>
                        <th class="px-5 py-4">Event</th>
                        <th class="px-5 py-4">Issued</th>
                        <th class="px-5 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($certificates as $certificate)
                        <tr>
                            <td class="px-5 py-4 font-semibold">{{ $certificate->certificate_number }}</td>
                            <td class="px-5 py-4">{{ $certificate->user->name }}</td>
                            <td class="px-5 py-4">{{ $certificate->event->title }}</td>
                            <td class="px-5 py-4">{{ $certificate->issued_at?->format('d M Y') }}</td>
                            <td class="px-5 py-4">
                                <a href="{{ route('certificates.download', $certificate) }}" class="rounded-full bg-blue-600 px-4 py-2 text-xs font-semibold text-white">Download</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-16 text-center">No certificates generated yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $certificates->links() }}
    </div>
@endsection