<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = GalleryAlbum::withCount('images')->orderBy('date', 'desc')->paginate(20);
        return view('admin.gallery.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.gallery.form', ['album' => new GalleryAlbum()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . time();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('public/gallery_covers');
            $data['cover_image'] = str_replace('public/', '', $data['cover_image']);
        }

        $album = GalleryAlbum::create($data);
        
        // Handle multiple image uploads if provided in same request
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('public/gallery_images');
                GalleryImage::create([
                    'album_id' => $album->id,
                    'image_path' => str_replace('public/', '', $path),
                    'caption' => null
                ]);
            }
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Photo album created successfully.');
    }

    public function edit(GalleryAlbum $gallery)
    {
        $album = $gallery->load('images');
        return view('admin.gallery.form', compact('album'));
    }

    public function update(Request $request, GalleryAlbum $gallery)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        if ($data['title'] !== $gallery->title) {
            $data['slug'] = Str::slug($data['title']) . '-' . time();
        }

        if ($request->hasFile('cover_image')) {
            if($gallery->cover_image) Storage::delete('public/'.$gallery->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('public/gallery_covers');
            $data['cover_image'] = str_replace('public/', '', $data['cover_image']);
        }

        $gallery->update($data);

        // Handle additional image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('public/gallery_images');
                GalleryImage::create([
                    'album_id' => $gallery->id,
                    'image_path' => str_replace('public/', '', $path),
                    'caption' => null
                ]);
            }
        }

        return redirect()->route('admin.gallery.edit', $gallery)->with('success', 'Album updated successfully.');
    }

    public function destroy(GalleryAlbum $gallery)
    {
        // Delete cover image
        if($gallery->cover_image) Storage::delete('public/'.$gallery->cover_image);
        
        // Delete all child images from storage
        foreach($gallery->images as $img) {
            Storage::delete('public/'.$img->image_path);
        }
        
        $gallery->delete(); // Cascades in DB if set up, or relies on Eloquent events
        
        return redirect()->route('admin.gallery.index')->with('success', 'Album and all its photos deleted successfully.');
    }

    // specific method to delete just one photo from an album
    public function destroyImage(GalleryImage $image)
    {
        Storage::delete('public/'.$image->image_path);
        $image->delete();
        return back()->with('success', 'Photo removed from album.');
    }
}
