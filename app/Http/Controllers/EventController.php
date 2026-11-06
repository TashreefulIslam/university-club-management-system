<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Club;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $query = Event::query()->with('club');

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($builder) use ($search): void {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('venue', 'like', "%{$search}%");
            });
        }

        if ($status = $request->string('status')->trim()->toString()) {
            $query->where('status', $status);
        }

        $events = $query->latest('event_date')->paginate(10)->withQueryString();

        return view('events.index', [
            'events' => $events,
            'clubs' => Club::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function create(): View
    {
        return view('events.create', [
            'clubs' => Club::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(EventRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('events/banners', 'public');
        }

        $data['created_by'] = $request->user()->id;

        Event::create($data);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event): View
    {
        $event->load(['club', 'creator', 'registrations.user', 'registrations.attendance']);

        return view('events.show', compact('event'));
    }

    public function edit(Event $event): View
    {
        return view('events.edit', [
            'event' => $event,
            'clubs' => Club::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(EventRequest $request, Event $event): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('banner')) {
            if ($event->banner) {
                Storage::disk('public')->delete($event->banner);
            }

            $data['banner'] = $request->file('banner')->store('events/banners', 'public');
        }

        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}