<?php

namespace App\Components\EncryptionAudit\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class EncryptionAuditLog extends Model
{
    protected $table = 'encryption_audit_logs';

    protected $fillable = [
        'model',
        'record_id',
        'field',
        'action',
        'accessed_by',
        'ip_address'
    ];

    /**
     * Relationship to the user who accessed/modified the encrypted data.
     */
    public function accessor()
    {
        return $this->belongsTo(User::class, 'accessed_by');
    }
}
