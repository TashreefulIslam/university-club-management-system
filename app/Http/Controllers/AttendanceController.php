<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(Event $event): View
    {
        $registrations = $event->registrations()->with(['user', 'attendance'])->approved()->get();

        return view('attendance.index', compact('event', 'registrations'));
    }

    public function store(AttendanceRequest $request, Event $event): RedirectResponse
    {
        foreach ($request->validated('attendance') as $registrationId => $status) {
            Attendance::query()->updateOrCreate(
                ['event_registration_id' => $registrationId],
                [
                    'marked_by' => $request->user()->id,
                    'status' => $status,
                    'marked_at' => now(),
                ]
            );
        }

        return back()->with('success', 'Attendance saved successfully.');
    }
}