@extends('layouts.public')

@section('title', 'Home')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::where('key', $key)->value('value') ?? $default;
@endphp
<!-- ═══════════════════════════════════════════════
     HERO CAROUSEL — Dynamic from Database
     ═══════════════════════════════════════════════ -->
<style>
    .hero-carousel .carousel-arrow {
        opacity: 0;
        transition: opacity 0.3s ease, background 0.3s ease;
    }
    .hero-carousel:hover .carousel-arrow {
        opacity: 1;
    }
</style>
<section class="hero-carousel" style="position: relative; overflow: hidden; height: 652px;">
    <!-- Slides -->
    <div class="carousel-track" id="carouselTrack" style="display: flex; height: 100%; transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
        
        @forelse($carouselSlides as $slide)
        <div class="carousel-slide" style="min-width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; text-align: center; color: white; position: relative; {{ $slide->image_url ? "background: url('".$slide->image_url."') center/cover no-repeat;" : "background: linear-gradient(135deg, var(--color-primary) 0%, #1e293b 100%);" }}">
            <!-- Rich Gradient Overlay -->
            <div style="position: absolute; inset: 0; background: linear-gradient(to bottom, {{ $slide->overlay_color ?? 'rgba(6, 78, 30, 0.7)' }}, rgba(6, 50, 20, 0.92));"></div>
            
            <!-- Animated decorative elements -->
            <div style="position: absolute; top: 15%; left: 10%; width: 120px; height: 120px; border: 1px solid rgba(255,255,255,0.05); border-radius: 50%; pointer-events: none;"></div>
            <div style="position: absolute; bottom: 20%; right: 15%; width: 250px; height: 250px; border: 1px solid rgba(255,255,255,0.03); border-radius: 50%; pointer-events: none;"></div>
            
            <div class="container" style="position: relative; z-index: 10; max-width: 850px; padding: 0 1.5rem;">
                <span style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.1); backdrop-filter: blur(8px); padding: 0.4rem 1.2rem; border-radius: 30px; font-size: 0.8rem; font-weight: 700; margin-bottom: 1.5rem; letter-spacing: 1.5px; text-transform: uppercase; color: #a7f3d0; border: 1px solid rgba(255,255,255,0.15);">
                    <i class="fa-solid fa-code" style="font-size: 0.7rem;"></i> {{ config('university.short_name') }} &middot; Computer Science
                </span>
                <h1 style="color: white; font-size: 3.8rem; font-family: var(--font-heading); font-weight: 800; margin-bottom: 1.2rem; line-height: 1.1; text-shadow: 0 10px 30px rgba(0,0,0,0.5);">{{ $slide->title }}</h1>
                @if($slide->subtitle)
                <p style="font-size: 1.15rem; color: #cbd5e1; margin: 0 auto 2.5rem; max-width: 700px; line-height: 1.7; text-shadow: 0 4px 10px rgba(0,0,0,0.3);">{{ $slide->subtitle }}</p>
                @endif
                @if($slide->button_text)
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ $slide->button_url ?? '#' }}" class="btn" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); color: white; font-weight: 700; padding: 0.9rem 2.5rem; font-size: 1.05rem; border-radius: 8px; border: none; box-shadow: 0 10px 25px -5px rgba(22, 163, 74, 0.4); display: inline-flex; align-items: center; gap: 0.6rem; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 35px -5px rgba(22, 163, 74, 0.5)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px -5px rgba(22, 163, 74, 0.4)'">
                        {{ $slide->button_text }} <i class="fa-solid fa-arrow-right" style="font-size: 0.9rem;"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
        @empty
        {{-- Fallback if no slides in DB --}}
        <div class="carousel-slide" style="min-width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; text-align: center; color: white; position: relative; background: linear-gradient(135deg, var(--color-primary) 0%, #1e293b 100%);">
            <div style="position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.95));"></div>
            
            <div style="position: absolute; top: 15%; left: 10%; width: 120px; height: 120px; border: 1px solid rgba(255,255,255,0.05); border-radius: 50%; pointer-events: none;"></div>
            <div style="position: absolute; bottom: 20%; right: 15%; width: 250px; height: 250px; border: 1px solid rgba(255,255,255,0.03); border-radius: 50%; pointer-events: none;"></div>
            
            <div class="container" style="position: relative; z-index: 10; max-width: 850px; padding: 0 1.5rem;">
                <span style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.1); backdrop-filter: blur(8px); padding: 0.4rem 1.2rem; border-radius: 30px; font-size: 0.8rem; font-weight: 700; margin-bottom: 1.5rem; letter-spacing: 1.5px; text-transform: uppercase; color: #a7f3d0; border: 1px solid rgba(255,255,255,0.15);">
                    <i class="fa-solid fa-laptop-code" style="font-size: 0.7rem;"></i> {{ config('university.short_name') }} &middot; Computer Science
                </span>
                <h1 style="color: white; font-size: 3.8rem; font-family: var(--font-heading); font-weight: 800; margin-bottom: 1.2rem; line-height: 1.1; text-shadow: 0 10px 30px rgba(0,0,0,0.5);">Empowering the Future<br>of Computing</h1>
                <p style="font-size: 1.15rem; color: #cbd5e1; margin: 0 auto 2.5rem; max-width: 700px; line-height: 1.7; text-shadow: 0 4px 10px rgba(0,0,0,0.3);">Discover world-class education, pioneering research, and a community dedicated to solving global challenges through technology.</p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="/about" class="btn" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); color: white; font-weight: 700; padding: 0.9rem 2.5rem; font-size: 1.05rem; border-radius: 8px; border: none; box-shadow: 0 10px 25px -5px rgba(22, 163, 74, 0.4); display: inline-flex; align-items: center; gap: 0.6rem; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 35px -5px rgba(22, 163, 74, 0.5)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px -5px rgba(22, 163, 74, 0.4)'">
                        Explore Department <i class="fa-solid fa-arrow-right" style="font-size: 0.9rem;"></i>
                    </a>
                    <a href="/academics" class="btn" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(4px); color: white; font-weight: 700; padding: 0.9rem 2.5rem; font-size: 1.05rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); display: inline-flex; align-items: center; gap: 0.6rem; transition: background 0.2s, transform 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
                        View Programmes
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    @if($carouselSlides->count() > 1)
    <!-- Navigation Arrows -->
    <button class="carousel-arrow" onclick="moveCarousel(-1)" style="position: absolute; left: 30px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.1); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.2); color: white; width: 54px; height: 54px; border-radius: 50%; cursor: pointer; font-size: 1.3rem; z-index: 10; box-shadow: 0 4px 15px rgba(0,0,0,0.1);" onmouseover="this.style.background='var(--color-primary)'; this.style.borderColor='var(--color-primary)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.2)'"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="carousel-arrow" onclick="moveCarousel(1)" style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.1); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.2); color: white; width: 54px; height: 54px; border-radius: 50%; cursor: pointer; font-size: 1.3rem; z-index: 10; box-shadow: 0 4px 15px rgba(0,0,0,0.1);" onmouseover="this.style.background='var(--color-primary)'; this.style.borderColor='var(--color-primary)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.2)'"><i class="fa-solid fa-chevron-right"></i></button>

    <!-- Dot Indicators -->
    <div style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); display: flex; gap: 12px; z-index: 10;">
        @foreach($carouselSlides as $i => $dot)
        <button class="carousel-dot {{ $i === 0 ? 'active' : '' }}" onclick="goToSlide({{ $i }})" style="width: 14px; height: 14px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.5); background: {{ $i === 0 ? 'white' : 'transparent' }}; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.borderColor='white'"></button>
        @endforeach
    </div>
    @endif
    
    <!-- Glassmorphism Announcements Ticker (Overlaps Hero Bottom) -->
    @if($announcements->count() > 0)
    <div style="position: absolute; bottom: 0; left: 0; width: 100%; z-index: 20; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(12px); border-top: 1px solid rgba(255,255,255,0.1); border-bottom: 2px solid var(--color-primary);">
        <div class="container" style="display: flex; align-items: center; gap: 1.5rem; padding: 0.8rem 1rem;">
            <div style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); color: white; padding: 0.3rem 0.8rem; border-radius: 6px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; white-space: nowrap; letter-spacing: 1px; box-shadow: 0 2px 10px rgba(22, 163, 74, 0.4); display: flex; align-items: center; gap: 0.4rem;">
                <i class="fa-solid fa-bolt"></i> Notice
            </div>
            <div style="overflow: hidden; flex: 1;">
                <div class="announcement-scroll" style="display: flex; gap: 4rem; animation: scrollAnnouncements 25s linear infinite; white-space: nowrap;">
                    @foreach($announcements as $announcement)
                    <span style="color: #cbd5e1; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.6rem;">
                        <strong style="color: white; font-weight: 600;">{{ $announcement->title }} <span style="color: #64748b; font-weight: 400; margin: 0 0.3rem;">&mdash;</span></strong> {{ Str::limit($announcement->body, 120) }}
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</section>

