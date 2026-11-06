<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClubRequest;
use App\Models\Club;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ClubController extends Controller
{
    public function index(Request $request): View
    {
        $query = Club::query()->withCount(['members', 'events']);

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($builder) use ($search): void {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('short_name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($status = $request->string('status')->trim()->toString()) {
            $query->where('status', $status);
        }

        $clubs = $query->latest()->paginate(10)->withQueryString();

        return view('clubs.index', [
            'clubs' => $clubs,
            'advisors' => User::query()->where('role', User::ROLE_SUPER_ADMIN)->orWhere('role', User::ROLE_CLUB_LEADER)->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function create(): View
    {
        return view('clubs.create', [
            'advisors' => User::query()->whereIn('role', [User::ROLE_SUPER_ADMIN, User::ROLE_CLUB_LEADER])->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(ClubRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('clubs/logos', 'public');
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('clubs/banners', 'public');
        }

        Club::create($data);

        return redirect()->route('clubs.index')->with('success', 'Club created successfully.');
    }

    public function show(Club $club): View
    {
        $club->load(['advisor', 'members.user', 'events' => fn ($query) => $query->latest('event_date')]);

        return view('clubs.show', compact('club'));
    }

    public function edit(Club $club): View
    {
        return view('clubs.edit', [
            'club' => $club,
            'advisors' => User::query()->whereIn('role', [User::ROLE_SUPER_ADMIN, User::ROLE_CLUB_LEADER])->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(ClubRequest $request, Club $club): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($club->logo) {
                Storage::disk('public')->delete($club->logo);
            }

            $data['logo'] = $request->file('logo')->store('clubs/logos', 'public');
        }

        if ($request->hasFile('banner')) {
            if ($club->banner) {
                Storage::disk('public')->delete($club->banner);
            }

            $data['banner'] = $request->file('banner')->store('clubs/banners', 'public');
        }

        $club->update($data);

        return redirect()->route('clubs.index')->with('success', 'Club updated successfully.');
    }

    public function destroy(Club $club): RedirectResponse
    {
        $club->delete();

        return redirect()->route('clubs.index')->with('success', 'Club deleted successfully.');
    }
}