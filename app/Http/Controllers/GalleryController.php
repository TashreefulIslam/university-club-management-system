<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryRequest;
use App\Models\Club;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $galleries = Gallery::query()->with(['club', 'event', 'uploader'])->latest('upload_date')->paginate(12)->withQueryString();

        return view('galleries.index', [
            'galleries' => $galleries,
            'clubs' => Club::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(GalleryRequest $request): RedirectResponse
    {
        $gallery = $request->validated();
        unset($gallery['image']);

        $gallery['image_path'] = $request->file('image')->store('galleries', 'public');
        $gallery['uploaded_by'] = $request->user()->id;
        $gallery['upload_date'] = now();

        Gallery::create($gallery);

        return back()->with('success', 'Gallery image uploaded successfully.');
    }

    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validate([
            'caption' => ['nullable', 'string', 'max:255'],
            'event_id' => ['nullable', 'exists:events,id'],
        ]);

        $gallery->update($data);

        return back()->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();

        return back()->with('success', 'Gallery item deleted successfully.');
    }
}