<!-- ═══════════════════════════════════════════════
     HOD WELCOME + STATS (Combined Section)
     ═══════════════════════════════════════════════ -->
<section style="padding: 5rem 0 0; background: #f8fafc; position: relative; overflow: hidden;">
    <!-- Abstract Background Decor -->
    <div style="position: absolute; top: -100px; right: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(22,163,74,0.08) 0%, transparent 70%); pointer-events: none;"></div>
    <div style="position: absolute; bottom: -50px; left: 10%; width: 250px; height: 250px; background: radial-gradient(circle, rgba(22,163,74,0.06) 0%, transparent 70%); pointer-events: none;"></div>
    
    <div class="container" style="display: flex; gap: 5rem; align-items: center; flex-wrap: wrap; position: relative; z-index: 2;">
        <!-- HoD Photo -->
        <div style="flex: 0 0 300px; max-width: 100%; position: relative;">
            <div style="position: absolute; inset: -12px -12px 12px 12px; border: 2px solid var(--color-primary); border-radius: 14px; z-index: 1;"></div>
            <div style="position: absolute; inset: 12px 12px -12px -12px; background: rgba(22,163,74,0.1); border-radius: 14px; z-index: 1;"></div>
            
            <div style="position: relative; z-index: 2; aspect-ratio: 3/4; border-radius: 14px; overflow: hidden; box-shadow: 0 20px 40px -12px rgba(0,0,0,0.15); border: 6px solid white;">
                @if($gs('hod_photo'))
                    <img src="{{ asset('storage/'.$gs('hod_photo')) }}" alt="{{ $gs('hod_name', $hod->name ?? 'HOD') }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                @elseif($hod && $hod->photo)
                    <img src="{{ asset('storage/'.$hod->photo) }}" alt="{{ $hod->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                @else
                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); color:white; font-size:6rem;"><i class="fa-solid fa-user-tie"></i></div>
                @endif
                
                <!-- Floating Badge -->
                <div style="position: absolute; bottom: 20px; right: -20px; background: white; padding: 1rem 1.5rem; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 40px; height: 40px; background: rgba(22,163,74,0.12); color: var(--color-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <div>
                        <p style="margin: 0; font-weight: 800; color: #0f172a; font-size: 1.1rem; font-family: var(--font-heading); line-height: 1;">{{ $gs('home_hod_badge_title','Excellence') }}</p>
                        <p style="margin: 0; font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-top: 0.2rem;">{{ $gs('home_hod_badge_subtitle','In Leadership') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- HoD Text -->
        <div style="flex: 1; min-width: 320px;">
            <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(22,163,74,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_hod_badge','Welcome Message') }}</span>
            <h2 style="font-size: 2.8rem; margin-bottom: 1.5rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; line-height: 1.15;">{{ $gs('home_hod_title','From the Head of Department') }}</h2>
            
            <div style="position: relative; padding-left: 2rem; margin-bottom: 2.5rem;">
                <i class="fa-solid fa-quote-left" style="position: absolute; top: -10px; left: -10px; font-size: 3.5rem; color: rgba(22,163,74,0.1); z-index: 0;"></i>
                <blockquote style="position: relative; z-index: 1; font-size: 1.15rem; color: #475569; line-height: 1.8; margin: 0; font-style: italic; text-align: justify;">
                    "{!! nl2br(e($gs('hod_welcome_message', 'Welcome to the Department of Computer Science. We are committed to providing world-class computing education.'))) !!}"
                </blockquote>
            </div>
            
            @if($hod || $gs('hod_name'))
            <div style="display: inline-flex; align-items: center; gap: 1.2rem; background: white; padding: 1rem 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0;">
                <div style="width: 4px; height: 35px; background: linear-gradient(to bottom, var(--color-primary), var(--color-secondary)); border-radius: 2px;"></div>
                <div>
                    <h4 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 1.1rem; font-family: var(--font-heading);">{{ $gs('hod_name', $hod->name ?? '') }}</h4>
                    <p style="margin: 0; color: #64748b; font-size: 0.9rem; font-weight: 500;">{{ $gs('hod_rank', $hod->rank ?? '') }}, Head of Department</p>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Stats Counter Cards — integrated into HOD section -->
    <div class="container" style="margin-top: 4rem; padding-bottom: 4rem;">
        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 1.2rem; text-align: center;">
            @foreach([1,2,3,4,5] as $n)
            @php
                $statIcon  = $gs("stat_{$n}_icon",  ['fa-regular fa-building','fa-solid fa-book-open','fa-solid fa-graduation-cap','fa-solid fa-building-user','fa-solid fa-medal'][$n-1]);
                $statValue = $gs("stat_{$n}_value", [config('university.established'), $courseCount, $programmes->count(), '6', 'NUC'][$n-1]);
                $statLabel = $gs("stat_{$n}_label", ['Established','Courses','Programmes','Departments','Full Accreditation'][$n-1]);
            @endphp
            <div class="stat-card">
                <div class="stat-bg-icon"><i class="{{ $statIcon }}"></i></div>
                <h2 class="stat-number">{{ $statValue }}</h2>
                <p>{{ $statLabel }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     PROGRAMMES — Premium Glassmorphism Hover Cards
     ═══════════════════════════════════════════════ -->
<section style="padding: 6rem 0; background: linear-gradient(to bottom, white 0%, #f8fafc 100%); position: relative;">
    <!-- Abstract wavy shape at the top -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; overflow: hidden; line-height: 0;">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 50px;">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" style="fill: #f8fafc;"></path>
        </svg>
    </div>
    
    <div class="container" style="position: relative; z-index: 2;">
        <div style="text-align: center; margin-bottom: 4rem;">
            <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(59,130,246,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_programmes_badge','What We Offer') }}</span>
            <h2 style="font-size: 2.8rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin-bottom: 1rem;">{{ $gs('home_programmes_title','Academic Programmes') }}</h2>
            <p style="color: #64748b; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.7;">{{ $gs('home_programmes_subtitle','Comprehensive undergraduate and postgraduate programmes designed to shape the next generation of global tech leaders.') }}</p>
        </div>
        
        <div class="hover-card-grid">
            @php
                $progColors = [
                    ['from' => '#16a34a', 'to' => '#059669', 'bg' => 'rgba(22,163,74,0.08)', 'badge' => '#dcfce7', 'badgeText' => '#15803d'],
                    ['from' => '#2563eb', 'to' => '#7c3aed', 'bg' => 'rgba(37,99,235,0.08)', 'badge' => '#dbeafe', 'badgeText' => '#1d4ed8'],
                    ['from' => '#0891b2', 'to' => '#0284c7', 'bg' => 'rgba(8,145,178,0.08)', 'badge' => '#cffafe', 'badgeText' => '#0e7490'],
                    ['from' => '#ea580c', 'to' => '#dc2626', 'bg' => 'rgba(234,88,12,0.08)', 'badge' => '#ffedd5', 'badgeText' => '#c2410c'],
                ];
                $progIcons = ['fa-solid fa-code', 'fa-solid fa-server', 'fa-solid fa-shield-halved', 'fa-solid fa-microchip', 'fa-solid fa-database'];
            @endphp
            @foreach($programmes as $pIdx => $prog)
            @php $pc = $progColors[$pIdx % count($progColors)]; @endphp
            <a href="/academics#{{ $prog->slug }}" class="hover-card" style="background: white; border-radius: 20px; text-decoration: none; color: inherit; position: relative; overflow: hidden; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); display: flex; flex-direction: column; box-shadow: 0 4px 20px -5px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 40px -10px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px -5px rgba(0,0,0,0.08)'">
                {{-- Gradient Header Strip --}}
                <div style="height: 6px; background: linear-gradient(90deg, {{ $pc['from'] }}, {{ $pc['to'] }});"></div>

                <div style="padding: 2rem 2rem 1.5rem;">
                    {{-- Icon + Badge Row --}}
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.2rem;">
                        <div style="width: 56px; height: 56px; border-radius: 16px; background: {{ $pc['bg'] }}; color: {{ $pc['from'] }}; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                            <i class="{{ $progIcons[$pIdx % count($progIcons)] }}"></i>
                        </div>
                        <span style="background: {{ $pc['badge'] }}; color: {{ $pc['badgeText'] }}; font-size: 0.78rem; font-weight: 800; padding: 0.35rem 1rem; border-radius: 20px; letter-spacing: 0.5px; text-transform: uppercase;">{{ $prog->level }}</span>
                    </div>

                    {{-- Programme Name --}}
                    <h3 style="font-size: 1.25rem; margin: 0 0 0.8rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800; line-height: 1.3;">{{ $prog->name }}</h3>

                    {{-- Description --}}
                    <p style="font-size: 0.9rem; color: #64748b; line-height: 1.65; flex: 1; margin: 0;">{{ Str::limit($prog->description, 110) }}</p>
                </div>

                {{-- Footer --}}
                <div style="padding: 1rem 2rem; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; margin-top: auto; background: #fafbfc;">
                    <div style="display: flex; gap: 1.2rem; font-size: 0.8rem; color: #475569; font-weight: 600;">
                        <span style="display: flex; align-items: center; gap: 0.35rem;"><i class="fa-regular fa-clock" style="color: {{ $pc['from'] }};"></i> {{ $prog->duration }}</span>
                        <span style="display: flex; align-items: center; gap: 0.35rem;"><i class="fa-solid fa-book-open" style="color: {{ $pc['from'] }};"></i> {{ $prog->mode_of_study }}</span>
                    </div>
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: {{ $pc['bg'] }}; color: {{ $pc['from'] }}; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; transition: all 0.3s;" class="card-arrow"><i class="fa-solid fa-arrow-right"></i></div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     MEET OUR STAFF
     ═══════════════════════════════════════════════ -->
<section style="padding: 6rem 0; background: white; position: relative; overflow: hidden;">
    <div style="position: absolute; top: -80px; left: -80px; width: 250px; height: 250px; background: radial-gradient(circle, rgba(22,163,74,0.06) 0%, transparent 70%); pointer-events: none;"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div style="text-align: center; margin-bottom: 4rem;">
            <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(22,163,74,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_staff_badge','Our Team') }}</span>
            <h2 style="font-size: 2.8rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin-bottom: 1rem;">{{ $gs('home_staff_title','Meet Our Faculty') }}</h2>
            <p style="color: #64748b; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.7;">{{ $gs('home_staff_subtitle','Dedicated academics and researchers shaping the future of computer science education.') }}</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            @foreach($featuredStaff as $member)
            <a href="{{ route('people.show', $member->slug) }}" class="staff-home-card" style="text-decoration: none; color: inherit; background: #f8fafc; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; transition: all 0.35s ease;">
                <div style="height: 260px; overflow: hidden; position: relative;">
                    @if($member->photo)
                        <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                    @else
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #14532d, #166534); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.3); font-size: 5rem;">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                    @endif
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 60px; background: linear-gradient(to top, rgba(0,0,0,0.4), transparent); pointer-events: none;"></div>
                </div>
                <div style="padding: 1.2rem 1.5rem;">
                    <h3 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0 0 0.3rem; font-family: var(--font-heading);">{{ $member->name }}</h3>
                    <p style="font-size: 0.85rem; color: var(--color-primary); font-weight: 600; margin: 0;">{{ $member->rank ?? 'Lecturer' }}</p>
                </div>
            </a>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="/people" style="display: inline-flex; align-items: center; gap: 0.6rem; background: var(--color-primary); color: white; padding: 0.8rem 2rem; border-radius: 10px; font-size: 1rem; font-weight: 700; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 15px rgba(22,163,74,0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(22,163,74,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(22,163,74,0.3)'">
                {{ $gs('home_staff_btn_text','View All Staff') }} <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     GALLERY SHOWCASE
     ═══════════════════════════════════════════════ -->
@if($galleryImages->count())
<section style="padding: 6rem 0; background: #0f172a; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(22,163,74,0.08) 0%, transparent 50%, rgba(22,163,74,0.05) 100%); pointer-events: none;"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span style="display: inline-block; color: #86efac; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(134,239,172,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_gallery_badge','Photo Gallery') }}</span>
                <h2 style="font-size: 2.8rem; font-family: var(--font-heading); font-weight: 800; color: white; margin: 0;">{{ $gs('home_gallery_title','Department Life') }}</h2>
                <p style="color: #94a3b8; font-size: 1.05rem; margin-top: 0.5rem;">{{ $gs('home_gallery_subtitle','Moments from events, lectures, and campus life') }} — {{ $galleryAlbumCount }} {{ Str::plural('album', $galleryAlbumCount) }}.</p>
            </div>
            <a href="{{ route('gallery.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #86efac; font-weight: 700; text-decoration: none; font-size: 0.95rem; transition: gap 0.2s;" onmouseover="this.style.gap='0.8rem'" onmouseout="this.style.gap='0.5rem'">
                {{ $gs('home_gallery_btn_text','View All Photos') }} <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.8rem;">
            @foreach($galleryImages as $img)
            <div class="gallery-home-item" style="aspect-ratio: {{ $loop->first || $loop->index === 3 ? '1/1' : '4/3' }}; border-radius: 12px; overflow: hidden; position: relative; cursor: pointer; {{ $loop->first ? 'grid-row: span 2;' : '' }}">
                <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $img->caption ?? '' }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 50%); opacity: 0; transition: opacity 0.3s; display: flex; align-items: flex-end; padding: 1rem;" class="gallery-overlay">
                    @if($img->caption)
                    <span style="color: white; font-size: 0.85rem; font-weight: 600;">{{ $img->caption }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ═══════════════════════════════════════════════
     DEPARTMENT SYSTEMS / EXTERNAL LINKS
     ═══════════════════════════════════════════════ -->
@if($externalSystems->count())
<section style="padding: 6rem 0; background: linear-gradient(to bottom, #f8fafc, white); position: relative;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 4rem;">
            <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(22,163,74,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_systems_badge','Quick Access') }}</span>
            <h2 style="font-size: 2.8rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin-bottom: 1rem;">{{ $gs('home_systems_title','Department Systems') }}</h2>
            <p style="color: #64748b; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.7;">{{ $gs('home_systems_subtitle','Access our online platforms, portals, and tools for students and staff.') }}</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem;">
            @foreach($externalSystems as $sys)
            <a href="{{ $sys->url }}" {{ $sys->open_in_new_tab ? 'target="_blank" rel="noopener"' : '' }} class="system-card" style="display: flex; flex-direction: column; align-items: center; text-align: center; gap: 1rem; padding: 2rem 1.5rem; background: white; border: 1px solid #e2e8f0; border-radius: 16px; text-decoration: none; transition: all 0.35s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.04); position: relative; overflow: hidden;">
                <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-secondary)); transform: scaleX(0); transition: transform 0.3s; transform-origin: left;" class="sys-bar"></div>
                <div style="width: 56px; height: 56px; background: rgba(22,163,74,0.1); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: var(--color-primary); font-size: 1.5rem; transition: all 0.3s;">
                    <i class="{{ $sys->icon ?? 'fa-solid fa-globe' }}"></i>
                </div>
                <div>
                    <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; margin: 0 0 0.3rem; font-family: var(--font-heading);">{{ $sys->name }}</h3>
                    @if($sys->description ?? false)
                    <p style="font-size: 0.85rem; color: #64748b; margin: 0; line-height: 1.4;">{{ Str::limit($sys->description, 60) }}</p>
                    @endif
                </div>
                <span style="font-size: 0.8rem; font-weight: 600; color: var(--color-primary); display: flex; align-items: center; gap: 0.3rem;">
                    Visit {{ $sys->open_in_new_tab ? '' : '' }}<i class="fa-solid {{ $sys->open_in_new_tab ? 'fa-up-right-from-square' : 'fa-arrow-right-long' }}" style="font-size: 0.7rem;"></i>
                </span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ═══════════════════════════════════════════════
     NACOS — Student Association Spotlight
     ═══════════════════════════════════════════════ -->
<section class="nacos-home-section" style="padding: 3.5rem 0; background: linear-gradient(165deg, #0f172a 0%, #1e293b 60%, #0f4c2e 100%); position: relative; overflow: hidden;">
    {{-- Decorative background --}}
    <div style="position: absolute; inset: 0; pointer-events: none;">
        <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(22,163,74,0.15) 0%, transparent 70%); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -50px; left: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(22,163,74,0.1) 0%, transparent 70%); border-radius: 50%;"></div>
        <div style="position: absolute; inset: 0; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220.5%22 fill=%22rgba(255,255,255,0.03)%22/></svg>');"></div>
    </div>

    <div class="container" style="position: relative; z-index: 2;">
        {{-- Section Header --}}
        <div style="display: grid; grid-template-columns: 1fr auto; align-items: end; gap: 1.5rem; margin-bottom: 2rem;">
            <div>
                <span style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(22,163,74,0.2); backdrop-filter: blur(8px); color: #4ade80; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; padding: 0.3rem 0.9rem; border-radius: 20px; margin-bottom: 0.6rem; border: 1px solid rgba(22,163,74,0.3);">
                    <i class="fa-solid fa-users-rectangle"></i> {{ $gs('home_nacos_badge','Student Association') }}
                </span>
                <h2 style="font-size: 2.4rem; font-family: var(--font-heading); font-weight: 800; color: white; margin-bottom: 0.5rem; line-height: 1.15;">{{ $gs('home_nacos_title','NACOS') }}</h2>
                <p style="color: #94a3b8; font-size: 0.95rem; max-width: 550px; line-height: 1.6; margin: 0;">{{ $gs('home_nacos_subtitle','The National Association of Computing Students (NUK Chapter) — empowering students through leadership, innovation and community.') }}</p>
            </div>
            <a href="{{ route('nacos-presidents') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #4ade80; font-weight: 700; font-size: 0.85rem; text-decoration: none; padding: 0.5rem 1rem; border: 1.5px solid rgba(74,222,128,0.3); border-radius: 10px; transition: all 0.3s; white-space: nowrap;" onmouseover="this.style.background='rgba(74,222,128,0.1)'; this.style.borderColor='rgba(74,222,128,0.6)'" onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(74,222,128,0.3)'">
                View More About NACOS <i class="fa-solid fa-arrow-right" style="font-size: 0.8rem;"></i>
            </a>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; align-items: start;">
            {{-- Left Column: About NACOS + Quick Stats --}}
            <div>
                {{-- About card --}}
                <div style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.08); border-radius: 14px; padding: 1.4rem; margin-bottom: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 0.8rem;">
                        <div style="width: 42px; height: 42px; background: linear-gradient(135deg, #16a34a, #059669); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: white;">
                            <i class="fa-solid fa-people-group"></i>
                        </div>
                        <div>
                            <h3 style="color: white; font-size: 1.05rem; font-weight: 700; margin: 0; font-family: var(--font-heading);">{{ $gs('home_nacos_about_title','About NACOS') }}</h3>
                            <span style="color: #64748b; font-size: 0.75rem;">{{ $gs('home_nacos_about_tag','NUK Chapter') }}</span>
                        </div>
                    </div>
                    <p style="color: #cbd5e1; font-size: 0.9rem; line-height: 1.65; margin: 0;">{{ $gs('home_nacos_about_text','NACOS is the umbrella body for all computing students. We foster academic excellence, professional development, and social bonds among members through events, workshops, competitions, and community service.') }}</p>
                </div>

                {{-- Quick Stats Row --}}
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem;">
                    @php
                        $nacosStats = [
                            ['icon' => 'fa-solid fa-crown', 'value' => $nacosTotalCount, 'label' => $gs('home_nacos_stat1_label','Past Leaders')],
                            ['icon' => 'fa-solid fa-calendar-check', 'value' => $gs('home_nacos_stat2_value','50+'), 'label' => $gs('home_nacos_stat2_label','Events Hosted')],
                            ['icon' => 'fa-solid fa-user-graduate', 'value' => $gs('home_nacos_stat3_value','500+'), 'label' => $gs('home_nacos_stat3_label','Active Members')],
                        ];
                    @endphp
                    @foreach($nacosStats as $stat)
                    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06); border-radius: 12px; padding: 0.9rem 0.7rem; text-align: center; transition: all 0.3s;" onmouseover="this.style.background='rgba(22,163,74,0.12)'; this.style.borderColor='rgba(22,163,74,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.04)'; this.style.borderColor='rgba(255,255,255,0.06)'">
                        <i class="{{ $stat['icon'] }}" style="color: #4ade80; font-size: 0.95rem; margin-bottom: 0.35rem; display: block;"></i>
                        <div style="font-size: 1.35rem; font-weight: 800; color: white; font-family: var(--font-heading); line-height: 1;">{{ $stat['value'] }}</div>
                        <div style="font-size: 0.7rem; color: #64748b; margin-top: 0.25rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Column: Past Leaders Grid --}}
            <div>
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.8rem;">
                    <h3 style="color: white; font-size: 1rem; font-weight: 700; margin: 0; font-family: var(--font-heading); display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-award" style="color: #4ade80;"></i> Recent Leaders
                    </h3>
                    <span style="color: #475569; font-size: 0.75rem; font-weight: 600;">{{ $nacosTotalCount }} total</span>
                </div>

                @if($nacosPresidents->count() > 0)
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    @foreach($nacosPresidents as $idx => $pres)
                    <a href="{{ route('nacos-presidents') }}" style="display: block; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 1rem; text-decoration: none; transition: all 0.35s; position: relative; overflow: hidden;" onmouseover="this.style.background='rgba(255,255,255,0.09)'; this.style.borderColor='rgba(74,222,128,0.3)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,255,255,0.08)'; this.style.transform='translateY(0)'">
                        <div style="display: flex; align-items: center; gap: 0.8rem;">
                            <div style="width: 44px; height: 44px; border-radius: 50%; border: 2px solid rgba(74,222,128,0.3); overflow: hidden; flex-shrink: 0; background: linear-gradient(135deg, #1e293b, #0f172a);">
                                <img src="{{ $pres->photo ? asset('storage/'.$pres->photo) : asset('images/avatar-placeholder.png') }}" alt="{{ $pres->name }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($pres->name) }}&background=16a34a&color=fff&size=100'">
                            </div>
                            <div style="min-width: 0;">
                                <h4 style="color: white; font-size: 0.88rem; font-weight: 700; margin: 0 0 0.15rem; font-family: var(--font-heading); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $pres->name }}</h4>
                                <span style="display: inline-block; background: rgba(22,163,74,0.2); color: #4ade80; padding: 0.1rem 0.5rem; border-radius: 12px; font-size: 0.68rem; font-weight: 600;">{{ $pres->tenure_start ?? '?' }} – {{ $pres->tenure_end ?? 'Present' }}</span>
                                @if($pres->current_status)
                                <p style="color: #64748b; font-size: 0.78rem; margin: 0.3rem 0 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $pres->current_status }}</p>
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div style="background: rgba(255,255,255,0.04); border: 1px dashed rgba(255,255,255,0.1); border-radius: 12px; padding: 2rem; text-align: center;">
                    <i class="fa-solid fa-user-tie" style="font-size: 1.6rem; color: #334155; margin-bottom: 0.6rem; display: block;"></i>
                    <p style="color: #64748b; font-size: 0.85rem; margin: 0;">NACOS leader records will appear here once added.</p>
                </div>
                @endif

                {{-- CTA Banner --}}
                <a href="{{ route('nacos-presidents') }}" style="display: flex; align-items: center; justify-content: space-between; margin-top: 0.75rem; padding: 0.8rem 1.2rem; background: linear-gradient(135deg, rgba(22,163,74,0.15), rgba(22,163,74,0.05)); border: 1px solid rgba(22,163,74,0.25); border-radius: 12px; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(22,163,74,0.25), rgba(22,163,74,0.1))'; this.style.borderColor='rgba(22,163,74,0.4)'" onmouseout="this.style.background='linear-gradient(135deg, rgba(22,163,74,0.15), rgba(22,163,74,0.05))'; this.style.borderColor='rgba(22,163,74,0.25)'">
                    <div>
                        <div style="color: white; font-weight: 700; font-size: 0.88rem; font-family: var(--font-heading);">{{ $gs('home_nacos_cta_title','Explore NACOS History') }}</div>
                        <div style="color: #64748b; font-size: 0.75rem;">{{ $gs('home_nacos_cta_desc','See all past leaders, their tenure and achievements') }}</div>
                    </div>
                    <div style="width: 32px; height: 32px; background: rgba(22,163,74,0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #4ade80; flex-shrink: 0; font-size: 0.85rem;">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    @media (max-width: 991px) {
        .nacos-home-section .container > div:nth-child(2) { grid-template-columns: 1fr !important; }
        .nacos-home-section .container > div:first-child { grid-template-columns: 1fr !important; text-align: center; }
        .nacos-home-section .container > div:first-child > a { justify-self: center; }
        .nacos-home-section .container > div:first-child p { margin: 0 auto !important; }
    }
    @media (max-width: 575px) {
        .nacos-home-section { padding: 2.5rem 0 !important; }
        .nacos-home-section h2 { font-size: 1.8rem !important; }
    }
