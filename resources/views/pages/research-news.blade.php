@extends('layouts.public')
@section('title', 'Department News')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::getCached($key) ?? $default;
    $heroSetting = (object)['value' => \App\Models\DepartmentSetting::getCached('hero_blog')];
    $heroUrl = $heroSetting && $heroSetting->value && file_exists(storage_path('app/public/' . $heroSetting->value))
        ? asset('storage/' . $heroSetting->value) 
        : asset('images/campus-bg.jpg');
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
            <i class="fa-solid fa-newspaper text-green-300"></i> Insights
        </div>
        
        <!-- Title -->
        <h1 data-aos="fade-up" data-aos-delay="100" class="text-white text-[clamp(2.5rem,6vw,4.5rem)] font-extrabold mb-6 tracking-tight leading-tight drop-shadow-2xl">
            Department News
        </h1>
        
        <!-- Subtitle inside a glass card -->
        <div data-aos="fade-up" data-aos-delay="200" class="max-w-3xl bg-black/20 border border-white/10 backdrop-blur-sm rounded-2xl p-5 sm:p-6 shadow-2xl">
            <p class="text-green-50 text-base sm:text-lg md:text-xl leading-relaxed m-0 text-center sm:text-justify font-medium">
                Stay updated with our latest departmental highlights and student activities.
            </p>
        </div>
    </div>
</div>

<div class="container relative z-20 py-12 max-w-6xl px-4 sm:px-6 mx-auto">

    <div class="w-full">
        @include('pages.research-news-partials.news')
        
        @include('pages.research-news-partials.announcements')
    </div>

</div>
@endsection
