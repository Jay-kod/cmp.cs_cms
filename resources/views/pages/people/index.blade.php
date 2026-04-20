@extends('layouts.public')
@section('title', 'People')

@section('content')
@php
    $hs = \App\Models\DepartmentSetting::where('group', 'page_people')->pluck('value', 'key')->toArray();
    $heroImg = \App\Models\DepartmentSetting::getCached('hero_people');
    $heroUrl = $heroImg && file_exists(storage_path('app/public/' . $heroImg))
        ? asset('storage/' . $heroImg)
        : null;
@endphp

{{-- Hero --}}
<div class="text-center py-32 pb-20 text-white bg-cover bg-center relative" style="{{ $heroUrl ? "background-image: url('{$heroUrl}');" : '' }}">
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-950/[0.92] to-green-700/[0.88]"></div>
    <div class="container relative z-10" data-aos="fade-up">
        <h1 class="text-white text-4xl md:text-[2.8rem] font-extrabold tracking-[-0.5px] mb-2">{{ $hs['people_hero_title'] ?? 'Our People' }}</h1>
        @if(!empty($hs['people_hero_subtitle']))
        <p class="mt-3 text-white/75 text-lg md:text-[1.15rem] max-w-[600px] mx-auto">{{ $hs['people_hero_subtitle'] }}</p>
        @endif
        <div class="w-[60px] h-1 bg-accent mx-auto mt-6 rounded-sm"></div>
    </div>
</div>