</style>

<!-- ═══════════════════════════════════════════════
     NEWS & EVENTS
     ═══════════════════════════════════════════════ -->
<section style="padding: 6rem 0; background: white; position: relative;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 400px; gap: 4rem; align-items: start;">
            
            <!-- News Column -->
            <div>
                <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 1rem;">
                    <div>
                        <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 0.5rem; background: rgba(59,130,246,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_news_badge','Stay Informed') }}</span>
                        <h2 style="margin: 0; font-size: 2.4rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a;">{{ $gs('home_news_title','Latest News') }}</h2>
                    </div>
                    <a href="/research-news" style="background: white; color: var(--color-primary); padding: 0.6rem 1.2rem; border-radius: 8px; font-size: 0.9rem; font-weight: 600; text-decoration: none; border: 1px solid #e2e8f0; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.5rem;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white'; this.style.borderColor='var(--color-primary)'" onmouseout="this.style.background='white'; this.style.color='var(--color-primary)'; this.style.borderColor='#e2e8f0'">
                        {{ $gs('home_news_btn_text','View All') }} <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @forelse($news as $item)
                    <a href="{{ route('research-news.show', $item->slug) }}" class="news-card" style="display: flex; gap: 1.5rem; padding: 1.2rem; text-decoration: none; border-radius: 16px; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        @if($item->featured_image)
                        <div style="width: 140px; height: 120px; flex-shrink: 0; border-radius: 12px; overflow: hidden; background: #e2e8f0; position: relative;">
                            <img src="{{ asset('storage/'.$item->featured_image) }}" alt="" style="width:100%; height:100%; object-fit:cover; transition: transform 0.5s;" class="news-img">
                        </div>
                        @else
                        <div style="width: 140px; height: 120px; flex-shrink: 0; border-radius: 12px; background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(99,102,241,0.1)); display: flex; align-items: center; justify-content: center; color: var(--color-primary); font-size: 2.5rem;">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                        @endif
                        <div style="flex: 1; min-width: 0; display: flex; flex-direction: column; justify-content: center;">
                            <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 0.5rem;">
                                <span style="font-size: 0.75rem; color: #0284c7; background: #e0f2fe; padding: 0.2rem 0.6rem; border-radius: 4px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">{{ $item->category }}</span>
                                <span style="font-size: 0.85rem; color: #94a3b8;"><i class="fa-regular fa-calendar" style="margin-right: 4px;"></i> {{ \Carbon\Carbon::parse($item->published_at)->format('M d, Y') }}</span>
                            </div>
                            <h3 style="font-size: 1.2rem; margin: 0 0 0.5rem 0; line-height: 1.4; color: #0f172a; font-family: var(--font-heading); font-weight: 700; transition: color 0.2s;" class="news-title">{{ $item->title }}</h3>
                            <p style="font-size: 0.95rem; color: #64748b; margin: 0; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ Str::limit(strip_tags($item->body), 120) }}</p>
                        </div>
                    </a>
                    @empty
                    <div style="text-align: center; padding: 4rem 2rem; background: #f8fafc; border-radius: 16px; color: #94a3b8; border: 1px dashed #cbd5e1;">
                        <i class="fa-solid fa-newspaper" style="font-size: 2.5rem; margin-bottom: 1rem; display: block; color: #cbd5e1;"></i>
                        <p style="margin: 0; font-size: 1.1rem; color: #64748b;">No news articles available yet.</p>
                    </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Events Sidebar -->
            <div>
                <div style="margin-bottom: 2.5rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 1rem;">
                    <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 0.5rem;">{{ $gs('home_events_badge','Calendar') }}</span>
                    <h2 style="margin: 0; font-size: 2.4rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a;">{{ $gs('home_events_title','Upcoming Events') }}</h2>
                </div>
                
                <div style="background: #f8fafc; border-radius: 16px; padding: 2rem; border: 1px solid #e2e8f0; position: relative; overflow: hidden;">
                    <!-- Top accent line -->
                    <div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));"></div>
                    
                    @forelse($events as $event)
                    <div style="display: flex; gap: 1.2rem; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0;" class="event-item">
                        <div style="text-align: center; min-width: 65px; background: white; border: 1px solid #e2e8f0; border-radius: 10px; padding: 0.4rem 0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; display: flex; flex-direction: column;">
                            <span style="display: block; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: white; background: var(--color-primary); padding: 0.2rem 0;">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                            <span style="display: block; font-size: 1.8rem; font-weight: 800; line-height: 1; margin-top: 0.4rem; color: #0f172a; font-family: var(--font-heading);">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                        </div>
                        <div style="flex: 1;">
                            <h4 style="font-size: 1.1rem; margin: 0 0 0.4rem 0; color: #0f172a; font-weight: 700; font-family: var(--font-heading); line-height: 1.3;">{{ $event->title }}</h4>
                            <div style="display: flex; flex-direction: column; gap: 0.3rem;">
                                <p style="font-size: 0.85rem; color: #64748b; margin: 0; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-regular fa-clock" style="color: var(--color-primary);"></i> {{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</p>
                                @if($event->venue)
                                <p style="font-size: 0.85rem; color: #64748b; margin: 0; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-location-dot" style="color: var(--color-primary);"></i> {{ $event->venue }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div style="text-align: center; padding: 2rem 0; color: #94a3b8;">
                        <i class="fa-regular fa-calendar-xmark" style="font-size: 2.5rem; margin-bottom: 1rem; display: block; color: #cbd5e1;"></i>
                        <p style="margin: 0; font-size: 1.05rem; color: #64748b;">No upcoming events scheduled.</p>
                    </div>
                    @endforelse
                    
                    <a href="/research-news#events" style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; text-align: center; font-size: 0.95rem; font-weight: 700; color: var(--color-primary); padding-top: 0.5rem; text-decoration: none; transition: gap 0.2s;" onmouseover="this.style.gap='0.8rem'" onmouseout="this.style.gap='0.5rem'">
                        {{ $gs('home_events_btn_text','View Full Calendar') }} <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .marquee-wrapper {
        display: flex;
        overflow: hidden;
        mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
    }
    .marquee-content {
        display: flex;
        flex-shrink: 0;
        min-width: 100%;
        gap: 1.5rem;
        padding: 1rem 0;
        animation: scrollLeft 30s linear infinite;
    }
    .marquee-wrapper:hover .marquee-content {
        animation-play-state: paused;
    }
    .marquee-content.reverse {
        animation: scrollRight 30s linear infinite;
    }
    @keyframes scrollLeft {
        from { transform: translateX(0); }
        to { transform: translateX(calc(-100% - 1.5rem)); }
    }
    @keyframes scrollRight {
        from { transform: translateX(calc(-100% - 1.5rem)); }
        to { transform: translateX(0); }
    }
    .quick-link-card {
        width: 220px;
        flex-shrink: 0;
    }

    /* ── Discover More — Static Grid ── */
    .discover-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }
    .discover-card {
        position: relative;
        display: flex;
        align-items: center;
        gap: 1.1rem;
        padding: 1.35rem 1.5rem;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        text-decoration: none;
        transition: all 0.35s cubic-bezier(.4,0,.2,1);
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        overflow: hidden;
        animation: discoverFadeUp 0.5s ease both;
    }
    .discover-card::before {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 4px;
        background: var(--card-color, var(--color-primary));
        border-radius: 16px 0 0 16px;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .discover-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.08);
        border-color: #cbd5e1;
    }
    .discover-card:hover::before { opacity: 1; }

    .discover-card__number {
        position: absolute;
        top: 0.6rem; right: 0.85rem;
        font-size: 0.7rem;
        font-weight: 700;
        color: #cbd5e1;
        font-family: var(--font-heading);
        letter-spacing: 0.5px;
        transition: color 0.3s;
    }
    .discover-card:hover .discover-card__number { color: var(--card-color); }

    .discover-card__icon {
        width: 48px; height: 48px;
        flex-shrink: 0;
        background: color-mix(in srgb, var(--card-color) 10%, transparent);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--card-color);
        font-size: 1.2rem;
        transition: all 0.35s;
    }
    .discover-card:hover .discover-card__icon {
        background: var(--card-color);
        color: white;
        transform: scale(1.08);
    }

    .discover-card__body { flex: 1; min-width: 0; }
    .discover-card__title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 0.15rem;
        font-family: var(--font-heading);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .discover-card__desc {
        font-size: 0.8rem;
        color: #94a3b8;
        margin: 0;
        line-height: 1.4;
    }

    .discover-card__arrow {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px; height: 30px;
        flex-shrink: 0;
        border-radius: 50%;
        background: #f1f5f9;
        color: #94a3b8;
        font-size: 0.75rem;
        transition: all 0.3s;
    }
    .discover-card:hover .discover-card__arrow {
        background: var(--card-color);
        color: white;
        transform: translateX(3px);
    }

    @keyframes discoverFadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 991px) {
        .discover-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 575px) {
        .discover-grid { grid-template-columns: 1fr; }
        .discover-card { padding: 1.1rem 1.2rem; }
    }
    .partner-card {
        height: 100px;
        min-width: 200px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 1.5rem;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        text-decoration: none;
    }
    .partner-logo {
        max-width: 140px;
        max-height: 55px;
        object-fit: contain;
        filter: grayscale(100%) opacity(0.5);
        transition: all 0.3s ease;
    }
    a.partner-card:hover, div.partner-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.06);
        border-color: #cbd5e1;
    }
    a.partner-card:hover .partner-logo, div.partner-card:hover .partner-logo {  
        filter: grayscale(0%) opacity(1);
        transform: scale(1.05);
    }
