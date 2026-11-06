<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Club;
use App\Models\ClubMember;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $profileFields = collect([
            $user?->profile_photo_path,
            $user?->phone,
            $user?->department,
            $user?->batch,
            $user?->bio,
        ]);

        $profileCompletion = (int) round(($profileFields->filter()->count() / max($profileFields->count(), 1)) * 100);

        $cards = [
            ['label' => 'Total Clubs', 'value' => Club::count(), 'color' => 'blue'],
            ['label' => 'Total Members', 'value' => ClubMember::count(), 'color' => 'indigo'],
            ['label' => 'Upcoming Events', 'value' => Event::query()->where('status', 'upcoming')->count(), 'color' => 'emerald'],
            ['label' => 'Certificates Generated', 'value' => Certificate::count(), 'color' => 'slate'],
        ];

        if ($user?->isStudent()) {
            $cards = [
                ['label' => 'My Clubs', 'value' => ClubMember::query()->where('user_id', $user->id)->count(), 'color' => 'blue'],
                ['label' => 'Registered Events', 'value' => EventRegistration::query()->where('user_id', $user->id)->count(), 'color' => 'indigo'],
                ['label' => 'Upcoming Events', 'value' => Event::query()->where('status', 'upcoming')->count(), 'color' => 'emerald'],
                ['label' => 'Certificates', 'value' => Certificate::query()->where('user_id', $user->id)->count(), 'color' => 'slate'],
            ];
        }

        return view('dashboard', [
            'user' => $user,
            'profileCompletion' => $profileCompletion,
            'cards' => $cards,
        ]);
    }
}