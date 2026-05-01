<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAutoSlug;

class Page extends Model
{
    use HasAutoSlug;

    protected $guarded = [];

    public function slugSource(): string
    {
        return 'title';
    }

    protected $casts = [
        'is_active'  => 'boolean',
        'is_system'  => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