</style>
        
        @if(isset($partners) && $partners->count() > 0)
        <!-- ═══════════════════════════════════════════════
             OUR PARTNERS
             ═══════════════════════════════════════════════ -->
        <section style="padding: 6rem 0; background: white; border-top: 1px solid #f1f5f9; position: relative;">
            <div class="container" style="position: relative; z-index: 2;">
                <div style="text-align: center; margin-bottom: 4rem;">
                    <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(22,163,74,0.1); padding: 0.3rem 1rem; border-radius: 20px;">Collaborators</span>
                    <h2 style="font-size: 2.8rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin-bottom: 1rem;">Industry Partners</h2>
                    <p style="color: #64748b; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.7;">Working together with leading organizations to provide the best opportunities.</p>
                </div>
        
                <div class="marquee-wrapper">
                    <div class="marquee-content reverse">
                        @foreach($partners as $partner)
                        @if($partner->url)
                        <a href="{{ $partner->url }}" target="_blank" rel="noopener noreferrer" class="partner-card" title="{{ $partner->name }}">
                        @else
                        <div class="partner-card" title="{{ $partner->name }}">
                        @endif
                            <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" class="partner-logo">
                        @if($partner->url)
                        </a>
                        @else
                        </div>
                        @endif
                        @endforeach
                    </div>
                    {{-- Duplicate for seamless loop --}}
                    <div class="marquee-content reverse" aria-hidden="true">
                        @foreach($partners as $partner)
                        @if($partner->url)
                        <a href="{{ $partner->url }}" target="_blank" rel="noopener noreferrer" class="partner-card" title="{{ $partner->name }}">
                        @else
                        <div class="partner-card" title="{{ $partner->name }}">
                        @endif
                            <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" class="partner-logo">
                        @if($partner->url)
                        </a>
                        @else
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif



