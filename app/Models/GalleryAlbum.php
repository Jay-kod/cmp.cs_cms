<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAutoSlug;

class GalleryAlbum extends Model
{
    use HasAutoSlug;

    protected $guarded = [];

    public function slugSource(): string
    {
        return 'title';
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function images()
    {
        return $this->hasMany(GalleryImage::class, 'album_id');
    }
}
