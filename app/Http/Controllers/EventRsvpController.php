<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRsvp;
use Illuminate\Http\Request;

class EventRsvpController extends Controller
{
    /**
     * Store a new RSVP for an event.
     */
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:150',
            'email' => 'nullable|email|max:150',
        ]);

        // Check if already RSVP'd using session
        $sessionId = $request->session()->getId();
        $existing = EventRsvp::where('event_id', $event->id)
            ->where('session_id', $sessionId)
            ->first();

        if ($existing) {
            $count = EventRsvp::where('event_id', $event->id)->count();
            return response()->json([
                'success' => false,
                'message' => 'You have already RSVP\'d for this event. See you there!',
                'count' => $count
            ], 422);
        }

        $rsvp = EventRsvp::create([
            'event_id'   => $event->id,
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'session_id' => $sessionId,
            'ip_address' => $request->ip(),
        ]);

        $count = EventRsvp::where('event_id', $event->id)->count();

        return response()->json([
            'success' => true,
            'message' => 'Thanks for RSVP\'ing!',
            'rsvp'    => $rsvp,
            'count'   => $count
        ]);
    }
}
