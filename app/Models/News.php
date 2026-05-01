<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAutoSlug;

class News extends Model
{
    use HasAutoSlug;

    protected $guarded = [];

    public function slugSource(): string
    {
        return 'title';
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getDisplayAuthorAttribute()
    {
        if ($this->author_type === 'outside' && !empty($this->author_name)) {
            return $this->author_name;
        }

        return $this->author ? $this->author->name : 'Department Administration';
    }
}
