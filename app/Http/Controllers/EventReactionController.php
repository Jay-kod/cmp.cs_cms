<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reaction;
use Illuminate\Http\Request;

class EventReactionController extends Controller
{
    /**
     * Store or update a reaction for an event.
     */
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'type' => 'required|in:' . implode(',', Reaction::TYPES),
        ]);

        $sessionId = $request->session()->getId();

        $existing = Reaction::where('event_id', $event->id)
            ->where('session_id', $sessionId)
            ->first();

        if ($existing) {
            if ($existing->type === $request->type) {
                // Toggle off — remove the reaction
                $existing->delete();
            } else {
                // Switch reaction type
                $existing->update(['type' => $request->type]);
            }
        } else {
            Reaction::create([
                'event_id'   => $event->id,
                'type'       => $request->type,
                'session_id' => $sessionId,
                'ip_address' => $request->ip(),
            ]);
        }

        return response()->json($this->buildReactionData($event, $sessionId));
    }

    /**
     * Get current reaction counts for an event.
     */
    public function show(Event $event, Request $request)
    {
        $sessionId = $request->session()->getId();
        return response()->json($this->buildReactionData($event, $sessionId));
    }

    /**
     * Build the reaction summary payload.
     */
    private function buildReactionData(Event $event, string $sessionId): array
    {
        $counts = Reaction::where('event_id', $event->id)
            ->selectRaw('type, count(*) as total')
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();

        $userReaction = Reaction::where('event_id', $event->id)
            ->where('session_id', $sessionId)
            ->value('type');

        return [
            'counts'        => $counts,
            'total'         => array_sum($counts),
            'user_reaction' => $userReaction,
        ];
    }
}
