@php($currentClub = $club ?? null)
<div class="grid gap-5 lg:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Club name</label>
        <input name="name" value="{{ old('name', $currentClub?->name) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Short name</label>
        <input name="short_name" value="{{ old('short_name', $currentClub?->short_name) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Category</label>
        <input name="category" value="{{ old('category', $currentClub?->category) }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
        <select name="status" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
            @foreach(['active' => 'Active', 'inactive' => 'Inactive'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $currentClub?->status ?? 'active') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Advisor</label>
        <select name="advisor_id" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
            <option value="">Select advisor</option>
            @foreach($advisors as $advisor)
                <option value="{{ $advisor->id }}" @selected((string) old('advisor_id', $currentClub?->advisor_id) === (string) $advisor->id)>{{ $advisor->name }}</option>
            @endforeach
        </select>
    </div>
    <!-- <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Logo</label>
        <input type="file" name="logo" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Banner</label>
        <input type="file" name="banner" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3">
    </div> -->
</div>
<div>
    <label class="mb-2 block text-sm font-semibold text-slate-700">Description</label>
    <textarea name="description" rows="5" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">{{ old('description', $currentClub?->description) }}</textarea>
</div>
<div>
    <label class="mb-2 block text-sm font-semibold text-slate-700">Mission</label>
    <textarea name="mission" rows="5" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">{{ old('mission', $currentClub?->mission) }}</textarea>
</div>
<div class="flex items-center gap-3">
    <button class="rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white">Save Club</button>
    <a href="{{ route('clubs.index') }}" class="rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700">Cancel</a>
</div>