<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResourceItem extends Model
{
    protected $table = 'resources';

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'file_path',
        'uploaded_at',
        'uploaded_by',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ResourceCategory::class, 'category_id');
    }

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}