<!-- ═══════════════════════════════════════════════
     CALL TO ACTION — Contact & Apply
     ═══════════════════════════════════════════════ -->
<section style="padding: 2.8rem 0; background: linear-gradient(105deg, #14532d 0%, #15803d 100%); position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220.6%22 fill=%22rgba(255,255,255,0.04)%22/></svg>'); pointer-events: none;"></div>
    
    <div class="container" style="position: relative; z-index: 2; display: flex; align-items: center; justify-content: space-between; gap: 2rem; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 280px;">
            <h2 style="font-size: 1.8rem; font-family: var(--font-heading); font-weight: 800; color: white; margin: 0 0 0.4rem; line-height: 1.2;">{{ $gs('home_cta_title','Ready to Join Us?') }}</h2>
            <p style="font-size: 0.95rem; color: rgba(255,255,255,0.7); line-height: 1.6; margin: 0;">{{ $gs('home_cta_subtitle','Whether you\'re a prospective student, an alumnus, or just curious about the department — we\'d love to hear from you.') }}</p>
        </div>
        
        <div style="display: flex; gap: 0.7rem; flex-wrap: wrap; align-items: center;">
            @foreach([1,2,3] as $bi)
            @php
                $defaultBtnLabels = ['Contact Us', 'About the Department', 'View Programmes'];
                $defaultBtnUrls   = ['/contact', '/about', '/academics'];
                $defaultBtnIcons  = ['fa-solid fa-envelope', 'fa-solid fa-circle-info', 'fa-solid fa-graduation-cap'];
                $btnText = $gs('home_cta_btn'.$bi.'_text', $defaultBtnLabels[$bi-1]);
                $btnUrl  = $gs('home_cta_btn'.$bi.'_url',  $defaultBtnUrls[$bi-1]);
                $btnIcon = $gs('home_cta_btn'.$bi.'_icon', $defaultBtnIcons[$bi-1]);
            @endphp
            @if($btnText && $btnUrl)
            @if($bi === 1)
            <a href="{{ $btnUrl }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: white; color: #14532d; padding: 0.65rem 1.5rem; border-radius: 8px; font-size: 0.9rem; font-weight: 700; text-decoration: none; transition: all 0.25s; box-shadow: 0 2px 10px rgba(0,0,0,0.15);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 16px rgba(0,0,0,0.25)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.15)'">
                <i class="{{ $btnIcon }}"></i> {{ $btnText }}
            </a>
            @else
            <a href="{{ $btnUrl }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.08); color: white; padding: 0.65rem 1.5rem; border-radius: 8px; font-size: 0.9rem; font-weight: 600; text-decoration: none; border: 1.5px solid rgba(255,255,255,0.2); transition: all 0.25s; backdrop-filter: blur(4px);" onmouseover="this.style.borderColor='rgba(255,255,255,0.5)'; this.style.background='rgba(255,255,255,0.14)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.2)'; this.style.background='rgba(255,255,255,0.08)'">
                <i class="{{ $btnIcon }}"></i> {{ $btnText }}
            </a>
            @endif
            @endif
            @endforeach
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     CAROUSEL JS + HOVER CARD CSS
     ═══════════════════════════════════════════════ -->
