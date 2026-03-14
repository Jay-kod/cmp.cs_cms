@extends('layouts.public')

@section('title', $album->title . ' — Gallery')

@section('content')
@php
    $coverSrc = $album->cover_image
        ? asset('storage/'.$album->cover_image)
        : ($album->images->first() ? asset('storage/'.$album->images->first()->image_path) : asset('images/campus-bg.jpg'));
@endphp

<!-- Hero -->
<div style="background: linear-gradient(135deg, rgba(15,23,42,0.93) 0%, rgba(4,120,87,0.85) 50%, rgba(15,23,42,0.93) 100%), url('{{ $coverSrc }}') center/cover; padding: 4rem 0 5rem; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; backdrop-filter: blur(2px); pointer-events: none;"></div>
    <div class="container" style="position: relative; z-index: 10; text-align: center;">
        <a href="{{ route('gallery.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #a7f3d0; font-size: 0.85rem; font-weight: 600; text-decoration: none; margin-bottom: 1.2rem; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#a7f3d0'">
            <i class="fa-solid fa-arrow-left"></i> Back to Gallery
        </a>
        <h1 style="color: white; font-size: 2.6rem; font-family: var(--font-heading); margin: 0 0 0.6rem; font-weight: 800; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">{{ $album->title }}</h1>
        <div style="display: flex; align-items: center; justify-content: center; gap: 1.5rem; flex-wrap: wrap; color: #cbd5e1; font-size: 0.9rem;">
            @if($album->date)
            <span><i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($album->date)->format('F j, Y') }}</span>
            @endif
            <span><i class="fa-regular fa-image"></i> {{ $album->images_count }} {{ Str::plural('photo', $album->images_count) }}</span>
        </div>
        @if($album->description)
        <p style="color: #94a3b8; font-size: 1rem; max-width: 640px; margin: 1rem auto 0; line-height: 1.7;">{{ $album->description }}</p>
        @endif
    </div>
</div>

<!-- Photo Grid -->
<div class="container" style="padding: 3rem 0 5rem;">
    @if($images->count())
    <div class="album-photo-grid" style="columns: 3; column-gap: 1rem;">
        @foreach($images as $img)
        <div class="album-photo-item" style="break-inside: avoid; margin-bottom: 1rem; border-radius: 10px; overflow: hidden; position: relative; cursor: pointer;" onclick="openLightbox({{ $loop->index }})">
            <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $img->caption ?? $album->title }}" style="width: 100%; display: block; transition: transform 0.4s;" loading="lazy">
            <div class="photo-overlay" style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 40%); opacity: 0; transition: opacity 0.3s; display: flex; align-items: flex-end; padding: 1rem;">
                @if($img->caption)
                <span style="color: white; font-size: 0.85rem; font-weight: 600;">{{ $img->caption }}</span>
                @endif
                <i class="fa-solid fa-expand" style="position: absolute; top: 12px; right: 12px; color: white; font-size: 1rem; opacity: 0.8;"></i>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div style="text-align: center; padding: 4rem 2rem;">
        <i class="fa-solid fa-image" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem;"></i>
        <p style="color: #6b7280;">This album has no photos yet.</p>
    </div>
    @endif
</div>

<!-- Lightbox -->
<div id="lightbox" style="display: none; position: fixed; inset: 0; z-index: 99999; background: rgba(0,0,0,0.92); backdrop-filter: blur(8px); align-items: center; justify-content: center; flex-direction: column;" onclick="if(event.target===this)closeLightbox()">
    <button onclick="closeLightbox()" style="position: absolute; top: 20px; right: 24px; background: none; border: none; color: white; font-size: 1.8rem; cursor: pointer; z-index: 10; opacity: 0.7; transition: opacity 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.7'"><i class="fa-solid fa-xmark"></i></button>
    <button id="lb-prev" onclick="navigateLightbox(-1)" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.1); border: none; color: white; font-size: 1.4rem; cursor: pointer; width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'"><i class="fa-solid fa-chevron-left"></i></button>
    <button id="lb-next" onclick="navigateLightbox(1)" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.1); border: none; color: white; font-size: 1.4rem; cursor: pointer; width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'"><i class="fa-solid fa-chevron-right"></i></button>
    <img id="lb-img" src="" alt="" style="max-width: 90vw; max-height: 82vh; object-fit: contain; border-radius: 6px; box-shadow: 0 20px 60px rgba(0,0,0,0.5); transition: opacity 0.25s;">
    <div id="lb-caption" style="color: #cbd5e1; font-size: 0.9rem; margin-top: 1rem; text-align: center; max-width: 600px;"></div>
    <div id="lb-counter" style="color: #64748b; font-size: 0.8rem; margin-top: 0.4rem;"></div>
</div>

<style>
.album-photo-item:hover img { transform: scale(1.03); }
.album-photo-item:hover .photo-overlay { opacity: 1 !important; }

@media (max-width: 768px) {
    .album-photo-grid { columns: 2 !important; }
    div[style*="padding: 4rem 0 5rem"] { padding: 2.5rem 0 3rem !important; }
    div[style*="padding: 4rem 0 5rem"] h1[style*="font-size: 2.6rem"] { font-size: 1.8rem !important; }
}
@media (max-width: 575px) {
    div[style*="padding: 4rem 0 5rem"] { padding: 2rem 0 2.5rem !important; }
    div[style*="padding: 4rem 0 5rem"] h1[style*="font-size: 2.6rem"] { font-size: 1.5rem !important; }
}
@media (max-width: 480px) {
    .album-photo-grid { columns: 1 !important; }
    div[style*="padding: 4rem 0 5rem"] h1[style*="font-size: 2.6rem"] { font-size: 1.35rem !important; }
}
</style>

<script>
const lbImages = @json($images->map(fn($i) => ['src' => asset('storage/'.$i->image_path), 'caption' => $i->caption ?? ''])->values());
let currentIdx = 0;

function openLightbox(idx) {
    currentIdx = idx;
    updateLightbox();
    document.getElementById('lightbox').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = '';
}
function navigateLightbox(dir) {
    currentIdx = (currentIdx + dir + lbImages.length) % lbImages.length;
    updateLightbox();
}
function updateLightbox() {
    const img = lbImages[currentIdx];
    document.getElementById('lb-img').src = img.src;
    document.getElementById('lb-caption').textContent = img.caption;
    document.getElementById('lb-counter').textContent = (currentIdx + 1) + ' / ' + lbImages.length;
}
document.addEventListener('keydown', e => {
    if (document.getElementById('lightbox').style.display === 'flex') {
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') navigateLightbox(-1);
        if (e.key === 'ArrowRight') navigateLightbox(1);
    }
});
</script>
@endsection
