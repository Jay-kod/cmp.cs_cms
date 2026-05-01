<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Comment;
use Illuminate\Http\Request;

class EventCommentController extends Controller
{
    /**
     * Get comments for an event.
     */
    public function index(Event $event)
    {
        $comments = $event->comments()
            ->approved()
            ->topLevel()
            ->with('replies')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'data'           => $comments->items(),
            'total'          => $comments->total(),
            'next_page_url'  => $comments->nextPageUrl(),
        ]);
    }

    /**
     * Store a new comment for an event.
     */
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'author_name' => 'nullable|string|max:255',
            'body'        => 'required|string|max:65535',
            'parent_id'   => 'nullable|integer|exists:comments,id',
        ]);

        $comment = Comment::create([
            'event_id'    => $event->id,
            'parent_id'   => $validated['parent_id'] ?? null,
            'author_name' => $validated['author_name'] ?? 'Anonymous',
            'body'        => $validated['body'],
            'ip_address'  => $request->ip(),
            'is_approved' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment posted successfully.',
            'comment' => [
                'id'            => $comment->id,
                'author_name'   => $comment->author_name,
                'body'          => $comment->body,
                'created_at'    => $comment->created_at->diffForHumans(),
                'is_own'        => true,
                'parent_id'     => $comment->parent_id,
                'replies'       => [],
            ]
        ]);
    }
}
