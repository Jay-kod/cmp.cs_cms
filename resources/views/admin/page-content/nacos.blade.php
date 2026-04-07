@extends($adminLayout ?? 'layouts.admin')
@section('title', 'NACOS Page Content')
@section('header', 'NACOS Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;

    $navSections = [
        'sec-home'       => ['icon' => 'fa-house',        'label' => 'Home Section',   'color' => '#6366f1'],
        'sec-about'      => ['icon' => 'fa-circle-info',  'label' => 'About Card',     'color' => '#ec4899'],
        'sec-stats'      => ['icon' => 'fa-chart-bar',    'label' => 'Home Stats',     'color' => '#10b981'],
        'sec-cta'        => ['icon' => 'fa-arrow-right',  'label' => 'Home CTA',       'color' => '#f59e0b'],
        'sec-page-about' => ['icon' => 'fa-file-lines',   'label' => 'Page About',     'color' => '#8b5cf6'],
        'sec-page-act'   => ['icon' => 'fa-laptop-code',  'label' => 'Page Activities','color' => '#06b6d4'],
        'sec-page-cta'   => ['icon' => 'fa-paper-plane',  'label' => 'Page CTA',       'color' => '#64748b'],
        'sec-pres'       => ['icon' => 'fa-crown',        'label' => 'Presidents Grid','color' => '#ef4444'],
        'sec-site'       => ['icon' => 'fa-globe',        'label' => 'External Site',  'color' => '#3b82f6'],
    ];
@endphp

<style>
/* ── Page shell ── */
.apc-shell { display: flex; gap: 1.5rem; align-items: flex-start; }

/* ── Fixed left nav ── */
.apc-sidenav { display: flex; flex-direction: column;
    width: 200px;
    flex-shrink: 0;
    background: white;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    align-self: flex-start;
    max-height: calc(100vh - 110px);
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: thin;
    scrollbar-color: #e2e8f0 transparent;
    z-index: 40;
}
.apc-sidenav-head { padding: 0.9rem 1rem; background: #0f172a; color: #94a3b8; font-size: 0.65rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; }
.apc-sidenav a { display: flex; align-items: center; gap: 0.6rem; padding: 0.6rem 1rem; font-size: 0.82rem; font-weight: 500; color: #475569; text-decoration: none; border-left: 3px solid transparent; transition: all 0.15s; }
.apc-sidenav a:hover { background: #f8fafc; color: #0f172a; }
.apc-sidenav a.active { background: #f0f9ff; color: #0284c7; border-left-color: #0284c7; font-weight: 600; }
.apc-sidenav-icon { width: 22px; height: 22px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; flex-shrink: 0; }

/* ── Main form area ── */
.apc-main { flex: 1; min-width: 0; }

/* ── Section cards ── */
.apc-section { background: white; border-radius: 14px; border: 1px solid #e2e8f0; margin-bottom: 1.25rem; box-shadow: 0 1px 4px rgba(0,0,0,0.03); overflow: hidden; scroll-margin-top: 90px; }
.apc-section-header { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.25rem; cursor: pointer; user-select: none; background: #fafafa; border-bottom: 1px solid #f1f5f9; gap: 0.8rem; }
.apc-section-header:hover { background: #f1f5f9; }
.apc-section-header-left { display: flex; align-items: center; gap: 0.75rem; }
.apc-section-icon { width: 34px; height: 34px; border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; color: white; flex-shrink: 0; }
.apc-section-title { font-size: 0.95rem; font-weight: 700; color: #1e293b; margin: 0; }
.apc-section-subtitle { font-size: 0.75rem; color: #94a3b8; margin: 0; margin-top: 1px; }
.apc-chevron { font-size: 0.75rem; color: #94a3b8; transition: transform 0.2s; flex-shrink: 0; }
.apc-section-header.open .apc-chevron { transform: rotate(180deg); }
.apc-section-body { padding: 1.5rem; display: block; }
.apc-section-body.collapsed { display: none; }

/* ── Form groups ── */
.apc-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.9rem; margin-bottom: 0.9rem; }
.apc-field { display: flex; flex-direction: column; gap: 0.35rem; margin-bottom: 0.8rem; }
.apc-label { font-size: 0.78rem; font-weight: 600; color: #64748b; letter-spacing: 0.3px; display: flex; align-items: center; gap: 0.4rem; }
.apc-hint { font-size: 0.72rem; color: #94a3b8; margin-top: 0.15rem; }
.apc-input, .apc-textarea { width: 100%; padding: 0.55rem 0.85rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-family: inherit; font-size: 0.9rem; color: #1e293b; box-sizing: border-box; background: white; transition: border-color 0.15s, box-shadow 0.15s; }
.apc-input:focus, .apc-textarea:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,0.08); }
.apc-textarea { resize: vertical; min-height: 80px; line-height: 1.6; }

/* ── Save bar ── */
.apc-save-bar { position: sticky; bottom: 1rem; background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 0.9rem 1.25rem; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 8px 25px -5px rgba(0,0,0,0.1); margin-top: 1.25rem; z-index: 10; }
.apc-save-btn { background: linear-gradient(135deg, #059669, #10b981); color: white; border: none; padding: 0.65rem 2rem; border-radius: 9px; font-size: 0.9rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 12px rgba(16,185,129,0.35); transition: all 0.2s; }
.apc-save-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(16,185,129,0.45); }

/* Toast */
.toast-success { position: fixed; top: 1.5rem; right: 1.5rem; background: #065f46; color: white; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 600; font-size: 0.95rem; display: flex; align-items: center; gap: 0.6rem; z-index: 9999; box-shadow: 0 10px 40px rgba(0,0,0,0.2); animation: slideIn 0.4s ease, fadeOut 0.4s ease 3.5s forwards; }
@keyframes slideIn { from { transform: translateX(100%) scale(0.9); opacity: 0; } to { transform: translateX(0) scale(1); opacity: 1; } }
@keyframes fadeOut { to { transform: translateX(100%); opacity: 0; } }

/* Inner cards */
.inner-card { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 1.25rem; margin-bottom: 1rem; background: #fafafa; }
.inner-card-header { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 1px dashed #cbd5e1; }
.inner-card-number { width: 30px; height: 30px; background: {{ $navSections['sec-page-act']['color'] }}; color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; font-weight: 700; }
.inner-card-title { font-size: 0.95rem; font-weight: 700; color: #1e293b; margin: 0; }

/* Quick Link */
.quick-link-card { display: flex; align-items: center; gap: 1rem; padding: 1rem 1.25rem; background: white; border: 1.5px solid #e2e8f0; border-radius: 12px; text-decoration: none; transition: all 0.2s; box-shadow: 0 2px 6px rgba(0,0,0,0.02); }
.quick-link-card:hover { border-color: var(--color-primary, #10b981); transform: translateY(-2px); box-shadow: 0 6px 15px rgba(0,0,0,0.05); }
.quick-link-card .ql-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }
.quick-link-card .ql-text { flex: 1; }
.quick-link-card .ql-text strong { display: block; font-size: 0.9rem; color: #0f172a; margin-bottom: 0.15rem; }
.quick-link-card .ql-text span { font-size: 0.75rem; color: #64748b; }
</style>

@if(session('success'))
<div class="toast-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
@endif

{{-- Top bar --}}
<div style="background: #0f172a; padding: 0.8rem 1.25rem; border-radius: 12px; margin-bottom: 1.25rem; margin-left: calc(200px + 1.5rem); display: flex; align-items: center; justify-content: space-between;">
    <div style="display: flex; align-items: center; gap: 0.7rem;">
        <div style="width: 8px; height: 8px; background: #3b82f6; border-radius: 50%;"></div>
        <span style="color: #94a3b8; font-size: 0.85rem;">Editing: <strong style="color: white;">NACOS Page Content</strong></span>
    </div>
    <div style="display: flex; gap: 0.5rem;">
        <a href="{{ route('admin.nacos-presidents.index') }}" target="_blank" style="background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.4rem 1rem; border-radius: 8px; font-size: 0.82rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.1); display: inline-flex; align-items: center; gap: 0.4rem; transition: background 0.15s;" onmouseover="this.style.background='rgba(255,255,255,0.14)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
            <i class="fa-solid fa-crown" style="font-size: 0.75rem;"></i> Manage Presidents
        </a>
        <a href="{{ route('home') }}#nacos" target="_blank" style="background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.4rem 1rem; border-radius: 8px; font-size: 0.82rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.1); display: inline-flex; align-items: center; gap: 0.4rem; transition: background 0.15s;" onmouseover="this.style.background='rgba(255,255,255,0.14)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
            <i class="fa-solid fa-up-right-from-square" style="font-size: 0.75rem;"></i> Preview
        </a>
    </div>
</div>

<form method="POST" id="nacosPageForm" action="{{ route('admin.page-content.update', 'nacos') }}" enctype="multipart/form-data">
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

        {{-- ── 1. HOMEPAGE SECTION ── --}}
        <div class="apc-section" id="sec-home">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-home']['color'] }};"><i class="fa-solid {{ $navSections['sec-home']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Homepage Header</p>
                        <p class="apc-section-subtitle">The spotlight section on the homepage</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Badge Text</label>
                        <input class="apc-input" type="text" name="home_nacos_badge" value="{{ $s('home_nacos_badge', 'Student Association') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Section Title</label>
                        <input class="apc-input" type="text" name="home_nacos_title" value="{{ $s('home_nacos_title', 'NACOS') }}">
                    </div>
                </div>
                <div class="apc-field">
                    <label class="apc-label">Section Subtitle</label>
                    <textarea class="apc-textarea" name="home_nacos_subtitle" rows="2">{{ $s('home_nacos_subtitle', 'The National Association of Computing Students (NUK Chapter) — empowering students through leadership, innovation and community.') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── 2. ABOUT CARD ── --}}
        <div class="apc-section" id="sec-about">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-about']['color'] }};"><i class="fa-solid {{ $navSections['sec-about']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">About NACOS Card</p>
                        <p class="apc-section-subtitle">Left column text in the homepage section</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Card Title</label>
                        <input class="apc-input" type="text" name="home_nacos_about_title" value="{{ $s('home_nacos_about_title', 'About NACOS') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Tag Line</label>
                        <input class="apc-input" type="text" name="home_nacos_about_tag" value="{{ $s('home_nacos_about_tag', 'NUK Chapter') }}">
                    </div>
                </div>
                <div class="apc-field">
                    <label class="apc-label">About Text</label>
                    <textarea class="apc-textarea" name="home_nacos_about_text" rows="3">{{ $s('home_nacos_about_text', 'NACOS is the umbrella body for all computing students. We foster academic excellence, professional development, and social bonds among members through events, workshops, competitions, and community service.') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── 3. STATS ── --}}
        <div class="apc-section" id="sec-stats">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-stats']['color'] }};"><i class="fa-solid {{ $navSections['sec-stats']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Home Statistics</p>
                        <p class="apc-section-subtitle">Bottom-left stats (Stat 1 is auto-counted from Presidents)</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div data-aos="fade-up" class="inner-card">
                    <div class="inner-card-header">
                        <div class="inner-card-number" style="background: {{ $navSections['sec-stats']['color'] }}">1</div>
                        <h4 class="inner-card-title">Auto-counted (Presidents)</h4>
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Label</label>
                        <input class="apc-input" type="text" name="home_nacos_stat1_label" value="{{ $s('home_nacos_stat1_label', 'Past Leaders') }}">
                    </div>
                </div>

                <div data-aos="fade-up" class="inner-card">
                    <div class="inner-card-header">
                        <div class="inner-card-number" style="background: {{ $navSections['sec-stats']['color'] }}">2</div>
                        <h4 class="inner-card-title">Stat #2</h4>
                    </div>
                    <div class="apc-row">
                        <div class="apc-field">
                            <label class="apc-label">Value</label>
                            <input class="apc-input" type="text" name="home_nacos_stat2_value" value="{{ $s('home_nacos_stat2_value', '50+') }}">
                        </div>
                        <div class="apc-field">
                            <label class="apc-label">Label</label>
                            <input class="apc-input" type="text" name="home_nacos_stat2_label" value="{{ $s('home_nacos_stat2_label', 'Events Hosted') }}">
                        </div>
                    </div>
                </div>

                <div data-aos="fade-up" class="inner-card">
                    <div class="inner-card-header">
                        <div class="inner-card-number" style="background: {{ $navSections['sec-stats']['color'] }}">3</div>
                        <h4 class="inner-card-title">Stat #3</h4>
                    </div>
                    <div class="apc-row">
                        <div class="apc-field">
                            <label class="apc-label">Value</label>
                            <input class="apc-input" type="text" name="home_nacos_stat3_value" value="{{ $s('home_nacos_stat3_value', '500+') }}">
                        </div>
                        <div class="apc-field">
                            <label class="apc-label">Label</label>
                            <input class="apc-input" type="text" name="home_nacos_stat3_label" value="{{ $s('home_nacos_stat3_label', 'Active Members') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── 4. HOME CTA ── --}}
        <div class="apc-section" id="sec-cta">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-cta']['color'] }};"><i class="fa-solid {{ $navSections['sec-cta']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Home CTA Banner</p>
                        <p class="apc-section-subtitle">Bottom CTA banner on the homepage segment</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">CTA Title</label>
                        <input class="apc-input" type="text" name="home_nacos_cta_title" value="{{ $s('home_nacos_cta_title', 'Explore NACOS History') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">CTA Description</label>
                        <textarea class="apc-textarea" name="home_nacos_cta_desc" rows="2">{{ $s('home_nacos_cta_desc', 'See all past leaders, their tenure and achievements') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── 5. PAGE ABOUT ── --}}
        <div class="apc-section" id="sec-page-about">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-page-about']['color'] }};"><i class="fa-solid {{ $navSections['sec-page-about']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">About NACOS (Public Page)</p>
                        <p class="apc-section-subtitle">Text, extra stats, and mission pillars</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-field">
                    <label class="apc-label">Section Title</label>
                    <input class="apc-input" type="text" name="nacos_page_about_title" value="{{ $s('nacos_page_about_title', 'About NACOS') }}">
                </div>
                <div class="apc-field">
                    <label class="apc-label">First Paragraph</label>
                    <textarea class="apc-textarea" name="nacos_page_about_text" rows="3">{{ $s('nacos_page_about_text', 'The National Association of Computing Students (NACOS) is the umbrella body for all students studying computing-related disciplines. Our NUK Chapter is dedicated to fostering academic excellence, professional development, and strong social bonds among members.') }}</textarea>
                </div>
                <div class="apc-field">
                    <label class="apc-label">Second Paragraph</label>
                    <textarea class="apc-textarea" name="nacos_page_about_text2" rows="3">{{ $s('nacos_page_about_text2', 'Through workshops, hackathons, seminars, and community outreach, NACOS prepares students for the ever-evolving tech industry while building a supportive network that extends well beyond graduation.') }}</textarea>
                </div>

                <hr style="border:0;border-top:1px dashed #cbd5e1;margin:1.5rem 0;">
                <p style="font-size:0.85rem;font-weight:700;color:#475569;margin-bottom:1rem;">Page Stats (Stat 2-4)</p>

                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Stat 2: Value</label>
                        <input class="apc-input" type="text" name="nacos_page_stat_events" value="{{ $s('nacos_page_stat_events', '50+') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Stat 2: Label</label>
                        <input class="apc-input" type="text" name="nacos_page_stat_events_label" value="{{ $s('nacos_page_stat_events_label', 'Events Hosted') }}">
                    </div>
                </div>
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Stat 3: Value</label>
                        <input class="apc-input" type="text" name="nacos_page_stat_members" value="{{ $s('nacos_page_stat_members', '500+') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Stat 3: Label</label>
                        <input class="apc-input" type="text" name="nacos_page_stat_members_label" value="{{ $s('nacos_page_stat_members_label', 'Active Members') }}">
                    </div>
                </div>
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Stat 4: Value</label>
                        <input class="apc-input" type="text" name="nacos_page_stat_awards" value="{{ $s('nacos_page_stat_awards', '20+') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Stat 4: Label</label>
                        <input class="apc-input" type="text" name="nacos_page_stat_awards_label" value="{{ $s('nacos_page_stat_awards_label', 'Awards Won') }}">
                    </div>
                </div>

                <hr style="border:0;border-top:1px dashed #cbd5e1;margin:1.5rem 0;">
                <p style="font-size:0.85rem;font-weight:700;color:#475569;margin-bottom:1rem;">Mission / Vision / Values Cards</p>

                @foreach([['num' => 1, 'default_title' => 'Our Mission', 'default_text' => 'To promote academic excellence, advance computing knowledge, and nurture future tech leaders through hands-on learning, mentorship, and industry collaboration.'], ['num' => 2, 'default_title' => 'Our Vision', 'default_text' => 'To be the foremost student body shaping innovative, ethical, and globally competitive computing professionals in Nigeria and beyond.'], ['num' => 3, 'default_title' => 'Our Values', 'default_text' => 'Innovation, integrity, collaboration, inclusivity, and continuous learning form the bedrock of everything we do as an association.']] as $card)
                <div data-aos="fade-up" class="inner-card">
                    <div class="inner-card-header">
                        <div class="inner-card-number" style="background: {{ $navSections['sec-page-about']['color'] }}">{{ $card['num'] }}</div>
                        <strong class="inner-card-title">Pillar {{ $card['num'] }}</strong>
                    </div>
                    <div class="apc-row">
                        <div class="apc-field">
                            <label class="apc-label">Title</label>
                            <input class="apc-input" type="text" name="nacos_page_pillar{{ $card['num'] }}_title" value="{{ $s('nacos_page_pillar'.$card['num'].'_title', $card['default_title']) }}">
                        </div>
                        <div class="apc-field">
                            <label class="apc-label">Text</label>
                            <textarea class="apc-textarea" name="nacos_page_pillar{{ $card['num'] }}_text" rows="2">{{ $s('nacos_page_pillar'.$card['num'].'_text', $card['default_text']) }}</textarea>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── 6. PAGE ACTIVITIES ── --}}
        <div class="apc-section" id="sec-page-act">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-page-act']['color'] }};"><i class="fa-solid {{ $navSections['sec-page-act']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Activities List</p>
                        <p class="apc-section-subtitle">The 6 activity cards shown in "What We Do"</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-field">
                    <label class="apc-label">Section Title</label>
                    <input class="apc-input" type="text" name="nacos_page_activities_title" value="{{ $s('nacos_page_activities_title', 'Our Activities') }}">
                </div>

                @foreach([
                    ['num' => 1, 'title' => 'Hackathons & Coding Contests', 'desc' => 'Regular programming competitions that test skills and encourage creative problem-solving among members.'],
                    ['num' => 2, 'title' => 'Workshops & Seminars', 'desc' => 'Industry-led training sessions on trending technologies like AI, cloud computing, and cybersecurity.'],
                    ['num' => 3, 'title' => 'Mentorship Programme', 'desc' => 'Pairing junior students with senior peers and alumni for academic guidance and career advice.'],
                    ['num' => 4, 'title' => 'Community Service', 'desc' => 'Giving back through IT literacy drives, school outreach, and digital empowerment projects.'],
                    ['num' => 5, 'title' => 'Social & Sports Events', 'desc' => 'Building bonds beyond the classroom with get-togethers, game nights, and inter-departmental sports.'],
                    ['num' => 6, 'title' => 'Annual NACOS Week', 'desc' => 'A week-long celebration with talks, exhibitions, awards, and cultural events showcasing computing talent.'],
                ] as $act)
                <div data-aos="fade-up" class="inner-card">
                    <div class="inner-card-header">
                        <div class="inner-card-number" style="background: {{ $navSections['sec-page-act']['color'] }}">{{ $act['num'] }}</div>
                        <strong class="inner-card-title">Activity {{ $act['num'] }}</strong>
                    </div>
                    <div class="apc-row">
                        <div class="apc-field">
                            <label class="apc-label">Title</label>
                            <input class="apc-input" type="text" name="nacos_act{{ $act['num'] }}_title" value="{{ $s('nacos_act'.$act['num'].'_title', $act['title']) }}">
                        </div>
                        <div class="apc-field">
                            <label class="apc-label">Description</label>
                            <textarea class="apc-textarea" name="nacos_act{{ $act['num'] }}_desc" rows="2">{{ $s('nacos_act'.$act['num'].'_desc', $act['desc']) }}</textarea>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── 7. PAGE CTA ── --}}
        <div class="apc-section" id="sec-page-cta">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-page-cta']['color'] }};"><i class="fa-solid {{ $navSections['sec-page-cta']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Page CTA Banner</p>
                        <p class="apc-section-subtitle">Bottom green ribbon at the end of the public page</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">CTA Title</label>
                        <input class="apc-input" type="text" name="nacos_page_cta_title" value="{{ $s('nacos_page_cta_title', 'Want to Know More?') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">CTA Subtitle</label>
                        <textarea class="apc-textarea" name="nacos_page_cta_subtitle" rows="2">{{ $s('nacos_page_cta_subtitle', 'Reach out to us for questions, collaborations, or if you want to get involved with NACOS.') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── 8. PRESIDENTS ── --}}
        <div class="apc-section" id="sec-pres">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-pres']['color'] }};"><i class="fa-solid {{ $navSections['sec-pres']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Presidents Grid Section</p>
                        <p class="apc-section-subtitle">Grid showing NACOS Presidents</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Section Title</label>
                        <input class="apc-input" type="text" name="nacos_page_leaders_title" value="{{ $s('nacos_page_leaders_title', 'Past NACOS Presidents') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Section Subtitle</label>
                        <textarea class="apc-textarea" name="nacos_page_leaders_subtitle" rows="2">{{ $s('nacos_page_leaders_subtitle', 'Honoring the visionaries who led our chapter and shaped its legacy.') }}</textarea>
                    </div>
                </div>
                <div class="apc-field">
                    <label class="apc-label">Intro Text (Optional)</label>
                    <textarea class="apc-textarea" name="nacos_presidents_intro" rows="3">{{ $s('nacos_presidents_intro', '') }}</textarea>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.8rem; margin-top: 1.5rem;">
                    <a data-aos="fade-up" href="{{ route('admin.nacos-presidents.index') }}" class="quick-link-card">
                        <div class="ql-icon" style="background: rgba(22,163,74,0.1); color: #16a34a;"><i class="fa-solid fa-crown"></i></div>
                        <div class="ql-text">
                            <strong>Manage Presidents</strong>
                            <span>Add, edit, or remove records</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- ── 9. OFFICIAL WEBSITE ── --}}
        <div class="apc-section" id="sec-site">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-site']['color'] }};"><i class="fa-solid {{ $navSections['sec-site']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Official Website Link</p>
                        <p class="apc-section-subtitle">Button to the major NACOS website</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Website URL</label>
                        <input class="apc-input" type="url" name="nacos_official_website_url" value="{{ $s('nacos_official_website_url', '') }}" placeholder="https://nacos.org.ng">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Button Label</label>
                        <input class="apc-input" type="text" name="nacos_official_website_label" value="{{ $s('nacos_official_website_label', 'Visit Major NACOS Website') }}">
                    </div>
                </div>
            </div>
        </div>

        

    </div>{{-- end .apc-main --}}
</div>{{-- end .apc-shell --}}
</form>

<script>
// ── Collapsible Sections ──
function toggleSection(header) {
    header.classList.toggle('open');
    header.nextElementSibling.classList.toggle('collapsed');
}

function openSection(id) {
    const sec = document.getElementById(id);
    if (!sec) return;

    const header = sec.querySelector('.apc-section-header');
    const body   = sec.querySelector('.apc-section-body');
    if (body && body.classList.contains('collapsed')) {
        header.classList.add('open');
        body.classList.remove('collapsed');
    }

    const offset = 90;
    const top = sec.getBoundingClientRect().top + window.pageYOffset - offset;
    window.scrollTo({ top, behavior: 'smooth' });

    document.querySelectorAll('.apc-sidenav a').forEach(l => l.classList.remove('active'));
    const match = document.querySelector(`.apc-sidenav a[href="#${id}"]`);
    if (match) match.classList.add('active');
}

// ── Fix sidenav to viewport on load ──
document.addEventListener('DOMContentLoaded', () => {
    const nav   = document.querySelector('.apc-sidenav');
    const shell = document.querySelector('.apc-shell');
    if (!nav || !shell) return;
    function pinNav() {
        nav.style.position = ''; nav.style.left = ''; nav.style.width = ''; nav.style.top = '';
        const rect = nav.getBoundingClientRect();
        nav.style.position = 'fixed'; nav.style.top = '85px'; nav.style.left = rect.left + 'px'; nav.style.width = rect.width + 'px';
        let spacer = shell.querySelector('.apc-sidenav-spacer');
        if (!spacer) {
            spacer = document.createElement('div'); spacer.className = 'apc-sidenav-spacer'; spacer.style.flexShrink = '0';
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

// ── Auto-dismiss toast ──
document.addEventListener('DOMContentLoaded', function() {
    const toast = document.querySelector('.toast-success');
    if (toast) setTimeout(() => toast.remove(), 4000);
});
</script>
@endsection