<div class="container relative z-10 -mt-8" data-aos="fade-up">

    {{-- Search & Filter Bar --}}
    <div class="bg-white rounded-xl py-5 px-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] mb-10 flex gap-4 flex-wrap items-center">
        <div id="search-form" class="flex gap-4 flex-wrap items-center flex-1">
            <div class="flex-1 min-w-[200px] relative group">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm group-focus-within:text-primary transition-colors"></i>
                <input type="text" id="search-input" value="{{ request('search') }}" placeholder="Search by name, rank, or specialisation..." class="w-full py-3 pr-3 pl-9 border border-slate-200 rounded-lg text-sm outline-none transition-colors focus:border-primary focus:ring-1 focus:ring-primary/20">
            </div>
            <select id="status-filter" class="py-3 px-4 border border-slate-200 rounded-lg text-sm bg-white cursor-pointer min-w-[140px] focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none">
                <option value="">All Status</option>
                <option value="Tenure" {{ request('status') === 'Tenure' ? 'selected' : '' }}>Tenure</option>
                <option value="Visiting" {{ request('status') === 'Visiting' ? 'selected' : '' }}>Visiting</option>
                <option value="Sabbatical" {{ request('status') === 'Sabbatical' ? 'selected' : '' }}>Sabbatical</option>
            </select>
            <button type="button" id="search-btn" class="py-3 px-6 bg-primary text-white border-0 rounded-lg font-semibold cursor-pointer text-sm inline-flex items-center gap-2 hover:bg-primary-dark transition-colors">
                <i class="fa-solid fa-search"></i> Search
            </button>
            <a href="javascript:void(0)" id="clear-btn" class="py-3 px-4 text-slate-500 font-medium text-sm hidden hover:text-slate-800 transition-colors items-center gap-1">
                <i class="fa-solid fa-xmark"></i> Clear
            </a>
        </div>
        <div id="staff-count" class="text-slate-400 text-sm font-medium">
            {{ $staff->count() }} {{ Str::plural('member', $staff->count()) }}
        </div>
    </div>

    {{-- HOD Spotlight --}}
    <div id="hod-section">
    @if($hod && !request('search') && !request('status'))
    <section data-aos="fade-up" class="hod-spotlight mb-12">
        <a href="{{ route('people.show', $hod->slug) }}" class="block no-underline text-inherit">
            <div data-aos="fade-up" class="hod-spotlight-card">
                {{-- Decorative background elements --}}
                <div data-aos="fade-up" class="hod-card-bg-decor">
                    <div class="hod-bg-circle hod-bg-circle-1"></div>
                    <div class="hod-bg-circle hod-bg-circle-2"></div>
                    <div class="hod-bg-pattern"></div>
                </div>

                {{-- Top accent bar --}}
                <div class="hod-accent-bar"></div>

                <div data-aos="fade-up" class="hod-card-inner">
                    {{-- Photo Column --}}
                    <div class="hod-photo-col">
                        <div class="hod-photo-frame">
                            <div class="hod-photo-ring"></div>
                            <img src="{{ $hod->photo ? asset('storage/'.$hod->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($hod->name) . '&size=400&background=14532d&color=fff&bold=true&format=svg' }}" alt="{{ $hod->name }}" class="hod-photo-img" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($hod->name) }}&size=400&background=14532d&color=fff&bold=true&format=svg'">
                        </div>
                        {{-- HOD Badge --}}
                        <div class="hod-badge-tag">
                            <i class="fa-solid fa-star"></i> Head of Department
                        </div>
                    </div>

                    {{-- Info Column --}}
                    <div class="hod-info-col">
                        <div class="hod-info-header">
                            <span class="hod-spotlight-label">
                                <i class="fa-solid fa-crown"></i> Department Leadership
                            </span>
                            <h3 class="hod-name">{{ $hod->title }} {{ $hod->name }}</h3>
                            @if($hod->rank)
                            <p class="hod-rank">{{ $hod->rank }}</p>
                            @endif
                        </div>

                        <div class="hod-info-details">
                            @if($hod->specialisation)
                            <div data-aos="fade-up" class="hod-detail-item">
                                <div class="hod-detail-icon">
                                    <i class="fa-solid fa-flask"></i>
                                </div>
                                <div>
                                    <span class="hod-detail-label">Research Focus</span>
                                    <span class="hod-detail-value">{{ $hod->specialisation }}</span>
                                </div>
                            </div>
                            @endif

                            @if(!empty($hod->qualifications))
                            <div data-aos="fade-up" class="hod-detail-item">
                                <div class="hod-detail-icon">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <div>
                                    <span class="hod-detail-label">Qualification</span>
                                    <span class="hod-detail-value">{{ $hod->qualifications }}</span>
                                </div>
                            </div>
                            @endif

                            @if($hod->email)
                            <div data-aos="fade-up" class="hod-detail-item">
                                <div class="hod-detail-icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div>
                                    <span class="hod-detail-label">Email</span>
                                    <span class="hod-detail-value">{{ $hod->email }}</span>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div data-aos="fade-up" class="hod-card-actions">
                            <span class="hod-view-btn">
                                View Full Profile <i class="fa-solid fa-arrow-right hod-arrow"></i>
                            </span>
                            @if($hod->courses->count())
                            <div class="hod-courses-preview">
                                @foreach($hod->courses->take(3) as $course)
                                <span class="hod-course-chip">{{ $course->code }}</span>
                                @endforeach
                                @if($hod->courses->count() > 3)
                                <span class="hod-course-chip hod-course-more">+{{ $hod->courses->count() - 3 }}</span>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </section>
    @endif
    </div>

    {{-- Staff Grid --}}
    <section data-aos="fade-up" class="mb-12">
        <div id="all-staff-heading" class="flex items-center gap-4 mb-6">
            <h2 class="m-0 text-2xl text-slate-900">All Staff</h2>
            <div class="flex-1 h-px bg-slate-200"></div>
        </div>

        <style>
            /* ═══════════════════════════════════════
               HOD SPOTLIGHT CARD
               ═══════════════════════════════════════ */
            .hod-spotlight-card {
                position: relative;
                background: #ffffff;
                border-radius: 24px;
                overflow: hidden;
                border: 2px solid #86efac;
                box-shadow: 0 8px 40px -8px rgba(5,150,105,0.15), 0 0 0 1px rgba(134,239,172,0.1);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                max-width: 800px;
                margin: 0 auto;
            }
            .hod-spotlight-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 25px 60px -12px rgba(5,150,105,0.25), 0 0 0 1px rgba(134,239,172,0.2);
                border-color: #4ade80;
            }

            /* Decorative background */
            .hod-card-bg-decor {
                position: absolute;
                inset: 0;
                pointer-events: none;
                z-index: 0;
            }
            .hod-bg-circle {
                position: absolute;
                border-radius: 50%;
            }
            .hod-bg-circle-1 {
                width: 300px;
                height: 300px;
                top: -120px;
                right: -60px;
                background: radial-gradient(circle, rgba(22,163,74,0.06) 0%, transparent 70%);
            }
            .hod-bg-circle-2 {
                width: 200px;
                height: 200px;
                bottom: -80px;
                left: -40px;
                background: radial-gradient(circle, rgba(22,163,74,0.04) 0%, transparent 70%);
            }
            .hod-bg-pattern {
                position: absolute;
                inset: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"><circle cx="16" cy="16" r="0.5" fill="rgba(22,163,74,0.04)"/></svg>');
            }

            /* Top accent bar */
            .hod-accent-bar {
                height: 5px;
                background: linear-gradient(90deg, #16a34a, #059669, #10b981, #34d399);
                background-size: 200% 100%;
                animation: shimmer-bar 3s ease infinite;
            }
            @keyframes shimmer-bar {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }

            /* Card inner layout */
            .hod-card-inner {
                display: flex;
                gap: 2.5rem;
                padding: 2rem 2.5rem 2rem 2rem;
                position: relative;
                z-index: 1;
                align-items: center;
            }

            /* Photo Column */
            .hod-photo-col {
                flex-shrink: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 0.8rem;
            }
            .hod-photo-frame {
                position: relative;
                width: 180px;
                height: 180px;
            }
            .hod-photo-ring {
                position: absolute;
                inset: -6px;
                border-radius: 22px;
                border: 2.5px solid transparent;
                background: linear-gradient(135deg, #16a34a, #059669, #10b981) border-box;
                -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
                -webkit-mask-composite: xor;
                mask-composite: exclude;
                animation: ring-rotate 6s linear infinite;
            }
            @keyframes ring-rotate {
                0% { background: linear-gradient(0deg, #16a34a, #059669, #10b981) border-box; }
                33% { background: linear-gradient(120deg, #16a34a, #059669, #10b981) border-box; }
                66% { background: linear-gradient(240deg, #16a34a, #059669, #10b981) border-box; }
                100% { background: linear-gradient(360deg, #16a34a, #059669, #10b981) border-box; }
            }
            .hod-photo-img {
                width: 100%;
                height: 100%;
                border-radius: 18px;
                object-fit: cover;
                object-position: center top;
                display: block;
                transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .hod-spotlight-card:hover .hod-photo-img {
                transform: scale(1.04);
            }
            .hod-badge-tag {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                padding: 0.35rem 1rem;
                background: linear-gradient(135deg, #dc2626, #b91c1c);
                color: white;
                font-size: 0.72rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.8px;
                border-radius: 20px;
                box-shadow: 0 3px 12px rgba(220,38,38,0.3);
                white-space: nowrap;
            }
            .hod-badge-tag i {
                font-size: 0.55rem;
            }

            /* Info Column */
            .hod-info-col {
                flex: 1;
                min-width: 0;
                display: flex;
                flex-direction: column;
                gap: 1.2rem;
            }
            .hod-spotlight-label {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                font-size: 0.72rem;
                font-weight: 700;
                color: #16a34a;
                text-transform: uppercase;
                letter-spacing: 1.2px;
                margin-bottom: 0.3rem;
            }
            .hod-spotlight-label i {
                font-size: 0.65rem;
                color: #f59e0b;
            }
            .hod-name {
                font-size: 1.6rem;
                font-weight: 800;
                color: #0f172a;
                margin: 0 0 0.2rem;
                line-height: 1.25;
                font-family: var(--font-heading);
            }
            .hod-rank {
                font-size: 0.95rem;
                color: #059669;
                font-weight: 600;
                margin: 0;
            }

            /* Detail Items */
            .hod-info-details {
                display: flex;
                flex-direction: column;
                gap: 0.65rem;
            }
            .hod-detail-item {
                display: flex;
                align-items: flex-start;
                gap: 0.7rem;
                text-align: left;
            }
            .hod-detail-icon {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                background: #f0fdf4;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                color: #16a34a;
                font-size: 0.8rem;
                transition: all 0.3s;
            }
            .hod-spotlight-card:hover .hod-detail-icon {
                background: #dcfce7;
            }
            .hod-detail-label {
                display: block;
                font-size: 0.68rem;
                font-weight: 600;
                color: #94a3b8;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                line-height: 1;
                margin-bottom: 2px;
            }
            .hod-detail-value {
                display: block;
                font-size: 0.88rem;
                color: #334155;
                font-weight: 500;
                line-height: 1.4;
            }

            /* Actions */
            .hod-card-actions {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                padding-top: 1rem;
                border-top: 1px solid #f0fdf4;
            }
            .hod-view-btn {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.6rem 1.6rem;
                background: linear-gradient(135deg, #16a34a, #059669);
                color: white;
                font-size: 0.85rem;
                font-weight: 700;
                border-radius: 12px;
                transition: all 0.3s;
                box-shadow: 0 4px 14px rgba(22,163,74,0.25);
                white-space: nowrap;
            }
            .hod-spotlight-card:hover .hod-view-btn {
                background: linear-gradient(135deg, #15803d, #047857);
                box-shadow: 0 6px 20px rgba(22,163,74,0.35);
                gap: 0.7rem;
            }
            .hod-arrow {
                font-size: 0.75rem;
                transition: transform 0.3s;
            }
            .hod-spotlight-card:hover .hod-arrow {
                transform: translateX(3px);
            }
            .hod-courses-preview {
                display: flex;
                gap: 0.35rem;
                flex-wrap: wrap;
            }
            .hod-course-chip {
                background: #f0fdf4;
                color: #166534;
                padding: 3px 10px;
                border-radius: 6px;
                font-size: 0.72rem;
                font-weight: 600;
                border: 1px solid #dcfce7;
                transition: all 0.2s;
            }
            .hod-spotlight-card:hover .hod-course-chip {
                background: #dcfce7;
                border-color: #bbf7d0;
            }
            .hod-course-more {
                background: transparent !important;
                border: none !important;
                color: #94a3b8;
            }

            /* HOD Card Responsive */
            @media (max-width: 768px) {
                .hod-card-inner {
                    flex-direction: column;
                    text-align: center;
                    gap: 1.5rem;
                    padding: 1.5rem;
                }
                .hod-photo-frame {
                    width: 150px;
                    height: 150px;
                }
                .hod-name {
                    font-size: 1.35rem;
                }
                .hod-rank {
                    text-align: center;
                    width: 100%;
                    display: block;
                }
                .hod-info-details {
                    align-items: flex-start;
                    text-align: left;
                    width: 100%;
                }
                .hod-detail-item {
                    justify-content: flex-start;
                    text-align: left;
                }
                .hod-card-actions {
                    flex-direction: column;
                    align-items: center;
                }
                .hod-courses-preview {
                    justify-content: center;
                }
            }
            @media (max-width: 480px) {
                .hod-card-inner {
                    padding: 1.2rem;
                }
                .hod-photo-frame {
                    width: 130px;
                    height: 130px;
                }
                .hod-name {
                    font-size: 1.2rem;
                }
                .hod-detail-value {
                    font-size: 0.82rem;
                }
            }

            /* ═══════════════════════════════════════
               STAFF CARDS GRID
               ═══════════════════════════════════════ */
            .staff-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 1.5rem;
            }
            .staff-card-link {
                text-decoration: none;
                color: inherit;
                display: block;
            }
            .staff-card-v2 {
                background: #fff;
                border-radius: 20px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
                border: 1px solid #bbf7d0;
                transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                height: 100%;
            }
            .staff-card-v2:hover {
                transform: translateY(-6px);
                box-shadow: 0 25px 50px -12px rgba(5,150,105,0.18);
                border-color: #86efac;
            }
            .staff-card-v2:hover .card-photo-img {
                transform: scale(1.05);
            }
            .staff-card-v2:hover .card-profile-btn {
                background: #059669;
                color: #fff;
                gap: 10px;
            }
            .staff-card-v2:hover .card-profile-btn .arrow-icon {
                transform: translateX(3px);
            }
            .card-photo-side {
                flex: none;
                position: relative;
                padding-top: 125%; /* 4:5 aspect ratio */
                overflow: hidden;
                background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
            }
            .card-photo-img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: top center;
                display: block;
                transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .card-photo-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(5,150,105,0.08) 0%, transparent 40%);
                pointer-events: none;
            }
            .card-status-badge {
                position: absolute;
                top: 12px;
                left: 12px;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 0.7rem;
                font-weight: 700;
                letter-spacing: 0.3px;
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                display: inline-flex;
                align-items: center;
                gap: 5px;
                z-index: 2;
            }
            .card-status-badge.tenure {
                background: rgba(22,163,74,0.15);
                color: #15803d;
                border: 1px solid rgba(22,163,74,0.2);
            }
            .card-status-badge.visiting {
                background: rgba(59,130,246,0.15);
                color: #1d4ed8;
                border: 1px solid rgba(59,130,246,0.2);
            }
            .card-status-badge.sabbatical {
                background: rgba(245,158,11,0.15);
                color: #b45309;
                border: 1px solid rgba(245,158,11,0.2);
            }
            .card-status-dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                display: inline-block;
                animation: pulse-dot 2s infinite;
            }
            .card-status-dot.tenure { background: #22c55e; }
            .card-status-dot.visiting { background: #3b82f6; }
            .card-status-dot.sabbatical { background: #f59e0b; }
            @keyframes pulse-dot {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.4; }
            }
            .card-info-side {
                flex: 1;
                display: flex;
                flex-direction: column;
                padding: 1.2rem 1.3rem 1rem;
                justify-content: space-between;
                align-items: center;
                min-width: 0;
                text-align: center;
                background: linear-gradient(180deg, #f0fdf4 0%, #ecfdf5 40%, #ffffff 100%);
            }
            .card-name {
                font-size: 1.08rem;
                font-weight: 800;
                color: #14532d;
                margin: 0 0 0.2rem;
                line-height: 1.3;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .card-rank {
                font-size: 0.84rem;
                color: #059669;
                font-weight: 600;
                margin: 0 0 0.4rem;
                text-align: center;
            }
            .card-specialisation {
                font-size: 0.78rem;
                color: #166534;
                margin: 0 0 0.3rem;
                line-height: 1.5;
                text-align: center;
            }
            .card-courses {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
                justify-content: center;
            }
            .card-course-tag {
                background: #dcfce7;
                color: #166534;
                padding: 3px 10px;
                border-radius: 6px;
                font-size: 0.72rem;
                font-weight: 600;
                white-space: nowrap;
                display: inline-flex;
                align-items: center;
                gap: 4px;
                transition: background 0.2s;
            }
            .staff-card-v2:hover .card-course-tag {
                background: #bbf7d0;
                color: #14532d;
            }
            .card-footer {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 0.8rem;
                margin-top: auto;
                padding-top: 0.8rem;
                border-top: 1px solid #dcfce7;
                width: 100%;
            }
            .card-profile-btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 0.45rem 1.1rem;
                border-radius: 10px;
                font-size: 0.8rem;
                font-weight: 700;
                color: #fff;
                background: #10b981;
                transition: all 0.3s ease;
                white-space: nowrap;
            }
            .card-profile-btn .arrow-icon {
                font-size: 0.7rem;
                transition: transform 0.3s ease;
            }
            .staff-grid-fade {
                opacity: 0;
                transform: translateY(10px);
                animation: fadeInGrid 0.35s ease forwards;
            }
            @keyframes fadeInGrid {
                to { opacity: 1; transform: translateY(0); }
            }
            @media (max-width: 768px) {
                .staff-grid {
                    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                    gap: 1.2rem;
                }
                .card-photo-side {
                    aspect-ratio: 4 / 3;
                }
            }
            @media (max-width: 480px) {
                .staff-grid {
                    grid-template-columns: 1fr;
                    gap: 1rem;
                }
                .card-photo-side {
                    aspect-ratio: 4 / 3;
                }
                .card-info-side {
                    padding: 1rem;
                }
                .card-name {
                    font-size: 1rem;
                }
                .card-profile-btn {
                    padding: 0.4rem 0.9rem;
                    font-size: 0.75rem;
                }
            }
        </style>

        <div id="staff-grid-container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 staff-grid-fade">
                @foreach($staff as $member)
                @if($hod && $member->id === $hod->id && !request('search') && !request('status')) @continue @endif

                <a data-aos="fade-up" href="{{ route('people.show', $member->slug) }}" class="group relative w-full h-[450px] flex-shrink-0 transition-transform duration-500 hover:-translate-y-3 block">
                    <!-- The Skewed Wrapper with Rounded Corners and Gap -->
                    <div class="absolute inset-0 transform lg:-skew-x-[8deg] overflow-hidden bg-emerald-950 border-[3px] border-emerald-900 rounded-[1.5rem] group-hover:border-emerald-400/50 transition-colors duration-500 z-10 shadow-[0_15px_30px_rgba(0,0,0,0.1)] group-hover:shadow-[0_20px_40px_rgba(22,163,74,0.2)]">
                        <!-- The Un-Skewed Inner Image Area (Reduced Zoom Ratio) -->                    
                        <div class="absolute inset-0 w-[125%] h-[100%] transform lg:skew-x-[8deg] -ml-[12.5%] bg-emerald-950">
                            @if($member->photo)
                                <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" class="w-full h-[100%] object-cover object-top transition-all duration-500 ease-out group-hover:scale-[1.03]">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&size=400&background=022c22&color=a7f3d0&bold=true&format=svg&font-size=0.35" alt="{{ $member->name }}" class="w-full h-full object-cover object-[center_top] transition-all duration-500 ease-out group-hover:scale-[1.03]">
                            @endif
                            
                            <!-- Smoother gradient shadow for text contrast -->
                            <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-emerald-950/90 to-transparent"></div>
                        </div>
                    </div>

                    <!-- Floating/Skewed Name Plate -->
                    <div class="absolute bottom-6 left-4 right-4 lg:left-3 lg:right-3 transform lg:-skew-x-[8deg] bg-emerald-950/95 backdrop-blur-sm border-l-[4px] border-emerald-400 p-4 sm:p-5 rounded-xl z-30 shadow-[0_10px_20px_rgba(0,0,0,0.5)] transition-all duration-500 group-hover:bg-emerald-800/95">
                        <div class="transform lg:skew-x-[8deg] flex flex-col justify-center">
                            <h3 class="text-white font-heading font-bold text-[1.1rem] uppercase tracking-wide m-0 mb-1 group-hover:text-primary transition-colors line-clamp-1" title="{{ $member->title }} {{ $member->name }}">{{ $member->title }} {{ $member->name }}</h3>
                            <p class="text-emerald-200/80 font-bold text-[0.7rem] sm:text-[0.75rem] tracking-[1.5px] uppercase m-0 group-hover:text-emerald-100 transition-colors">{{ $member->rank ?? 'Lecturer' }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const statusFilter = document.getElementById('status-filter');
    const searchBtn = document.getElementById('search-btn');
    const clearBtn = document.getElementById('clear-btn');
    const staffCount = document.getElementById('staff-count');
    const gridContainer = document.getElementById('staff-grid-container');
    const hodSection = document.getElementById('hod-section');
    const heading = document.getElementById('all-staff-heading');
    const searchUrl = @json(route('people.search'));

    let debounceTimer;
    let currentRequest = null;

    function isFiltering() {
        return searchInput.value.trim() !== '' || statusFilter.value !== '';
    }

    function updateClearBtn() {
        clearBtn.style.display = isFiltering() ? 'inline-block' : 'none';
    }

    function avatarUrl(name) {
        return 'https://ui-avatars.com/api/?name=' + encodeURIComponent(name) + '&size=300&background=1e3a8a&color=fff&bold=true&format=svg';
    }

    function statusBadgeHtml(status) {
        if (!status) return '';
        const s = status.toLowerCase();
        const map = { tenure: 'tenure', visiting: 'visiting', sabbatical: 'sabbatical' };
        if (!map[s]) return '';
        return `<span class="card-status-badge ${map[s]}"><span class="card-status-dot ${map[s]}"></span> ${status}</span>`;
    }

    function renderCard(m) {
        const photo = m.photo ? `/storage/${m.photo}` : avatarUrl(m.name);
        const fallback = avatarUrl(m.name);
        return `
        <a data-aos="fade-up" href="${m.profile_url}" class="group relative w-full h-[450px] flex-shrink-0 transition-transform duration-500 hover:-translate-y-3 block">
            <!-- The Skewed Wrapper with Rounded Corners and Gap -->
            <div class="absolute inset-0 transform lg:-skew-x-[8deg] overflow-hidden bg-emerald-950 border-[3px] border-emerald-900 rounded-[1.5rem] group-hover:border-emerald-400/50 transition-colors duration-500 z-10 shadow-[0_15px_30px_rgba(0,0,0,0.1)] group-hover:shadow-[0_20px_40px_rgba(22,163,74,0.2)]">
                <!-- The Un-Skewed Inner Image Area (Reduced Zoom Ratio) -->                    
                <div class="absolute inset-0 w-[125%] h-[100%] transform lg:skew-x-[8deg] -ml-[12.5%] bg-emerald-950">
                    <img src="${photo}" onerror="this.src='${fallback}'" alt="${m.name}" class="w-full h-[100%] object-cover object-top transition-all duration-500 ease-out group-hover:scale-[1.03]">
                    
                    <!-- Smoother gradient shadow for text contrast -->
                    <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-emerald-950/90 to-transparent"></div>
                </div>
            </div>

            <!-- Floating/Skewed Name Plate -->
            <div class="absolute bottom-6 left-4 right-4 lg:left-3 lg:right-3 transform lg:-skew-x-[8deg] bg-emerald-950/95 backdrop-blur-sm border-l-[4px] border-emerald-400 p-4 sm:p-5 rounded-xl z-30 shadow-[0_10px_20px_rgba(0,0,0,0.5)] transition-all duration-500 group-hover:bg-emerald-800/95">
                <div class="transform lg:skew-x-[8deg] flex flex-col justify-center">
                    <h3 class="text-white font-heading font-bold text-[1.1rem] uppercase tracking-wide m-0 mb-1 group-hover:text-primary transition-colors line-clamp-1" title="${m.name}">${m.title + ' ' + m.name}</h3>
                    <p class="text-emerald-200/80 font-bold text-[0.7rem] sm:text-[0.75rem] tracking-[1.5px] uppercase m-0 group-hover:text-emerald-100 transition-colors">${m.rank || 'Lecturer'}</p>
                </div>
            </div>
            
            <!-- Optional Status Badge overlayed if needed -->
            <div class="absolute top-4 right-4 z-40 transform lg:-skew-x-[8deg]">
                ${statusBadgeHtml(m.status)}
            </div>
        </a>`;
    }

    function performSearch() {
        const search = searchInput.value.trim();
        const status = statusFilter.value;
        updateClearBtn();

        const params = new URLSearchParams();
        if (search) params.set('search', search);
        if (status) params.set('status', status);

        // Abort previous request
        if (currentRequest) currentRequest.abort();
        const controller = new AbortController();
        currentRequest = controller;

        // Show loading state
        gridContainer.style.opacity = '0.5';
        gridContainer.style.transition = 'opacity 0.15s';

        fetch(searchUrl + '?' + params.toString(), { signal: controller.signal })
            .then(r => r.json())
            .then(data => {
                currentRequest = null;
                const filtering = search || status;

                // Toggle HOD section
                hodSection.style.display = filtering ? 'none' : '';
                heading.style.display = filtering ? 'none' : '';

                // Update count
                staffCount.textContent = data.count + ' member' + (data.count !== 1 ? 's' : '');

                // Render cards
                const cards = data.staff
                    .filter(m => !m.skip_as_hod)
                    .map(renderCard)
                    .join('');

                if (data.count === 0 || cards.length === 0) {
                    gridContainer.innerHTML = `
                        <div class="text-center py-16 px-8 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                            <i class="fa-solid fa-users-slash text-5xl text-slate-300 mb-4 block"></i>
                            <h3 class="text-slate-700 m-0 mb-2">No Staff Found</h3>
                            <p class="text-slate-500">Try adjusting your search or filter.</p>
                        </div>`;
<!-- Replace old CSS class with pure Tailwind Grid -->
            gridContainer.innerHTML = `<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 staff-grid-fade">${cards}</div>`;
        }

                gridContainer.style.opacity = '1';

                // Update URL without reload
                const url = new URL(window.location);
                if (search) url.searchParams.set('search', search); else url.searchParams.delete('search');
                if (status) url.searchParams.set('status', status); else url.searchParams.delete('status');
                history.replaceState(null, '', url);
            })
            .catch(err => {
                if (err.name !== 'AbortError') {
                    gridContainer.style.opacity = '1';
                }
            });
    }

    // Events
    searchBtn.addEventListener('click', performSearch);

    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            performSearch();
            return;
        }
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(performSearch, 350);
    });

    statusFilter.addEventListener('change', performSearch);

    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        statusFilter.value = '';
        performSearch();
    });

    updateClearBtn();
});
</script>

