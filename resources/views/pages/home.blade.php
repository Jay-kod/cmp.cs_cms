@extends('layouts.public')

@section('title', 'Home')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::where('key', $key)->value('value') ?? $default;
@endphp

@include('pages.home-partials.hero')

@include('pages.home-partials.hod-welcome')

@include('pages.home-partials.programmes')

@include('pages.home-partials.staff')

@include('pages.home-partials.gallery')

@include('pages.home-partials.systems')

@include('pages.home-partials.nacos')

@include('pages.home-partials.news-events')

@include('pages.home-partials.timetable')

@include('pages.home-partials.partners')

@include('pages.home-partials.cta')

@include('pages.home-partials.styles')

@endsection
