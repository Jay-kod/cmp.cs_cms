@extends('layouts.public')
@section('title', 'Research & News')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::where('key', $key)->value('value') ?? $default;
    $heroSetting = \App\Models\DepartmentSetting::where('key', 'hero_blog')->first();
    $heroUrl = $heroSetting && $heroSetting->value && file_exists(storage_path('app/public/' . $heroSetting->value))
        ? asset('storage/' . $heroSetting->value) 
        : asset('images/campus-bg.jpg');
@endphp

@include('pages.research-news-partials.hero')

<div class="container page-layout reveal" style="margin-top: -3rem; position: relative; z-index: 20; padding-bottom: 4rem;">
    <div class="main-content blog-main" style="background: white; border-radius: 16px; box-shadow: 0 20px 50px -12px rgba(0,0,0,0.1); padding: 3rem 4rem;">

        @include('pages.research-news-partials.research-areas')

        @include('pages.research-news-partials.publications')

        @include('pages.research-news-partials.news')

        @include('pages.research-news-partials.events')

        @include('pages.research-news-partials.gallery')

    </div>

    @include('pages.research-news-partials.toc')
</div>

@include('pages.research-news-partials.styles')
@endsection
