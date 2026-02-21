<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class);
    }
}
