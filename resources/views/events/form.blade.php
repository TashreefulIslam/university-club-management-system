@php($currentEvent = $event ?? null)
<div class="grid gap-5 lg:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Club</label>
        <select name="club_id" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
            @foreach($clubs as $club)
                <option value="{{ $club->id }}" @selected((string) old('club_id', $currentEvent?->club_id) === (string) $club->id)>{{ $club->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
        <select name="status" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
            @foreach(['upcoming','running','completed','cancelled'] as $status)
                <option value="{{ $status }}" @selected(old('status', $currentEvent?->status ?? 'upcoming') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Title</label><input name="title" value="{{ old('title', $currentEvent?->title) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Venue</label><input name="venue" value="{{ old('venue', $currentEvent?->venue) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Event date</label><input type="date" name="event_date" value="{{ old('event_date', $currentEvent?->event_date?->format('Y-m-d')) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Registration deadline</label><input type="date" name="registration_deadline" value="{{ old('registration_deadline', optional($currentEvent?->registration_deadline)->format('Y-m-d')) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Start time</label><input type="time" name="start_time" value="{{ old('start_time', $currentEvent?->start_time?->format('H:i')) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">End time</label><input type="time" name="end_time" value="{{ old('end_time', $currentEvent?->end_time?->format('H:i')) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Maximum participants</label><input type="number" name="maximum_participants" value="{{ old('maximum_participants', $currentEvent?->maximum_participants) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"></div>
    <div><label class="mb-2 block text-sm font-semibold text-slate-700">Banner</label><input type="file" name="banner" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3"></div>
</div>
<div><label class="mb-2 block text-sm font-semibold text-slate-700">Description</label><textarea name="description" rows="6" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">{{ old('description', $currentEvent?->description) }}</textarea></div>
<div class="flex items-center gap-3"><button class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white">Save Event</button><a href="{{ route('events.index') }}" class="rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700">Cancel</a></div>