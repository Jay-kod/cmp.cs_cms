@extends('layouts.public')

@section('title', $album->title . ' — Gallery')

@section('content')
@php
    $coverSrc = $album->cover_image
        ? asset('storage/'.$album->cover_image)
        : ($album->images->first() ? asset('storage/'.$album->images->first()->image_path) : asset('images/campus-bg.jpg'));
@endphp

<!-- Hero -->
<div class="relative overflow-hidden bg-gradient-to-br from-[#102b1f] via-[#15803d] to-[#16a34a] pt-20 pb-28 md:pt-28 md:pb-36 flex items-center justify-center">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat mix-blend-overlay opacity-40 filter grayscale" style="background-image: url('{{ $coverSrc }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#102b1f] to-transparent opacity-80"></div>
    <!-- Subtle Grid Pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNykiLz48L3N2Zz4=')] opacity-50 z-0"></div>

    <div class="container relative z-10 px-4 flex flex-col items-center text-center">
        <!-- Back Link -->
        <a data-aos="fade-up" href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2.5 px-6 py-2 bg-white/10 border border-white/20 backdrop-blur-md text-green-100 rounded-full text-xs sm:text-sm font-bold uppercase tracking-widest mb-6 shadow-xl hover:bg-white/20 hover:-translate-y-1 transition-all duration-300">
            <i class="fa-solid fa-arrow-left text-green-300"></i> Back to Gallery
        </a>
        
        <!-- Title -->
        <h1 data-aos="fade-up" data-aos-delay="100" class="text-white text-[clamp(2.5rem,6vw,4.5rem)] font-extrabold mb-6 tracking-tight leading-tight drop-shadow-2xl">
            {{ $album->title }}
        </h1>
        
        <!-- Metadata -->
        <div data-aos="fade-up" data-aos-delay="150" class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 mb-6">
            @if($album->date)
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-black/30 backdrop-blur-sm rounded-full text-green-100 text-sm font-semibold border border-white/10">
                <i class="fa-regular fa-calendar text-green-400"></i> {{ \Carbon\Carbon::parse($album->date)->format('F j, Y') }}
            </div>
            @endif
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-black/30 backdrop-blur-sm rounded-full text-green-100 text-sm font-semibold border border-white/10">
                <i class="fa-regular fa-image text-green-400"></i> {{ $album->images_count }} {{ Str::plural('photo', $album->images_count) }}
            </div>
        </div>

        <!-- Subtitle inside a glass card -->
        @if($album->description)
        <div data-aos="fade-up" data-aos-delay="200" class="max-w-3xl bg-black/20 border border-white/10 backdrop-blur-sm rounded-2xl p-5 sm:p-6 shadow-2xl">
            <p class="text-green-50 text-base sm:text-lg md:text-xl leading-relaxed m-0 text-center sm:text-justify font-medium">
                {{ $album->description }}
            </p>
        </div>
        @endif
    </div>
</div>

<!-- Photo Grid -->
<div class="container mx-auto px-4 py-16 md:py-24 relative z-20 -mt-16 max-w-7xl">
    @if($images->count())
    <!-- Using CSS masonry-style columns for photos -->
    <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
        @foreach($images as $img)
        <div data-aos="fade-up" class="break-inside-avoid rounded-2xl sm:rounded-3xl overflow-hidden relative cursor-pointer group shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:shadow-[0_20px_40px_rgb(0,0,0,0.15)] transition-all duration-500" onclick="openLightbox({{ $loop->index }})">
            <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $img->caption ?? $album->title }}" class="w-full block object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy">
            
            {{-- Hover Overlays --}}
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="absolute inset-0 bg-green-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 mix-blend-overlay"></div>
            
            {{-- Expand Icon --}}
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 group-hover:-translate-y-1/2 transition-all duration-500 scale-95 group-hover:scale-100">
                <span class="inline-flex items-center justify-center w-14 h-14 bg-white/95 text-green-600 rounded-full shadow-2xl">
                    <i class="fa-solid fa-expand text-xl transition-transform duration-500 group-hover:scale-110"></i>
                </span>
            </div>

            {{-- Caption --}}
            @if($img->caption)
            <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500 translate-y-4 group-hover:translate-y-0 transform">
                <p class="text-white text-sm sm:text-base font-bold m-0 leading-tight drop-shadow-md text-center sm:text-justify">
                    {{ $img->caption }}
                </p>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @else
    {{-- Empty State --}}
    <div data-aos="fade-up" class="max-w-2xl mx-auto bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100 p-8 sm:p-12 text-center mt-10">
        <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto bg-green-50 text-green-500 rounded-full flex items-center justify-center text-3xl sm:text-4xl mb-6 shadow-inner">
            <i class="fa-solid fa-image"></i>
        </div>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 mb-4">No Photos Found</h2>
        <p class="text-base sm:text-lg text-slate-500 leading-relaxed max-w-md mx-auto mb-0 text-center sm:text-justify">This album does not have any photos yet. Check back soon!</p>
    </div>
    @endif
</div>

<!-- Lightbox -->
<div id="lightbox" class="hidden fixed inset-0 z-[99999] bg-slate-900/95 backdrop-blur-xl items-center justify-center flex-col" onclick="if(event.target===this)closeLightbox()">
    <button onclick="closeLightbox()" class="absolute top-6 right-6 w-12 h-12 bg-white/10 hover:bg-red-500 border-none text-white text-xl rounded-full cursor-pointer z-10 transition-all duration-300 flex items-center justify-center hover:rotate-90 shadow-xl"><i class="fa-solid fa-xmark"></i></button>
    <button id="lb-prev" onclick="navigateLightbox(-1)" class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-green-500 border-none text-white text-xl cursor-pointer w-14 h-14 rounded-full flex items-center justify-center transition-all duration-300 shadow-xl hidden sm:flex"><i class="fa-solid fa-chevron-left"></i></button>
    <button id="lb-next" onclick="navigateLightbox(1)" class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-green-500 border-none text-white text-xl cursor-pointer w-14 h-14 rounded-full flex items-center justify-center transition-all duration-300 shadow-xl hidden sm:flex"><i class="fa-solid fa-chevron-right"></i></button>
    
    <img id="lb-img" src="" alt="" class="max-w-[95vw] sm:max-w-[90vw] max-h-[80vh] object-contain rounded-xl shadow-[0_20px_60px_rgba(0,0,0,0.5)] transition-opacity duration-300 mt-10 sm:mt-0">
    <div id="lb-caption" class="text-green-50 text-sm sm:text-lg mt-6 text-center max-w-2xl font-medium drop-shadow-md px-4"></div>
    <div id="lb-counter" class="text-green-200/80 text-xs sm:text-sm mt-2 font-bold tracking-widest uppercase"></div>
    
    <!-- Mobile Navigation -->
    <div class="flex items-center gap-6 mt-6 sm:hidden">
        <button onclick="navigateLightbox(-1)" class="w-12 h-12 bg-white/10 hover:bg-green-500 border-none text-white text-lg rounded-full flex items-center justify-center transition-all shadow-xl"><i class="fa-solid fa-chevron-left"></i></button>
        <button onclick="navigateLightbox(1)" class="w-12 h-12 bg-white/10 hover:bg-green-500 border-none text-white text-lg rounded-full flex items-center justify-center transition-all shadow-xl"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
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
