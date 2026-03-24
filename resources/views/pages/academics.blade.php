@extends('layouts.public')
@section('title', 'Academics')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::where('key', $key)->value('value') ?? $default;
    $heroSetting = \App\Models\DepartmentSetting::where('key', 'hero_academics')->first();
    $heroUrl = $heroSetting && $heroSetting->value && file_exists(storage_path('app/public/' . $heroSetting->value))
        ? asset('storage/' . $heroSetting->value) 
        : asset('images/campus-bg.jpg');
@endphp
<!-- Hero Section -->
<div class="acad-hero" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(4, 120, 87, 0.9) 50%, rgba(15, 23, 42, 0.95) 100%), url('{{ $heroUrl }}') center/cover; padding: 5.5rem 0 6.5rem; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: radial-gradient(circle at 20% 80%, rgba(16, 185, 129, 0.15), transparent 50%), radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.1), transparent 50%); pointer-events: none;"></div>
    
    <!-- Floating Decorative Elements -->
    <div style="position: absolute; top: 15%; right: 10%; width: 150px; height: 150px; border: 1px solid rgba(255,255,255,0.05); border-radius: 50%; pointer-events: none;"></div>
    <div style="position: absolute; bottom: 10%; left: 5%; width: 250px; height: 250px; border: 1px solid rgba(255,255,255,0.04); border-radius: 50%; pointer-events: none;"></div>
    <div style="position: absolute; bottom: 20%; right: 25%; font-size: 8rem; color: rgba(255,255,255,0.02); transform: rotate(15deg); pointer-events: none;"><i class="fa-solid fa-laptop-code"></i></div>
    
    <div class="container" style="position: relative; z-index: 10; text-align: center; display: flex; flex-direction: column; align-items: center;">
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.4rem 1.2rem; background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); color: #a7f3d0; border-radius: 20px; font-size: 0.8rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.1);">
            <i class="fa-solid fa-book-open" style="font-size: 0.7rem;"></i> {{ $gs('academics_hero_badge', 'Explore Our Programs') }}
        </div>
        <h1 style="text-align: center; color: white; font-size: 3.2rem; font-family: var(--font-heading); margin: 0 0 1rem 0; font-weight: 800; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">{{ $gs('academics_hero_title', 'Discover Academic Excellence') }}</h1>
        <p style="text-align: center; color: #cbd5e1; font-size: 1.15rem; max-width: 680px; margin: 0 auto; line-height: 1.7;">{{ $gs('academics_hero_subtitle', 'Rigorous computing programmes designed to equip you with cutting-edge skills for the technology-driven world.') }}</p>
    </div>
</div>

