<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NacosPresident extends Model
{
    protected $fillable = [
        'name',
        'photo',
        'tenure_start',
        'tenure_end',
        'bio',
        'current_status'
    ];
}
