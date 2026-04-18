@extends('layouts.public')

@section('title', $album->title . ' — Gallery')

@section('content')
@php
    $coverSrc = $album->cover_image
        ? asset('storage/'.$album->cover_image)
        : ($album->images->first() ? asset('storage/'.$album->images->first()->image_path) : asset('images/campus-bg.jpg'));
@endphp

<!-- Hero -->
<div class="bg-[url('{{ $coverSrc }}')] bg-cover bg-center py-[4rem] pb-[5rem] relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900/[0.93] via-emerald-800/[0.85] to-slate-900/[0.93]"></div>
    <div class="absolute inset-0 backdrop-blur-[2px] pointer-events-none"></div>
    <div class="container relative z-10 text-center flex flex-col items-center" data-aos="fade-up">
        <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 text-emerald-200 text-[0.85rem] font-semibold no-underline mb-[1.2rem] transition-colors duration-200 hover:text-white">
            <i class="fa-solid fa-arrow-left"></i> Back to Gallery
        </a>
        <h1 class="text-white text-[2.6rem] font-heading m-0 mb-2 font-extrabold [text-shadow:0_4px_20px_rgba(0,0,0,0.3)] max-[768px]:text-[1.8rem] max-[575px]:text-[1.5rem] max-[480px]:text-[1.35rem]">{{ $album->title }}</h1>
        <div class="flex items-center justify-center gap-6 flex-wrap text-slate-300 text-[0.9rem]">
            @if($album->date)
            <span><i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($album->date)->format('F j, Y') }}</span>
            @endif
            <span><i class="fa-regular fa-image"></i> {{ $album->images_count }} {{ Str::plural('photo', $album->images_count) }}</span>
        </div>
        @if($album->description)
        <p class="text-slate-400 text-[1rem] max-w-[640px] mx-auto mt-4 leading-[1.7]">{{ $album->description }}</p>
        @endif
    </div>
</div>

<!-- Photo Grid -->
<div class="container py-12 pb-20" data-aos="fade-up">
    @if($images->count())
    <div class="album-photo-grid columns-3 max-md:columns-2 max-[480px]:columns-1 gap-4">
        @foreach($images as $img)
        <div data-aos="fade-up" class="album-photo-item break-inside-avoid mb-4 rounded-[10px] overflow-hidden relative cursor-pointer group" onclick="openLightbox({{ $loop->index }})">
            <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $img->caption ?? $album->title }}" class="w-full block transition-transform duration-400 group-hover:scale-[1.03]" loading="lazy">
            <div class="photo-overlay absolute inset-0 bg-gradient-to-t from-black/50 to-transparent/40 opacity-0 transition-opacity duration-300 flex items-end p-4 group-hover:opacity-100">
                @if($img->caption)
                <span class="text-white text-[0.85rem] font-semibold">{{ $img->caption }}</span>
                @endif
                <i class="fa-solid fa-expand absolute top-3 right-3 text-white text-[1rem] opacity-80"></i>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 px-8">
        <i class="fa-solid fa-image text-5xl text-slate-300 mb-4"></i>
        <p class="text-slate-500">This album has no photos yet.</p>
    </div>
    @endif
</div>

<!-- Lightbox -->
<div id="lightbox" class="hidden fixed inset-0 z-[99999] bg-black/[0.92] backdrop-blur-[8px] items-center justify-center flex-col" onclick="if(event.target===this)closeLightbox()">
    <button onclick="closeLightbox()" class="absolute top-[20px] right-[24px] bg-transparent border-none text-white text-[1.8rem] cursor-pointer z-10 opacity-70 transition-opacity duration-200 hover:opacity-100"><i class="fa-solid fa-xmark"></i></button>
    <button id="lb-prev" onclick="navigateLightbox(-1)" class="absolute left-[20px] top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 border-none text-white text-[1.4rem] cursor-pointer w-[48px] h-[48px] rounded-full flex items-center justify-center transition-colors duration-200"><i class="fa-solid fa-chevron-left"></i></button>
    <button id="lb-next" onclick="navigateLightbox(1)" class="absolute right-[20px] top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 border-none text-white text-[1.4rem] cursor-pointer w-[48px] h-[48px] rounded-full flex items-center justify-center transition-colors duration-200"><i class="fa-solid fa-chevron-right"></i></button>
    <img id="lb-img" src="" alt="" class="max-w-[90vw] max-h-[82vh] object-contain rounded-[6px] shadow-[0_20px_60px_rgba(0,0,0,0.5)] transition-opacity duration-250">
    <div id="lb-caption" class="text-slate-300 text-[0.9rem] mt-4 text-center max-w-[600px]"></div>
    <div id="lb-counter" class="text-slate-500 text-[0.8rem] mt-1.5"></div>
</div>

<style>
/* Additional component styling removed as it's now handled by Tailwind */
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
