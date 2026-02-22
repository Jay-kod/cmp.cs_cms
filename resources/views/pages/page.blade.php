@extends('layouts.public')
@section('title', $page->title)

@section('content')
<div class="page-header" style="background: var(--color-primary); color: white; padding: 3.5rem 0; text-align: center;">
    <div class="container">
        @if($page->icon)
        <i class="{{ $page->icon }}" style="font-size: 2rem; margin-bottom: 0.8rem; display: block; opacity: 0.85;"></i>
        @endif
        <h1 style="color: white; font-size: 2.2rem; margin-bottom: 0;">{{ $page->title }}</h1>
    </div>
</div>

<div class="container reveal" style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-xl); max-width: 820px;">
    <div class="page-content" style="background: var(--color-bg-alt); padding: 2.5rem; border-radius: 12px; line-height: 1.8; font-size: 1rem;">
        <style>
            .page-content h2 { font-size: 1.6rem; color: var(--color-primary); margin-top: 0; margin-bottom: 1rem; font-family: var(--font-heading); }
            .page-content h3 { font-size: 1.2rem; color: #1f2937; margin-top: 2rem; margin-bottom: 0.8rem; font-family: var(--font-heading); }
            .page-content p { margin-bottom: 1rem; color: #374151; }
            .page-content ul { padding-left: 1.5rem; margin-bottom: 1.2rem; }
            .page-content ul li { margin-bottom: 0.5rem; color: #374151; }
            .page-content a { color: var(--color-primary); text-decoration: underline; font-weight: 500; }
            .page-content a:hover { color: var(--color-secondary); }
            .page-content strong { color: #111827; }
        </style>
        {!! $page->content !!}
    </div>

    <div style="margin-top: 1.5rem; text-align: center; font-size: 0.82rem; color: #9ca3af;">
        Last updated: {{ $page->updated_at->format('F j, Y') }}
    </div>
</div>
@endsection
