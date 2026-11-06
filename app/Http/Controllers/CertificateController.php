<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Certificate;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function index()
    {
        $query = Certificate::query()->with(['user', 'event.club', 'issuer'])->latest();

        if (! auth()->user()?->isSuperAdmin() && ! auth()->user()?->isClubLeader()) {
            $query->where('user_id', auth()->id());
        }

        $certificates = $query->paginate(12);

        $eligibleRegistrations = EventRegistration::query()
            ->with(['user', 'event'])
            ->where('status', EventRegistration::STATUS_APPROVED)
            ->where('remarks', 'present')
            ->whereHas('attendance', fn ($query) => $query->where('status', 'present'))
            ->whereDoesntHave('attendance.certificate')
            ->latest()
            ->get();

        return view('certificates.index', compact('certificates', 'eligibleRegistrations'));
    }

    public function store(Event $event, Attendance $attendance): RedirectResponse
    {
        abort_unless($attendance->registration->event_id === $event->id, 404);
        abort_unless($attendance->status === 'present', 403, 'Certificate can only be issued for present attendees.');

        $certificateNumber = 'UCMS-'.Str::upper(Str::random(10));
        $user = $attendance->registration->user;

        $pdf = Pdf::loadView('certificates.pdf', [
            'certificateNumber' => $certificateNumber,
            'user' => $user,
            'event' => $event,
        ]);

        $pdfPath = 'certificates/'.$certificateNumber.'.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        Certificate::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'attendance_id' => $attendance->id,
            'issued_by' => request()->user()->id,
            'certificate_number' => $certificateNumber,
            'pdf_path' => $pdfPath,
            'issued_at' => now(),
            'status' => 'issued',
        ]);

        return redirect()->route('certificates.index')->with('success', 'Certificate generated successfully.');
    }

    public function issueFromRegistration(Event $event, EventRegistration $registration): RedirectResponse
    {
        abort_unless($registration->event_id === $event->id, 404);
        abort_unless($registration->status === EventRegistration::STATUS_APPROVED, 403, 'Only approved registrations can receive certificates.');
        abort_unless($registration->remarks === 'present', 403, 'Certificates can only be issued for present attendees.');

        $attendance = $registration->attendance;
        abort_unless($attendance, 404, 'Attendance has not been recorded for this registration yet.');
        abort_if(Certificate::query()->where('attendance_id', $attendance->id)->exists(), 409, 'Certificate already issued for this attendee.');

        $certificateNumber = 'UCMS-'.Str::upper(Str::random(10));
        $pdf = Pdf::loadView('certificates.pdf', [
            'certificateNumber' => $certificateNumber,
            'user' => $registration->user,
            'event' => $event,
        ]);

        $pdfPath = 'certificates/'.$certificateNumber.'.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        Certificate::create([
            'user_id' => $registration->user_id,
            'event_id' => $event->id,
            'attendance_id' => $attendance->id,
            'issued_by' => request()->user()->id,
            'certificate_number' => $certificateNumber,
            'pdf_path' => $pdfPath,
            'issued_at' => now(),
            'status' => 'issued',
        ]);

        return redirect()->route('certificates.index')->with('success', 'Certificate generated successfully.');
    }

    public function download(Certificate $certificate)
    {
        $user = auth()->user();

        if (! ($user->isSuperAdmin() || $user->isClubLeader() || $certificate->user_id === $user->id)) {
            abort(403);
        }

        $filePath = Storage::disk('public')->path($certificate->pdf_path);

        if (! file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath, $certificate->certificate_number.'.pdf');
    }
}