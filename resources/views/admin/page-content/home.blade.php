@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Home Page Content')
@section('header', 'Home Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;

    $navSections = [
        'sec-stats'      => ['icon' => 'fa-chart-bar',       'label' => 'Stats Counter',   'color' => '#6366f1'],
        'sec-hod'        => ['icon' => 'fa-user-tie',        'label' => 'HOD Welcome',     'color' => '#0ea5e9'],
        'sec-programmes' => ['icon' => 'fa-graduation-cap',  'label' => 'Programmes',      'color' => '#10b981'],
        'sec-staff'      => ['icon' => 'fa-users',           'label' => 'Staff',           'color' => '#f59e0b'],
        'sec-gallery'    => ['icon' => 'fa-images',          'label' => 'Gallery',         'color' => '#ec4899'],
        'sec-systems'    => ['icon' => 'fa-globe',           'label' => 'Systems',         'color' => '#8b5cf6'],
        'sec-news'       => ['icon' => 'fa-newspaper',       'label' => 'News',            'color' => '#06b6d4'],
        'sec-events'     => ['icon' => 'fa-calendar-days',   'label' => 'Events',          'color' => '#64748b'],
        'sec-explore'    => ['icon' => 'fa-compass',         'label' => 'Explore Links',   'color' => '#f97316'],
        'sec-nacos'      => ['icon' => 'fa-users-rectangle', 'label' => 'NACOS',           'color' => '#14b8a6'],
        'sec-cta'        => ['icon' => 'fa-paper-plane',     'label' => 'CTA Banner',      'color' => '#ef4444'],
    ];

    $defaultIcons  = ['fa-regular fa-building','fa-solid fa-book-open','fa-solid fa-graduation-cap','fa-solid fa-building-user','fa-solid fa-user-graduate','fa-solid fa-users'];
    $defaultValues = ['2019', '16', '3', '5', '1,500+', '7'];
    $defaultLabels = ['Established','Courses','Programmes','Departments','Active Students','Expert Staff'];

    $iconChoices = [
        1 => ['fa-regular fa-building' => 'Building', 'fa-solid fa-landmark' => 'Landmark', 'fa-solid fa-calendar-check' => 'Calendar'],
        2 => ['fa-solid fa-book-open' => 'Book Open', 'fa-solid fa-book' => 'Book', 'fa-solid fa-chalkboard' => 'Chalkboard'],
        3 => ['fa-solid fa-graduation-cap' => 'Graduation Cap', 'fa-solid fa-user-graduate' => 'Graduate', 'fa-solid fa-scroll' => 'Scroll'],
        4 => ['fa-solid fa-building-user' => 'Building User', 'fa-solid fa-building-columns' => 'Building Columns', 'fa-solid fa-sitemap' => 'Sitemap'],
        5 => ['fa-solid fa-user-graduate' => 'Student Cap', 'fa-solid fa-graduation-cap' => 'Cap', 'fa-solid fa-user-group' => 'Group'],
        6 => ['fa-solid fa-users' => 'Team', 'fa-solid fa-chalkboard-user' => 'Teachers', 'fa-solid fa-user-tie' => 'Staff'],
    ];
@endphp

<style>
/* ── Page shell ── */
.apc-shell { display: flex; gap: 1.5rem; align-items: flex-start; }

/* ── Fixed left nav ── */
.apc-sidenav { display: flex; flex-direction: column;
    width: 190px;
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
.apc-field { display: flex; flex-direction: column; gap: 0.35rem; }
.apc-label { font-size: 0.78rem; font-weight: 600; color: #64748b; letter-spacing: 0.3px; display: flex; align-items: center; gap: 0.4rem; }
.apc-hint { font-size: 0.72rem; color: #94a3b8; margin-top: 0.15rem; }
.apc-input, .apc-textarea { width: 100%; padding: 0.55rem 0.85rem; border: 1.5px solid #e2e8f0; border-radius: 8px; font-family: inherit; font-size: 0.9rem; color: #1e293b; box-sizing: border-box; background: white; transition: border-color 0.15s, box-shadow 0.15s; }
.apc-input:focus, .apc-textarea:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,0.08); }
.apc-textarea { resize: vertical; min-height: 80px; line-height: 1.6; }

/* ── Sub-section divider ── */
.apc-subsection-title { font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; padding: 0.5rem 0; margin: 1rem 0 0.75rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.4rem; }

/* ── Stat Picker ── */
.icon-pick { display: flex; flex-direction: column; align-items: center; gap: 0.35rem; padding: 0.7rem 0.5rem; border: 2px solid #e2e8f0; border-radius: 10px; cursor: pointer; transition: all 0.2s; background: white; flex: 1; text-align: center; }
.icon-pick i { font-size: 1.4rem; color: #64748b; transition: all 0.2s; }
.icon-pick span { font-size: 0.7rem; font-weight: 600; color: #94a3b8; transition: color 0.2s; }
.icon-pick:hover { border-color: #cbd5e1; background: #f8fafc; }
.icon-pick:hover i { color: #334155; }
.icon-pick-active { border-color: #10b981; background: rgba(16,185,129,0.06); box-shadow: 0 0 0 3px rgba(16,185,129,0.1); }
.icon-pick-active i { color: #10b981; }

/* ── Save bar ── */
.apc-save-bar { position: sticky; bottom: 1rem; background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 0.9rem 1.25rem; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 8px 25px -5px rgba(0,0,0,0.1); margin-top: 1.25rem; z-index: 10; }
.apc-save-btn { background: linear-gradient(135deg, #059669, #10b981); color: white; border: none; padding: 0.65rem 2rem; border-radius: 9px; font-size: 0.9rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 12px rgba(16,185,129,0.35); transition: all 0.2s; }
.apc-save-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(16,185,129,0.45); }

/* Toast */
.toast-success { position: fixed; top: 1.5rem; right: 1.5rem; background: #065f46; color: white; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 600; font-size: 0.95rem; display: flex; align-items: center; gap: 0.6rem; z-index: 9999; box-shadow: 0 10px 40px rgba(0,0,0,0.2); animation: slideIn 0.4s ease, fadeOut 0.4s ease 3.5s forwards; }
@keyframes slideIn { from { transform: translateX(100%) scale(0.9); opacity: 0; } to { transform: translateX(0) scale(1); opacity: 1; } }
@keyframes fadeOut { to { transform: translateX(100%); opacity: 0; } }
</style>

@if(session('success'))
<div class="toast-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
@endif

{{-- Top bar --}}
<div style="background: #0f172a; padding: 0.8rem 1.25rem; border-radius: 12px; margin-bottom: 1.25rem; margin-left: calc(190px + 1.5rem); display: flex; align-items: center; justify-content: space-between;">
    <div style="display: flex; align-items: center; gap: 0.7rem;">
        <div style="width: 8px; height: 8px; background: #22c55e; border-radius: 50%;"></div>
        <span style="color: #94a3b8; font-size: 0.85rem;">Editing: <strong style="color: white;">Home Page</strong></span>
    </div>
    <a href="{{ route('home') }}" target="_blank" style="background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.4rem 1rem; border-radius: 8px; font-size: 0.82rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.1); display: inline-flex; align-items: center; gap: 0.4rem; transition: background 0.15s;" onmouseover="this.style.background='rgba(255,255,255,0.14)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
        <i class="fa-solid fa-up-right-from-square" style="font-size: 0.75rem;"></i> Preview Page
    </a>
</div>

<form method="POST" action="{{ route('admin.page-content.update', 'home') }}" enctype="multipart/form-data">
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

        {{-- ── STATS COUNTER ── --}}
        <div class="apc-section" id="sec-stats">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #6366f1;"><i class="fa-solid fa-chart-bar"></i></div>
                    <div>
                        <p class="apc-section-title">Stats Counter Cards</p>
                        <p class="apc-section-subtitle">6 metric cards displayed over the HOD section</p>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:0.6rem;">
                    <span style="background:#e0e7ff; color:#4338ca; font-size:0.7rem; font-weight:700; padding:0.2rem 0.6rem; border-radius:20px;">6 cards</span>
                    <i class="fa-solid fa-chevron-down apc-chevron"></i>
                </div>
            </div>
            <div class="apc-section-body">
                @foreach([1,2,3,4,5,6] as $n)
                @php $currentIcon = $s("stat_{$n}_icon", $defaultIcons[$n-1] ?? 'fa-solid fa-star'); @endphp
                <div style="border:1.5px solid #e2e8f0; border-radius:10px; padding:1rem; margin-bottom:1rem; background:#fafafa;">
                    <div style="font-size:0.8rem; font-weight:800; color:#64748b; margin-bottom:0.8rem;">CARD #{{ $n }}</div>
                    <div class="apc-row" style="grid-template-columns: 1.5fr 1fr 1fr;">
                        <div class="apc-field">
                            <label class="apc-label"><i class="fa-solid fa-icons" style="color:#0ea5e9;"></i> Icon</label>
                            <input type="hidden" name="stat_{{ $n }}_icon" id="statIconInput{{ $n }}" value="{{ $currentIcon }}">
                            <div style="display:flex; gap:0.5rem; margin-top:0.2rem;">
                                @foreach($iconChoices[$n] ?? ['fa-solid fa-users' => 'Team', 'fa-solid fa-chalkboard-user' => 'Teachers', 'fa-solid fa-user-tie' => 'Staff'] as $iconClass => $iconLabel)
                                <div class="icon-pick {{ $currentIcon === $iconClass ? 'icon-pick-active' : '' }}" onclick="pickIcon({{ $n }}, '{{ $iconClass }}', this)">
                                    <i class="{{ $iconClass }}"></i>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="apc-field">
                            <label class="apc-label">Metric Value</label>
                            <input class="apc-input" type="text" name="stat_{{ $n }}_value" value="{{ $s("stat_{$n}_value", $defaultValues[$n-1] ?? '') }}" placeholder="{{ $defaultValues[$n-1] ?? '' }}">
                        </div>
                        <div class="apc-field">
                            <label class="apc-label">Label</label>
                            <input class="apc-input" type="text" name="stat_{{ $n }}_label" value="{{ $s("stat_{$n}_label", $defaultLabels[$n-1] ?? '') }}" placeholder="{{ $defaultLabels[$n-1] ?? '' }}">
                        </div>
                        @if($n == 1)
                        <div class="apc-field">
                            <label class="apc-label">Badge Text (Accreditation)</label>
                            <input class="apc-input" type="text" name="stat_1_badge" value="{{ $s('stat_1_badge', 'NUC Accredited') }}" placeholder="NUC Accredited">
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── HOD WELCOME ── --}}
        <div class="apc-section" id="sec-hod">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #0ea5e9;"><i class="fa-solid fa-user-tie"></i></div>
                    <div>
                        <p class="apc-section-title">HOD Welcome Section</p>
                        <p class="apc-section-subtitle">Head of Department welcome message and photo</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Badge Text</label>
                        <input class="apc-input" type="text" name="home_hod_badge" value="{{ $s('home_hod_badge', 'Welcome Message') }}" placeholder="Welcome Message">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Section Title</label>
                        <input class="apc-input" type="text" name="home_hod_title" value="{{ $s('home_hod_title', 'From the Head of Department') }}" placeholder="From the Head of Department">
                    </div>
                </div>
                
                <div class="apc-subsection-title"><i class="fa-solid fa-award"></i> Floating Badge (Over Photo)</div>
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Badge Title</label>
                        <input class="apc-input" type="text" name="home_hod_badge_title" value="{{ $s('home_hod_badge_title', 'Excellence') }}" placeholder="Excellence">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Badge Subtitle</label>
                        <input class="apc-input" type="text" name="home_hod_badge_subtitle" value="{{ $s('home_hod_badge_subtitle', 'In Leadership') }}" placeholder="In Leadership">
                    </div>
                </div>

                <div class="apc-subsection-title"><i class="fa-solid fa-address-card"></i> HOD Details & Photo</div>
                <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
                    <div style="flex-shrink: 0;">
                        @if($s('hod_photo'))
                            <img src="{{ asset('storage/' . $s('hod_photo')) }}" style="width: 110px; height: 135px; object-fit: cover; border-radius: 10px; border: 1px solid #e2e8f0;">
                        @else
                            <div style="width: 110px; height: 135px; border-radius: 10px; background: #f8fafc; border: 2px dashed #cbd5e1; display: flex; align-items: center; justify-content: center; color: #94a3b8;"><i class="fa-solid fa-camera fa-2x"></i></div>
                        @endif
                    </div>
                    <div style="flex: 1; min-width: 250px;">
                        <input type="file" name="hod_photo" accept="image/*" class="apc-input" style="padding: 0.4rem; font-size: 0.8rem; margin-bottom: 0.8rem;" onchange="previewHodPhoto(this)">
                        <div class="apc-row" style="margin-bottom:0;">
                            <div class="apc-field">
                                <label class="apc-label">HOD Name</label>
                                <input class="apc-input" type="text" name="hod_name" value="{{ $s('hod_name') }}" placeholder="Leave blank to use Staff record">
                            </div>
                            <div class="apc-field">
                                <label class="apc-label">HOD Rank/Title</label>
                                <input class="apc-input" type="text" name="hod_rank" value="{{ $s('hod_rank') }}" placeholder="Leave blank to use Staff record">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="apc-field" style="margin-top: 1.2rem;">
                    <label class="apc-label"><i class="fa-solid fa-quote-left" style="color:#0ea5e9;"></i> Welcome Message</label>
                    <textarea class="apc-textarea" name="hod_welcome_message" rows="5" placeholder="Write welcome message...">{{ $s('hod_welcome_message', 'Welcome to the Department of Computer Science...') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── PROGRAMMES ── --}}
        <div class="apc-section" id="sec-programmes">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #10b981;"><i class="fa-solid fa-graduation-cap"></i></div>
                    <div>
                        <p class="apc-section-title">Programmes Section</p>
                        <p class="apc-section-subtitle">Heading above the dynamically pulled academic programmes</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Badge Text</label>
                        <input class="apc-input" type="text" name="home_programmes_badge" value="{{ $s('home_programmes_badge', 'What We Offer') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Section Title</label>
                        <input class="apc-input" type="text" name="home_programmes_title" value="{{ $s('home_programmes_title', 'Academic Programmes') }}">
                    </div>
                </div>
                <div class="apc-field">
                    <label class="apc-label">Section Subtitle</label>
                    <textarea class="apc-textarea" name="home_programmes_subtitle" rows="2">{{ $s('home_programmes_subtitle', 'Comprehensive undergraduate and postgraduate programmes...') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── STAFF ── --}}
        <div class="apc-section" id="sec-staff">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #f59e0b;"><i class="fa-solid fa-users"></i></div>
                    <div>
                        <p class="apc-section-title">Meet Our Staff</p>
                        <p class="apc-section-subtitle">Heading and card count for the staff grid</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Badge Text</label>
                        <input class="apc-input" type="text" name="home_staff_badge" value="{{ $s('home_staff_badge', 'Our Team') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Section Title</label>
                        <input class="apc-input" type="text" name="home_staff_title" value="{{ $s('home_staff_title', 'Meet Our Faculty') }}">
                    </div>
                </div>
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Card Count</label>
                        <input class="apc-input" type="number" name="home_staff_count" value="{{ $s('home_staff_count', '4') }}" min="1">
                        <span class="apc-hint">Number of staff cards to show (default 4)</span>
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">"View All" Button Text</label>
                        <input class="apc-input" type="text" name="home_staff_btn_text" value="{{ $s('home_staff_btn_text', 'View All Staff') }}">
                    </div>
                </div>
                <div class="apc-field">
                    <label class="apc-label">Subtitle</label>
                    <textarea class="apc-textarea" name="home_staff_subtitle" rows="2">{{ $s('home_staff_subtitle', 'Dedicated academics shaping the future...') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── GALLERY ── --}}
        <div class="apc-section" id="sec-gallery">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #ec4899;"><i class="fa-solid fa-images"></i></div>
                    <div>
                        <p class="apc-section-title">Gallery Showcase</p>
                        <p class="apc-section-subtitle">Heading and grid limits for the dark gallery</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Badge Text</label>
                        <input class="apc-input" type="text" name="home_gallery_badge" value="{{ $s('home_gallery_badge', 'Photo Gallery') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Section Title</label>
                        <input class="apc-input" type="text" name="home_gallery_title" value="{{ $s('home_gallery_title', 'Department Life') }}">
                    </div>
                </div>
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Image Count</label>
                        <input class="apc-input" type="number" name="home_gallery_count" value="{{ $s('home_gallery_count', '8') }}" min="1">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">"View All" Button Text</label>
                        <input class="apc-input" type="text" name="home_gallery_btn_text" value="{{ $s('home_gallery_btn_text', 'View All Photos') }}">
                    </div>
                </div>
                <div class="apc-field">
                    <label class="apc-label">Subtitle</label>
                    <textarea class="apc-textarea" name="home_gallery_subtitle" rows="2">{{ $s('home_gallery_subtitle', 'Moments from events and campus life...') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── SYSTEMS ── --}}
        <div class="apc-section" id="sec-systems">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #8b5cf6;"><i class="fa-solid fa-globe"></i></div>
                    <div>
                        <p class="apc-section-title">Department Systems</p>
                        <p class="apc-section-subtitle">Heading above dynamic external system links</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field"><label class="apc-label">Badge</label><input class="apc-input" type="text" name="home_systems_badge" value="{{ $s('home_systems_badge', 'Quick Access') }}"></div>
                    <div class="apc-field"><label class="apc-label">Title</label><input class="apc-input" type="text" name="home_systems_title" value="{{ $s('home_systems_title', 'Department Systems') }}"></div>
                </div>
                <div class="apc-field">
                    <label class="apc-label">Subtitle</label>
                    <textarea class="apc-textarea" name="home_systems_subtitle" rows="2">{{ $s('home_systems_subtitle', 'Access our online platforms...') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── NEWS ── --}}
        <div class="apc-section" id="sec-news">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #06b6d4;"><i class="fa-solid fa-newspaper"></i></div>
                    <div>
                        <p class="apc-section-title">Latest News</p>
                        <p class="apc-section-subtitle">News column heading</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field"><label class="apc-label">Badge</label><input class="apc-input" type="text" name="home_news_badge" value="{{ $s('home_news_badge', 'Stay Informed') }}"></div>
                    <div class="apc-field"><label class="apc-label">Title</label><input class="apc-input" type="text" name="home_news_title" value="{{ $s('home_news_title', 'Latest News') }}"></div>
                    <div class="apc-field"><label class="apc-label">"View All" Button</label><input class="apc-input" type="text" name="home_news_btn_text" value="{{ $s('home_news_btn_text', 'View All') }}"></div>
                </div>
            </div>
        </div>

        {{-- ── EVENTS ── --}}
        <div class="apc-section" id="sec-events">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #64748b;"><i class="fa-solid fa-calendar-days"></i></div>
                    <div>
                        <p class="apc-section-title">Upcoming Events</p>
                        <p class="apc-section-subtitle">Events sidebar column heading</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field"><label class="apc-label">Badge</label><input class="apc-input" type="text" name="home_events_badge" value="{{ $s('home_events_badge', 'Calendar') }}"></div>
                    <div class="apc-field"><label class="apc-label">Title</label><input class="apc-input" type="text" name="home_events_title" value="{{ $s('home_events_title', 'Upcoming Events') }}"></div>
                    <div class="apc-field"><label class="apc-label">"Full Calendar" Button</label><input class="apc-input" type="text" name="home_events_btn_text" value="{{ $s('home_events_btn_text', 'View Full Calendar') }}"></div>
                </div>
            </div>
        </div>

        {{-- ── EXPLORE / QUICK LINKS ── --}}
        <div class="apc-section" id="sec-explore">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #f97316;"><i class="fa-solid fa-compass"></i></div>
                    <div>
                        <p class="apc-section-title">Explore Links</p>
                        <p class="apc-section-subtitle">Quick link card definitions</p>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:0.6rem;">
                    <span style="background:#fff7ed; color:#c2410c; font-size:0.7rem; font-weight:700; padding:0.2rem 0.6rem; border-radius:20px;">6 built-in links</span>
                    <i class="fa-solid fa-chevron-down apc-chevron"></i>
                </div>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field"><label class="apc-label">Badge Text</label><input class="apc-input" type="text" name="home_explore_badge" value="{{ $s('home_explore_badge', 'Explore') }}"></div>
                    <div class="apc-field"><label class="apc-label">Section Title</label><input class="apc-input" type="text" name="home_explore_title" value="{{ $s('home_explore_title', 'Discover More') }}"></div>
                </div>
                <div class="apc-field" style="margin-bottom:1.5rem;">
                    <label class="apc-label">Subtitle</label>
                    <input class="apc-input" type="text" name="home_explore_subtitle" value="{{ $s('home_explore_subtitle', 'Everything you need to know...') }}">
                </div>

                <div class="apc-subsection-title"><i class="fa-solid fa-link"></i> Link Cards</div>
                @php
                    $defaultLinks = [
                        ['icon' => 'fa-solid fa-building-columns', 'label' => 'About Us',      'desc' => 'Our history', 'url' => '/about',        'color' => '#16a34a'],
                        ['icon' => 'fa-solid fa-graduation-cap',   'label' => 'Academics',     'desc' => 'Programmes', 'url' => '/academics',    'color' => '#0891b2'],
                        ['icon' => 'fa-solid fa-users',            'label' => 'Our Staff',     'desc' => 'Faculty directory',    'url' => '/people',       'color' => '#7c3aed'],
                        ['icon' => 'fa-solid fa-newspaper',        'label' => 'Blog & News',   'desc' => 'Latest updates',       'url' => '/research-news','color' => '#ea580c'],
                        ['icon' => 'fa-solid fa-users',            'label' => 'NACOS',         'desc' => 'Contact & connect',    'url' => '/nacos-presidents','color' => '#dc2626'],
                        ['icon' => 'fa-solid fa-images',           'label' => 'Gallery',       'desc' => 'Photos & albums',      'url' => '/about#gallery','color' => '#ca8a04'],
                    ];
                @endphp
                @foreach($defaultLinks as $li => $dl)
                @php $qi = $li + 1; @endphp
                <div style="border:1.5px solid #e2e8f0; border-radius:10px; padding:1rem; margin-bottom:0.8rem; background:#fafafa;">
                    <div style="font-size:0.75rem; font-weight:800; color:#64748b; margin-bottom:0.8rem; display:flex; gap:0.5rem; align-items:center;">
                        <span style="color:{{ $dl['color'] }};"><i class="{{ $s('home_qlink'.$qi.'_icon', $dl['icon']) }}"></i></span> LINK CARD #{{ $qi }}
                    </div>
                    <div class="apc-row" style="margin-bottom:0;">
                        <div class="apc-field"><label class="apc-label">Label</label><input class="apc-input" type="text" name="home_qlink{{ $qi }}_label" value="{{ $s('home_qlink'.$qi.'_label', $dl['label']) }}"></div>
                        <div class="apc-field"><label class="apc-label">URL</label><input class="apc-input" type="text" name="home_qlink{{ $qi }}_url" value="{{ $s('home_qlink'.$qi.'_url', $dl['url']) }}"></div>
                        <div class="apc-field"><label class="apc-label">Icon (FA)</label><input class="apc-input" type="text" name="home_qlink{{ $qi }}_icon" value="{{ $s('home_qlink'.$qi.'_icon', $dl['icon']) }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── NACOS INFO ── --}}
        <div class="apc-section" id="sec-nacos">
            <div class="apc-section-header">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #14b8a6;"><i class="fa-solid fa-users-rectangle"></i></div>
                    <div>
                        <p class="apc-section-title">NACOS Section</p>
                        <p class="apc-section-subtitle">Has its own dedicated editor page</p>
                    </div>
                </div>
            </div>
            <div class="apc-section-body" style="text-align: center; padding: 2.5rem 1rem;">
                <i class="fa-solid fa-users-rectangle fa-2x" style="color: #14b8a6; margin-bottom: 0.8rem;"></i>
                <h4 style="margin:0 0 0.5rem; color:#1e293b;">Managed Separately</h4>
                <p style="color:#64748b; font-size:0.85rem; margin-bottom:1.5rem;">NACOS content, stats, and presidents are managed in a dedicated CMS editor.</p>
                <a href="{{ route('admin.page-content.show', 'nacos') }}" style="display:inline-flex; align-items:center; gap:0.5rem; background:#1e293b; color:white; padding:0.6rem 1.5rem; border-radius:8px; font-size:0.85rem; font-weight:600; text-decoration:none;"><i class="fa-solid fa-arrow-right"></i> Open NACOS Editor</a>
            </div>
        </div>

        {{-- ── CTA BANNER ── --}}
        <div class="apc-section" id="sec-cta">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #ef4444;"><i class="fa-solid fa-paper-plane"></i></div>
                    <div>
                        <p class="apc-section-title">CTA Banner</p>
                        <p class="apc-section-subtitle">Green footer banner inviting action</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-field" style="margin-bottom:0.9rem;">
                    <label class="apc-label">Banner Title</label>
                    <input class="apc-input" type="text" name="home_cta_title" value="{{ $s('home_cta_title', 'Ready to Join Us?') }}">
                </div>
                <div class="apc-field" style="margin-bottom:1.5rem;">
                    <label class="apc-label">Banner Subtitle</label>
                    <textarea class="apc-textarea" name="home_cta_subtitle" rows="2">{{ $s('home_cta_subtitle', "Whether you're a prospective student...") }}</textarea>
                </div>
                
                <div class="apc-subsection-title"><i class="fa-solid fa-link"></i> Banner Buttons</div>
                @php
                    $defaultBtnLabels = ['Contact Us', 'About the Department', 'View Programmes'];
                    $defaultBtnUrls   = ['/contact', '/about', '/academics'];
                    $defaultBtnIcons  = ['fa-solid fa-envelope', 'fa-solid fa-circle-info', 'fa-solid fa-graduation-cap'];
                @endphp
                @foreach([1,2,3] as $bi)
                <div style="border:1.5px solid #e2e8f0; border-radius:10px; padding:1rem; margin-bottom:0.8rem; background:#fafafa;">
                    <div style="font-size:0.75rem; font-weight:800; color:#64748b; margin-bottom:0.8rem;">BUTTON #{{ $bi }}</div>
                    <div class="apc-row" style="margin-bottom:0;">
                        <div class="apc-field"><label class="apc-label">Text</label><input class="apc-input" type="text" name="home_cta_btn{{ $bi }}_text" value="{{ $s('home_cta_btn'.$bi.'_text', $defaultBtnLabels[$bi-1]) }}"></div>
                        <div class="apc-field"><label class="apc-label">URL</label><input class="apc-input" type="text" name="home_cta_btn{{ $bi }}_url" value="{{ $s('home_cta_btn'.$bi.'_url', $defaultBtnUrls[$bi-1]) }}"></div>
                        <div class="apc-field"><label class="apc-label">Icon (FA)</label><input class="apc-input" type="text" name="home_cta_btn{{ $bi }}_icon" value="{{ $s('home_cta_btn'.$bi.'_icon', $defaultBtnIcons[$bi-1]) }}"></div>
                    </div>
                </div>
                @endforeach
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
        nav.style.position = '';
        nav.style.left     = '';
        nav.style.width    = '';
        nav.style.top      = '';

        const rect = nav.getBoundingClientRect();

        nav.style.position = 'fixed';
        nav.style.top      = '85px';
        nav.style.left     = rect.left + 'px';
        nav.style.width    = rect.width + 'px';

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

// ── Icon Picker ──
function pickIcon(n, iconClass, el) {
    document.getElementById('statIconInput' + n).value = iconClass;
    el.parentElement.querySelectorAll('.icon-pick').forEach(t => t.classList.remove('icon-pick-active'));
    el.classList.add('icon-pick-active');
}

// ── HOD Photo Preview ──
function previewHodPhoto(input) {
    // Basic preview logic could be added here if needed
}
</script>
@endsection