<div class="container page-layout reveal" style="margin-top: -3rem; position: relative; z-index: 20; padding-bottom: 4rem;">
    <div class="main-content acad-main" style="background: white; border-radius: 16px; box-shadow: 0 20px 50px -12px rgba(0,0,0,0.1); padding: 3rem 4rem;">

        {{-- Search / Filter Bar --}}
        <div id="acad-search-bar" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1rem 1.5rem; margin-bottom: 2.5rem; display: flex; flex-wrap: wrap; gap: 0.8rem; align-items: center;">
            <div style="flex: 1; min-width: 200px; position: relative;">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.85rem;"></i>
                <input type="text" id="acad-search-input" placeholder="Search programmes or courses..." style="width: 100%; padding: 0.6rem 0.8rem 0.6rem 2.2rem; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.9rem; outline: none; transition: border-color 0.2s; background: white;" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#e2e8f0'">
            </div>
            <select id="acad-section-filter" style="padding: 0.6rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.9rem; background: white; color: #334155; cursor: pointer; outline: none;">
                <option value="all">All Sections</option>
                <option value="programmes">Programmes Only</option>
                <option value="courses">Courses Only</option>
            </select>
            <span id="acad-result-count" style="font-size: 0.8rem; color: #64748b; font-weight: 500; padding: 0.4rem 0.8rem; background: white; border-radius: 20px; border: 1px solid #e2e8f0; white-space: nowrap;"></span>
        </div>

        {{-- ═══════════ PROGRAMME CATEGORIES OVERVIEW ═══════════ --}}
        <section id="overview" style="margin-bottom: 4rem;">
            <div class="acad-section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="acad-section-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(99, 102, 241, 0.1)); color: #3b82f6; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">{{ $gs('academics_overview_title', 'Degree Programmes') }}</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #3b82f6, #6366f1); margin-bottom: 2rem; border-radius: 2px;"></div>
            
            <p style="font-size: 1.05rem; line-height: 1.8; color: #475569; margin-bottom: 2.5rem;">
                {{ $gs('academics_overview_desc', 'We offer rigorous academic paths ranging from undergraduate to doctoral studies, customized to meet global technology demands and equip our graduates with both theoretical depth and practical prowess.') }}
            </p>

            {{-- Category Quick Nav Cards --}}
            <div class="acad-cat-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.2rem;">
                @php
                    $catColors = [
                        ['bg' => '#eff6ff', 'border' => '#bfdbfe', 'text' => '#1d4ed8', 'icon' => '#3b82f6'],
                        ['bg' => '#ecfdf5', 'border' => '#a7f3d0', 'text' => '#047857', 'icon' => '#10b981'],
                        ['bg' => '#faf5ff', 'border' => '#ddd6fe', 'text' => '#6d28d9', 'icon' => '#8b5cf6'],
                        ['bg' => '#fffbeb', 'border' => '#fde68a', 'text' => '#b45309', 'icon' => '#f59e0b'],
                        ['bg' => '#f0f9ff', 'border' => '#bae6fd', 'text' => '#2563eb', 'icon' => '#3b82f6']
                    ];
                @endphp
                @foreach($categories as $index => $cat)
                @php $color = $catColors[$index % 5]; @endphp
                <a href="#{{ $cat->slug }}" style="display: flex; gap: 1.2rem; align-items: flex-start; background: white; padding: 1.5rem; border-radius: 14px; text-decoration: none; border: 1px solid #e2e8f0; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;"
                   onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 25px -5px rgba(0,0,0,0.05)'; this.style.borderColor='{{ $color['border'] }}'"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.02)'; this.style.borderColor='#e2e8f0'">
                    
                    {{-- Left Side: Icon --}}
                    <div style="width: 54px; height: 54px; flex-shrink: 0; background: {{ $color['bg'] }}; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; color: {{ $color['icon'] }}; border: 1px solid {{ $color['border'] }};">
                        <i class="{{ $cat->icon ?? 'fa-solid fa-graduation-cap' }}"></i>
                    </div>

                    {{-- Right Side: Title + Count --}}
                    <div style="flex: 1; display: flex; flex-direction: column; justify-content: center; gap: 0.4rem; padding-top: 0.2rem;">
                        <strong style="font-size: 1.15rem; color: #1e293b; font-family: var(--font-heading); line-height: 1.3;">{{ $cat->name }}</strong>
                        
                        <div style="display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #64748b; font-weight: 500;">
                            <span style="display: flex; align-items: center; justify-content: center; width: 22px; height: 22px; background: #f1f5f9; border-radius: 50%; color: {{ $color['icon'] }}; font-size: 0.7rem;">
                                <i class="fa-solid fa-layer-group"></i>
                            </span>
                            {{ $cat->programmes->count() }} Programme{{ $cat->programmes->count() !== 1 ? 's' : '' }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>

        {{-- ═══════════ HOW TO APPLY SUMMARY (NEW) ═══════════ --}}
        <section id="admission-process" class="acad-admission" style="margin-bottom: 4rem; padding: 3rem; background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border-radius: 16px; color: white; position: relative; overflow: hidden; box-shadow: 0 15px 30px -10px rgba(15, 23, 42, 0.5);">
            <div style="position: absolute; top: 0; right: 0; width: 300px; height: 300px; background: radial-gradient(circle, rgba(16,185,129,0.1) 0%, transparent 60%); pointer-events: none;"></div>
            
            <div style="text-align: center; margin-bottom: 2.5rem; position: relative; z-index: 2;">
                <span style="display: inline-block; padding: 0.3rem 1rem; background: rgba(255,255,255,0.1); color: #a7f3d0; border-radius: 20px; font-size: 0.75rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1rem;">{{ $gs('academics_apply_badge', 'Admissions') }}</span>
                <h2 style="margin: 0 0 1rem; font-size: 2rem; font-family: var(--font-heading); color: white;">{{ $gs('academics_apply_title', 'How to Apply') }}</h2>
                <p style="color: #cbd5e1; font-size: 1.05rem; max-width: 500px; margin: 0 auto;">{{ $gs('academics_apply_subtitle', 'Join our vibrant academic community in three simple steps.') }}</p>
            </div>

            <div class="acad-steps-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; position: relative; z-index: 2;">
                @php
                    $applySteps = json_decode(\App\Models\DepartmentSetting::where('key', 'academics_apply_steps')->value('value') ?? '[]', true) ?? [];
                    if (empty($applySteps)) {
                        $applySteps = [
                            ['title' => 'Check Requirements', 'desc' => 'Review the entry requirements for your desired programme under its details below.'],
                            ['title' => 'University Portal', 'desc' => 'Visit the central NSUK admissions portal to purchase forms during the intake window.'],
                            ['title' => 'Screening', 'desc' => 'Attend the departmental screening exercise with your credentials.']
                        ];
                    }
                @endphp
                @foreach($applySteps as $i => $step)
                <div class="acad-step-card" style="background: linear-gradient(145deg, rgba(30,41,59,0.7), rgba(15,23,42,0.9)); padding: 2.5rem 2rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.08); text-align: center; backdrop-filter: blur(10px); transition: all 0.4s ease; box-shadow: 0 10px 30px -5px rgba(0,0,0,0.3);" onmouseover="this.style.transform='translateY(-8px)'; this.style.borderColor='rgba(16,185,129,0.4)'; this.style.boxShadow='0 20px 40px -5px rgba(0,0,0,0.4), inset 0 0 0 1px rgba(16,185,129,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(255,255,255,0.08)'; this.style.boxShadow='0 10px 30px -5px rgba(0,0,0,0.3)'">
                    <div style="width: 64px; height: 64px; background: linear-gradient(135deg, var(--color-primary), #047857); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; margin: 0 auto 1.5rem; box-shadow: 0 8px 20px rgba(16,185,129,0.3); border: 2px solid rgba(255,255,255,0.1);">{{ $i + 1 }}</div>
                    <strong style="display: block; font-size: 1.25rem; font-family: var(--font-heading); margin-bottom: 0.8rem; color: white;">{{ $step['title'] ?? '' }}</strong>
                    <p style="font-size: 0.95rem; color: #94a3b8; margin: 0; line-height: 1.6;">{{ $step['desc'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- ═══════════ DETAILED PROGRAMMES BY CATEGORY ═══════════ --}}
        @foreach($categories as $index => $cat)
        @php 
            // Cycle through some brand colors for section headers
            $headers = ['#10b981', '#3b82f6', '#8b5cf6', '#ea580c'];
            $hc = $headers[$index % 4]; 
        @endphp
        <section id="{{ $cat->slug }}" style="margin-bottom: 4rem;">
            <div class="acad-section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.2rem;">
                <div class="acad-section-icon" style="width: 44px; height: 44px; background: {{ $hc }}15; color: {{ $hc }}; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                    <i class="{{ $cat->icon ?? 'fa-solid fa-graduation-cap' }}"></i>
                </div>
                <h2 style="margin: 0; font-size: 1.8rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">{{ $cat->name }}</h2>
            </div>
            <div style="width: 50px; height: 3px; background: {{ $hc }}; margin-bottom: 1.5rem; border-radius: 2px;"></div>

            @if($cat->description)
            <p style="font-size: 1.05rem; line-height: 1.7; color: #475569; margin-bottom: 2rem; max-width: 800px;">{{ $cat->description }}</p>
            @endif

            @if($cat->programmes->isEmpty())
            <div style="background: #f8fafc; padding: 2.5rem; border-radius: 12px; text-align: center; color: #64748b; border: 1px dashed #cbd5e1;">
                <div style="width: 48px; height: 48px; background: #e2e8f0; color: #94a3b8; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin: 0 auto 1rem;">
                    <i class="fa-solid fa-info"></i>
                </div>
                <p style="margin: 0; font-size: 1rem;">Information regarding programmes in this category is currently being updated.</p>
            </div>
            @else
            <div style="display: grid; gap: 1.2rem;">
                @foreach($cat->programmes as $prog)
                <details class="programme-card acad-programme-item" data-name="{{ strtolower($prog->name) }}" data-level="{{ strtolower($prog->level ?? '') }}" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); transition: box-shadow 0.3s;"
                         onmouseover="this.style.boxShadow='0 10px 25px -5px rgba(0,0,0,0.05)'"
                         onmouseout="this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.02)'">
                    
                    <summary style="cursor: pointer; padding: 1.5rem; position: relative; list-style: none; user-select: none;">
                        <div class="expand-icon" style="position: absolute; right: 1.5rem; top: 1.5rem; width: 36px; height: 36px; background: #f8fafc; border: 1px solid #e2e8f0; color: #64748b; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: transform 0.3s; z-index: 2;">
                            <i class="fa-solid fa-chevron-down" style="font-size: 0.8rem;"></i>
                        </div>

                        <div style="width: 100%; box-sizing: border-box;">
                            <div style="padding-right: 3.5rem; margin-bottom: 1rem;">
                                <h3 style="margin: 0; font-size: 1rem; color: #1d4ed8; background: #eff6ff; font-family: var(--font-heading); line-height: 1.4; padding: 0.4rem 0.8rem; border-radius: 8px; display: inline-block;">{{ $prog->name }}</h3>
                            </div>
                            
                            {{-- Meta Badges --}}
                            <div style="display: flex; flex-wrap: nowrap; align-items: center; gap: 0.35rem; width: 100%;">
                                @if($prog->level)
                                <span style="background: rgba(16, 185, 129, 0.1); color: #047857; padding: 0.25rem 0.55rem; border-radius: 20px; font-size: 0.7rem; font-weight: 700; border: 1px solid rgba(16,185,129,0.2); white-space: nowrap; flex-shrink: 0; letter-spacing: 0.2px;">
                                    {{ $prog->level }}
                                </span>
                                @endif
                                @if($prog->duration)
                                <span style="background: #f8fafc; color: #475569; padding: 0.25rem 0.55rem; border-radius: 20px; font-size: 0.7rem; font-weight: 600; border: 1px solid #e2e8f0; display: inline-flex; align-items: center; gap: 0.25rem; white-space: nowrap; flex-shrink: 0; letter-spacing: 0.2px;">
                                    <i class="fa-regular fa-clock" style="font-size: 0.65rem;"></i> {{ $prog->duration }}
                                </span>
                                @endif
                                @if($prog->mode_of_study)
                                <span style="background: #f8fafc; color: #475569; padding: 0.25rem 0.55rem; border-radius: 20px; font-size: 0.7rem; font-weight: 600; border: 1px solid #e2e8f0; display: inline-flex; align-items: center; gap: 0.25rem; white-space: nowrap; flex-shrink: 0; letter-spacing: 0.2px;">
                                    <i class="fa-solid fa-book-open" style="font-size: 0.65rem;"></i> {{ $prog->mode_of_study }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </summary>

                    <div style="padding: 0 1.5rem 1.5rem 1.5rem; border-top: 1px solid #f1f5f9; margin-top: -0.5rem; pt-4">
                        @if($prog->description)
                        <p style="line-height: 1.7; color: #475569; font-size: 0.95rem; margin: 1rem 0 1.5rem;">{{ $prog->description }}</p>
                        @endif

                        <div class="acad-prog-details-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                            @if($prog->objectives)
                            <div style="background: #faf5ff; padding: 1.2rem; border-radius: 10px; border-left: 3px solid #a855f7;">
                                <h4 style="margin: 0 0 0.5rem; font-size: 0.95rem; color: #7e22ce; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-bullseye"></i> Objectives</h4>
                                <p style="margin: 0; font-size: 0.9rem; color: #4c1d95; line-height: 1.6;">{{ $prog->objectives }}</p>
                            </div>
                            @endif

                            @if($prog->career_pathways)
                            <div style="background: #eff6ff; padding: 1.2rem; border-radius: 10px; border-left: 3px solid #3b82f6;">
                                <h4 style="margin: 0 0 0.5rem; font-size: 0.95rem; color: #1d4ed8; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-road"></i> Career Pathways</h4>
                                <p style="margin: 0; font-size: 0.9rem; color: #1e3a8a; line-height: 1.6;">{{ $prog->career_pathways }}</p>
                            </div>
                            @endif

                            @if($prog->requirements_utme)
                            <div style="background: #fdf2f8; padding: 1.2rem; border-radius: 10px; border-left: 3px solid #ec4899;">
                                <h4 style="margin: 0 0 0.5rem; font-size: 0.95rem; color: #be185d; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-clipboard-check"></i> UTME Requirements</h4>
                                <p style="margin: 0; font-size: 0.9rem; color: #831843; line-height: 1.6;">{{ $prog->requirements_utme }}</p>
                            </div>
                            @endif

                            @if($prog->requirements_de)
                            <div style="background: #fffbeb; padding: 1.2rem; border-radius: 10px; border-left: 3px solid #f59e0b;">
                                <h4 style="margin: 0 0 0.5rem; font-size: 0.95rem; color: #b45309; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-clipboard-list"></i> Direct Entry Requirements</h4>
                                <p style="margin: 0; font-size: 0.9rem; color: #78350f; line-height: 1.6;">{{ $prog->requirements_de }}</p>
                            </div>
                            @endif
                        </div>

                        @if($prog->handbook_pdf)
                        <div style="margin-top: 1.5rem; padding-top: 1.2rem; border-top: 1px dashed #e2e8f0; text-align: right;">
                            <a href="{{ asset('storage/' . $prog->handbook_pdf) }}" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='var(--color-secondary)'" onmouseout="this.style.background='var(--color-primary)'">
                                <i class="fa-solid fa-cloud-arrow-down"></i> Download Handbook
                            </a>
                        </div>
                        @endif
                    </div>
                </details>
                @endforeach
            </div>
            @endif
        </section>
        @endforeach

        {{-- ═══════════ COURSE STRUCTURE ═══════════ --}}
        <section id="course-structure" style="margin-bottom: 2rem;">
            <div class="acad-section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="acad-section-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(236, 72, 153, 0.15), rgba(225, 29, 72, 0.1)); color: #ec4899; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-diagram-project"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">{{ $gs('academics_courses_title', 'Course Structure') }}</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #ec4899, #e11d48); margin-bottom: 1.5rem; border-radius: 2px;"></div>
            
            <p style="font-size: 1.05rem; color: #475569; margin-bottom: 2.5rem;">{{ $gs('academics_courses_desc', 'Browse the unified curriculum outline showing core and elective courses across different academic levels.') }}</p>

            @foreach($courses as $level => $levelCourses)
            <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; margin-bottom: 2.5rem; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 8px 10px -6px rgba(0,0,0,0.01);">
                <div style="background: #ffffff; padding: 1.5rem 1.8rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 1rem;">
                    <span style="background: #0f172a; color: white; width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.15rem; box-shadow: 0 4px 10px rgba(15, 23, 42, 0.25);">L{{ $level }}</span>
                    <h3 style="margin: 0; font-size: 1.4rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700; letter-spacing: -0.02em;">Level {{ $level }} Courses</h3>
                </div>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; min-width: 650px; text-align: left;">
                        <thead>
                            <tr style="background: #f8fafc; color: #64748b; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">
                                <th style="padding: 1.2rem 1.8rem; font-weight: 700; border-bottom: 1px solid #e2e8f0;">Course Code</th>
                                <th style="padding: 1.2rem 1.8rem; font-weight: 700; border-bottom: 1px solid #e2e8f0;">Course Title</th>
                                <th style="padding: 1.2rem 1.8rem; font-weight: 700; text-align: center; border-bottom: 1px solid #e2e8f0;">Units</th>
                                <th style="padding: 1.2rem 1.8rem; font-weight: 700; text-align: center; border-bottom: 1px solid #e2e8f0;">Semester</th>
                                <th style="padding: 1.2rem 1.8rem; font-weight: 700; text-align: center; border-bottom: 1px solid #e2e8f0;">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($levelCourses as $index => $course)
                            <tr class="acad-course-row" data-code="{{ strtolower($course->code) }}" data-coursetitle="{{ strtolower($course->title) }}" style="border-bottom: 1px solid #f1f5f9; background: {{ $index % 2 === 0 ? 'white' : '#fafafb' }}; transition: all 0.2s ease;" onmouseover="this.style.background='#f1f5f9'; this.style.transform='translateY(-1px)'" onmouseout="this.style.background='{{ $index % 2 === 0 ? 'white' : '#fafafb' }}'; this.style.transform='translateY(0)'">
                                <td style="padding: 1.2rem 1.8rem;">
                                    <strong style="color: var(--color-primary); font-family: 'Courier New', Courier, monospace; font-size: 0.95rem; background: rgba(var(--color-primary-rgb, 37, 99, 235), 0.08); padding: 0.4rem 0.8rem; border-radius: 8px; border: 1px solid rgba(var(--color-primary-rgb, 37, 99, 235), 0.15); font-weight: 700; letter-spacing: 0.5px;">{{ $course->code }}</strong>
                                </td>
                                <td style="padding: 1.2rem 1.8rem; color: #1e293b; font-size: 1rem; font-weight: 600;">{{ $course->title }}</td>
                                <td style="padding: 1.2rem 1.8rem; text-align: center; color: #475569; font-weight: 700; font-size: 1rem;">{{ $course->credit_units }}</td>
                                <td style="padding: 1.2rem 1.8rem; text-align: center; color: #64748b; font-size: 0.95rem; font-weight: 500;">
                                    <span style="display: inline-flex; align-items: center; gap: 0.4rem; background: white; padding: 0.3rem 0.8rem; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 1px 2px rgba(0,0,0,0.05);"><i class="fa-solid {{ strtolower($course->semester) == 'first' ? 'fa-sun' : 'fa-snowflake' }}" style="color: {{ strtolower($course->semester) == 'first' ? '#f59e0b' : '#38bdf8' }};"></i> {{ $course->semester }}</span>
                                </td>
                                <td style="padding: 1.2rem 1.8rem; text-align: center;">
                                    @if($course->is_elective)
                                        <span style="background: rgba(245, 158, 11, 0.1); color: #b45309; padding: 0.4rem 1rem; border-radius: 30px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; border: 1px solid rgba(245, 158, 11, 0.2); letter-spacing: 0.5px;">Elective</span>
                                    @else
                                        <span style="background: rgba(16, 185, 129, 0.1); color: #047857; padding: 0.4rem 1rem; border-radius: 30px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; border: 1px solid rgba(16, 185, 129, 0.2); letter-spacing: 0.5px;">Core</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </section>
    </div>

    @php
        $sections = [
            'overview' => 'Programme Overview',
            'admission-process' => 'How to Apply'
        ];
        foreach($categories as $c) {
            $sections[$c->slug] = $c->name;
        }
        $sections['course-structure'] = 'Course Structure';
    @endphp
    <x-sticky-toc :sections="$sections" />
</div>

<style>
    /* Details/Summary animation styles */
    details.programme-card summary::-webkit-details-marker { display: none; }
    details.programme-card[open] summary .expand-icon { transform: rotate(180deg); background: var(--color-primary); color: white; }
    details.programme-card[open] { border-color: var(--color-primary); box-shadow: 0 10px 25px -5px rgba(22, 163, 74, 0.1) !important; }

    /* ── Academics Page Responsive ── */

    /* Tablet landscape (≤1024px) */
    @media (max-width: 1024px) {
        .acad-hero h1 { font-size: 2.6rem !important; }
        .acad-main { padding: 2.5rem 2.5rem !important; }
        .acad-cat-grid { grid-template-columns: repeat(2, 1fr) !important; }
        .acad-prog-details-grid { grid-template-columns: 1fr !important; }
    }

    /* Tablet portrait (≤768px) */
    @media (max-width: 768px) {
        .page-layout { flex-direction: column; }
        .acad-hero { padding: 3.5rem 0 5.5rem !important; }
        .acad-hero h1 { font-size: 2rem !important; }
        .acad-hero p { font-size: 1rem !important; }
        .acad-main { padding: 1.5rem 1.2rem !important; border-radius: 12px !important; }
        .acad-main section { margin-bottom: 2.5rem !important; }
        .acad-section-heading h2 { font-size: 1.5rem !important; }
        .acad-section-icon { width: 40px !important; height: 40px !important; font-size: 1.1rem !important; border-radius: 10px !important; }
        .acad-cat-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 1rem !important; }
        .acad-cat-grid a { padding: 1.5rem 1rem !important; }
        .acad-cat-grid a strong { font-size: 1rem !important; }
        .acad-admission { padding: 2rem 1.5rem !important; border-radius: 12px !important; }
        .acad-admission h2 { font-size: 1.6rem !important; }
        .acad-admission p { font-size: 0.95rem !important; }
        .acad-steps-grid { grid-template-columns: 1fr !important; gap: 1rem !important; }
        .acad-prog-details-grid { grid-template-columns: 1fr !important; }
        details.programme-card summary { padding: 1.2rem !important; }
        details.programme-card summary h3 { font-size: 1.1rem !important; }
        details.programme-card summary > div:first-child { flex-direction: column !important; }
        details.programme-card div[style*="padding: 0 1.5rem"] { padding: 0 1.2rem 1.2rem 1.2rem !important; }
    }

    /* Mobile (≤576px) */
    @media (max-width: 576px) {
        .acad-hero { padding: 2.5rem 0 5rem !important; }
        .acad-hero h1 { font-size: 1.6rem !important; }
        .acad-hero p { font-size: 0.88rem !important; }
        .acad-main { padding: 1.2rem 1rem !important; margin-top: -1.5rem !important; }
        .acad-section-heading h2 { font-size: 1.3rem !important; }
        .acad-cat-grid { grid-template-columns: 1fr 1fr !important; gap: 0.8rem !important; }
        .acad-cat-grid a { padding: 1.2rem 0.8rem !important; }
        .acad-cat-grid a div[style*="width: 56px"] { width: 44px !important; height: 44px !important; font-size: 1.3rem !important; }
        .acad-cat-grid a strong { font-size: 0.92rem !important; }
        .acad-cat-grid a span { font-size: 0.75rem !important; padding: 0.15rem 0.6rem !important; }
        .acad-admission { padding: 1.5rem 1.2rem !important; }
        .acad-admission h2 { font-size: 1.4rem !important; }
        .acad-steps-grid > div { padding: 1.2rem !important; }
        details.programme-card summary { padding: 1rem !important; gap: 0.5rem !important; }
        details.programme-card summary h3 { font-size: 1rem !important; }
        details.programme-card div[style*="padding: 0 1.5rem"] { padding: 0 1rem 1rem 1rem !important; }
        .acad-prog-details-grid > div { padding: 1rem !important; }
        /* Course table responsive */
        table th, table td { padding: 0.6rem 0.8rem !important; font-size: 0.82rem !important; }
        table th:nth-child(4), table td:nth-child(4),
        table th:nth-child(5), table td:nth-child(5) { display: none; }
    }

    /* Small mobile (≤400px) */
    @media (max-width: 400px) {
        .acad-hero h1 { font-size: 1.35rem !important; }
        .acad-cat-grid { grid-template-columns: 1fr !important; }
        .acad-cat-grid a { flex-direction: row !important; align-items: center !important; text-align: left !important; padding: 1rem !important; gap: 0.8rem !important; }
        .acad-cat-grid a div[style*="width: 56px"] { width: 40px !important; height: 40px !important; font-size: 1.1rem !important; margin-bottom: 0 !important; }
    }
</style>
@endsection
