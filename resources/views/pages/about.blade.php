@extends('layouts.public')

@section('title', 'About Us')

@section('content')
<div class="page-header" style="background: var(--color-primary); color: white; padding: 4rem 0; text-align: center;">
    <div class="container">
        <h1 style="color: white; font-size: 2.5rem; margin-bottom: 0;">About the Department</h1>
    </div>
</div>

<div class="container page-layout reveal" style="margin-top: var(--spacing-lg);">
    <div class="main-content">
        <section id="our-story" style="margin-bottom: var(--spacing-xl);">
            <h2>Our Story</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            <p style="font-size: 1.05rem; line-height: 1.8; color: var(--color-text-main);">
                Founded in {{ config('university.established') }}, the Department of Computer Science at {{ config('university.short_name') }} has grown to become one of the premier institutions for computing education in Nigeria. We have consistently refined our curriculum to match the rapid advancements in global technology. Over the decades, we have produced thousands of graduates who now lead innovative tech initiatives globally.
            </p>
        </section>

        <section id="vision-mission" style="margin-bottom: var(--spacing-xl); display: flex; gap: var(--spacing-lg); flex-wrap: wrap;">
            <div style="flex: 1; min-width: 300px; background: var(--color-bg-alt); padding: 2rem; border-radius: 8px; border-top: 4px solid var(--color-accent);">
                <h3><i class="fa-solid fa-eye" style="color: var(--color-primary); margin-right: 10px;"></i> Vision</h3>
                <p>{{ $settings['vision_statement'] ?? 'To be a world-class centre of excellence in computing research and education.' }}</p>
            </div>
            <div style="flex: 1; min-width: 300px; background: var(--color-bg-alt); padding: 2rem; border-radius: 8px; border-top: 4px solid var(--color-secondary);">
                <h3><i class="fa-solid fa-bullseye" style="color: var(--color-primary); margin-right: 10px;"></i> Mission</h3>
                <p>{{ $settings['mission_statement'] ?? 'To produce highly skilled IT professionals capable of competing globally and solving local challenges.' }}</p>
            </div>
        </section>

        <section id="core-values" style="margin-bottom: var(--spacing-xl);">
            <h2>Core Values</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--spacing-md);">
                @php
                    $values = explode(',', $settings['core_values'] ?? 'Excellence, Integrity, Innovation, Collaboration');
                    $icons = ['fa-star', 'fa-shield-halved', 'fa-lightbulb', 'fa-handshake'];
                @endphp
                @foreach($values as $index => $val)
                <div style="text-align: center; padding: 2rem; background: var(--color-bg-alt); border-radius: 8px; border: 1px solid var(--color-border);">
                    <i class="fa-solid {{ $icons[$index % 4] }}" style="font-size: 2.5rem; color: var(--color-secondary); margin-bottom: 1rem;"></i>
                    <h4 style="margin: 0; font-size: 1.2rem;">{{ trim($val) }}</h4>
                </div>
                @endforeach
            </div>
        </section>

        <section id="facilities" style="margin-bottom: var(--spacing-xl);">
            <h2>Facilities & Labs</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            <p style="margin-bottom: 1.5rem;">Our department boasts state-of-the-art laboratories to support practical learning and research across various IT domains:</p>
            <ul style="list-style-type: none; padding: 0;">
                <li style="margin-bottom: 1.5rem; display: flex; gap: 1rem; background: var(--color-bg-alt); padding: 1.5rem; border-radius: 8px;">
                    <i class="fa-solid fa-code" style="color: var(--color-primary); font-size: 2rem; margin-top: 4px;"></i> 
                    <div>
                        <strong style="font-size: 1.1rem; display: block; margin-bottom: 0.5rem;">Software Engineering Lab</strong>
                        <span style="color: var(--color-text-muted);">Equipped with modern IDEs and collaboration tools for full-stack software development and testing.</span>
                    </div>
                </li>
                <li style="margin-bottom: 1.5rem; display: flex; gap: 1rem; background: var(--color-bg-alt); padding: 1.5rem; border-radius: 8px;">
                    <i class="fa-solid fa-network-wired" style="color: var(--color-primary); font-size: 2rem; margin-top: 4px;"></i> 
                    <div>
                        <strong style="font-size: 1.1rem; display: block; margin-bottom: 0.5rem;">Hardware & Networking Lab</strong>
                        <span style="color: var(--color-text-muted);">Provides hands-on experience with CISCO routing, switching, and embedded systems micro-controller design.</span>
                    </div>
                </li>
                <li style="margin-bottom: 1.5rem; display: flex; gap: 1rem; background: var(--color-bg-alt); padding: 1.5rem; border-radius: 8px;">
                    <i class="fa-solid fa-microchip" style="color: var(--color-primary); font-size: 2rem; margin-top: 4px;"></i> 
                    <div>
                        <strong style="font-size: 1.1rem; display: block; margin-bottom: 0.5rem;">AI & Data Science Hub</strong>
                        <span style="color: var(--color-text-muted);">High-performance computing clusters dedicated to machine learning and big data analytics research.</span>
                    </div>
                </li>
            </ul>
        </section>
    </div>

    <!-- The exact component we built previously -->
    <x-sticky-toc :sections="['our-story' => 'Our Story', 'vision-mission' => 'Vision & Mission', 'core-values' => 'Core Values', 'facilities' => 'Facilities & Labs']" />
</div>
@endsection
