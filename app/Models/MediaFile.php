<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MediaFile extends Model
{
    protected $table = 'media_files';

    protected $fillable = [
        'type',
        'mime_type',
        'size_bytes',
        'original_path',
        'checksum_sha256',
        'status',
        'error_message',
        'uploaded_by',
    ];

    public function derivatives(): HasMany
    {
        return $this->hasMany(MediaDerivative::class, 'media_file_id');
    }

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}

