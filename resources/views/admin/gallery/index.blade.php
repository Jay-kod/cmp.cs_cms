@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Photo Gallery')
@section('header', 'Manage Photo Albums')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">All Albums</h2>
        <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.88rem;">Group thousands of photos into manageable event albums.</p>
    </div>
    <div style="display: flex; gap: 0.6rem;">
        <a href="{{ route('admin.gallery.create') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 0.85rem; box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2); transition: background 0.2s;">
            <i class="fa-solid fa-folder-plus"></i> Create New Album
        </a>
    </div>
</div>

@if(session('success'))
<div style="background: #ecfdf5; color: #047857; padding: 1rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #a7f3d0; font-size: 0.9rem; display: flex; align-items: center; gap: 0.6rem;">
    <i class="fa-solid fa-check-circle" style="font-size: 1.1rem;"></i> {{ session('success') }}
</div>
@endif

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
    @forelse($albums as $album)
    <div class="admin-card" style="padding: 0; overflow: hidden; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); display: flex; flex-direction: column; transition: transform 0.2s ease, box-shadow 0.2s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)'">
        <div style="height: 180px; background: #f1f5f9; position: relative;">
            @if($album->cover_image)
                <img src="{{ asset('storage/'.$album->cover_image) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
            @elseif($album->images->first())
                <img src="{{ asset('storage/'.$album->images->first()->image_path) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #e2e8f0, #cbd5e1); color: #94a3b8; font-size: 2.5rem;">
                    <i class="fa-solid fa-images"></i>
                </div>
            @endif
            <div style="position: absolute; top: 12px; right: 12px; background: rgba(15, 23, 42, 0.65); color: white; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; backdrop-filter: blur(4px); display: flex; align-items: center; gap: 0.4rem; border: 1px solid rgba(255,255,255,0.1);">
                <i class="fa-regular fa-image"></i> {{ $album->images_count }} photos
            </div>
        </div>
        
        <div style="padding: 1.2rem 1.5rem; flex: 1; display: flex; flex-direction: column; background: #fff;">
            <h3 style="margin: 0 0 0.4rem 0; font-size: 1.05rem; font-weight: 600; color: #0f172a;">{{ Str::limit($album->title, 50) }}</h3>
            <div style="font-size: 0.85rem; color: #64748b; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.4rem;">
                <i class="fa-regular fa-calendar" style="color: #94a3b8;"></i> {{ \Carbon\Carbon::parse($album->date)->format('F j, Y') }}
            </div>
            
            <div style="margin-top: auto; display: flex; gap: 0.6rem;">
                <a href="{{ route('admin.gallery.edit', $album) }}" style="flex: 1; text-align: center; padding: 0.5rem; font-size: 0.85rem; font-weight: 500; background: #f1f5f9; color: #475569; text-decoration: none; border-radius: 6px; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#0f172a'">
                    <i class="fa-solid fa-pen" style="margin-right: 0.3rem;"></i> Edit Album
                </a>
                <form action="{{ route('admin.gallery.destroy', $album) }}" method="POST" data-confirm="WARNING: This will delete the album AND ALL {{ $album->images_count }} PHOTOS inside it. Continue?" style="margin: 0;">
                    @csrf @method('DELETE')
                    <button type="submit" style="display: flex; align-items: center; justify-content: center; padding: 0.5rem 0.8rem; font-size: 0.85rem; font-weight: 500; background: #fef2f2; color: #ef4444; border: none; cursor: pointer; border-radius: 6px; transition: all 0.2s;" onmouseover="this.style.background='#fee2e2'; this.style.color='#b91c1c'" title="Delete Album">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px dashed #e2e8f0;">
        <i class="fa-solid fa-camera-retro" style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
        <h3 style="margin: 0 0 0.5rem; color: #475569; font-size: 1.1rem; font-weight: 600;">No Photo Albums Yet</h3>
        <p style="margin: 0 0 1.5rem; color: #94a3b8; font-size: 0.9rem;">Create your first album to start organizing gallery photos.</p>
        <a href="{{ route('admin.gallery.create') }}" style="display: inline-block; background: white; color: var(--color-primary); padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; border: 1px solid var(--color-primary); transition: all 0.2s;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white'">
            Create First Album
        </a>
    </div>
    @endforelse
</div>

@if($albums->hasPages())
<div style="margin-top: 2rem;">
    {{ $albums->links() }}
</div>
@endif
@endsection
