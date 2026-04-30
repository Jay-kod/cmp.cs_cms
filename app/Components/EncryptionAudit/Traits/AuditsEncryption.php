<?php

namespace App\Components\EncryptionAudit\Traits;

use App\Components\EncryptionAudit\Models\EncryptionAuditLog;

trait AuditsEncryption
{
    /**
     * Boot the trait to listen for Eloquent events.
     */
    public static function bootAuditsEncryption()
    {
        // 1. Automatically generate blind indices before saving
        static::saving(function ($model) {
            $fields = $model->getEncryptedFieldsConfig();
            foreach ($fields as $field) {
                if ($model->isDirty($field)) {
                    // Create a SHA-256 hash so we can search the DB securely without decrypting
                    $hashField = $field . '_hash';
                    $model->{$hashField} = hash('sha256', strtolower($model->{$field}));
                }
            }
        });

        // 2. Log Encryption Activity when records are updated or created
        static::saved(function ($model) {
            $fields = $model->getEncryptedFieldsConfig();
            foreach ($fields as $field) {
                if ($model->wasChanged($field) || $model->wasRecentlyCreated) {
                    $model->logEncryptionActivity($field, 'encrypted');
                }
            }
        });
    }

    /**
     * Get the fields marked for encryption tracking on the model.
     * Add `protected array $auditedEncryptedFields = ['email', 'phone'];` to your model.
     */
    public function getEncryptedFieldsConfig(): array
    {
        return property_exists($this, 'auditedEncryptedFields') ? $this->auditedEncryptedFields : [];
    }

    /**
     * Create an audit log record for this model.
     */
    public function logEncryptionActivity(string $field, string $action)
    {
        EncryptionAuditLog::create([
            'model'       => class_basename($this),
            'record_id'   => $this->id,
            'field'       => $field,
            'action'      => $action,
            'accessed_by' => auth()->id(),
            'ip_address'  => request()->ip(),
        ]);
    }

    /**
     * Explicitly log a decryption event (Call this when explicitly reading sensitive data in controllers).
     */
    public function logDecryption(string $field)
    {
        $this->logEncryptionActivity($field, 'decrypted');
    }
}
