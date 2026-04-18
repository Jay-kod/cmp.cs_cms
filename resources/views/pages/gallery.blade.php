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
<div class="bg-cover bg-center py-[4.5rem] pb-[5.5rem] relative overflow-hidden" style="background-image: url('{{ $heroUrl }}');">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900/[0.95] via-emerald-800/[0.88] to-slate-900/[0.93]"></div>
    <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(circle_at_20%_80%,rgba(16,185,129,0.12),transparent_50%),radial-gradient(circle_at_80%_20%,rgba(59,130,246,0.08),transparent_50%)]"></div>
    <div class="container relative z-10 text-center flex flex-col items-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-5 py-1.5 bg-white/10 backdrop-blur-md text-emerald-200 rounded-full text-[0.8rem] font-semibold tracking-[1.5px] uppercase mb-6 border border-white/10">
            <i class="fa-solid fa-images text-[0.7rem]"></i> {{ $gsData['gallery_hero_badge'] ?? 'Photo Gallery' }}
        </div>
        <h1 class="text-white text-[3rem] font-heading m-0 mb-3 font-extrabold [text-shadow:0_4px_20px_rgba(0,0,0,0.3)]">{{ $gsData['gallery_hero_title'] ?? 'Our Photo Gallery' }}</h1>
        <p class="text-slate-300 text-[1.1rem] max-w-[600px] mx-auto leading-[1.7]">{{ $gsData['gallery_hero_subtitle'] ?? 'Browse through moments from events, lectures, ceremonies, and campus life.' }}</p>
    </div>
</div>

<!-- Albums Grid -->
<div class="container py-12 pb-20" data-aos="fade-up">

    @if($albums->count())
    <div class="grid grid-cols-[repeat(auto-fill,minmax(300px,1fr))] max-[575px]:grid-cols-1 gap-[1.8rem]">
        @foreach($albums as $album)
        <a href="{{ route('gallery.show', $album->slug) }}" class="gallery-album-card no-underline bg-white rounded-[14px] overflow-hidden shadow-[0_4px_16px_rgba(0,0,0,0.06)] border border-slate-200 transition-all duration-350 flex flex-col hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,0.12)] hover:border-[color:var(--color-primary)] group">
            {{-- Cover Image --}}
            <div class="h-[220px] max-md:h-[180px] max-[575px]:h-[200px] relative overflow-hidden bg-slate-100">
                @php
                    $coverSrc = $album->cover_image
                        ? asset('storage/'.$album->cover_image)
                        : ($album->images->first() ? asset('storage/'.$album->images->first()->image_path) : null);
                @endphp
                @if($coverSrc)
                    <img src="{{ $coverSrc }}" alt="{{ $album->title }}" class="album-cover-img w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                @else
                    <div class="w-full h-full flex items-center justify-center text-slate-400 text-5xl">
                        <i class="fa-solid fa-images"></i>
                    </div>
                @endif
                {{-- Photo count badge --}}
                <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-sm text-white py-1.5 px-3 rounded-full text-xs font-bold">
                    <i class="fa-regular fa-image"></i> {{ $album->images_count }} {{ Str::plural('photo', $album->images_count) }}
                </div>
                {{-- Hover overlay --}}
                <div class="album-overlay absolute inset-0 bg-gradient-to-t from-black/55 to-transparent/60 opacity-0 transition-opacity duration-350 group-hover:opacity-100"></div>
                <div class="album-view-btn absolute bottom-4 left-1/2 -translate-x-1/2 translate-y-2.5 opacity-0 transition-all duration-350 bg-white text-[color:var(--color-primary)] py-2 px-5 rounded-lg text-[0.85rem] font-bold whitespace-nowrap group-hover:opacity-100 group-hover:translate-y-0">
                    <i class="fa-solid fa-eye"></i> View Album
                </div>
            </div>

            {{-- Info --}}
            <div class="p-[1.2rem_1.4rem] flex-1 flex flex-col">
                <h3 class="m-0 mb-1.5 text-[1.1rem] font-heading font-bold text-slate-900 leading-snug">{{ $album->title }}</h3>
                @if($album->description)
                <p class="text-slate-500 text-[0.85rem] leading-relaxed m-0 mb-3">{{ Str::limit($album->description, 100) }}</p>
                @endif
                <div class="mt-auto flex items-center gap-2 text-slate-400 text-[0.8rem]">
                    <i class="fa-regular fa-calendar"></i>
                    {{ $album->date ? \Carbon\Carbon::parse($album->date)->format('F j, Y') : 'No date' }}
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($albums->hasPages())
    <div class="mt-12 flex justify-center">
        {{ $albums->links() }}
    </div>
    @endif

    @else
    <div class="text-center py-20 px-8">
        <i class="fa-solid fa-camera text-7xl text-gray-300 mb-6"></i>
        <h2 class="font-heading text-gray-700 text-2xl mb-2">No Albums Yet</h2>
        <p class="text-gray-500">Photo albums will appear here once they are created.</p>
    </div>
    @endif
</div>

<style>
/* Additional component styling removed as it's now handled by Tailwind */
</style>
@endsection
