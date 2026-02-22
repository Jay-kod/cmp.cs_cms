@extends('layouts.admin')
@section('title', 'Home Page Content')
@section('header', 'Home Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
@endphp

<style>
/* ── Editor Chrome ── */
.editor-toolbar { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 1rem 1.5rem; border-radius: 14px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
.editor-toolbar .page-label { color: #94a3b8; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem; }
.editor-toolbar .page-label strong { color: white; }
.editor-toolbar .toolbar-actions { display: flex; gap: 0.6rem; }
.toolbar-btn { padding: 0.45rem 1rem; border-radius: 8px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; border: none; cursor: pointer; transition: all 0.2s; }
.toolbar-btn-preview { background: rgba(255,255,255,0.08); color: #cbd5e1; border: 1px solid rgba(255,255,255,0.1); }
.toolbar-btn-preview:hover { background: rgba(255,255,255,0.15); color: white; }
.toolbar-btn-save { background: var(--color-primary); color: white; }
.toolbar-btn-save:hover { filter: brightness(1.1); transform: translateY(-1px); }

/* ── Section Tabs ── */
.section-tabs { display: flex; gap: 0.25rem; background: #f1f5f9; border-radius: 12px; padding: 0.3rem; margin-bottom: 1.5rem; overflow-x: auto; }
.section-tab { padding: 0.6rem 1.2rem; border-radius: 10px; font-size: 0.85rem; font-weight: 600; color: #64748b; cursor: pointer; transition: all 0.2s; white-space: nowrap; display: flex; align-items: center; gap: 0.5rem; border: none; background: transparent; }
.section-tab:hover { color: #334155; background: rgba(255,255,255,0.6); }
.section-tab.active { background: white; color: var(--color-primary); box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
.section-tab i { font-size: 0.8rem; }

/* ── Cards ── */
.pc-card { background: white; border-radius: 14px; border: 1px solid #e2e8f0; margin-bottom: 1.5rem; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.04); transition: box-shadow 0.2s; }
.pc-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.07); }
.pc-card-header { padding: 1rem 1.5rem; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; cursor: pointer; user-select: none; transition: background 0.2s; }
.pc-card-header:hover { background: #f1f5f9; }
.pc-card-header h3 { margin: 0; font-size: 1rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 0.6rem; }
.pc-card-header .section-badge { font-size: 0.7rem; background: rgba(22,163,74,0.1); color: var(--color-primary); padding: 0.2rem 0.6rem; border-radius: 20px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
.pc-card-body { padding: 1.5rem; display: block; animation: fadeIn 0.3s ease; }
.pc-card-body.collapsed { display: none; }
.toggle-icon { font-size: 0.8rem; color: #64748b; transition: transform 0.3s; }
.pc-card-header.open .toggle-icon { transform: rotate(180deg); }

/* ── Form Elements ── */
.form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; margin-bottom: 1rem; }
.form-group { display: flex; flex-direction: column; gap: 0.4rem; }
.form-group label { font-size: 0.85rem; font-weight: 600; color: #475569; display: flex; align-items: center; gap: 0.4rem; }
.form-group input, .form-group textarea, .form-group select { width: 100%; padding: 0.65rem 0.9rem; border: 1.5px solid #e2e8f0; border-radius: 10px; font-family: inherit; font-size: 0.95rem; color: #334155; box-sizing: border-box; transition: all 0.2s; background: white; }
.form-group input:focus, .form-group textarea:focus, .form-group select:focus { outline: none; border-color: var(--color-primary); box-shadow: 0 0 0 3px rgba(22,163,74,0.1); }
.form-group input::placeholder, .form-group textarea::placeholder { color: #cbd5e1; }
.form-group textarea { resize: vertical; min-height: 80px; }
.hint { font-size: 0.78rem; color: #94a3b8; margin-top: 0.25rem; line-height: 1.4; }

/* ── Stat Cards ── */
.stat-editor { border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 1.2rem; margin-bottom: 1rem; background: #fafbfc; transition: all 0.2s; }
.stat-editor:hover { border-color: #cbd5e1; background: white; }
.stat-editor-header { display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1rem; }
.stat-editor-num { width: 32px; height: 32px; background: linear-gradient(135deg, var(--color-primary), #059669); color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; font-weight: 800; flex-shrink: 0; }
.stat-editor-header h4 { font-size: 0.9rem; color: #334155; margin: 0; font-weight: 700; }

/* ── Icon Picker Tiles ── */
.icon-pick { display: flex; flex-direction: column; align-items: center; gap: 0.35rem; padding: 0.7rem 0.5rem; border: 2px solid #e2e8f0; border-radius: 10px; cursor: pointer; transition: all 0.2s; background: white; flex: 1; text-align: center; }
.icon-pick i { font-size: 1.4rem; color: #64748b; transition: all 0.2s; }
.icon-pick span { font-size: 0.7rem; font-weight: 600; color: #94a3b8; transition: color 0.2s; }
.icon-pick:hover { border-color: #cbd5e1; background: #f8fafc; }
.icon-pick:hover i { color: #334155; }
.icon-pick-active { border-color: var(--color-primary); background: rgba(22,163,74,0.06); box-shadow: 0 0 0 3px rgba(22,163,74,0.1); }
.icon-pick-active i { color: var(--color-primary); }
.icon-pick-active span { color: var(--color-primary); }

/* ── Icon Picker Helper ── */
.icon-preview { width: 40px; height: 40px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--color-primary); font-size: 1.1rem; border: 1px solid #e2e8f0; flex-shrink: 0; }

/* ── Section Panel ── */
.section-panel { display: none; }
.section-panel.active { display: block; animation: fadeIn 0.3s ease; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }

/* ── Help Panel ── */
.help-tip { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 10px; padding: 0.8rem 1rem; margin-bottom: 1rem; display: flex; align-items: flex-start; gap: 0.6rem; font-size: 0.85rem; color: #1e40af; line-height: 1.5; }
.help-tip i { margin-top: 0.1rem; flex-shrink: 0; }

/* ── Success toast ── */
.toast-success { position: fixed; top: 1.5rem; right: 1.5rem; background: #065f46; color: white; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 600; font-size: 0.95rem; display: flex; align-items: center; gap: 0.6rem; z-index: 9999; box-shadow: 0 10px 40px rgba(0,0,0,0.2); animation: slideIn 0.4s ease, fadeOut 0.4s ease 3.5s forwards; }
@keyframes slideIn { from { transform: translateX(100%) scale(0.9); opacity: 0; } to { transform: translateX(0) scale(1); opacity: 1; } }
@keyframes fadeOut { to { transform: translateX(100%); opacity: 0; } }

/* ── Responsive ── */
@media (max-width: 768px) {
    .section-tabs { flex-wrap: nowrap; overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .form-row { grid-template-columns: 1fr; }
    .editor-toolbar { flex-direction: column; text-align: center; }
}
</style>

{{-- Success Toast --}}
@if(session('success'))
<div class="toast-success">
    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
</div>
@endif

<!-- ══════════════════════════════════════
     TOOLBAR
     ══════════════════════════════════════ -->
<div class="editor-toolbar">
    <div class="page-label">
        <i class="fa-solid fa-house"></i>
        Editing: <strong>Home Page</strong>
        <span style="color: #475569; font-size: 0.8rem; margin-left: 0.5rem;">All sections of your homepage can be customized below</span>
    </div>
    <div class="toolbar-actions">
        <a href="{{ route('home') }}" target="_blank" class="toolbar-btn toolbar-btn-preview">
            <i class="fa-solid fa-external-link"></i> Preview Live
        </a>
        <button type="submit" form="homePageForm" class="toolbar-btn toolbar-btn-save">
            <i class="fa-solid fa-save"></i> Save Changes
        </button>
    </div>
</div>

<!-- ══════════════════════════════════════
     SECTION TABS
     ══════════════════════════════════════ -->
<div class="section-tabs" id="sectionTabs">
    <button type="button" class="section-tab active" data-section="stats"><i class="fa-solid fa-chart-bar"></i> Stats</button>
    <button type="button" class="section-tab" data-section="hod"><i class="fa-solid fa-user-tie"></i> HOD Welcome</button>
    <button type="button" class="section-tab" data-section="programmes"><i class="fa-solid fa-graduation-cap"></i> Programmes</button>
    <button type="button" class="section-tab" data-section="staff"><i class="fa-solid fa-users"></i> Staff</button>
    <button type="button" class="section-tab" data-section="gallery"><i class="fa-solid fa-images"></i> Gallery</button>
    <button type="button" class="section-tab" data-section="systems"><i class="fa-solid fa-globe"></i> Systems</button>
    <button type="button" class="section-tab" data-section="news"><i class="fa-solid fa-newspaper"></i> News</button>
    <button type="button" class="section-tab" data-section="events"><i class="fa-solid fa-calendar-days"></i> Events</button>
    <button type="button" class="section-tab" data-section="explore"><i class="fa-solid fa-compass"></i> Explore</button>
    <button type="button" class="section-tab" data-section="nacos"><i class="fa-solid fa-users-rectangle"></i> NACOS</button>
    <button type="button" class="section-tab" data-section="cta"><i class="fa-solid fa-paper-plane"></i> CTA</button>
</div>

<form method="POST" id="homePageForm" action="{{ route('admin.page-content.update', 'home') }}" enctype="multipart/form-data">
@csrf

<!-- ══════════════════════════════════════
     PANEL: STATS COUNTER
     ══════════════════════════════════════ -->
<div class="section-panel active" id="panel-stats">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-chart-bar" style="color: var(--color-primary);"></i>
                Stats Counter Cards
                <span class="section-badge">4 Cards</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>These 5 stat cards appear in the HOD welcome section. Each card shows a dark green background with a watermark icon, a prominent value/number, and a label beneath it. Use Font Awesome icon classes (e.g. <code>fa-solid fa-graduation-cap</code>).</span>
            </div>

            @foreach([1,2,3,4,5] as $n)
            @php
                $defaultIcons  = ['fa-regular fa-building','fa-solid fa-book-open','fa-solid fa-graduation-cap','fa-solid fa-building-user','fa-solid fa-medal'];
                $defaultValues = ['2019', '0', '6', '6', 'NUC'];
                $defaultLabels = ['Established','Courses','Programmes','Departments','Full Accreditation'];

                // 3 icon choices per card
                $iconChoices = [
                    1 => [
                        'fa-regular fa-building'       => 'Building',
                        'fa-solid fa-landmark'          => 'Landmark',
                        'fa-solid fa-calendar-check'    => 'Calendar',
                    ],
                    2 => [
                        'fa-solid fa-book-open'         => 'Book Open',
                        'fa-solid fa-book'              => 'Book',
                        'fa-solid fa-chalkboard'        => 'Chalkboard',
                    ],
                    3 => [
                        'fa-solid fa-graduation-cap'    => 'Graduation Cap',
                        'fa-solid fa-user-graduate'     => 'Graduate',
                        'fa-solid fa-scroll'            => 'Scroll',
                    ],
                    4 => [
                        'fa-solid fa-building-user'     => 'Building User',
                        'fa-solid fa-building-columns'  => 'Building Columns',
                        'fa-solid fa-sitemap'           => 'Sitemap',
                    ],
                    5 => [
                        'fa-solid fa-medal'             => 'Medal',
                        'fa-solid fa-award'             => 'Award',
                        'fa-solid fa-certificate'       => 'Certificate',
                    ],
                ];

                $currentIcon = $s("stat_{$n}_icon", $defaultIcons[$n-1]);
            @endphp
            <div class="stat-editor">
                <div class="stat-editor-header">
                    <div class="stat-editor-num">{{ $n }}</div>
                    <h4>Stat Card #{{ $n }}</h4>
                </div>
                <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr;">
                    <div class="form-group">
                        <label><i class="fa-solid fa-icons" style="color: var(--color-primary);"></i> Choose Icon</label>
                        <input type="hidden" name="stat_{{ $n }}_icon" id="statIconInput{{ $n }}" value="{{ $currentIcon }}">
                        <div style="display: flex; gap: 0.5rem; margin-top: 0.2rem;">
                            @foreach($iconChoices[$n] as $iconClass => $iconLabel)
                            <div class="icon-pick {{ $currentIcon === $iconClass ? 'icon-pick-active' : '' }}" onclick="pickIcon({{ $n }}, '{{ $iconClass }}', this)" title="{{ $iconLabel }}">
                                <i class="{{ $iconClass }}"></i>
                                <span>{{ $iconLabel }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Value / Number</label>
                        <input type="text" name="stat_{{ $n }}_value" value="{{ $s("stat_{$n}_value", $defaultValues[$n-1]) }}" placeholder="e.g. 2019 or 12+">
                    </div>
                    <div class="form-group">
                        <label>Label</label>
                        <input type="text" name="stat_{{ $n }}_label" value="{{ $s("stat_{$n}_label", $defaultLabels[$n-1]) }}" placeholder="e.g. Established">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: HOD WELCOME
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-hod">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-user-tie" style="color: var(--color-primary);"></i>
                HOD Welcome Section
                <span class="section-badge">Welcome</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>This section controls the "From the Head of Department" area on the homepage — the photo, welcome message, and name card. Upload a photo and write a welcome message below.</span>
            </div>

            {{-- Section Heading Controls --}}
            <div class="form-row" style="margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label><i class="fa-solid fa-tag" style="color: #94a3b8;"></i> Badge Text</label>
                    <input type="text" name="home_hod_badge" value="{{ $s('home_hod_badge', 'Welcome Message') }}" placeholder="Welcome Message">
                    <span class="hint">Small highlighted label above the heading</span>
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-heading" style="color: #94a3b8;"></i> Section Title</label>
                    <input type="text" name="home_hod_title" value="{{ $s('home_hod_title', 'From the Head of Department') }}" placeholder="From the Head of Department">
                    <span class="hint">Main heading text of the HOD section</span>
                </div>
            </div>

            {{-- Floating Badge --}}
            <div class="form-row" style="margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label><i class="fa-solid fa-award" style="color: #f59e0b;"></i> Floating Badge Title</label>
                    <input type="text" name="home_hod_badge_title" value="{{ $s('home_hod_badge_title', 'Excellence') }}" placeholder="Excellence">
                    <span class="hint">The bold word on the floating badge overlay on the photo</span>
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-award" style="color: #f59e0b;"></i> Floating Badge Subtitle</label>
                    <input type="text" name="home_hod_badge_subtitle" value="{{ $s('home_hod_badge_subtitle', 'In Leadership') }}" placeholder="In Leadership">
                    <span class="hint">Small text below the badge title</span>
                </div>
            </div>

            {{-- HOD Photo Upload --}}
            <div style="margin-bottom: 1.5rem; padding: 1.2rem; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px;">
                <label style="font-size: 0.9rem; font-weight: 700; color: #334155; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;"><i class="fa-solid fa-camera" style="color: var(--color-primary);"></i> HOD Photograph</label>
                <div style="display: flex; align-items: flex-start; gap: 1.5rem; flex-wrap: wrap;">
                    {{-- Current Photo Preview --}}
                    <div style="flex-shrink: 0;">
                        @if($s('hod_photo'))
                            <div style="position: relative;">
                                <img src="{{ asset('storage/' . $s('hod_photo')) }}" alt="Current HOD Photo" style="width: 120px; height: 150px; object-fit: cover; border-radius: 12px; border: 3px solid white; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <div style="position: absolute; top: -6px; right: -6px; background: #059669; color: white; width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; border: 2px solid white;"><i class="fa-solid fa-check"></i></div>
                            </div>
                        @else
                            <div style="width: 120px; height: 150px; border-radius: 12px; background: linear-gradient(135deg, #f1f5f9, #e2e8f0); border: 2px dashed #cbd5e1; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #94a3b8; gap: 0.4rem;">
                                <i class="fa-solid fa-user-tie" style="font-size: 2rem;"></i>
                                <span style="font-size: 0.7rem; font-weight: 600;">No Photo</span>
                            </div>
                        @endif
                    </div>
                    {{-- Upload Input --}}
                    <div style="flex: 1; min-width: 200px;">
                        <div class="form-group">
                            <label>Upload New Photo</label>
                            <input type="file" name="hod_photo" accept="image/*" style="padding: 0.5rem; border: 1.5px dashed #cbd5e1; border-radius: 10px; background: white; width: 100%; cursor: pointer;" onchange="previewHodPhoto(this)">
                            <span class="hint">Recommended: Portrait orientation, at least 400×500px. JPG or PNG.</span>
                        </div>
                        <div id="hodPhotoPreview" style="display: none; margin-top: 0.8rem;">
                            <p style="font-size: 0.8rem; font-weight: 600; color: #475569; margin: 0 0 0.4rem;"><i class="fa-solid fa-eye" style="color: var(--color-primary); margin-right: 4px;"></i> New photo preview:</p>
                            <img id="hodPhotoPreviewImg" src="" alt="Preview" style="width: 100px; height: 125px; object-fit: cover; border-radius: 10px; border: 2px solid var(--color-primary); box-shadow: 0 4px 12px rgba(22,163,74,0.15);">
                        </div>
                    </div>
                </div>
            </div>

            {{-- HOD Name & Title --}}
            <div class="form-row" style="margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label><i class="fa-solid fa-user" style="color: #94a3b8;"></i> HOD Full Name</label>
                    <input type="text" name="hod_name" value="{{ $s('hod_name') }}" placeholder="e.g. Dr. John Smith">
                    <span class="hint">Leave blank to use the name from the Staff record.</span>
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-id-badge" style="color: #94a3b8;"></i> HOD Title / Rank</label>
                    <input type="text" name="hod_rank" value="{{ $s('hod_rank') }}" placeholder="e.g. Associate Professor">
                    <span class="hint">Leave blank to use the rank from the Staff record.</span>
                </div>
            </div>

            {{-- Welcome Message --}}
            <div class="form-group">
                <label><i class="fa-solid fa-quote-left" style="color: #94a3b8;"></i> Welcome Message</label>
                <textarea name="hod_welcome_message" rows="8" placeholder="Write the HOD's welcome message here...">{{ $s('hod_welcome_message', 'Welcome to the Department of Computer Science. We are committed to providing world-class computing education.') }}</textarea>
                <span class="hint"><i class="fa-solid fa-lightbulb" style="color: #f59e0b;"></i> Tip: Keep it between 2-4 sentences for best display. Line breaks are preserved.</span>
            </div>

            <div style="margin-top: 1rem; padding: 1rem; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                <p style="margin: 0 0 0.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;"><i class="fa-solid fa-link" style="color: var(--color-primary); margin-right: 4px;"></i> Related Settings</p>
                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Staff details can also be managed in <a href="{{ route('admin.staff.index') }}" style="color: var(--color-primary); font-weight: 600;">Staff Management</a>. Fields set here will override the Staff record on the homepage.</p>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: PROGRAMMES SECTION
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-programmes">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-graduation-cap" style="color: var(--color-primary);"></i>
                Programmes Section
                <span class="section-badge">Heading</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>Customize the heading area of the "Academic Programmes" section on the homepage. The actual programme cards are generated automatically from your <a href="{{ route('admin.programmes.index') }}" style="color: #1e40af; font-weight: 600;">Programmes data</a>.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Badge Text</label>
                    <input type="text" name="home_programmes_badge" value="{{ $s('home_programmes_badge', 'What We Offer') }}" placeholder="What We Offer">
                    <span class="hint">Small highlighted label above the title</span>
                </div>
                <div class="form-group">
                    <label>Section Title</label>
                    <input type="text" name="home_programmes_title" value="{{ $s('home_programmes_title', 'Academic Programmes') }}" placeholder="Academic Programmes">
                    <span class="hint">Main heading for this section</span>
                </div>
            </div>
            <div class="form-group">
                <label>Section Subtitle / Description</label>
                <textarea name="home_programmes_subtitle" rows="3" placeholder="A brief description of your academic offerings...">{{ $s('home_programmes_subtitle', 'Comprehensive undergraduate and postgraduate programmes designed to shape the next generation of global tech leaders.') }}</textarea>
                <span class="hint">Appears below the title. Keep it 1-2 sentences.</span>
            </div>

            <div style="margin-top: 1rem; padding: 1rem; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                <p style="margin: 0 0 0.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;"><i class="fa-solid fa-link" style="color: var(--color-primary); margin-right: 4px;"></i> Related Settings</p>
                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">The programme cards themselves are managed in <a href="{{ route('admin.programmes.index') }}" style="color: var(--color-primary); font-weight: 600;">Programmes</a>. Only active programmes are displayed.</p>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: STAFF SECTION
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-staff">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-users" style="color: var(--color-primary);"></i>
                Meet Our Staff Section
                <span class="section-badge">Heading</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>Customize the heading of the "Meet Our Faculty" section. The 4 most recent active staff members are shown automatically with their photos and links to their profiles.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Badge Text</label>
                    <input type="text" name="home_staff_badge" value="{{ $s('home_staff_badge', 'Our Team') }}" placeholder="Our Team">
                    <span class="hint">Small label above the title</span>
                </div>
                <div class="form-group">
                    <label>Section Title</label>
                    <input type="text" name="home_staff_title" value="{{ $s('home_staff_title', 'Meet Our Faculty') }}" placeholder="Meet Our Faculty">
                </div>
                <div class="form-group">
                    <label>Subtitle</label>
                    <textarea name="home_staff_subtitle" rows="2" placeholder="Short description...">{{ $s('home_staff_subtitle', 'Dedicated academics and researchers shaping the future of computer science education.') }}</textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>"View All" Button Text</label>
                    <input type="text" name="home_staff_btn_text" value="{{ $s('home_staff_btn_text', 'View All Staff') }}" placeholder="View All Staff">
                    <span class="hint">Label on the button below the staff cards</span>
                </div>
                <div class="form-group">
                    <label>Number of Staff Shown</label>
                    <input type="number" name="home_staff_count" value="{{ $s('home_staff_count', '4') }}" placeholder="4" min="1" max="12">
                    <span class="hint">How many featured staff cards to display (default: 4)</span>
                </div>
            </div>

            <div style="margin-top: 1rem; padding: 1rem; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                <p style="margin: 0 0 0.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;"><i class="fa-solid fa-link" style="color: var(--color-primary); margin-right: 4px;"></i> Related Settings</p>
                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Staff members are managed in <a href="{{ route('admin.staff.index') }}" style="color: var(--color-primary); font-weight: 600;">Staff Management</a>. The {{ $s('home_staff_count', '4') }} most recent active staff are displayed.</p>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: GALLERY SECTION
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-gallery">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-images" style="color: var(--color-primary);"></i>
                Gallery Showcase Section
                <span class="section-badge">Heading</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>Customize the heading of the dark "Gallery Showcase" section. The 8 most recent gallery images are displayed in a grid. This section only appears if gallery images exist.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Badge Text</label>
                    <input type="text" name="home_gallery_badge" value="{{ $s('home_gallery_badge', 'Photo Gallery') }}" placeholder="Photo Gallery">
                    <span class="hint">Small label above the title</span>
                </div>
                <div class="form-group">
                    <label>Section Title</label>
                    <input type="text" name="home_gallery_title" value="{{ $s('home_gallery_title', 'Department Life') }}" placeholder="Department Life">
                </div>
                <div class="form-group">
                    <label>Subtitle</label>
                    <textarea name="home_gallery_subtitle" rows="2" placeholder="Short description...">{{ $s('home_gallery_subtitle', 'Moments from events, lectures, and campus life') }}</textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>"View All" Link Text</label>
                    <input type="text" name="home_gallery_btn_text" value="{{ $s('home_gallery_btn_text', 'View All Photos') }}" placeholder="View All Photos">
                    <span class="hint">Link text next to the gallery heading</span>
                </div>
                <div class="form-group">
                    <label>Number of Images Shown</label>
                    <input type="number" name="home_gallery_count" value="{{ $s('home_gallery_count', '8') }}" placeholder="8" min="1" max="20">
                    <span class="hint">How many gallery images to show (default: 8)</span>
                </div>
            </div>

            <div style="margin-top: 1rem; padding: 1rem; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                <p style="margin: 0 0 0.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;"><i class="fa-solid fa-link" style="color: var(--color-primary); margin-right: 4px;"></i> Related Settings</p>
                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Gallery albums and images are managed in <a href="{{ route('admin.gallery.index') }}" style="color: var(--color-primary); font-weight: 600;">Gallery Management</a>. The latest {{ $s('home_gallery_count', '8') }} images are shown.</p>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: DEPARTMENT SYSTEMS
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-systems">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-globe" style="color: var(--color-primary);"></i>
                Department Systems Section
                <span class="section-badge">Heading</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>Customize the heading of the "Department Systems" section. This section shows all active external systems (LMS, portals, tools) as clickable cards. It only appears if external systems exist.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Badge Text</label>
                    <input type="text" name="home_systems_badge" value="{{ $s('home_systems_badge', 'Quick Access') }}" placeholder="Quick Access">
                    <span class="hint">Small label above the title</span>
                </div>
                <div class="form-group">
                    <label>Section Title</label>
                    <input type="text" name="home_systems_title" value="{{ $s('home_systems_title', 'Department Systems') }}" placeholder="Department Systems">
                </div>
                <div class="form-group">
                    <label>Subtitle</label>
                    <textarea name="home_systems_subtitle" rows="2" placeholder="Short description...">{{ $s('home_systems_subtitle', 'Access our online platforms, portals, and tools for students and staff.') }}</textarea>
                </div>
            </div>

            <div style="margin-top: 1rem; padding: 1rem; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                <p style="margin: 0 0 0.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;"><i class="fa-solid fa-link" style="color: var(--color-primary); margin-right: 4px;"></i> Related Settings</p>
                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">External systems are managed in <a href="{{ route('admin.external-systems.index') }}" style="color: var(--color-primary); font-weight: 600;">External Systems</a>. Active systems are shown automatically.</p>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: NEWS SECTION
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-news">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-newspaper" style="color: var(--color-primary);"></i>
                Latest News Section
                <span class="section-badge">Heading</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>Customize the heading area of the "Latest News" column on the homepage. The 3 most recent news articles are shown automatically.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Badge Text</label>
                    <input type="text" name="home_news_badge" value="{{ $s('home_news_badge', 'Stay Informed') }}" placeholder="Stay Informed">
                    <span class="hint">Small highlighted label above the title</span>
                </div>
                <div class="form-group">
                    <label>Section Title</label>
                    <input type="text" name="home_news_title" value="{{ $s('home_news_title', 'Latest News') }}" placeholder="Latest News">
                    <span class="hint">Main heading for the news column</span>
                </div>
                <div class="form-group">
                    <label>"View All" Button Text</label>
                    <input type="text" name="home_news_btn_text" value="{{ $s('home_news_btn_text', 'View All') }}" placeholder="View All">
                    <span class="hint">Text on the button linking to the full news page</span>
                </div>
            </div>

            <div style="margin-top: 1rem; padding: 1rem; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                <p style="margin: 0 0 0.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;"><i class="fa-solid fa-link" style="color: var(--color-primary); margin-right: 4px;"></i> Related Settings</p>
                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">News articles are managed in <a href="{{ route('admin.news.index') }}" style="color: var(--color-primary); font-weight: 600;">News Management</a>. The 3 most recent articles are displayed automatically.</p>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: EVENTS SECTION
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-events">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-calendar-days" style="color: var(--color-primary);"></i>
                Upcoming Events Section
                <span class="section-badge">Heading</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>Customize the heading area of the "Upcoming Events" sidebar on the homepage. Events are automatically pulled from your events data, showing the next 3 upcoming events.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Badge Text</label>
                    <input type="text" name="home_events_badge" value="{{ $s('home_events_badge', 'Calendar') }}" placeholder="Calendar">
                    <span class="hint">Small label above the title</span>
                </div>
                <div class="form-group">
                    <label>Section Title</label>
                    <input type="text" name="home_events_title" value="{{ $s('home_events_title', 'Upcoming Events') }}" placeholder="Upcoming Events">
                    <span class="hint">Main heading for the events sidebar</span>
                </div>
                <div class="form-group">
                    <label>"View Calendar" Button Text</label>
                    <input type="text" name="home_events_btn_text" value="{{ $s('home_events_btn_text', 'View Full Calendar') }}" placeholder="View Full Calendar">
                    <span class="hint">Text on the link at the bottom of the events sidebar</span>
                </div>
            </div>

            <div style="margin-top: 1rem; padding: 1rem; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                <p style="margin: 0 0 0.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;"><i class="fa-solid fa-link" style="color: var(--color-primary); margin-right: 4px;"></i> Related Settings</p>
                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Events are managed in <a href="{{ route('admin.events.index') }}" style="color: var(--color-primary); font-weight: 600;">Events Management</a>. Future events are shown automatically.</p>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: EXPLORE / QUICK LINKS
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-explore">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-compass" style="color: var(--color-primary);"></i>
                Discover More / Quick Links Section
                <span class="section-badge">Heading</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>This section displays quick-access cards linking to major pages: About, Academics, Staff, Blog, NACOS, Gallery, plus any active CMS pages you've created. Customize the heading text below.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Badge Text</label>
                    <input type="text" name="home_explore_badge" value="{{ $s('home_explore_badge', 'Explore') }}" placeholder="Explore">
                    <span class="hint">Small label above the title</span>
                </div>
                <div class="form-group">
                    <label>Section Title</label>
                    <input type="text" name="home_explore_title" value="{{ $s('home_explore_title', 'Discover More') }}" placeholder="Discover More">
                </div>
                <div class="form-group">
                    <label>Subtitle</label>
                    <input type="text" name="home_explore_subtitle" value="{{ $s('home_explore_subtitle', 'Everything you need to know about the department — all in one place.') }}" placeholder="Short description...">
                </div>
            </div>

            {{-- Quick Links Editor --}}
            <div style="margin-top: 1.5rem; padding: 1.2rem; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px;">
                <label style="font-size: 0.9rem; font-weight: 700; color: #334155; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;"><i class="fa-solid fa-link" style="color: var(--color-primary);"></i> Quick Link Cards (6 built-in)</label>
                <div class="help-tip" style="margin-bottom: 1rem;">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>Edit the labels, descriptions, icons, and URLs for each quick link card. Active CMS pages are added automatically after these. Leave both label and URL blank to hide a link.</span>
                </div>

                @php
                    $defaultLinks = [
                        ['icon' => 'fa-solid fa-building-columns', 'label' => 'About Us',      'desc' => 'Our history & vision', 'url' => '/about',        'color' => '#16a34a'],
                        ['icon' => 'fa-solid fa-graduation-cap',   'label' => 'Academics',     'desc' => 'Programmes & courses', 'url' => '/academics',    'color' => '#0891b2'],
                        ['icon' => 'fa-solid fa-users',            'label' => 'Our Staff',     'desc' => 'Faculty directory',    'url' => '/people',       'color' => '#7c3aed'],
                        ['icon' => 'fa-solid fa-newspaper',        'label' => 'Blog & News',   'desc' => 'Latest updates',       'url' => '/research-news','color' => '#ea580c'],
                        ['icon' => 'fa-solid fa-users',            'label' => 'NACOS',         'desc' => 'Contact & connect',    'url' => '/nacos-presidents','color' => '#dc2626'],
                        ['icon' => 'fa-solid fa-images',           'label' => 'Gallery',       'desc' => 'Photos & albums',      'url' => '/about#gallery','color' => '#ca8a04'],
                    ];
                @endphp

                @foreach($defaultLinks as $li => $dl)
                @php $qi = $li + 1; @endphp
                <div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 1rem; margin-bottom: {{ $qi < 6 ? '0.8rem' : '0' }}; background: white;">
                    <div style="display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.8rem;">
                        <div style="width: 28px; height: 28px; background: {{ $dl['color'] }}15; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: {{ $dl['color'] }}; font-size: 0.85rem;"><i class="{{ $s('home_qlink'.$qi.'_icon', $dl['icon']) }}"></i></div>
                        <span style="font-size: 0.85rem; font-weight: 700; color: #334155;">Quick Link #{{ $qi }}</span>
                    </div>
                    <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr 1fr;">
                        <div class="form-group">
                            <label>Label</label>
                            <input type="text" name="home_qlink{{ $qi }}_label" value="{{ $s('home_qlink'.$qi.'_label', $dl['label']) }}" placeholder="{{ $dl['label'] }}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="home_qlink{{ $qi }}_desc" value="{{ $s('home_qlink'.$qi.'_desc', $dl['desc']) }}" placeholder="{{ $dl['desc'] }}">
                        </div>
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" name="home_qlink{{ $qi }}_icon" value="{{ $s('home_qlink'.$qi.'_icon', $dl['icon']) }}" placeholder="{{ $dl['icon'] }}">
                        </div>
                        <div class="form-group">
                            <label>URL</label>
                            <input type="text" name="home_qlink{{ $qi }}_url" value="{{ $s('home_qlink'.$qi.'_url', $dl['url']) }}" placeholder="{{ $dl['url'] }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div style="margin-top: 1rem; padding: 1rem; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                <p style="margin: 0 0 0.5rem; font-size: 0.85rem; font-weight: 600; color: #475569;"><i class="fa-solid fa-link" style="color: var(--color-primary); margin-right: 4px;"></i> Additional Links</p>
                <p style="margin: 0; font-size: 0.82rem; color: #64748b;">Active <a href="{{ route('admin.pages.index') }}" style="color: var(--color-primary); font-weight: 600;">CMS Pages</a> are automatically appended after the 6 links above.</p>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: NACOS (redirect)
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-nacos">
    <div class="pc-card">
        <div class="pc-card-header open">
            <h3>
                <i class="fa-solid fa-users-rectangle" style="color: var(--color-primary);"></i>
                NACOS Section
                <span class="section-badge">Separate Editor</span>
            </h3>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>The NACOS section on the homepage has its own dedicated editor with full controls for the section header, about card, stats, CTA banner, and the Presidents page.</span>
            </div>
            <div style="text-align: center; padding: 2rem 1rem;">
                <div style="width: 64px; height: 64px; background: rgba(22,163,74,0.1); border-radius: 18px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem;">
                    <i class="fa-solid fa-users-rectangle" style="font-size: 1.6rem; color: var(--color-primary);"></i>
                </div>
                <h4 style="font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 0 0 0.5rem;">NACOS has its own editor</h4>
                <p style="color: #64748b; font-size: 0.9rem; max-width: 400px; margin: 0 auto 1.5rem; line-height: 1.6;">Manage all the NACOS homepage section content, stats, and the Presidents page settings from the dedicated NACOS editor.</p>
                <a href="{{ route('admin.page-content.show', 'nacos') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--color-primary); color: white; padding: 0.7rem 1.5rem; border-radius: 10px; font-size: 0.9rem; font-weight: 700; text-decoration: none; transition: all 0.2s; box-shadow: 0 4px 12px rgba(22,163,74,0.25);" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'">
                    <i class="fa-solid fa-arrow-right"></i> Open NACOS Editor
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: CALL TO ACTION
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-cta">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-paper-plane" style="color: var(--color-primary);"></i>
                Call to Action Banner
                <span class="section-badge">Heading</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>The green CTA banner at the bottom of the homepage. It features a title, subtitle, and buttons linking to Contact, About, and Programmes pages.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="home_cta_title" value="{{ $s('home_cta_title', 'Ready to Join Us?') }}" placeholder="Ready to Join Us?">
                    <span class="hint">Main headline for the CTA banner</span>
                </div>
                <div class="form-group">
                    <label>Subtitle</label>
                    <textarea name="home_cta_subtitle" rows="3" placeholder="Motivating message...">{{ $s('home_cta_subtitle', "Whether you're a prospective student, an alumnus, or just curious about the department — we'd love to hear from you.") }}</textarea>
                    <span class="hint">Supporting text shown below the title</span>
                </div>
            </div>

            {{-- CTA Buttons --}}
            <div style="margin-top: 1.5rem; padding: 1.2rem; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px;">
                <label style="font-size: 0.9rem; font-weight: 700; color: #334155; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;"><i class="fa-solid fa-link" style="color: var(--color-primary);"></i> CTA Buttons (up to 3)</label>
                <div class="help-tip" style="margin-bottom: 1rem;">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>Customize the button labels and URLs. Leave both fields blank to hide a button.</span>
                </div>

                @foreach([1,2,3] as $bi)
                @php
                    $defaultBtnLabels = ['Contact Us', 'About the Department', 'View Programmes'];
                    $defaultBtnUrls   = ['/contact', '/about', '/academics'];
                    $defaultBtnIcons  = ['fa-solid fa-envelope', 'fa-solid fa-circle-info', 'fa-solid fa-graduation-cap'];
                @endphp
                <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr; margin-bottom: {{ $bi < 3 ? '0.8rem' : '0' }};">
                    <div class="form-group">
                        <label>Button {{ $bi }} Text</label>
                        <input type="text" name="home_cta_btn{{ $bi }}_text" value="{{ $s('home_cta_btn'.$bi.'_text', $defaultBtnLabels[$bi-1]) }}" placeholder="{{ $defaultBtnLabels[$bi-1] }}">
                    </div>
                    <div class="form-group">
                        <label>Button {{ $bi }} URL</label>
                        <input type="text" name="home_cta_btn{{ $bi }}_url" value="{{ $s('home_cta_btn'.$bi.'_url', $defaultBtnUrls[$bi-1]) }}" placeholder="{{ $defaultBtnUrls[$bi-1] }}">
                    </div>
                    <div class="form-group">
                        <label>Button {{ $bi }} Icon</label>
                        <input type="text" name="home_cta_btn{{ $bi }}_icon" value="{{ $s('home_cta_btn'.$bi.'_icon', $defaultBtnIcons[$bi-1]) }}" placeholder="{{ $defaultBtnIcons[$bi-1] }}">
                        <span class="hint">Font Awesome class</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     STICKY SAVE BAR
     ══════════════════════════════════════ -->
<div style="position: sticky; bottom: 0; background: white; border-top: 1px solid #e2e8f0; padding: 1rem 1.5rem; margin: 1.5rem -1.5rem -1.5rem; display: flex; justify-content: space-between; align-items: center; z-index: 50; border-radius: 0 0 14px 14px; box-shadow: 0 -4px 20px rgba(0,0,0,0.05);">
    <div style="display: flex; align-items: center; gap: 1rem;">
        <span style="font-size: 0.85rem; color: #64748b;"><i class="fa-solid fa-circle-info" style="margin-right: 4px;"></i> Changes take effect immediately after saving.</span>
    </div>
    <div style="display: flex; gap: 0.8rem;">
        <a href="{{ route('home') }}" target="_blank" class="toolbar-btn toolbar-btn-preview" style="border: 1px solid #e2e8f0; color: #475569;">
            <i class="fa-solid fa-eye"></i> Preview
        </a>
        <button type="submit" class="toolbar-btn toolbar-btn-save" style="padding: 0.6rem 2rem; font-size: 0.95rem;">
            <i class="fa-solid fa-save"></i> Save Home Page
        </button>
    </div>
</div>

</form>

<!-- ══════════════════════════════════════
     QUICK-LINKS CARD (Below form)
     ══════════════════════════════════════ -->
<div style="margin-top: 2rem;">
    <div class="pc-card">
        <div class="pc-card-header" style="cursor: default;">
            <h3><i class="fa-solid fa-rocket" style="color: var(--color-primary);"></i> Quick Links — Manage Home Page Content</h3>
        </div>
        <div class="pc-card-body">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <a href="{{ route('admin.carousel.index') }}" style="padding: 1.2rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-decoration: none; color: inherit; transition: all 0.2s; display: flex; align-items: center; gap: 1rem;" onmouseover="this.style.borderColor='var(--color-primary)'; this.style.background='#f0fdf4'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #dbeafe, #eff6ff); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #3b82f6; font-size: 1.1rem;"><i class="fa-solid fa-images"></i></div>
                    <div>
                        <p style="margin: 0; font-weight: 700; color: #0f172a; font-size: 0.9rem;">Hero Carousel</p>
                        <p style="margin: 0; font-size: 0.78rem; color: #94a3b8;">Manage slides</p>
                    </div>
                </a>
                <a href="{{ route('admin.announcements.index') }}" style="padding: 1.2rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-decoration: none; color: inherit; transition: all 0.2s; display: flex; align-items: center; gap: 1rem;" onmouseover="this.style.borderColor='var(--color-primary)'; this.style.background='#f0fdf4'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #fef3c7, #fffbeb); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 1.1rem;"><i class="fa-solid fa-bullhorn"></i></div>
                    <div>
                        <p style="margin: 0; font-weight: 700; color: #0f172a; font-size: 0.9rem;">Announcements</p>
                        <p style="margin: 0; font-size: 0.78rem; color: #94a3b8;">Ticker bar content</p>
                    </div>
                </a>
                <a href="{{ route('admin.staff.index') }}" style="padding: 1.2rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-decoration: none; color: inherit; transition: all 0.2s; display: flex; align-items: center; gap: 1rem;" onmouseover="this.style.borderColor='var(--color-primary)'; this.style.background='#f0fdf4'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #e0e7ff, #eef2ff); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #6366f1; font-size: 1.1rem;"><i class="fa-solid fa-user-tie"></i></div>
                    <div>
                        <p style="margin: 0; font-weight: 700; color: #0f172a; font-size: 0.9rem;">Staff / HOD</p>
                        <p style="margin: 0; font-size: 0.78rem; color: #94a3b8;">HOD photo & details</p>
                    </div>
                </a>
                <a href="{{ route('admin.programmes.index') }}" style="padding: 1.2rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-decoration: none; color: inherit; transition: all 0.2s; display: flex; align-items: center; gap: 1rem;" onmouseover="this.style.borderColor='var(--color-primary)'; this.style.background='#f0fdf4'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #d1fae5, #ecfdf5); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #059669; font-size: 1.1rem;"><i class="fa-solid fa-graduation-cap"></i></div>
                    <div>
                        <p style="margin: 0; font-weight: 700; color: #0f172a; font-size: 0.9rem;">Programmes</p>
                        <p style="margin: 0; font-size: 0.78rem; color: #94a3b8;">Programme cards data</p>
                    </div>
                </a>
                <a href="{{ route('admin.news.index') }}" style="padding: 1.2rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-decoration: none; color: inherit; transition: all 0.2s; display: flex; align-items: center; gap: 1rem;" onmouseover="this.style.borderColor='var(--color-primary)'; this.style.background='#f0fdf4'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #fee2e2, #fef2f2); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.1rem;"><i class="fa-solid fa-newspaper"></i></div>
                    <div>
                        <p style="margin: 0; font-weight: 700; color: #0f172a; font-size: 0.9rem;">News</p>
                        <p style="margin: 0; font-size: 0.78rem; color: #94a3b8;">News articles</p>
                    </div>
                </a>
                <a href="{{ route('admin.events.index') }}" style="padding: 1.2rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-decoration: none; color: inherit; transition: all 0.2s; display: flex; align-items: center; gap: 1rem;" onmouseover="this.style.borderColor='var(--color-primary)'; this.style.background='#f0fdf4'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #fce7f3, #fdf2f8); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #ec4899; font-size: 1.1rem;"><i class="fa-solid fa-calendar-days"></i></div>
                    <div>
                        <p style="margin: 0; font-weight: 700; color: #0f172a; font-size: 0.9rem;">Events</p>
                        <p style="margin: 0; font-size: 0.78rem; color: #94a3b8;">Event listings</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// ── Section Tab Navigation ──
document.querySelectorAll('.section-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.section-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.section-panel').forEach(p => p.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('panel-' + this.dataset.section).classList.add('active');
    });
});

// ── Collapsible Sections ──
function toggleSection(header) {
    header.classList.toggle('open');
    const body = header.nextElementSibling;
    body.classList.toggle('collapsed');
}

// ── Live Icon Preview ──
function updateIconPreview(n, value) {
    const preview = document.getElementById('iconPreview' + n);
    if (preview) {
        preview.innerHTML = '<i class="' + value + '"></i>';
    }
}

// ── Icon Picker ──
function pickIcon(n, iconClass, el) {
    // Update hidden input
    document.getElementById('statIconInput' + n).value = iconClass;
    // Remove active from siblings
    el.parentElement.querySelectorAll('.icon-pick').forEach(t => t.classList.remove('icon-pick-active'));
    // Activate clicked
    el.classList.add('icon-pick-active');
}

// ── HOD Photo Preview ──
function previewHodPhoto(input) {
    const preview = document.getElementById('hodPhotoPreview');
    const img = document.getElementById('hodPhotoPreviewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}

// ── Auto-dismiss toast ──
document.addEventListener('DOMContentLoaded', function() {
    const toast = document.querySelector('.toast-success');
    if (toast) {
        setTimeout(() => toast.remove(), 4000);
    }
});
</script>
@endsection
