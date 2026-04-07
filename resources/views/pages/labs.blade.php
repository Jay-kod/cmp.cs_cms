@extends('layouts.public')

@section('title', 'Facilities & Labs')

@section('content')
<!-- Hero Section -->
<section data-aos="fade-up" class="page-hero pt-5 pb-5" style="background: linear-gradient(135deg, var(--color-primary) 0%, #047857 100%); color: white; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
    <div class="container" data-aos="fade-up" style="position: relative; z-index: 10;">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center col-md-10">
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.35rem 1rem; background: rgba(255,255,255,0.1); color: #a7f3d0; border-radius: 20px; font-size: 0.85rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.15);">
                    <i class="fa-solid fa-server"></i> Discover
                </div>
                <h1 style="font-family: var(--font-heading); font-weight: 800; font-size: 3rem; margin-bottom: 1rem; text-shadow: 0 4px 15px rgba(0,0,0,0.2);">Facilities & Labs</h1>
                <p style="font-size: 1.15rem; color: #d1fae5; line-height: 1.8; max-width: 700px; margin: 0 auto;">
                    {{ $settings['about_facilities_desc'] ?? 'Our department boasts state-of-the-art laboratories to support practical learning and research across various IT domains.' }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section data-aos="fade-up" class="py-5" style="background: #f8fafc;">
    <div class="container py-4">
        
        <div class="about-facilities-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
            @php
                $labs = json_decode($settings['about_facilities'] ?? '[]', true) ?? [];
                if (empty($labs)) {
                    $labs = [
                        ['name' => 'Software Engineering Lab', 'icon' => 'fa-code', 'gradient' => 'linear-gradient(135deg, #16a34a, #15803d)', 'shadow' => 'rgba(22,163,74,0.3)', 'desc' => 'Modern IDEs and collaboration tools for full-stack software development, testing, and real-world project simulations.'],
                        ['name' => 'Hardware & Networking Lab', 'icon' => 'fa-network-wired', 'gradient' => 'linear-gradient(135deg, #10b981, #059669)', 'shadow' => 'rgba(16,185,129,0.3)', 'desc' => 'Hands-on experience with CISCO routing, switching, and embedded systems micro-controller design.'],
                        ['name' => 'AI & Data Science Hub', 'icon' => 'fa-microchip', 'gradient' => 'linear-gradient(135deg, #059669, #047857)', 'shadow' => 'rgba(5,150,105,0.3)', 'desc' => 'High-performance computing clusters for machine learning, big data analytics, and advanced algorithmic processing.'],
                        ['name' => 'Cybersecurity Lab', 'icon' => 'fa-shield-halved', 'gradient' => 'linear-gradient(135deg, #15803d, #14532d)', 'shadow' => 'rgba(21,128,61,0.3)', 'desc' => 'Dedicated environment for penetration testing, digital forensics, and cybersecurity research.'],
                    ];
                }
            @endphp
            @foreach($labs as $lab)
            <div class="about-facilities-card" style="display: flex; flex-direction: column; gap: 1.5rem; background: white; padding: 2.5rem; border-radius: 16px; border: 1px solid #e2e8f0; transition: all 0.3s; box-shadow: 0 4px 20px rgba(0,0,0,0.03);" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 20px 40px -10px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.03)'">
                <div style="width: 72px; height: 72px; border-radius: 18px; background: {{ $lab['gradient'] ?? 'linear-gradient(135deg, #16a34a, #15803d)' }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 2rem; box-shadow: 0 10px 25px -5px {{ $lab['shadow'] ?? 'rgba(22,163,74,0.3)' }};">
                    <i class="fa-solid {{ $lab['icon'] ?? 'fa-server' }}"></i>
                </div>
                <div>
                    <h3 style="font-size: 1.4rem; margin-bottom: 0.8rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">{{ $lab['name'] ?? '' }}</h3>
                    <p style="margin: 0; color: #475569; line-height: 1.7; font-size: 1.05rem;">{!! nl2br(e($lab['desc'] ?? '')) !!}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endsection