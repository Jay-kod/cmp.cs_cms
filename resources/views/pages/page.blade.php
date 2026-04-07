@extends('layouts.public')
@section('title', $page->title)

@section('content')
<div class="page-header relative" style="@if($page->hero_image) background-image: url('{{ Storage::url($page->hero_image) }}'); background-size: cover; background-position: center; @else background: var(--color-primary); @endif color: white; padding: 5rem 0; text-align: center; display: flex; flex-direction: column; align-items: center; position: relative;">
    @if($page->hero_image)
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(5, 150, 105, 0.85); z-index: 1;"></div>
    @endif
    <div class="container relative" data-aos="fade-up" style="z-index: 2;">
        @if($page->icon)
        <i class="{{ $page->icon }}" style="font-size: 2.5rem; margin-bottom: 1rem; display: block; opacity: 0.9;"></i>
        @endif
        <h1 style="color: white; font-size: 2.8rem; margin-bottom: 0; font-weight: 700; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">{{ $page->title }}</h1>
    </div>
</div>

<div class="container" data-aos="fade-up" style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-xl); max-width: 820px;">
    
    @if($page->attachment)
    <div style="margin-bottom: 2rem; background: #ecfdf5; border: 1px solid #a7f3d0; padding: 1.5rem; border-radius: 8px; display: flex; flex-direction: column; align-items: center; gap: 0.8rem; text-align: center;" data-aos="fade-up">
        <div style="background: #10b981; color: white; width: 48px; height: 48px; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 1.5rem; box-shadow: 0 4px 6px rgba(16,185,129,0.3);">
            <i class="fa-solid fa-file-pdf"></i>
        </div>
        <h3 style="margin: 0; color: #065f46; font-size: 1.2rem;">Official Document Available</h3>
        <p style="margin: 0; color: #047857; font-size: 0.95rem;">You can download or view the attached file for "{{ $page->title }}" below.</p>
        <a href="{{ Storage::url($page->attachment) }}" target="_blank" class="btn" style="background: #059669; color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 999px; font-weight: 600; font-size: 0.95rem; text-decoration: none; margin-top: 0.5rem; display: inline-flex; align-items: center; gap: 0.5rem; transition: background 0.2s, transform 0.2s;" onmouseover="this.style.background='#047857'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#059669'; this.style.transform='translateY(0)'">
            <i class="fa-solid fa-download"></i> Download / View Uploaded File
        </a>
    </div>
    @endif

    <div class="page-content" style="background: var(--color-bg-alt); padding: 2.5rem; border-radius: 12px; line-height: 1.8; font-size: 1rem;">
        <style>
            .page-content h2 { font-size: 1.6rem; color: var(--color-primary); margin-top: 0; margin-bottom: 1rem; font-family: var(--font-heading); }
            .page-content h3 { font-size: 1.2rem; color: #1f2937; margin-top: 2rem; margin-bottom: 0.8rem; font-family: var(--font-heading); }
            .page-content p { margin-bottom: 1rem; color: #374151; text-align: justify; }
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

<style>
/* Generic Page Responsive */
@media (max-width: 768px) {
    .page-header[style*="padding: 3.5rem"] { padding: 2.5rem 0 !important; }
    .page-header h1[style*="font-size: 2.2rem"] { font-size: 1.7rem !important; }
    .page-content[style*="padding: 2.5rem"] { padding: 1.5rem !important; }
}
@media (max-width: 575px) {
    .page-header[style*="padding: 3.5rem"] { padding: 2rem 0 !important; }
    .page-header h1[style*="font-size: 2.2rem"] { font-size: 1.4rem !important; }
    .page-content[style*="padding: 2.5rem"] { padding: 1.2rem !important; }
    .page-content h2 { font-size: 1.3rem !important; }
}
</style>
@endsection
