@extends('layouts.admin')
@section('title', 'Photo Gallery')
@section('header', 'Manage Photo Albums')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="margin: 0; font-size: 1.1rem;">All Albums</h2>
        <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Group thousands of photos into manageable event albums.</p>
    </div>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-secondary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 4px; text-decoration: none;"><i class="fa-solid fa-folder-plus"></i> Create New Album</a>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
    @forelse($albums as $album)
    <div class="admin-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
        <div style="height: 160px; background: #e5e7eb; position: relative;">
            @if($album->cover_image)
                <img src="{{ asset('storage/'.$album->cover_image) }}" style="width: 100%; height: 100%; object-fit: cover;">
            @elseif($album->images->first())
                <img src="{{ asset('storage/'.$album->images->first()->image_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 2rem;">
                    <i class="fa-solid fa-images"></i>
                </div>
            @endif
            <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.6); color: white; padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: bold; backdrop-filter: blur(4px);">
                <i class="fa-regular fa-image"></i> {{ $album->images_count }} photos
            </div>
        </div>
        
        <div style="padding: 1.2rem; flex: 1; display: flex; flex-direction: column;">
            <h3 style="margin: 0 0 5px 0; font-size: 1.05rem; color: var(--color-primary);">{{ Str::limit($album->title, 50) }}</h3>
            <div style="font-size: 0.8rem; color: #6b7280; margin-bottom: 1.5rem;">
                <i class="fa-regular fa-calendar" style="width: 14px;"></i> {{ \Carbon\Carbon::parse($album->date)->format('F j, Y') }}
            </div>
            
            <div style="margin-top: auto; display: flex; gap: 8px;">
                <a href="{{ route('admin.gallery.edit', $album) }}" class="btn btn-secondary" style="flex: 1; text-align: center; padding: 0.4rem; font-size: 0.8rem; background: #f3f4f6; color: #374151; text-decoration: none; border-radius: 4px; border: 1px solid #d1d5db;"><i class="fa-solid fa-pen"></i> Edit & Add</a>
                <form action="{{ route('admin.gallery.destroy', $album) }}" method="POST" data-confirm="WARNING: This will delete the album AND ALL {{ $album->images_count }} PHOTOS inside it. Continue?" style="flex: 1; margin: 0;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-secondary" style="width: 100%; padding: 0.4rem; font-size: 0.8rem; background: white; color: #ef4444; border: 1px solid #fca5a5; cursor: pointer; border-radius: 4px;"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; background: white; border-radius: 8px; border: 1px solid #e5e7eb;">
        <i class="fa-solid fa-camera" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem;"></i>
        <p style="color: #6b7280;">No photo albums created yet.</p>
    </div>
    @endforelse
</div>

@if($albums->hasPages())
<div style="margin-top: 2rem;">
    {{ $albums->links() }}
</div>
@endif
@endsection
