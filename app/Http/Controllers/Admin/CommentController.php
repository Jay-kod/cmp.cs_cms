<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Toggle the approval status of a comment.
     */
    public function toggleApproval(Comment $comment)
    {
        $comment->update([
            'is_approved' => !$comment->is_approved,
        ]);

        $status = $comment->is_approved ? 'approved' : 'flagged';
        return back()->with('success', "Comment has been {$status}.");
    }

    /**
     * Delete a comment.
     */
    public function destroy(Comment $comment)
    {
        // First delete any replies to this comment (if we want cascading delete)
        $comment->replies()->delete();
        
        $comment->delete();
        
        return back()->with('success', 'Comment deleted successfully.');
    }
}
