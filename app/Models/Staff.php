<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $guarded = [];

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
