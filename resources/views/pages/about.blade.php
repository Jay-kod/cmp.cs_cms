@extends('layouts.public')

@section('title', 'About Us')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::where('key', $key)->value('value') ?? $default;
    $heroSetting = \App\Models\DepartmentSetting::where('key', 'hero_about')->first();
    $heroUrl = $heroSetting && $heroSetting->value && file_exists(storage_path('app/public/' . $heroSetting->value))
        ? asset('storage/' . $heroSetting->value) 
        : asset('images/campus-bg.jpg');
@endphp

@include('pages.about-partials.hero')

<div class="container page-layout reveal" style="margin-top: -3rem; position: relative; z-index: 20; padding-bottom: 4rem;">
    <div class="main-content about-main" style="background: white; border-radius: 16px; box-shadow: 0 20px 50px -12px rgba(0,0,0,0.1); padding: 3rem 4rem;">

        @include('pages.about-partials.our-story')

        @include('pages.about-partials.vision-mission')

        @include('pages.about-partials.core-values')

        @include('pages.about-partials.programmes')

        @include('pages.about-partials.departmental-board')

        @include('pages.about-partials.entry-requirements')

        @include('pages.about-partials.facilities')

        @include('pages.about-partials.faculty')

    </div>

    @include('pages.about-partials.toc')
</div>

@include('pages.about-partials.styles')
@endsection
