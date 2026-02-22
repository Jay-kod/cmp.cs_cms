<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(ProgrammeCategory::class, 'programme_category_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
