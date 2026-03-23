<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaDerivative extends Model
{
    protected $table = 'media_derivatives';

    protected $fillable = [
        'media_file_id',
        'format',
        'width',
        'path',
        'status',
        'error_message',
    ];

    public function mediaFile(): BelongsTo
    {
        return $this->belongsTo(MediaFile::class, 'media_file_id');
    }
}

