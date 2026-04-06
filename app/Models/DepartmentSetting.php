<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentSetting extends Model
{
    protected $guarded = [];

    public static function getCached(string $key, $default = null)
    {
        $settings = cache()->rememberForever('all_department_settings', function() {
            return self::pluck('value', 'key')->toArray();
        });
        
        return $settings[$key] ?? $default;
    }

    protected static function booted()
    {
        static::saved(function ($setting) {
            cache()->forget('all_department_settings');
        });
        static::deleted(function ($setting) {
            cache()->forget('all_department_settings');
        });
    }
}
