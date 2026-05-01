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
<div class="relative overflow-hidden bg-gradient-to-br from-[#102b1f] via-[#15803d] to-[#16a34a] pt-20 pb-28 md:pt-28 md:pb-36 flex items-center justify-center">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat mix-blend-overlay opacity-40 filter grayscale" style="background-image: url('{{ $heroUrl }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#102b1f] to-transparent opacity-80"></div>
    <!-- Subtle Grid Pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNykiLz48L3N2Zz4=')] opacity-50 z-0"></div>

    <div class="container relative z-10 px-4 flex flex-col items-center text-center">
        <!-- Badge -->
        <div data-aos="fade-up" class="inline-flex items-center gap-2.5 px-6 py-2 bg-white/10 border border-white/20 backdrop-blur-md text-green-100 rounded-full text-xs sm:text-sm font-bold uppercase tracking-widest mb-6 shadow-xl">
            <i class="fa-solid fa-camera-retro text-green-300"></i>
            {{ $gsData['gallery_hero_badge'] ?? 'Photo Gallery' }}
        </div>
        
        <!-- Title -->
        <h1 data-aos="fade-up" data-aos-delay="100" class="text-white text-[clamp(2.5rem,6vw,4.5rem)] font-extrabold mb-6 tracking-tight leading-tight drop-shadow-2xl">
            {{ $gsData['gallery_hero_title'] ?? 'Our Photo Gallery' }}
        </h1>
        
        <!-- Subtitle inside a glass card -->
        <div data-aos="fade-up" data-aos-delay="200" class="max-w-3xl bg-black/20 border border-white/10 backdrop-blur-sm rounded-2xl p-5 sm:p-6 shadow-2xl">
            <p class="text-green-50 text-base sm:text-lg md:text-xl leading-relaxed m-0 text-center sm:text-justify font-medium">
                {{ $gsData['gallery_hero_subtitle'] ?? 'Browse through moments from events, lectures, ceremonies, and campus life.' }}
            </p>
        </div>
    </div>
</div>

<!-- Albums Grid -->
<div class="container mx-auto px-4 py-16 md:py-24 relative z-20 -mt-16 max-w-7xl">
    @if($albums->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
        @foreach($albums as $album)
        <div data-aos="fade-up" class="group h-full">
            <a href="{{ route('gallery.show', $album->slug) }}" class="block h-full bg-white rounded-3xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100 hover:shadow-[0_20px_40px_rgb(0,0,0,0.12)] hover:border-green-200 hover:-translate-y-2 transition-all duration-500 flex flex-col relative">
                
                {{-- Cover Image --}}
                <div class="h-60 sm:h-64 lg:h-72 relative overflow-hidden bg-slate-100 w-full">
                    @php
                        $coverSrc = $album->cover_image
                            ? asset('storage/'.$album->cover_image)
                            : ($album->images->first() ? asset('storage/'.$album->images->first()->image_path) : null);
                    @endphp
                    @if($coverSrc)
                        <img src="{{ $coverSrc }}" alt="{{ $album->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-100 to-slate-200 flex flex-col items-center justify-center text-slate-300">
                            <i class="fa-solid fa-image text-5xl mb-2"></i>
                            <span class="text-xs font-bold uppercase tracking-widest">No Cover</span>
                        </div>
                    @endif
                    
                    {{-- Overlays --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-500"></div>
                    <div class="absolute inset-0 bg-green-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 mix-blend-overlay"></div>
                    
                    {{-- Badges --}}
                    <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-md border border-white/30 text-white py-1.5 px-3.5 rounded-full text-xs font-bold shadow-lg flex items-center gap-2">
                        <i class="fa-solid fa-images text-green-300"></i>
                        <span>{{ $album->images_count }} {{ Str::plural('photo', $album->images_count) }}</span>
                    </div>

                    {{-- Hover Button --}}
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 group-hover:-translate-y-1/2 transition-all duration-500 scale-95 group-hover:scale-100">
                        <span class="inline-flex items-center justify-center w-14 h-14 bg-white/95 text-green-600 rounded-full shadow-2xl">
                            <i class="fa-solid fa-arrow-right text-xl -rotate-45 group-hover:rotate-0 transition-transform duration-500"></i>
                        </span>
                    </div>

                    {{-- Date Overlay at Bottom --}}
                    <div class="absolute bottom-4 left-4 flex items-center gap-2 text-white/90 text-[0.75rem] font-bold uppercase tracking-widest">
                        <i class="fa-regular fa-calendar text-green-300"></i>
                        {{ $album->date ? \Carbon\Carbon::parse($album->date)->format('M d, Y') : 'Ongoing' }}
                    </div>
                </div>

                {{-- Content Info --}}
                <div class="p-6 md:p-8 flex-1 flex flex-col bg-white">
                    <h3 class="text-xl md:text-2xl font-bold text-slate-800 leading-tight mb-3 group-hover:text-green-600 transition-colors">
                        {{ $album->title }}
                    </h3>
                    @if($album->description)
                    <p class="text-slate-500 text-sm md:text-base leading-relaxed text-justify m-0 line-clamp-3">
                        {{ $album->description }}
                    </p>
                    @endif
                    
                    <div class="mt-auto pt-6 flex items-center text-sm font-bold text-green-600 group-hover:text-green-700 transition-colors">
                        Explore Album <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($albums->hasPages())
    <div class="mt-16 flex justify-center">
        {{ $albums->links() }}
    </div>
    @endif

    @else
    {{-- Empty State --}}
    <div data-aos="fade-up" class="max-w-2xl mx-auto bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100 p-8 sm:p-12 text-center mt-10">
        <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto bg-green-50 text-green-500 rounded-full flex items-center justify-center text-3xl sm:text-4xl mb-6 shadow-inner">
            <i class="fa-solid fa-camera-retro"></i>
        </div>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 mb-4">No Albums Yet</h2>
        <p class="text-base sm:text-lg text-slate-500 leading-relaxed max-w-md mx-auto mb-0 text-center sm:text-justify">Our photo gallery is currently empty. Check back later for moments captured from our events, lectures, and campus life!</p>
    </div>
    @endif
</div>
@endsection
