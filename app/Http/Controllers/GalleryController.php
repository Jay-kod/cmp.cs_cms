<?php

namespace App\Http\Controllers;

use App\Models\GalleryAlbum;
use App\Models\DepartmentSetting;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = GalleryAlbum::withCount('images')
            ->with(['images' => fn($q) => $q->orderBy('sort_order')->limit(1)])
            ->has('images')
            ->orderByDesc('date')
            ->paginate(12);

        return view('pages.gallery', compact('albums'));
    }

    public function show(GalleryAlbum $album)
    {
        $album->loadCount('images');
        $images = $album->images()->orderBy('sort_order')->get();

        return view('pages.gallery-album', compact('album', 'images'));
    }
}
