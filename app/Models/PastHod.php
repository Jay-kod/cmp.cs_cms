<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastHod extends Model
{
    protected $fillable = [
        'name',
        'is_current',
        'email',
        'phone',
        'rank',
        'qualifications',
        'area_of_specialization',
        'status',
        'position',
        'photo',
        'tenure_start',
        'tenure_end',
        'bio'
    ];
}
