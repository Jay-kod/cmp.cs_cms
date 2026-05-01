<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAutoSlug;

class ProgrammeCategory extends Model
{
    use HasFactory, HasAutoSlug;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
