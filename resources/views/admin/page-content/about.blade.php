@extends($adminLayout ?? 'layouts.admin')
@section('title', 'About Page Content')
@section('header', 'About Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    
    // Core Values Fallback
    $coreValues = json_decode($s('about_core_values', '[]'), true) ?? [];
    if (empty($coreValues)) {
        $coreValues = [
            ['title' => 'Innovation', 'icon' => 'fa-lightbulb', 'color' => '#16a34a', 'bg' => '#f0fdf4', 'description' => 'Pioneering creative solutions in technology'],
            ['title' => 'Excellence', 'icon' => 'fa-award', 'color' => '#15803d', 'bg' => '#f0fdf4', 'description' => 'Pursuing the highest academic standards'],
            ['title' => 'Integrity', 'icon' => 'fa-shield-halved', 'color' => '#10b981', 'bg' => '#ecfdf5', 'description' => 'Upholding ethical principles in all endeavors'],
            ['title' => 'Self-Reliance', 'icon' => 'fa-person-rays', 'color' => '#047857', 'bg' => '#ecfdf5', 'description' => 'Building independent and capable professionals'],
            ['title' => 'Inclusivity', 'icon' => 'fa-people-group', 'color' => '#059669', 'bg' => '#f0fdf4', 'description' => 'Accessible education for all communities'],
            ['title' => 'Creativity', 'icon' => 'fa-palette', 'color' => '#16a34a', 'bg' => '#f0fdf4', 'description' => 'Fostering original thinking and resourcefulness'],
        ];
    }
    
    // Facilities Fallback
    $facilities = json_decode($s('about_facilities', '[]'), true) ?? [];
    if (empty($facilities)) {
        $facilities = [
            ['name' => 'Software Lab', 'icon' => 'fa-laptop-code', 'description' => 'The Department of Computer Science is equipped with state-of-the-art facilities that empower students to explore, innovate, and succeed in their academic and professional journeys.'],
            ['name' => 'Hardware Lab', 'icon' => 'fa-microchip', 'description' => 'A dedicated space for practical experiments with computer architecture and embedded systems.'],
            ['name' => 'Networking Lab', 'icon' => 'fa-network-wired', 'description' => 'Advanced infrastructural setup for studying cryptography, network administration, and cybersecurity protocols.'],
            ['name' => 'Library', 'icon' => 'fa-book', 'description' => 'A comprehensive collection of academic resources, research journals, and reference materials for computer science studies.'],
        ];
    }
    
    // Requirements Fallback
    $requirements = json_decode($s('about_requirements', '[]'), true) ?? [];
    if (empty($requirements)) {
        $requirements = [
            ['level' => 'O\' Level', 'icon' => 'fa-school', 'desc' => 'WAEC/NECO with 5 credits including Maths & English'],
            ['level' => 'A\' Level', 'icon' => 'fa-book-open', 'desc' => 'Advanced Level or JUPEB with required passes'],
            ['level' => 'UTME', 'icon' => 'fa-pen-fancy', 'desc' => 'Mathematics, English, Physics & one of Chemistry/Biology/Economics'],
            ['level' => 'Postgraduate', 'icon' => 'fa-user-graduate', 'desc' => 'B.Sc. in Computer Science or related field with minimum of 2nd Class'],
            ['level' => 'PhD', 'icon' => 'fa-hat-wizard', 'desc' => 'M.Sc. in Computer Science or related field'],
        ];
    }
    
    // Programmes Fallback
    $programmes = json_decode($s('about_programmes', '[]'), true) ?? [];
    if (empty($programmes)) {
        $programmes = [
            [
                'title' => 'Postgraduate',
                'icon' => 'fa-hat-wizard',
                'theme_main' => '#0f172a',
                'theme_accent' => '#1e293b',
                'items' => "Ph.D. Computer Science\nM.Phil./Ph.D. Computer Science\nM.Sc. Computer Science\nM.Sc. (Database/Info Systems)\nM.Sc. (Information Security)\nM.Sc. (Networking)\nM.Sc. (Software Engineering)\nPGD Computer Science"
            ],
            [
                'title' => 'Undergraduate',
                'icon' => 'fa-user-graduate',
                'theme_main' => '#f0fdf4',
                'theme_accent' => '#dcfce7',
                'items' => "B.Sc. Computer Science\nB.Sc. Network Technology & Cybersecurity\nB.Sc. Software Engineering"
            ],
            [
                'title' => 'Part-Time',
                'icon' => 'fa-clock',
                'theme_main' => '#f8fafc',
                'theme_accent' => '#e2e8f0',
                'items' => "B.Sc. Computer Science (Part-Time)\nProfessional Diplomas\nShort Certificate Courses"
            ]
        ];
    }
    
    // Faculty Highlights (No default)
    $faculty = json_decode($s('about_faculty', '[]'), true) ?? [];
    
    // Milestones Fallback
    $milestones = json_decode($s('about_milestones', '[]'), true) ?? [];
    if (empty($milestones)) {
        $milestones = [
            ['year' => '2003', 'title' => 'Established as a Unit'],
            ['year' => '2017', 'title' => 'Upgraded to Department'],
            ['year' => '2021', 'title' => 'New Programmes Added'],
            ['year' => '11+', 'title' => 'Academic Programmes']
        ];
    }
    
    // Objectives Fallback
    $objectives = json_decode($s('about_objectives', '[]'), true) ?? [];
    if (empty($objectives)) {
        $objectives = [
            ['icon' => 'fa-user-graduate', 'title' => 'Industry-Ready Graduates', 'text' => 'Produce market-ready graduates with appropriate IT skills and capacity for independent thinking, self-reliance, and resourcefulness.'],
            ['icon' => 'fa-flask', 'title' => 'Research Excellence', 'text' => 'Develop trend-setting multidisciplinary research excellence with national, regional, and international recognition.'],
            ['icon' => 'fa-laptop-code', 'title' => 'Future Leaders', 'text' => 'Equip students with cutting-edge knowledge and abilities to lead, innovate, and create across diverse industries.'],
            ['icon' => 'fa-handshake', 'title' => 'Community & Inclusivity', 'text' => 'Promote inclusivity and accessibility to the Nasarawa State community and the nation at large through quality education.'],
        ];
    }
    
    // Board Fallback
    $boardMembers = json_decode($s('about_board', '[]'), true) ?? [];
    if (empty($boardMembers)) {
        $boardMembers = [
            ['title' => 'Chairman', 'icon' => 'fa-crown', 'who' => 'Head of Department (HOD)'],
            ['title' => 'Members', 'icon' => 'fa-users', 'who' => "All Academic Staff\n(Except Graduate Assistants)"],
            ['title' => 'Mandate', 'icon' => 'fa-clipboard-check', 'who' => 'Course organisation, teaching oversight & examination control'],
        ];
    }

    $navSections = [
        'sec-hero'         => ['icon' => 'fa-image',          'label' => 'Hero',           'color' => '#6366f1'],
        'sec-intro'        => ['icon' => 'fa-align-left',     'label' => 'Introduction',   'color' => '#0ea5e9'],
        'sec-mv'           => ['icon' => 'fa-bullseye',       'label' => 'Mission & Vision','color' => '#10b981'],
        'sec-objectives'   => ['icon' => 'fa-list-check',     'label' => 'Objectives',     'color' => '#f59e0b'],
        'sec-values'       => ['icon' => 'fa-star',           'label' => 'Core Values',    'color' => '#ec4899'],
        'sec-history'      => ['icon' => 'fa-clock-rotate-left','label' => 'History',      'color' => '#8b5cf6'],
        'sec-programmes'   => ['icon' => 'fa-graduation-cap', 'label' => 'Programmes',     'color' => '#06b6d4'],
        'sec-board'        => ['icon' => 'fa-users-viewfinder','label' => 'Board',         'color' => '#64748b'],
        'sec-requirements' => ['icon' => 'fa-clipboard-list', 'label' => 'Requirements',   'color' => '#f97316'],
        'sec-facilities'   => ['icon' => 'fa-building',       'label' => 'Facilities',     'color' => '#14b8a6'],
        'sec-faculty'      => ['icon' => 'fa-chalkboard-user','label' => 'Faculty',        'color' => '#ef4444'],
    ];
@endphp

<style>
/* ── Page shell ── */
.apc-shell { display: flex; gap: 1.5rem; align-items: flex-start; }

/* ── Sticky left nav ── */
.apc-sidenav { display: flex; flex-direction: column;
    width: 190px;
    flex-shrink: 0;
    background: white;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    /* JS will switch this to position:fixed after reading natural coords */
    align-self: flex-start;
    max-height: calc(100vh - 110px);
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: thin;
    scrollbar-color: #e2e8f0 transparent;
    z-index: 40;
}
.apc-sidenav-head {
    padding: 0.9rem 1rem;
    background: #0f172a;
    color: #94a3b8;
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}
.apc-sidenav a {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.6rem 1rem;
    font-size: 0.82rem;
    font-weight: 500;
    color: #475569;
    text-decoration: none;
    border-left: 3px solid transparent;
    transition: all 0.15s;
}
.apc-sidenav a:hover { background: #f8fafc; color: #0f172a; }
.apc-sidenav a.active { background: #f0f9ff; color: #0284c7; border-left-color: #0284c7; font-weight: 600; }
.apc-sidenav-icon { width: 22px; height: 22px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; flex-shrink: 0; }

/* ── Main form area ── */
.apc-main { flex: 1; min-width: 0; }

/* ── Section cards ── */
.apc-section {
    background: white;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    margin-bottom: 1.25rem;
    box-shadow: 0 1px 4px rgba(0,0,0,0.03);
    overflow: hidden;
    scroll-margin-top: 90px;
}
.apc-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.25rem;
    cursor: pointer;
    user-select: none;
    background: #fafafa;
    border-bottom: 1px solid #f1f5f9;
    gap: 0.8rem;
}
.apc-section-header:hover { background: #f1f5f9; }
.apc-section-header-left { display: flex; align-items: center; gap: 0.75rem; }
.apc-section-icon {
    width: 34px; height: 34px;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem;
    color: white;
    flex-shrink: 0;
}
.apc-section-title { font-size: 0.95rem; font-weight: 700; color: #1e293b; margin: 0; }
.apc-section-subtitle { font-size: 0.75rem; color: #94a3b8; margin: 0; margin-top: 1px; }
.apc-chevron { font-size: 0.75rem; color: #94a3b8; transition: transform 0.2s; flex-shrink: 0; }
.apc-section-header.open .apc-chevron { transform: rotate(180deg); }
.apc-section-body { padding: 1.5rem; display: block; }
.apc-section-body.collapsed { display: none; }

/* ── Form groups ── */
.apc-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.9rem; margin-bottom: 0.9rem; }
.apc-field { display: flex; flex-direction: column; gap: 0.35rem; }
.apc-label { font-size: 0.78rem; font-weight: 600; color: #64748b; letter-spacing: 0.3px; }
.apc-label span.required { color: #ef4444; margin-left: 2px; }
.apc-hint { font-size: 0.72rem; color: #94a3b8; margin-top: 0.15rem; }
.apc-input, .apc-textarea, .apc-select {
    width: 100%;
    padding: 0.55rem 0.85rem;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    font-family: inherit;
    font-size: 0.9rem;
    color: #1e293b;
    box-sizing: border-box;
    background: white;
    transition: border-color 0.15s, box-shadow 0.15s;
}
.apc-input:focus, .apc-textarea:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,0.08); }
.apc-textarea { resize: vertical; min-height: 80px; line-height: 1.6; }
.apc-file { font-size: 0.82rem; color: #475569; }

/* ── Image preview ── */
.apc-img-preview {
    width: 100%; height: 90px;
    border-radius: 8px;
    object-fit: cover;
    border: 1px solid #e2e8f0;
    margin-bottom: 0.5rem;
}

/* ── Sub-section divider ── */
.apc-subsection-title {
    font-size: 0.75rem;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0.5rem 0;
    margin: 1rem 0 0.75rem;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

/* ── Repeater ── */
.apc-repeater { display: flex; flex-direction: column; gap: 0.65rem; }
.apc-rep-row {
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    padding: 1rem;
    background: #fafafa;
    position: relative;
    transition: border-color 0.15s;
}
.apc-rep-row:hover { border-color: #cbd5e1; background: #f8fafc; }
.apc-rep-num {
    position: absolute;
    top: 0.6rem;
    left: 0.75rem;
    font-size: 0.65rem;
    font-weight: 800;
    color: white;
    background: #94a3b8;
    width: 18px; height: 18px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
}
.apc-rep-row-content { padding-left: 1.5rem; }
.apc-remove-btn {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    width: 26px; height: 26px;
    background: #fee2e2;
    color: #dc2626;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.7rem;
    display: flex; align-items: center; justify-content: center;
    transition: background 0.15s;
}
.apc-remove-btn:hover { background: #fecaca; }
.apc-add-btn {
    width: 100%;
    padding: 0.6rem;
    border: 1.5px dashed #cbd5e1;
    background: white;
    color: #64748b;
    border-radius: 8px;
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s;
    display: flex; align-items: center; justify-content: center; gap: 0.4rem;
    margin-top: 0.5rem;
}
.apc-add-btn:hover { background: #f0f9ff; border-color: #0284c7; color: #0284c7; }

/* ── Save bar ── */
.apc-save-bar {
    position: sticky;
    bottom: 1rem;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 0.9rem 1.25rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 8px 25px -5px rgba(0,0,0,0.1);
    margin-top: 1.25rem;
    z-index: 10;
}
.apc-save-btn {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: white;
    border: none;
    padding: 0.65rem 2rem;
    border-radius: 9px;
    font-size: 0.9rem;
    font-weight: 700;
    cursor: pointer;
    display: flex; align-items: center; gap: 0.5rem;
    box-shadow: 0 4px 12px rgba(99,102,241,0.35);
    transition: all 0.2s;
}
.apc-save-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(99,102,241,0.45); }
</style>

{{-- Top bar --}}
<div style="background: #0f172a; padding: 0.8rem 1.25rem; border-radius: 12px; margin-bottom: 1.25rem; margin-left: calc(190px + 1.5rem); display: flex; align-items: center; justify-content: space-between;">
    <div style="display: flex; align-items: center; gap: 0.7rem;">
        <div style="width: 8px; height: 8px; background: #22c55e; border-radius: 50%;"></div>
        <span style="color: #94a3b8; font-size: 0.85rem;">Editing: <strong style="color: white;">About Page</strong></span>
    </div>
    <a href="{{ route('about') }}" target="_blank" style="background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.4rem 1rem; border-radius: 8px; font-size: 0.82rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.1); display: inline-flex; align-items: center; gap: 0.4rem; transition: background 0.15s;" onmouseover="this.style.background='rgba(255,255,255,0.14)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
        <i class="fa-solid fa-up-right-from-square" style="font-size: 0.75rem;"></i> Preview Page
    </a>
</div>

<form method="POST" action="{{ route('admin.page-content.update', 'about') }}" enctype="multipart/form-data">
@csrf

<div class="apc-shell">

    {{-- ══ SIDE NAV ══ --}}
    <nav class="apc-sidenav">
        <div class="apc-sidenav-head">Sections</div>
        @foreach($navSections as $id => $nav)
        <a href="#{{ $id }}" onclick="openSection('{{ $id }}')">
            <span class="apc-sidenav-icon" style="background: {{ $nav['color'] }}22; color: {{ $nav['color'] }};"><i class="fa-solid {{ $nav['icon'] }}"></i></span>
            {{ $nav['label'] }}
        </a>
        @endforeach
    
<div style="padding: 1rem; margin-top: auto; position: sticky; bottom: 0; background: white; border-top: 1px solid #e2e8f0; z-index: 10;">
            <button type="submit" class="apc-save-btn" style="width: 100%; justify-content: center;">
                <i class="fa-solid fa-save"></i> Save Content
            </button>
        </div>
    </nav>

    {{-- ══ MAIN CONTENT ══ --}}
    <div class="apc-main">

        {{-- ── HERO ── --}}
        <div class="apc-section" id="sec-hero">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #6366f1;"><i class="fa-solid fa-image"></i></div>
                    <div>
                        <p class="apc-section-title">Hero Section</p>
                        <p class="apc-section-subtitle">Banner, title, subtitle & background image</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Badge Text</label>
                        <input class="apc-input" type="text" name="about_hero_badge" value="{{ $s('about_hero_badge', 'About Us') }}" placeholder="About Us">
                        <span class="apc-hint">Small label above the heading</span>
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Hero Title</label>
                        <input class="apc-input" type="text" name="about_hero_title" value="{{ $s('about_hero_title', 'Excellence in Computing Education') }}" placeholder="Excellence in Computing Education">
                    </div>
                </div>
                <div class="apc-field" style="margin-bottom: 0.9rem;">
                    <label class="apc-label">Hero Subtitle</label>
                    <textarea class="apc-textarea" name="about_hero_subtitle" rows="2" placeholder="Shaping the future through technology...">{{ $s('about_hero_subtitle', 'Shaping the future through technology, research and innovation.') }}</textarea>
                </div>
                <div class="apc-field">
                    <label class="apc-label">Background Image</label>
                    @if($s('hero_about'))
                    <img src="{{ asset('storage/'.$s('hero_about')) }}" class="apc-img-preview" alt="Current hero">
                    @endif
                    <input class="apc-file" type="file" name="hero_about" accept="image/jpeg,image/png,image/webp">
                    <span class="apc-hint">JPEG, PNG or WebP — recommended 1920×600px</span>
                </div>
            </div>
        </div>

        {{-- ── INTRODUCTION ── --}}
        <div class="apc-section" id="sec-intro">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #0ea5e9;"><i class="fa-solid fa-align-left"></i></div>
                    <div>
                        <p class="apc-section-title">Introduction / Overview</p>
                        <p class="apc-section-subtitle">Department story text & history context</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body">
                <div class="apc-row" style="margin-bottom: 0.9rem;">
                    <div class="apc-field">
                        <label class="apc-label">Section Heading</label>
                        <input class="apc-input" type="text" name="about_section_story_title" value="{{ $s('about_section_story_title', 'Our Story') }}" placeholder="Our Story">
                        <span class="apc-hint">Section h2 heading shown on the public page</span>
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Intro Title</label>
                        <input class="apc-input" type="text" name="about_intro_title" value="{{ $s('about_intro_title', 'About the Department') }}" placeholder="About the Department">
                    </div>
                </div>
                <div class="apc-field" style="margin-bottom: 0.9rem;">
                    <label class="apc-label">Main Body Text</label>
                    <textarea class="apc-textarea" name="about_intro_body" rows="7" placeholder="Write the department's story here...">{{ $s('about_intro_body') }}</textarea>
                    <span class="apc-hint">Leave blank to use the default hardcoded text on the public page</span>
                </div>
                <div class="apc-field">
                    <label class="apc-label">History / Additional Context <span style="color:#94a3b8; font-weight:400;">(optional)</span></label>
                    <textarea class="apc-textarea" name="about_history" rows="4" placeholder="Extra historical background...">{{ $s('about_history') }}</textarea>
                    <span class="apc-hint">Shown as a highlighted block below the main story text if filled in</span>
                </div>
            </div>
        </div>

        {{-- ── MISSION & VISION ── --}}
        <div class="apc-section" id="sec-mv">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #10b981;"><i class="fa-solid fa-bullseye"></i></div>
                    <div>
                        <p class="apc-section-title">Mission & Vision</p>
                        <p class="apc-section-subtitle">Two editorial statements for the department</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body">
                <div class="apc-row" style="margin-bottom: 1rem;">
                    <div class="apc-field">
                        <label class="apc-label">Section Heading</label>
                        <input class="apc-input" type="text" name="about_section_vm_title" value="{{ $s('about_section_vm_title', 'Vision, Mission & Objectives') }}" placeholder="Vision, Mission & Objectives">
                    </div>
                </div>
                <div class="apc-subsection-title"><i class="fa-solid fa-eye"></i> Vision & Mission Card Labels</div>
                <div class="apc-row" style="margin-bottom: 1rem;">
                    <div class="apc-field">
                        <label class="apc-label">Vision Card Label</label>
                        <input class="apc-input" type="text" name="about_vision_label" value="{{ $s('about_vision_label', 'Our Vision') }}" placeholder="Our Vision">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Mission Card Label</label>
                        <input class="apc-input" type="text" name="about_mission_label" value="{{ $s('about_mission_label', 'Our Mission') }}" placeholder="Our Mission">
                    </div>
                </div>
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label"><i class="fa-solid fa-eye" style="color:#10b981; margin-right:4px;"></i> Vision Statement</label>
                        <textarea class="apc-textarea" name="about_vision" rows="5" placeholder="To be a leading edge in computing...">{{ $s('about_vision', $s('vision_statement')) }}</textarea>
                    </div>
                    <div class="apc-field">
                        <label class="apc-label"><i class="fa-solid fa-bullseye" style="color:#10b981; margin-right:4px;"></i> Mission Statement</label>
                        <textarea class="apc-textarea" name="about_mission" rows="5" placeholder="To promote technological advancement...">{{ $s('about_mission', $s('mission_statement')) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── OBJECTIVES ── --}}
        <div class="apc-section" id="sec-objectives">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #f59e0b;"><i class="fa-solid fa-list-check"></i></div>
                    <div>
                        <p class="apc-section-title">Department Objectives</p>
                        <p class="apc-section-subtitle">Grid of goal cards (icon + title + description)</p>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:0.6rem;">
                    <span style="background:#fef3c7; color:#92400e; font-size:0.7rem; font-weight:700; padding:0.2rem 0.6rem; border-radius:20px;">{{ count($objectives) }} items</span>
                    <i class="fa-solid fa-chevron-down apc-chevron"></i>
                </div>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row" style="margin-bottom: 1rem;">
                    <div class="apc-field">
                        <label class="apc-label">Objectives Box Title</label>
                        <input class="apc-input" type="text" name="about_objectives_title" value="{{ $s('about_objectives_title', 'Our Objectives') }}" placeholder="Our Objectives">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Objectives Box Sub-heading</label>
                        <input class="apc-input" type="text" name="about_objectives_subtitle" value="{{ $s('about_objectives_subtitle', 'What we strive to achieve') }}" placeholder="What we strive to achieve">
                    </div>
                </div>
                <div class="apc-repeater" id="objectivesRepeater">
                    @foreach($objectives as $i => $obj)
                    <div class="apc-rep-row">
                        <span class="apc-rep-num">{{ $i+1 }}</span>
                        <button type="button" class="apc-remove-btn" onclick="this.closest('.apc-rep-row').remove()" title="Remove"><i class="fa-solid fa-xmark"></i></button>
                        <div class="apc-rep-row-content">
                            <div class="apc-row">
                                <div class="apc-field"><label class="apc-label">Icon <span style="color:#94a3b8;">(FA class)</span></label><input class="apc-input" type="text" name="about_objectives[{{ $i }}][icon]" value="{{ $obj['icon'] ?? '' }}" placeholder="fa-flask"></div>
                                <div class="apc-field"><label class="apc-label">Title</label><input class="apc-input" type="text" name="about_objectives[{{ $i }}][title]" value="{{ $obj['title'] ?? '' }}"></div>
                            </div>
                            <div class="apc-field"><label class="apc-label">Description</label><textarea class="apc-textarea" name="about_objectives[{{ $i }}][text]" rows="2">{{ $obj['text'] ?? '' }}</textarea></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="apc-add-btn" onclick="addObjective()"><i class="fa-solid fa-plus"></i> Add Objective</button>
            </div>
        </div>

        {{-- ── CORE VALUES ── --}}
        <div class="apc-section" id="sec-values">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #ec4899;"><i class="fa-solid fa-star"></i></div>
                    <div>
                        <p class="apc-section-title">Core Values</p>
                        <p class="apc-section-subtitle">Value cards displayed in a grid</p>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:0.6rem;">
                    <span style="background:#fce7f3; color:#9d174d; font-size:0.7rem; font-weight:700; padding:0.2rem 0.6rem; border-radius:20px;">{{ count($coreValues) }} items</span>
                    <i class="fa-solid fa-chevron-down apc-chevron"></i>
                </div>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-field" style="margin-bottom: 1rem;">
                    <label class="apc-label">Section Heading</label>
                    <input class="apc-input" type="text" name="about_section_values_title" value="{{ $s('about_section_values_title', 'Core Values') }}" placeholder="Core Values">
                </div>
                <div class="apc-repeater" id="coreValuesRepeater">
                    @foreach($coreValues as $i => $cv)
                    <div class="apc-rep-row">
                        <span class="apc-rep-num">{{ $i+1 }}</span>
                        <button type="button" class="apc-remove-btn" onclick="this.closest('.apc-rep-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                        <div class="apc-rep-row-content">
                            <div class="apc-row">
                                <div class="apc-field"><label class="apc-label">Icon <span style="color:#94a3b8;">(FA class)</span></label><input class="apc-input" type="text" name="about_core_values[{{ $i }}][icon]" value="{{ $cv['icon'] ?? '' }}" placeholder="fa-star"></div>
                                <div class="apc-field"><label class="apc-label">Title</label><input class="apc-input" type="text" name="about_core_values[{{ $i }}][title]" value="{{ $cv['title'] ?? '' }}"></div>
                            </div>
                            <div class="apc-field"><label class="apc-label">Description</label><textarea class="apc-textarea" name="about_core_values[{{ $i }}][description]" rows="2">{{ $cv['description'] ?? '' }}</textarea></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="apc-add-btn" onclick="addCoreValue()"><i class="fa-solid fa-plus"></i> Add Core Value</button>
            </div>
        </div>

        {{-- ── HISTORY & MILESTONES ── --}}
        <div class="apc-section" id="sec-history">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #8b5cf6;"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    <div>
                        <p class="apc-section-title">History & Timeline Milestones</p>
                        <p class="apc-section-subtitle">Historical context + stat cards (year/metric + label)</p>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:0.6rem;">
                    <span style="background:#ede9fe; color:#5b21b6; font-size:0.7rem; font-weight:700; padding:0.2rem 0.6rem; border-radius:20px;">{{ count($milestones) }} milestones</span>
                    <i class="fa-solid fa-chevron-down apc-chevron"></i>
                </div>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-field" style="margin-bottom: 1.25rem;">
                    <label class="apc-label">History Text <span style="color:#94a3b8; font-weight:400;">(optional)</span></label>
                    <textarea class="apc-textarea" name="about_history" rows="4" placeholder="Add supplemental history or context...">{{ $s('about_history') }}</textarea>
                </div>
                <div class="apc-subsection-title"><i class="fa-solid fa-timeline"></i> Timeline Milestone Cards</div>
                <div class="apc-repeater" id="milestonesRepeater">
                    @foreach($milestones as $i => $ms)
                    <div class="apc-rep-row">
                        <span class="apc-rep-num">{{ $i+1 }}</span>
                        <button type="button" class="apc-remove-btn" onclick="this.closest('.apc-rep-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                        <div class="apc-rep-row-content">
                            <div class="apc-row">
                                <div class="apc-field"><label class="apc-label">Year / Metric</label><input class="apc-input" type="text" name="about_milestones[{{ $i }}][year]" value="{{ $ms['year'] ?? '' }}" placeholder="2003 or 11+"></div>
                                <div class="apc-field"><label class="apc-label">Label / Description</label><input class="apc-input" type="text" name="about_milestones[{{ $i }}][title]" value="{{ $ms['title'] ?? '' }}" placeholder="Established as a Unit"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="apc-add-btn" onclick="addMilestone()"><i class="fa-solid fa-plus"></i> Add Milestone</button>
            </div>
        </div>

        {{-- ── ACADEMIC PROGRAMMES ── --}}
        <div class="apc-section" id="sec-programmes">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #06b6d4;"><i class="fa-solid fa-graduation-cap"></i></div>
                    <div>
                        <p class="apc-section-title">Academic Programmes</p>
                        <p class="apc-section-subtitle">Programme category cards with degree lists</p>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:0.6rem;">
                    <span style="background:#cffafe; color:#155e75; font-size:0.7rem; font-weight:700; padding:0.2rem 0.6rem; border-radius:20px;">{{ count($programmes) }} categories</span>
                    <i class="fa-solid fa-chevron-down apc-chevron"></i>
                </div>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row" style="margin-bottom: 1rem;">
                    <div class="apc-field">
                        <label class="apc-label">Section Heading</label>
                        <input class="apc-input" type="text" name="about_section_programmes_title" value="{{ $s('about_section_programmes_title', 'Academic Programmes') }}" placeholder="Academic Programmes">
                    </div>
                </div>
                <div class="apc-field" style="margin-bottom: 1.25rem;">
                    <label class="apc-label">Section Description</label>
                    <textarea class="apc-textarea" name="about_programmes_desc" rows="3">{{ $s('about_programmes_desc', "The department offers Bachelor's, Post-graduate Diploma, Master's, and PhD degrees.") }}</textarea>
                </div>
                <div class="apc-subsection-title"><i class="fa-solid fa-layer-group"></i> Programme Category Cards</div>
                <div class="apc-repeater" id="progRepeater">
                    @foreach($programmes as $i => $prog)
                    <div class="apc-rep-row">
                        <span class="apc-rep-num">{{ $i+1 }}</span>
                        <button type="button" class="apc-remove-btn" onclick="this.closest('.apc-rep-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                        <div class="apc-rep-row-content">
                            <div class="apc-row">
                                <div class="apc-field"><label class="apc-label">Category Name</label><input class="apc-input" type="text" name="about_programmes[{{ $i }}][title]" value="{{ $prog['title'] ?? '' }}" placeholder="Postgraduate"></div>
                                <div class="apc-field"><label class="apc-label">Icon (FA)</label><input class="apc-input" type="text" name="about_programmes[{{ $i }}][icon]" value="{{ $prog['icon'] ?? 'fa-hat-wizard' }}"></div>
                            </div>
                            <div class="apc-row">
                                <div class="apc-field"><label class="apc-label">Card Background Color</label><input class="apc-input" type="text" name="about_programmes[{{ $i }}][theme_main]" value="{{ $prog['theme_main'] ?? '#0f172a' }}" placeholder="#0f172a"></div>
                                <div class="apc-field"><label class="apc-label">Card Accent Color</label><input class="apc-input" type="text" name="about_programmes[{{ $i }}][theme_accent]" value="{{ $prog['theme_accent'] ?? '#1e293b' }}" placeholder="#1e293b"></div>
                            </div>
                            <div class="apc-field">
                                <label class="apc-label">Degrees / Programmes <span class="apc-hint" style="margin:0;">(one per line)</span></label>
                                <textarea class="apc-textarea" name="about_programmes[{{ $i }}][items]" rows="5" placeholder="Ph.D. Computer Science&#10;M.Sc. Computer Science">{{ $prog['items'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="apc-add-btn" onclick="addProg()"><i class="fa-solid fa-plus"></i> Add Programme Category</button>
            </div>
        </div>

        {{-- ── DEPARTMENTAL BOARD ── --}}
        <div class="apc-section" id="sec-board">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #64748b;"><i class="fa-solid fa-users-viewfinder"></i></div>
                    <div>
                        <p class="apc-section-title">Departmental Board</p>
                        <p class="apc-section-subtitle">Board structure cards (Chairman, Members, Mandate)</p>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:0.6rem;">
                    <span style="background:#f1f5f9; color:#475569; font-size:0.7rem; font-weight:700; padding:0.2rem 0.6rem; border-radius:20px;">{{ count($boardMembers) }} cards</span>
                    <i class="fa-solid fa-chevron-down apc-chevron"></i>
                </div>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-field" style="margin-bottom: 1rem;">
                    <label class="apc-label">Section Heading</label>
                    <input class="apc-input" type="text" name="about_section_board_title" value="{{ $s('about_section_board_title', 'Departmental Board') }}" placeholder="Departmental Board">
                </div>
                <div class="apc-field" style="margin-bottom: 1.25rem;">
                    <textarea class="apc-textarea" name="about_board_desc" rows="3">{{ $s('about_board_desc', 'The Departmental Board is made up of all lecturers in the Department...') }}</textarea>
                </div>
                <div class="apc-subsection-title"><i class="fa-solid fa-id-card"></i> Board Cards</div>
                <div class="apc-repeater" id="boardRepeater">
                    @foreach($boardMembers as $i => $bm)
                    <div class="apc-rep-row">
                        <span class="apc-rep-num">{{ $i+1 }}</span>
                        <button type="button" class="apc-remove-btn" onclick="this.closest('.apc-rep-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                        <div class="apc-rep-row-content">
                            <div class="apc-row">
                                <div class="apc-field"><label class="apc-label">Title / Group Name</label><input class="apc-input" type="text" name="about_board[{{ $i }}][title]" value="{{ $bm['title'] ?? '' }}" placeholder="Chairman"></div>
                                <div class="apc-field"><label class="apc-label">Icon (FA)</label><input class="apc-input" type="text" name="about_board[{{ $i }}][icon]" value="{{ $bm['icon'] ?? 'fa-crown' }}"></div>
                            </div>
                            <div class="apc-field"><label class="apc-label">Details / Who</label><textarea class="apc-textarea" name="about_board[{{ $i }}][who]" rows="2">{{ $bm['who'] ?? '' }}</textarea></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="apc-add-btn" onclick="addBoard()"><i class="fa-solid fa-plus"></i> Add Board Card</button>
            </div>
        </div>

        {{-- ── ENTRY REQUIREMENTS ── --}}
        <div class="apc-section" id="sec-requirements">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #f97316;"><i class="fa-solid fa-clipboard-list"></i></div>
                    <div>
                        <p class="apc-section-title">Entry Requirements</p>
                        <p class="apc-section-subtitle">Admission requirement cards per level</p>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:0.6rem;">
                    <span style="background:#fff7ed; color:#9a3412; font-size:0.7rem; font-weight:700; padding:0.2rem 0.6rem; border-radius:20px;">{{ count($requirements) }} levels</span>
                    <i class="fa-solid fa-chevron-down apc-chevron"></i>
                </div>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row" style="margin-bottom: 1rem;">
                    <div class="apc-field">
                        <label class="apc-label">Section Heading</label>
                        <input class="apc-input" type="text" name="about_section_requirements_title" value="{{ $s('about_section_requirements_title', 'Entry Requirements') }}" placeholder="Entry Requirements">
                    </div>
                </div>
                <div class="apc-repeater" id="reqRepeater">
                    @foreach($requirements as $i => $req)
                    <div class="apc-rep-row">
                        <span class="apc-rep-num">{{ $i+1 }}</span>
                        <button type="button" class="apc-remove-btn" onclick="this.closest('.apc-rep-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                        <div class="apc-rep-row-content">
                            <div class="apc-row">
                                <div class="apc-field"><label class="apc-label">Level</label><input class="apc-input" type="text" name="about_requirements[{{ $i }}][level]" value="{{ $req['level'] ?? '' }}" placeholder="O' Level"></div>
                                <div class="apc-field"><label class="apc-label">Icon (FA)</label><input class="apc-input" type="text" name="about_requirements[{{ $i }}][icon]" value="{{ $req['icon'] ?? 'fa-school' }}"></div>
                            </div>
                            <div class="apc-field"><label class="apc-label">Requirement Description</label><textarea class="apc-textarea" name="about_requirements[{{ $i }}][desc]" rows="2">{{ $req['desc'] ?? '' }}</textarea></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="apc-add-btn" onclick="addReq()"><i class="fa-solid fa-plus"></i> Add Entry Requirement</button>
                <div class="apc-row" style="margin-top: 1rem;">
                    <div class="apc-field">
                        <label class="apc-label">CTA Button Text</label>
                        <input class="apc-input" type="text" name="about_req_btn_text" value="{{ $s('about_req_btn_text', 'See Full Admission Details') }}" placeholder="See Full Admission Details">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">CTA Button URL</label>
                        <input class="apc-input" type="text" name="about_req_btn_url" value="{{ $s('about_req_btn_url', '/academics') }}" placeholder="/academics">
                    </div>
                </div>
            </div>
        </div>
        <div class="apc-section" id="sec-facilities">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #14b8a6;"><i class="fa-solid fa-building"></i></div>
                    <div>
                        <p class="apc-section-title">Facilities & Labs</p>
                        <p class="apc-section-subtitle">Lab/facility cards shown on the About page</p>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:0.6rem;">
                    <span style="background:#f0fdfa; color:#134e4a; font-size:0.7rem; font-weight:700; padding:0.2rem 0.6rem; border-radius:20px;">{{ count($facilities) }} labs</span>
                    <i class="fa-solid fa-chevron-down apc-chevron"></i>
                </div>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-field" style="margin-bottom: 1rem;">
                    <label class="apc-label">Section Heading</label>
                    <input class="apc-input" type="text" name="about_section_facilities_title" value="{{ $s('about_section_facilities_title', 'Facilities & Labs') }}" placeholder="Facilities & Labs">
                </div>
                <div class="apc-field" style="margin-bottom: 1.25rem;">
                    <label class="apc-label">Section Description</label>
                    <textarea class="apc-textarea" name="about_facilities_desc" rows="3">{{ $s('about_facilities_desc', 'Our department boasts state-of-the-art laboratories to support practical learning and research across various IT domains.') }}</textarea>
                </div>
                <div class="apc-subsection-title"><i class="fa-solid fa-flask"></i> Lab / Facility Cards</div>
                <div class="apc-repeater" id="facilitiesRepeater">
                    @foreach($facilities as $i => $f)
                    <div class="apc-rep-row">
                        <span class="apc-rep-num">{{ $i+1 }}</span>
                        <button type="button" class="apc-remove-btn" onclick="this.closest('.apc-rep-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                        <div class="apc-rep-row-content">
                            <div class="apc-row">
                                <div class="apc-field"><label class="apc-label">Icon (FA)</label><input class="apc-input" type="text" name="about_facilities[{{ $i }}][icon]" value="{{ $f['icon'] ?? '' }}" placeholder="fa-desktop"></div>
                                <div class="apc-field"><label class="apc-label">Lab / Facility Name</label><input class="apc-input" type="text" name="about_facilities[{{ $i }}][name]" value="{{ $f['name'] ?? '' }}"></div>
                            </div>
                            <div class="apc-field"><label class="apc-label">Description</label><textarea class="apc-textarea" name="about_facilities[{{ $i }}][description]" rows="2">{{ $f['description'] ?? '' }}</textarea></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="apc-add-btn" onclick="addFacility()"><i class="fa-solid fa-plus"></i> Add Facility</button>
            </div>
        </div>

        {{-- ── OUR FACULTY CTA ── --}}
        <div class="apc-section" id="sec-faculty">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #ef4444;"><i class="fa-solid fa-chalkboard-user"></i></div>
                    <div>
                        <p class="apc-section-title">Faculty CTA Banner</p>
                        <p class="apc-section-subtitle">Call-to-action text for the "Meet Our Faculty" section</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Badge Text</label>
                        <input class="apc-input" type="text" name="about_faculty_badge" value="{{ $s('about_faculty_badge', '27+ Academic Staff') }}" placeholder="27+ Academic Staff">
                        <span class="apc-hint">Small label shown above the section heading</span>
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Section Title</label>
                        <input class="apc-input" type="text" name="about_faculty_title" value="{{ $s('about_faculty_title', 'Meet Our Faculty') }}" placeholder="Meet Our Faculty">
                    </div>
                </div>
                <div class="apc-field" style="margin-bottom: 0.9rem;">
                    <label class="apc-label">Faculty Description (HTML allowed)</label>
                    <textarea class="apc-textarea" name="about_faculty_desc" rows="5" placeholder="Our department is home to <strong>3 Professors</strong>...">{{ $s('about_faculty_desc', 'Our department is home to <strong>3 Professors</strong>, <strong>3 Associate Professors</strong>, and a team of dedicated academics with expertise spanning AI, cybersecurity, data science, networking, and software engineering.') }}</textarea>
                    <span class="apc-hint">You may use HTML bold tags like &lt;strong&gt;. This appears in the green CTA banner at the bottom of the About page.</span>
                </div>
                <div class="apc-subsection-title"><i class="fa-solid fa-arrow-pointer"></i> CTA Buttons</div>
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Button 1 Text</label>
                        <input class="apc-input" type="text" name="about_faculty_btn1_text" value="{{ $s('about_faculty_btn1_text', 'View Staff Directory') }}" placeholder="View Staff Directory">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Button 1 URL</label>
                        <input class="apc-input" type="text" name="about_faculty_btn1_url" value="{{ $s('about_faculty_btn1_url', '/people') }}" placeholder="/people">
                    </div>
                </div>
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Button 2 Text</label>
                        <input class="apc-input" type="text" name="about_faculty_btn2_text" value="{{ $s('about_faculty_btn2_text', 'Contact Us') }}" placeholder="Contact Us">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Button 2 URL</label>
                        <input class="apc-input" type="text" name="about_faculty_btn2_url" value="{{ $s('about_faculty_btn2_url', '/contact') }}" placeholder="/contact">
                    </div>
                </div>
                <div class="apc-subsection-title"><i class="fa-solid fa-user-tie"></i> Faculty Spotlight / Highlights</div>
                <div class="apc-repeater" id="facRepeater">
                    @foreach($faculty as $i => $fac)
                    <div class="apc-rep-row">
                        <span class="apc-rep-num">{{ $i+1 }}</span>
                        <button type="button" class="apc-remove-btn" onclick="this.closest('.apc-rep-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                        <div class="apc-rep-row-content">
                            <div class="apc-row">
                                <div class="apc-field"><label class="apc-label">Name</label><input class="apc-input" type="text" name="about_faculty[{{ $i }}][name]" value="{{ $fac['name'] ?? '' }}" placeholder="Dr. John Doe"></div>
                                <div class="apc-field"><label class="apc-label">Title / Rank</label><input class="apc-input" type="text" name="about_faculty[{{ $i }}][title]" value="{{ $fac['title'] ?? '' }}" placeholder="Professor"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="apc-add-btn" onclick="addFac()"><i class="fa-solid fa-plus"></i> Add Faculty Member</button>
            </div>
        </div>

        

    </div>{{-- end .apc-main --}}
</div>{{-- end .apc-shell --}}
</form>

<script>
function toggleSection(header) {
    header.classList.toggle('open');
    header.nextElementSibling.classList.toggle('collapsed');
}

function openSection(id) {
    const sec = document.getElementById(id);
    if (!sec) return;

    // Open if collapsed
    const header = sec.querySelector('.apc-section-header');
    const body   = sec.querySelector('.apc-section-body');
    if (body && body.classList.contains('collapsed')) {
        header.classList.add('open');
        body.classList.remove('collapsed');
    }

    // Scroll to section with offset for sticky header
    const offset = 90;
    const top = sec.getBoundingClientRect().top + window.pageYOffset - offset;
    window.scrollTo({ top, behavior: 'smooth' });

    // Update active link immediately
    document.querySelectorAll('.apc-sidenav a').forEach(l => l.classList.remove('active'));
    const match = document.querySelector(`.apc-sidenav a[href="#${id}"]`);
    if (match) match.classList.add('active');
}

// ── Repeater add functions ──
let msIdx  = {{ count($milestones) }};
let objIdx = {{ count($objectives) }};
let cvIdx  = {{ count($coreValues) }};
let facIdx = {{ count($facilities) }};
let progIdx= {{ count($programmes) }};
let boardIdx={{ count($boardMembers) }};
let reqIdx = {{ count($requirements) }};
let fpIdx  = {{ count($faculty) }};

function rowHtml(num, inner) {
    return `<div class="apc-rep-row">
        <span class="apc-rep-num">${num}</span>
        <button type="button" class="apc-remove-btn" onclick="this.closest('.apc-rep-row').remove()"><i class="fa-solid fa-xmark"></i></button>
        <div class="apc-rep-row-content">${inner}</div>
    </div>`;
}

function addMilestone() {
    const r = document.getElementById('milestonesRepeater');
    msIdx++;
    r.insertAdjacentHTML('beforeend', rowHtml(msIdx, `
        <div class="apc-row">
            <div class="apc-field"><label class="apc-label">Year / Metric</label><input class="apc-input" type="text" name="about_milestones[${msIdx}][year]" placeholder="2003 or 11+"></div>
            <div class="apc-field"><label class="apc-label">Label</label><input class="apc-input" type="text" name="about_milestones[${msIdx}][title]" placeholder="Established as a Unit"></div>
        </div>`));
}

function addObjective() {
    const r = document.getElementById('objectivesRepeater');
    objIdx++;
    r.insertAdjacentHTML('beforeend', rowHtml(objIdx, `
        <div class="apc-row">
            <div class="apc-field"><label class="apc-label">Icon (FA)</label><input class="apc-input" type="text" name="about_objectives[${objIdx}][icon]" placeholder="fa-flask"></div>
            <div class="apc-field"><label class="apc-label">Title</label><input class="apc-input" type="text" name="about_objectives[${objIdx}][title]"></div>
        </div>
        <div class="apc-field"><label class="apc-label">Description</label><textarea class="apc-textarea" name="about_objectives[${objIdx}][text]" rows="2"></textarea></div>`));
}

function addCoreValue() {
    const r = document.getElementById('coreValuesRepeater');
    cvIdx++;
    r.insertAdjacentHTML('beforeend', rowHtml(cvIdx, `
        <div class="apc-row">
            <div class="apc-field"><label class="apc-label">Icon (FA)</label><input class="apc-input" type="text" name="about_core_values[${cvIdx}][icon]" placeholder="fa-star"></div>
            <div class="apc-field"><label class="apc-label">Title</label><input class="apc-input" type="text" name="about_core_values[${cvIdx}][title]"></div>
        </div>
        <div class="apc-field"><label class="apc-label">Description</label><textarea class="apc-textarea" name="about_core_values[${cvIdx}][description]" rows="2"></textarea></div>`));
}

function addFacility() {
    const r = document.getElementById('facilitiesRepeater');
    facIdx++;
    r.insertAdjacentHTML('beforeend', rowHtml(facIdx, `
        <div class="apc-row">
            <div class="apc-field"><label class="apc-label">Icon (FA)</label><input class="apc-input" type="text" name="about_facilities[${facIdx}][icon]" placeholder="fa-desktop"></div>
            <div class="apc-field"><label class="apc-label">Name</label><input class="apc-input" type="text" name="about_facilities[${facIdx}][name]"></div>
        </div>
        <div class="apc-field"><label class="apc-label">Description</label><textarea class="apc-textarea" name="about_facilities[${facIdx}][description]" rows="2"></textarea></div>`));
}

function addProg() {
    const r = document.getElementById('progRepeater');
    progIdx++;
    r.insertAdjacentHTML('beforeend', rowHtml(progIdx, `
        <div class="apc-row">
            <div class="apc-field"><label class="apc-label">Category Name</label><input class="apc-input" type="text" name="about_programmes[${progIdx}][title]" placeholder="Postgraduate"></div>
            <div class="apc-field"><label class="apc-label">Icon (FA)</label><input class="apc-input" type="text" name="about_programmes[${progIdx}][icon]" value="fa-hat-wizard"></div>
        </div>
        <div class="apc-row">
            <div class="apc-field"><label class="apc-label">Background Color</label><input class="apc-input" type="text" name="about_programmes[${progIdx}][theme_main]" value="#0f172a" placeholder="#0f172a"></div>
            <div class="apc-field"><label class="apc-label">Accent Color</label><input class="apc-input" type="text" name="about_programmes[${progIdx}][theme_accent]" value="#1e293b" placeholder="#1e293b"></div>
        </div>
        <div class="apc-field"><label class="apc-label">Degrees (one per line)</label><textarea class="apc-textarea" name="about_programmes[${progIdx}][items]" rows="5"></textarea></div>`));
}

function addBoard() {
    const r = document.getElementById('boardRepeater');
    boardIdx++;
    r.insertAdjacentHTML('beforeend', rowHtml(boardIdx, `
        <div class="apc-row">
            <div class="apc-field"><label class="apc-label">Title</label><input class="apc-input" type="text" name="about_board[${boardIdx}][title]" placeholder="Chairman"></div>
            <div class="apc-field"><label class="apc-label">Icon (FA)</label><input class="apc-input" type="text" name="about_board[${boardIdx}][icon]" value="fa-crown"></div>
        </div>
        <div class="apc-field"><label class="apc-label">Details</label><textarea class="apc-textarea" name="about_board[${boardIdx}][who]" rows="2"></textarea></div>`));
}

function addReq() {
    const r = document.getElementById('reqRepeater');
    reqIdx++;
    r.insertAdjacentHTML('beforeend', rowHtml(reqIdx, `
        <div class="apc-row">
            <div class="apc-field"><label class="apc-label">Level</label><input class="apc-input" type="text" name="about_requirements[${reqIdx}][level]" placeholder="O' Level"></div>
            <div class="apc-field"><label class="apc-label">Icon (FA)</label><input class="apc-input" type="text" name="about_requirements[${reqIdx}][icon]" value="fa-school"></div>
        </div>
        <div class="apc-field"><label class="apc-label">Description</label><textarea class="apc-textarea" name="about_requirements[${reqIdx}][desc]" rows="2"></textarea></div>`));
}

function addFac() {
    const r = document.getElementById('facRepeater');
    fpIdx++;
    r.insertAdjacentHTML('beforeend', rowHtml(fpIdx, `
        <div class="apc-row">
            <div class="apc-field"><label class="apc-label">Name</label><input class="apc-input" type="text" name="about_faculty[${fpIdx}][name]" placeholder="Dr. John Doe"></div>
            <div class="apc-field"><label class="apc-label">Title / Rank</label><input class="apc-input" type="text" name="about_faculty[${fpIdx}][title]" placeholder="Professor"></div>
        </div>`));
}

// ── Fix sidenav to viewport on load ──
document.addEventListener('DOMContentLoaded', () => {
    const nav   = document.querySelector('.apc-sidenav');
    const shell = document.querySelector('.apc-shell');
    if (!nav || !shell) return;

    function pinNav() {
        // Reset inline styles so the browser reflows naturally
        nav.style.position = '';
        nav.style.left     = '';
        nav.style.width    = '';
        nav.style.top      = '';

        // Only read LEFT/WIDTH — these depend on admin sidebar width (dynamic)
        // TOP is always fixed: 75px admin header + 10px breathing room
        const rect = nav.getBoundingClientRect();

        nav.style.position = 'fixed';
        nav.style.top      = '85px';
        nav.style.left     = rect.left + 'px';
        nav.style.width    = rect.width + 'px';

        // Keep the spacer so the flex layout doesn't collapse
        let spacer = shell.querySelector('.apc-sidenav-spacer');
        if (!spacer) {
            spacer = document.createElement('div');
            spacer.className   = 'apc-sidenav-spacer';
            spacer.style.flexShrink = '0';
            shell.insertBefore(spacer, nav);
        }
        spacer.style.width = rect.width + 'px';
    }

    pinNav();
    window.addEventListener('resize', pinNav);
});

// ── Highlight active sidenav link on scroll ──
document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('.apc-sidenav a');
    const sections = Array.from(document.querySelectorAll('.apc-section'));
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                links.forEach(l => l.classList.remove('active'));
                const match = document.querySelector(`.apc-sidenav a[href="#${e.target.id}"]`);
                if (match) match.classList.add('active');
            }
        });
    }, { threshold: 0.25 });
    sections.forEach(s => observer.observe(s));
});
</script>
@endsection
