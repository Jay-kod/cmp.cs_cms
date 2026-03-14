<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'parent_id',
        'author_name',
        'author_email',
        'body',
        'session_id',
        'ip_address',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    /**
     * The news article this comment belongs to.
     */
    public function news()
    {
        return $this->belongsTo(News::class);
    }

    /**
     * Parent comment (for replies).
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Replies to this comment.
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')
            ->where('is_approved', true)
            ->orderBy('created_at', 'asc');
    }

    /**
     * Scope: only approved comments.
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope: only top-level comments (not replies).
     */
    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Get display name — use author_name or "Anonymous".
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->author_name ?: 'Anonymous';
    }

    /**
     * Get avatar initials.
     */
    public function getInitialsAttribute(): string
    {
        if ($this->author_name) {
            $parts = explode(' ', $this->author_name);
            return strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
        }
        return 'AN';
    }
}