<style>
/* Carousel */
.hero-carousel { background: var(--color-primary); }

/* Hover Cards */
.hover-card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
}

.hover-card:hover .card-arrow {
    transform: translateX(8px);
}


/* News Custom Hover Effects */
.news-card:hover .news-img {
    transform: scale(1.08);
}
.news-card:hover .news-title {
    color: var(--color-primary) !important;
}

/* Specific Stat Card Styles */
.stat-card {
    background: linear-gradient(135deg, #14532d 0%, #166534 50%, #15803d 100%);
    border: none;
    border-radius: 14px;
    padding: 1.8rem 1.2rem 1.4rem;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: all 0.35s ease;
    box-shadow: 0 4px 15px rgba(20,83,45,0.25);
    min-height: 130px;
}

.stat-bg-icon {
    position: absolute;
    bottom: 10px;
    right: 12px;
    font-size: 3rem;
    color: rgba(255,255,255,0.12);
    line-height: 1;
    pointer-events: none;
    transition: transform 0.35s ease, color 0.35s ease;
    opacity: 0.9;
}

.stat-number {
    font-size: 2.8rem;
    margin-bottom: 0.3rem;
    color: #ffffff;
    font-family: var(--font-heading);
    font-weight: 900;
    line-height: 1;
    position: relative;
    z-index: 2;
    transition: transform 0.3s ease;
}

.stat-card p {
    text-transform: uppercase;
    font-size: 0.7rem;
    letter-spacing: 1.5px;
    color: rgba(255,255,255,0.75);
    font-weight: 700;
    margin: 0;
    position: relative;
    z-index: 2;
    transition: color 0.3s ease;
}

/* Stat Card Hover Effects */
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(20,83,45,0.35);
    background: linear-gradient(135deg, #166534 0%, #15803d 50%, #16a34a 100%);
}
.stat-card:hover .stat-bg-icon {
    color: rgba(255,255,255,0.18);
    transform: scale(1.1);
}
.stat-card:hover .stat-number {
    transform: scale(1.05);
}
.stat-card:hover p {
    color: rgba(255,255,255,0.9);
}

/* Event Item Last */
.event-item:last-of-type {
    border-bottom: none !important;
    margin-bottom: 1rem !important;
    padding-bottom: 0 !important;
}

/* Staff Home Cards */
.staff-home-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    border-color: #cbd5e1;
}
.staff-home-card:hover img {
    transform: scale(1.08);
}

