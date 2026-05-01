<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'event_id',
        'type',
        'session_id',
        'ip_address',
    ];

    public const TYPES = ['like', 'love', 'dislike', 'insightful', 'angry'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
