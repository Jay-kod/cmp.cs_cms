@extends('layouts.public')
@section('title', 'Research & Innovations')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::getCached($key) ?? $default;
    $heroSetting = (object)['value' => \App\Models\DepartmentSetting::getCached('hero_blog')];
    $heroUrl = $heroSetting && $heroSetting->value && file_exists(storage_path('app/public/' . $heroSetting->value))
        ? asset('storage/' . $heroSetting->value) 
        : asset('images/campus-bg.jpg');
@endphp

@include('pages.research-news-partials.hero')

<div class="container page-layout" style="margin-top: -3rem; position: relative; z-index: 20; padding-bottom: 4rem;">
    <div class="main-content blog-main" style="background: white; border-radius: 16px; box-shadow: 0 20px 50px -12px rgba(0,0,0,0.1); padding: 3rem 4rem;">

        @include('pages.research-news-partials.research-areas')

        @include('pages.research-news-partials.publications')

        @include('pages.research-news-partials.events')

        @include('pages.research-news-partials.gallery')

    </div>

    <x-sticky-toc :sections="[
        'research-areas' => 'Core Research Areas', 
        'publications' => 'Publications',
        'events' => 'Events Calendar', 
        'gallery' => 'Photo Gallery'
    ]" />
</div>

@include('pages.research-news-partials.styles')
@endsection