/* Gallery Home Items */
.gallery-home-item:hover img {
    transform: scale(1.1);
}
.gallery-home-item:hover .gallery-overlay {
    opacity: 1 !important;
}

/* System Cards */
.system-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    border-color: #cbd5e1;
}
.system-card:hover .sys-bar {
    transform: scaleX(1) !important;
}
.system-card:hover div[style*="border-radius: 14px"] {
    background: var(--color-primary) !important;
    color: white !important;
}

/* Quick Link Cards */
.quick-link-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    border-color: #cbd5e1;
}
.quick-link-card:hover div:first-child {
    transform: scale(1.1);
}

/* Announcement scroll */
@keyframes scrollAnnouncements {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* Responsive */
@media (max-width: 991px) {
    .hero-carousel { height: 480px !important; }
    .hero-carousel h1 { font-size: 2.6rem !important; }
    .hero-carousel p { font-size: 1.05rem !important; }
    .carousel-arrow { width: 44px !important; height: 44px !important; font-size: 1.1rem !important; }
}

@media (max-width: 768px) {
    .hero-carousel { height: 450px !important; }
    .hero-carousel h1 { font-size: 2rem !important; line-height: 1.2 !important;}
    .hero-carousel p { font-size: 0.95rem !important; margin-bottom: 1.5rem !important; }
    .hero-carousel .btn { padding: 0.7rem 1.5rem !important; font-size: 0.95rem !important; }
    .hover-card-grid { grid-template-columns: 1fr; }
    
    /* Stack news/events on mobile */
    section .container > div[style*="grid-template-columns: 1fr 380px"],
    section .container > div[style*="grid-template-columns: 1fr 400px"] {
        grid-template-columns: 1fr !important;
    }

    /* Gallery 2-col on mobile */
    section div[style*="grid-template-columns: repeat(4"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }

    /* Stats responsive */
    div[style*="grid-template-columns: repeat(5"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}
</style>

<script>
(function() {
    let currentSlide = 0;
    const track = document.getElementById('carouselTrack');
    const dots = document.querySelectorAll('.carousel-dot');
    const totalSlides = {{ $carouselSlides->count() ?: 1 }};
    let autoplayTimer;

    function updateCarousel() {
        track.style.transform = `translateX(-${currentSlide * 100}%)`;
        dots.forEach((dot, i) => {
            dot.style.background = i === currentSlide ? 'white' : 'transparent';
        });
    }

    window.moveCarousel = function(dir) {
        currentSlide = (currentSlide + dir + totalSlides) % totalSlides;
        updateCarousel();
        resetAutoplay();
    };

    window.goToSlide = function(index) {
        currentSlide = index;
        updateCarousel();
        resetAutoplay();
    };

    function resetAutoplay() {
        clearInterval(autoplayTimer);
        if (totalSlides > 1) {
            autoplayTimer = setInterval(() => {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateCarousel();
            }, 5000);
        }
    }

    // Start autoplay
    resetAutoplay();
})();
</script>
@endsection
