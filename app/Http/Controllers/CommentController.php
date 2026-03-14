<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a new comment (anonymous or with optional name/email).
     */
    public function store(Request $request, News $news)
    {
        $request->validate([
            'body'         => 'required|string|max:2000',
            'author_name'  => 'nullable|string|max:100',
            'author_email' => 'nullable|email|max:150',
            'parent_id'    => 'nullable|exists:comments,id',
        ]);

        $comment = Comment::create([
            'news_id'      => $news->id,
            'parent_id'    => $request->parent_id,
            'author_name'  => $request->author_name ?: null,
            'author_email' => $request->author_email ?: null,
            'body'         => $request->body,
            'session_id'   => $request->session()->getId(),
            'ip_address'   => $request->ip(),
            'is_approved'  => true,
        ]);

        if ($request->expectsJson()) {
            $comment->load('replies');
            return response()->json([
                'success' => true,
                'comment' => [
                    'id'           => $comment->id,
                    'author_name'  => $comment->display_name,
                    'initials'     => $comment->initials,
                    'body'         => e($comment->body),
                    'parent_id'    => $comment->parent_id,
                    'created_at'   => $comment->created_at->diffForHumans(),
                    'date'         => $comment->created_at->format('M d, Y \a\t g:ia'),
                    'is_own'       => true,
                ],
            ]);
        }

        return back()->with('success', 'Comment posted successfully!');
    }

    /**
     * Get comments for a news article (paginated JSON).
     */
    public function index(News $news, Request $request)
    {
        $sessionId = $request->session()->getId();

        $comments = Comment::where('news_id', $news->id)
            ->approved()
            ->topLevel()
            ->with('replies')
            ->orderByDesc('created_at')
            ->paginate(15);

        $data = $comments->through(function ($comment) use ($sessionId) {
            return $this->formatComment($comment, $sessionId);
        });

        return response()->json($data);
    }

    /**
     * Format a comment for JSON output.
     */
    private function formatComment(Comment $comment, string $sessionId): array
    {
        return [
            'id'           => $comment->id,
            'author_name'  => $comment->display_name,
            'initials'     => $comment->initials,
            'body'         => e($comment->body),
            'parent_id'    => $comment->parent_id,
            'created_at'   => $comment->created_at->diffForHumans(),
            'date'         => $comment->created_at->format('M d, Y \a\t g:ia'),
            'is_own'       => $comment->session_id === $sessionId,
            'replies'      => $comment->replies->map(function ($reply) use ($sessionId) {
                return $this->formatComment($reply, $sessionId);
            })->values()->toArray(),
        ];
    }
}
