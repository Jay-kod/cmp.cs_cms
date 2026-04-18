@extends('layouts.public')

@section('title', 'Facilities & Labs')

@section('content')
<!-- Hero Section -->
<section class="page-hero pt-5 pb-5 bg-gradient-to-br from-[color:var(--color-primary)] to-emerald-700 text-white relative overflow-hidden" data-aos="fade-up">
    <div class="absolute inset-0 w-full h-full opacity-10 bg-[radial-gradient(circle_at_2px_2px,white_1px,transparent_0)] bg-[size:32px_32px]"></div>
    <div class="container relative z-10" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center col-md-10">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 text-emerald-200 rounded-full text-[0.85rem] font-semibold tracking-[1.5px] uppercase mb-6 border border-white/15">
                    <i class="fa-solid fa-server"></i> Discover
                </div>
                <h1 class="font-heading font-extrabold text-5xl mb-4 [text-shadow:0_4px_15px_rgba(0,0,0,0.2)]">Facilities & Labs</h1>
                <p class="text-[1.15rem] text-emerald-100 leading-[1.8] max-w-[700px] mx-auto">
                    {{ $settings['about_facilities_desc'] ?? 'Our department boasts state-of-the-art laboratories to support practical learning and research across various IT domains.' }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-5 bg-slate-50" data-aos="fade-up">
    <div class="container py-4">
        
        <div class="grid grid-cols-[repeat(auto-fit,minmax(320px,1fr))] gap-8">
            @php
                $labs = json_decode($settings['about_facilities'] ?? '[]', true) ?? [];
                if (empty($labs)) {
                    $labs = [
                        ['name' => 'Software Engineering Lab', 'icon' => 'fa-code', 'gradient' => 'linear-gradient(135deg, #16a34a, #15803d)', 'shadow_tw' => 'shadow-green-600/30', 'desc' => 'Modern IDEs and collaboration tools for full-stack software development, testing, and real-world project simulations.'],
                        ['name' => 'Hardware & Networking Lab', 'icon' => 'fa-network-wired', 'gradient' => 'linear-gradient(135deg, #10b981, #059669)', 'shadow_tw' => 'shadow-emerald-500/30', 'desc' => 'Hands-on experience with CISCO routing, switching, and embedded systems micro-controller design.'],
                        ['name' => 'AI & Data Science Hub', 'icon' => 'fa-microchip', 'gradient' => 'linear-gradient(135deg, #059669, #047857)', 'shadow_tw' => 'shadow-emerald-600/30', 'desc' => 'High-performance computing clusters for machine learning, big data analytics, and advanced algorithmic processing.'],
                        ['name' => 'Cybersecurity Lab', 'icon' => 'fa-shield-halved', 'gradient' => 'linear-gradient(135deg, #15803d, #14532d)', 'shadow_tw' => 'shadow-green-700/30', 'desc' => 'Dedicated environment for penetration testing, digital forensics, and cybersecurity research.'],
                    ];
                }
            @endphp
            @foreach($labs as $lab)
            <div data-aos="fade-up" class="flex flex-col gap-6 bg-white p-10 rounded-2xl border border-slate-200 transition-all duration-300 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:-translate-y-[5px] hover:shadow-[0_20px_40px_-10px_rgba(0,0,0,0.1)]">
                <div class="w-[72px] h-[72px] rounded-[18px] text-white flex items-center justify-center text-[2rem] shadow-lg {{ $lab['shadow_tw'] ?? 'shadow-green-600/30' }}" style="background: {{ $lab['gradient'] ?? 'linear-gradient(135deg, #16a34a, #15803d)' }};">
                    <i class="fa-solid {{ $lab['icon'] ?? 'fa-server' }}"></i>
                </div>
                <div>
                    <h3 class="text-[1.4rem] mb-3 text-slate-900 font-heading font-bold">{{ $lab['name'] ?? '' }}</h3>
                    <p class="m-0 text-slate-600 leading-[1.7] text-[1.05rem]">{!! nl2br(e($lab['desc'] ?? '')) !!}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endsection