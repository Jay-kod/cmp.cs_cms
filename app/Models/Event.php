<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAutoSlug;

class Event extends Model
{
    use HasFactory, HasAutoSlug;

    protected $guarded = [];

    public function slugSource(): string
    {
        return 'title';
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function rsvps()
    {
        return $this->hasMany(EventRsvp::class);
    }
}
