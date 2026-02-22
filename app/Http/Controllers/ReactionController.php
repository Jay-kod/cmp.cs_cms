<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    /**
     * Store or update a reaction for a news article.
     */
    public function store(Request $request, News $news)
    {
        $request->validate([
            'type' => 'required|in:' . implode(',', Reaction::TYPES),
        ]);

        $sessionId = $request->session()->getId();

        $existing = Reaction::where('news_id', $news->id)
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
                'news_id'    => $news->id,
                'type'       => $request->type,
                'session_id' => $sessionId,
                'ip_address' => $request->ip(),
            ]);
        }

        return response()->json($this->buildReactionData($news, $sessionId));
    }

    /**
     * Get current reaction counts for a news article.
     */
    public function show(News $news, Request $request)
    {
        $sessionId = $request->session()->getId();
        return response()->json($this->buildReactionData($news, $sessionId));
    }

    /**
     * Build the reaction summary payload.
     */
    private function buildReactionData(News $news, string $sessionId): array
    {
        $counts = Reaction::where('news_id', $news->id)
            ->selectRaw('type, count(*) as total')
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();

        $userReaction = Reaction::where('news_id', $news->id)
            ->where('session_id', $sessionId)
            ->value('type');

        return [
            'counts'        => $counts,
            'total'         => array_sum($counts),
            'user_reaction' => $userReaction,
        ];
    }
}
