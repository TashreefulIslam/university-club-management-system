<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationReviewRequest;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventRegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        if ($user->isSuperAdmin()) {
            $registrations = EventRegistration::query()->with(['event.club', 'user', 'reviewer', 'attendance'])->latest()->paginate(12)->withQueryString();
        } elseif ($user->isClubLeader()) {
            $clubIds = $user->clubMemberships()->pluck('club_id');
            // alternatively use clubs where advisor_id == user id
            $registrations = EventRegistration::query()->with(['event.club', 'user', 'reviewer', 'attendance'])
                ->whereHas('event.club', fn($q) => $q->where('advisor_id', $user->id))
                ->latest()->paginate(12)->withQueryString();
        } else {
            $registrations = EventRegistration::query()->with(['event.club', 'user', 'reviewer', 'attendance'])->where('user_id', $user->id)->latest()->paginate(12)->withQueryString();
        }

        return view('registrations.index', compact('registrations'));
    }

    public function store(Request $request, Event $event): RedirectResponse
    {
        $request->user()->eventRegistrations()->updateOrCreate(
            ['event_id' => $event->id],
            [
                'status' => EventRegistration::STATUS_PENDING,
                'registered_at' => now(),
            ]
        );

        return back()->with('success', 'Event registration submitted successfully.');
    }

    public function updateReview(RegistrationReviewRequest $request, Event $event, $registration): RedirectResponse
    {
        $data = $request->validated();

        $registration = EventRegistration::query()
            ->where('event_id', $event->id)
            ->findOrFail($registration);

        $user = $request->user();

        if (! $user->isSuperAdmin()) {
            // club leaders can only manage registrations for their own club's events
            if (! $user->isClubLeader() || $registration->event->club->advisor_id !== $user->id) {
                abort(403);
            }
        }

        $attendanceStatus = $data['remarks'] ?? 'absent';

        $registration->update([
            'status' => $data['status'],
            'remarks' => $attendanceStatus,
            'reviewed_by' => $user->id,
            'reviewed_at' => now(),
        ]);

        if ($data['status'] === EventRegistration::STATUS_APPROVED) {
            Attendance::query()->updateOrCreate(
                ['event_registration_id' => $registration->id],
                [
                    'marked_by' => $user->id,
                    'status' => $attendanceStatus,
                    'marked_at' => now(),
                    'remarks' => $attendanceStatus,
                ]
            );
        } else {
            $registration->attendance()->delete();
        }

        return back()->with('success', 'Registration reviewed successfully.');
    }

    public function destroy(Request $request, EventRegistration $registration): RedirectResponse
    {
        $routeName = $request->route()?->getName();

        // If this is the user-cancel route, only allow owner
        if ($routeName === 'registrations.cancel') {
            if ($registration->user_id !== $request->user()->id) {
                abort(403);
            }

            $registration->delete();

            return back()->with('success', 'Registration cancelled successfully.');
        }

        // Otherwise this is an admin delete - allow super admin or club leader of the event
        $user = $request->user();

        if ($user->isSuperAdmin() || ($user->isClubLeader() && $registration->event->club->advisor_id === $user->id)) {
            $registration->delete();

            return back()->with('success', 'Registration removed successfully.');
        }

        abort(403);
    }
}