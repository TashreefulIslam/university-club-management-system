<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ClubMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClubMemberController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        if ($user->isSuperAdmin()) {
            $members = ClubMember::query()->with(['club', 'user'])->latest()->paginate(12)->withQueryString();
        } elseif ($user->isClubLeader()) {
            $clubIds = Club::query()->where('advisor_id', $user->id)->pluck('id');
            $members = ClubMember::query()->with(['club', 'user'])->whereIn('club_id', $clubIds)->latest()->paginate(12)->withQueryString();
        } else {
            $members = ClubMember::query()->with(['club', 'user'])->where('user_id', $user->id)->latest()->paginate(12)->withQueryString();
        }

        return view('members.index', [
            'members' => $members,
            'clubs' => Club::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function join(Request $request, Club $club): RedirectResponse
    {
        $request->user()->clubMemberships()->updateOrCreate(
            ['club_id' => $club->id],
            [
                'role' => 'general_member',
                'status' => ClubMember::STATUS_PENDING,
                'joined_at' => now(),
            ]
        );

        return back()->with('success', 'Join request submitted successfully.');
    }

    public function leave(Request $request, Club $club): RedirectResponse
    {
        ClubMember::query()
            ->where('club_id', $club->id)
            ->where('user_id', $request->user()->id)
            ->delete();

        return back()->with('success', 'You left the club successfully.');
    }

    public function updateRole(Request $request, ClubMember $clubMember): RedirectResponse
    {
        $data = $request->validate([
            'role' => ['required', 'in:president,vice_president,secretary,treasurer,executive_member,general_member'],
            'status' => ['required', 'in:active,pending,blocked'],
        ]);

        $clubMember->update($data);

        return back()->with('success', 'Member role updated successfully.');
    }

    public function destroy(ClubMember $clubMember): RedirectResponse
    {
        $user = request()->user();

        // Allow self-removal, super admin, or club leader of the club
        if ($user->id === $clubMember->user_id || $user->isSuperAdmin() || ($user->isClubLeader() && $clubMember->club->advisor_id === $user->id)) {
            $clubMember->delete();

            return back()->with('success', 'Member removed successfully.');
        }

        abort(403);
    }

    public function review(Request $request, ClubMember $clubMember): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,approved,declined'],
            'remarks' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = $request->user();

        if (! $user->isSuperAdmin()) {
            // club leaders can only manage their own club members
            if (! $user->isClubLeader() || $clubMember->club->advisor_id !== $user->id) {
                abort(403);
            }
        }

        $clubMember->update([
            'status' => $data['status'],
            'remarks' => $data['remarks'] ?? null,
            'approved_by' => $data['status'] === 'approved' ? $user->id : null,
            'approved_at' => $data['status'] === 'approved' ? now() : null,
        ]);

        return back()->with('success', 'Membership request updated successfully.');
    }
}