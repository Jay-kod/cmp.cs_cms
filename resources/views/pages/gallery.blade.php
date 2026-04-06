@extends('layouts.public')

@section('title', 'Photo Gallery')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::getCached($key) ?? $default;
    $heroSetting = (object)['value' => \App\Models\DepartmentSetting::getCached('hero_gallery')];
    $heroUrl = $heroSetting && $heroSetting->value && file_exists(storage_path('app/public/' . $heroSetting->value))
        ? asset('storage/' . $heroSetting->value)
        : asset('images/campus-bg.jpg');
    $gsData = \App\Models\DepartmentSetting::where('group', 'page_gallery')->pluck('value', 'key')->toArray();
@endphp

<!-- Hero -->
<div style="background: linear-gradient(135deg, rgba(15,23,42,0.95) 0%, rgba(4,120,87,0.88) 50%, rgba(15,23,42,0.93) 100%), url('{{ $heroUrl }}') center/cover; padding: 4.5rem 0 5.5rem; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: radial-gradient(circle at 20% 80%, rgba(16,185,129,0.12), transparent 50%), radial-gradient(circle at 80% 20%, rgba(59,130,246,0.08), transparent 50%); pointer-events: none;"></div>
    <div class="container" style="position: relative; z-index: 10; text-align: center; display: flex; flex-direction: column; align-items: center;">
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.4rem 1.2rem; background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); color: #a7f3d0; border-radius: 20px; font-size: 0.8rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.1);">
            <i class="fa-solid fa-images" style="font-size: 0.7rem;"></i> {{ $gsData['gallery_hero_badge'] ?? 'Photo Gallery' }}
        </div>
        <h1 style="color: white; font-size: 3rem; font-family: var(--font-heading); margin: 0 0 0.8rem; font-weight: 800; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">{{ $gsData['gallery_hero_title'] ?? 'Our Photo Gallery' }}</h1>
        <p style="color: #cbd5e1; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.7;">{{ $gsData['gallery_hero_subtitle'] ?? 'Browse through moments from events, lectures, ceremonies, and campus life.' }}</p>
    </div>
</div>

<!-- Albums Grid -->
<div class="container" style="padding: 3rem 0 5rem;">

    @if($albums->count())
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.8rem;">
        @foreach($albums as $album)
        <a href="{{ route('gallery.show', $album->slug) }}" class="gallery-album-card" style="text-decoration: none; background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; transition: all 0.35s ease; display: flex; flex-direction: column;">
            {{-- Cover Image --}}
            <div style="height: 220px; position: relative; overflow: hidden; background: #f1f5f9;">
                @php
                    $coverSrc = $album->cover_image
                        ? asset('storage/'.$album->cover_image)
                        : ($album->images->first() ? asset('storage/'.$album->images->first()->image_path) : null);
                @endphp
                @if($coverSrc)
                    <img src="{{ $coverSrc }}" alt="{{ $album->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" class="album-cover-img">
                @else
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 3rem;">
                        <i class="fa-solid fa-images"></i>
                    </div>
                @endif
                {{-- Photo count badge --}}
                <div style="position: absolute; top: 12px; right: 12px; background: rgba(0,0,0,0.6); backdrop-filter: blur(6px); color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;">
                    <i class="fa-regular fa-image"></i> {{ $album->images_count }} {{ Str::plural('photo', $album->images_count) }}
                </div>
                {{-- Hover overlay --}}
                <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.55) 0%, transparent 60%); opacity: 0; transition: opacity 0.35s;" class="album-overlay"></div>
                <div style="position: absolute; bottom: 16px; left: 50%; transform: translateX(-50%) translateY(10px); opacity: 0; transition: all 0.35s; background: white; color: var(--color-primary); padding: 8px 20px; border-radius: 8px; font-size: 0.85rem; font-weight: 700; white-space: nowrap;" class="album-view-btn">
                    <i class="fa-solid fa-eye"></i> View Album
                </div>
            </div>

            {{-- Info --}}
            <div style="padding: 1.2rem 1.4rem; flex: 1; display: flex; flex-direction: column;">
                <h3 style="margin: 0 0 0.4rem; font-size: 1.1rem; font-family: var(--font-heading); font-weight: 700; color: #0f172a; line-height: 1.35;">{{ $album->title }}</h3>
                @if($album->description)
                <p style="color: #64748b; font-size: 0.85rem; line-height: 1.5; margin: 0 0 0.8rem;">{{ Str::limit($album->description, 100) }}</p>
                @endif
                <div style="margin-top: auto; display: flex; align-items: center; gap: 0.5rem; color: #94a3b8; font-size: 0.8rem;">
                    <i class="fa-regular fa-calendar"></i>
                    {{ $album->date ? \Carbon\Carbon::parse($album->date)->format('F j, Y') : 'No date' }}
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($albums->hasPages())
    <div style="margin-top: 3rem; display: flex; justify-content: center;">
        {{ $albums->links() }}
    </div>
    @endif

    @else
    <div style="text-align: center; padding: 5rem 2rem;">
        <i class="fa-solid fa-camera" style="font-size: 4rem; color: #d1d5db; margin-bottom: 1.5rem;"></i>
        <h2 style="font-family: var(--font-heading); color: #374151; font-size: 1.5rem; margin-bottom: 0.5rem;">No Albums Yet</h2>
        <p style="color: #6b7280;">Photo albums will appear here once they are created.</p>
    </div>
    @endif
</div>

<style>
.gallery-album-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.12);
    border-color: var(--color-primary);
}
.gallery-album-card:hover .album-cover-img {
    transform: scale(1.06);
}
.gallery-album-card:hover .album-overlay {
    opacity: 1 !important;
}
.gallery-album-card:hover .album-view-btn {
    opacity: 1 !important;
    transform: translateX(-50%) translateY(0) !important;
}

/* Gallery Page Responsive */
@media (max-width: 768px) {
    div[style*="padding: 4.5rem 0 5.5rem"] { padding: 3rem 0 3.5rem !important; }
    div[style*="padding: 4.5rem 0 5.5rem"] h1[style*="font-size: 3rem"] { font-size: 2rem !important; }
    div[style*="padding: 4.5rem 0 5.5rem"] p[style*="font-size: 1.1rem"] { font-size: 0.92rem !important; }
    .gallery-album-card div[style*="height: 220px"] { height: 180px !important; }
}
@media (max-width: 575px) {
    div[style*="padding: 4.5rem 0 5.5rem"] { padding: 2rem 0 2.5rem !important; }
    div[style*="padding: 4.5rem 0 5.5rem"] h1[style*="font-size: 3rem"] { font-size: 1.6rem !important; }
    div[style*="grid-template-columns: repeat(auto-fill, minmax(300px"] { grid-template-columns: 1fr !important; }
    .gallery-album-card div[style*="height: 220px"] { height: 200px !important; }
}
@media (max-width: 480px) {
    div[style*="padding: 4.5rem 0 5.5rem"] h1[style*="font-size: 3rem"] { font-size: 1.4rem !important; }
}
</style>
@endsection
