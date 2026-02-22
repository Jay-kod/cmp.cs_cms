<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastHod extends Model
{
    protected $fillable = [
        'name',
        'photo',
        'tenure_start',
        'tenure_end',
        'bio'
    ];
}
