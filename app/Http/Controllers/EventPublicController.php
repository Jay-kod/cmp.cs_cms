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

    public function show(Event $event)
    {
        $event->load([
            'comments' => function($q) {
                $q->approved()->topLevel()->with('replies');
            },
            'rsvps',
        ]);

        $reactionsCount = $event->reactions()->select('type', \DB::raw('count(*) as count'))
            ->groupBy('type')->pluck('count', 'type')->toArray();

        $related = Event::where('date', '>=', now())
            ->where('id', '!=', $event->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.event-show', compact('event', 'reactionsCount', 'related'));
    }
}
