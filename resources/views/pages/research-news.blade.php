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

<!-- Hero Section -->
<div class="blog-hero bg-cover bg-center py-[5.5rem] pt-24 pb-28 relative overflow-hidden" style="background-image: url('{{ $heroUrl }}');">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900/[0.96] via-emerald-800/[0.9] to-slate-900/[0.95]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_80%,rgba(16,185,129,0.15),transparent_50%),radial-gradient(circle_at_20%_20%,rgba(59,130,246,0.1),transparent_50%)] pointer-events-none"></div>
    
    <!-- Floating Decorative Elements -->
    <div class="absolute top-[15%] left-[10%] w-[150px] h-[150px] border border-white/5 rounded-full pointer-events-none"></div>
    <div class="absolute bottom-[10%] right-[5%] w-[250px] h-[250px] border border-white/[0.04] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-[15%] right-[25%] text-[8rem] text-white/5 -rotate-15 pointer-events-none"><i class="fa-solid fa-microscope"></i></div>
    
    <div class="container relative z-10 text-center flex flex-col items-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 py-1.5 px-5 bg-white/10 backdrop-blur-md text-emerald-200 rounded-[20px] text-[0.8rem] font-semibold tracking-[1.5px] uppercase mb-6 border border-white/10">
            <i class="fa-solid fa-newspaper text-[0.7rem]"></i> Insights
        </div>
        <h1 class="text-center text-white text-[3.2rem] font-heading m-[0_0_1rem_0] font-extrabold [text-shadow:0_4px_20px_rgba(0,0,0,0.3)]">Department News</h1>
        <p class="text-center text-slate-300 text-[1.15rem] max-w-[680px] mx-auto leading-[1.7]">Stay updated with our latest departmental highlights and student activities.</p>
    </div>
</div>

<div class="container page-layout -mt-12 relative z-20 pb-16">

    <div class="main-content blog-main bg-white rounded-2xl shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] p-12 lg:p-16">
        @include('pages.research-news-partials.news')
        
        @include('pages.research-news-partials.announcements')
    </div>
    
    <div class="right-toc-wrapper shrink-0 sticky top-[120px] self-start h-max z-40">
        <div class="w-[200px]">
            <x-sticky-toc :sections="[
                'news' => 'Department News',
                'announcements' => 'Announcements'
            ]" />
        </div>
    </div>

</div>
@endsection
