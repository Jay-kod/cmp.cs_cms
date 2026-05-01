@extends('layouts.public')
@section('title', $page->title)

@section('content')
<!-- Hero -->
<div class="relative overflow-hidden bg-gradient-to-br from-[#102b1f] via-[#15803d] to-[#16a34a] pt-24 pb-36 md:pt-32 md:pb-48 flex items-center justify-center">
    <!-- Background Image with Overlay -->
    @if($page->hero_image)
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat mix-blend-overlay opacity-40 filter grayscale" style="background-image: url('{{ Storage::url($page->hero_image) }}');"></div>
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-[#102b1f] to-transparent opacity-80"></div>
    <!-- Subtle Grid Pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNykiLz48L3N2Zz4=')] opacity-50 z-0"></div>

    <div class="container relative z-10 px-4 flex flex-col items-center text-center">
        <!-- Badge -->
        <div data-aos="fade-up" class="inline-flex items-center gap-2.5 px-6 py-2 bg-white/10 border border-white/20 backdrop-blur-md text-green-100 rounded-full text-xs sm:text-sm font-bold uppercase tracking-widest mb-6 shadow-xl">
            @if($page->icon)
            <i class="{{ $page->icon }} text-green-300"></i>
            @else
            <i class="fa-solid fa-file-lines text-green-300"></i>
            @endif
            Information
        </div>
        
        <!-- Title -->
        <h1 data-aos="fade-up" data-aos-delay="100" class="text-white text-[clamp(2.5rem,5vw,4rem)] font-extrabold mb-4 tracking-tight leading-tight drop-shadow-2xl max-w-4xl">
            {{ $page->title }}
        </h1>
    </div>
</div>

<div class="container relative z-20 -mt-24 md:-mt-32 pb-24 max-w-5xl px-4 sm:px-6 mx-auto">
    
    @if($page->attachment)
    <!-- Attachment Card -->
    <div data-aos="fade-up" data-aos-delay="200" class="mb-8 bg-white rounded-3xl p-6 md:p-8 flex flex-col sm:flex-row items-center gap-6 shadow-[0_20px_40px_rgb(0,0,0,0.08)] border border-green-100">
        <div class="w-16 h-16 shrink-0 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-3xl shadow-inner">
            <i class="fa-regular fa-file-pdf"></i>
        </div>
        <div class="flex-grow text-center sm:text-left">
            <h3 class="text-xl font-bold text-slate-800 mb-1">Official Document Available</h3>
            <p class="text-slate-500 text-sm m-0">You can download or view the official attached document for this page.</p>
        </div>
        <div class="shrink-0">
            <a href="{{ Storage::url($page->attachment) }}" target="_blank" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 shadow-lg hover:shadow-green-600/30 hover:-translate-y-1">
                <i class="fa-solid fa-download"></i> View Document
            </a>
        </div>
    </div>
    @endif

    <!-- Content Card -->
    @if(!empty(trim(str_replace(['<p><br></p>', '<p></p>'], '', $page->content))))
    <div data-aos="fade-up" data-aos-delay="300" class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-8 md:p-12 overflow-x-auto">
        <div class="page-content">
            <style>
                .page-content h2 { font-size: 1.8rem; color: #15803d; margin-top: 0; margin-bottom: 1.2rem; font-family: var(--font-heading); font-weight: 800; }
                .page-content h3 { font-size: 1.4rem; color: #1e293b; margin-top: 2rem; margin-bottom: 1rem; font-family: var(--font-heading); font-weight: 700; }
                .page-content p { margin-bottom: 1.2rem; color: #475569; text-align: justify; line-height: 1.8; font-size: 1.05rem; }
                .page-content ul { padding-left: 1.5rem; margin-bottom: 1.5rem; list-style-type: disc; }
                .page-content ul li { margin-bottom: 0.5rem; color: #475569; line-height: 1.6; }
                .page-content a { color: #16a34a; text-decoration: underline; font-weight: 600; text-underline-offset: 4px; transition: color 0.2s; }
                .page-content a:hover { color: #15803d; }
                .page-content strong { color: #0f172a; font-weight: 700; }
                .page-content img { border-radius: 16px; margin: 2rem 0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); max-width: 100%; height: auto; }
                
                /* Table Styling specifically for Academic Calendar */
                .page-content table { width: 100%; border-collapse: separate; border-spacing: 0; margin-bottom: 2rem; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; }
                .page-content th, .page-content td { padding: 1.2rem; border-bottom: 1px solid #e2e8f0; text-align: left; }
                .page-content th { background-color: #f8fafc; font-weight: 700; color: #0f172a; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; }
                .page-content tr:last-child td { border-bottom: none; }
                .page-content tr:hover td { background-color: #f8fafc; }
            </style>
            
            {!! $page->content !!}
        </div>

        <div class="mt-12 pt-6 border-t border-slate-100 text-center flex items-center justify-center gap-2 text-sm text-slate-400 font-medium">
            <i class="fa-solid fa-clock-rotate-left"></i> Last updated: {{ $page->updated_at->format('F j, Y') }}
        </div>
    </div>
    @endif
</div>
@endsection
