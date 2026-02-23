<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventPublicController extends Controller
{
    public function index()
    {
        $upcoming = Event::where('date', '>=', now())
            ->orderBy('date')
            ->get();

        $past = Event::where('date', '<', now())
            ->orderByDesc('date')
            ->paginate(12);

        return view('pages.events', compact('upcoming', 'past'));
    }
}
