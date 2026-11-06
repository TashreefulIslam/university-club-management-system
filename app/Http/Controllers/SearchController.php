<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $term = $request->string('q')->trim()->toString();

        $clubs = Club::query()->where('name', 'like', "%{$term}%")->limit(5)->get();
        $events = Event::query()->where('title', 'like', "%{$term}%")->limit(5)->get();
        $students = User::query()->where('name', 'like', "%{$term}%")->where('role', User::ROLE_STUDENT)->limit(5)->get();

        return view('search.index', compact('term', 'clubs', 'events', 'students'));
    }
}