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
<div class="blog-hero" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.96) 0%, rgba(4, 120, 87, 0.9) 50%, rgba(15, 23, 42, 0.95) 100%), url('{{ $heroUrl }}') center/cover; padding: 5.5rem 0 6.5rem; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.15), transparent 50%), radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.1), transparent 50%); pointer-events: none;"></div>
    
    <div class="container" data-aos="fade-up" style="position: relative; z-index: 10; text-align: center; display: flex; flex-direction: column; align-items: center;">
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.4rem 1.2rem; background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); color: #a7f3d0; border-radius: 20px; font-size: 0.8rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.1);">
            <i class="fa-solid fa-newspaper" style="font-size: 0.7rem;"></i> Insights
        </div>
        <h1 style="text-align: center; color: white; font-size: 3.2rem; font-family: var(--font-heading); margin: 0 0 1rem 0; font-weight: 800; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">Department News</h1>
        <p style="text-align: center; color: #cbd5e1; font-size: 1.15rem; max-width: 680px; margin: 0 auto; line-height: 1.7;">Stay updated with our latest departmental highlights and student activities.</p>
    </div>
</div>

<div class="container page-layout" style="margin-top: -3rem; position: relative; z-index: 20; padding-bottom: 4rem;">

    <div class="main-content blog-main" style="background: white; border-radius: 16px; box-shadow: 0 20px 50px -12px rgba(0,0,0,0.1); padding: 3rem 4rem;">
        @include('pages.research-news-partials.news')
        
        @include('pages.research-news-partials.announcements')
    </div>
    
    <div class="right-toc-wrapper" style="flex-shrink: 0;">
        <x-sticky-toc :sections="[
            'news' => 'Department News',
            'announcements' => 'Announcements'
        ]" />
    </div>

</div>

<style>
    /* Make the TOC appear on the right side and smaller on this page */
    .right-toc-wrapper .sidebar-toc {
        width: 200px !important;
    }
    .right-toc-wrapper .toc-container {
        padding: 1rem !important;
    }
    .right-toc-wrapper .toc-container h3 {
        font-size: 0.95rem !important;
        margin-bottom: 0.5rem !important;
    }
    .right-toc-wrapper .toc-list a {
        font-size: 0.85rem !important;
        padding: 0.25rem 0 !important;
    }
</style>

@include('pages.research-news-partials.styles')
@endsection
