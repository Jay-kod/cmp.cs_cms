@extends($adminLayout ?? 'layouts.admin')
@section('title', 'NACOS Page Content')
@section('header', 'NACOS Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
@endphp

<style>
/* ── Editor Chrome ── */
.editor-toolbar { 
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); 
    padding: 1.2rem 1.8rem; 
    border-radius: 16px; 
    margin-bottom: 2rem; 
    display: flex; 
    align-items: center; 
    justify-content: space-between; 
    flex-wrap: wrap; 
    gap: 1rem; 
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    border: 1px solid rgba(255,255,255,0.05);
    position: relative;
    overflow: hidden;
}
.editor-toolbar::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
}
.editor-toolbar .page-label { color: #cbd5e1; font-size: 0.95rem; display: flex; align-items: center; gap: 0.6rem; }
.editor-toolbar .page-label strong { color: white; font-size: 1.05rem; }
.editor-toolbar .toolbar-actions { display: flex; gap: 0.8rem; }
.toolbar-btn { padding: 0.5rem 1.2rem; border-radius: 10px; font-size: 0.88rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
.toolbar-btn-preview { background: rgba(255,255,255,0.05); color: #e2e8f0; border: 1px solid rgba(255,255,255,0.1); backdrop-filter: blur(4px); }
.toolbar-btn-preview:hover { background: rgba(255,255,255,0.1); color: white; transform: translateY(-1px); border-color: rgba(255,255,255,0.2); }
.toolbar-btn-save { background: linear-gradient(135deg, #16a34a, #059669); color: white; box-shadow: 0 4px 15px rgba(22,163,74,0.3); }
.toolbar-btn-save:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(22,163,74,0.4); }

/* ── Section Tabs ── */
.section-tabs { 
    display: flex; 
    gap: 0.35rem; 
    background: #f8fafc; 
    border-radius: 14px; 
    padding: 0.4rem; 
    margin-bottom: 2rem; 
    overflow-x: auto; 
    border: 1px solid #e2e8f0;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
}
.section-tab { 
    padding: 0.7rem 1.4rem; 
    border-radius: 10px; 
    font-size: 0.88rem; 
    font-weight: 600; 
    color: #64748b; 
    cursor: pointer; 
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
    white-space: nowrap; 
    display: flex; 
    align-items: center; 
    gap: 0.6rem; 
    border: none; 
    background: transparent; 
}
.section-tab:hover { color: #0f172a; background: rgba(0,0,0,0.03); }
.section-tab.active { 
    background: white; 
    color: var(--color-primary); 
    box-shadow: 0 4px 12px rgba(0,0,0,0.06); 
    border: 1px solid rgba(22,163,74,0.1);
}
.section-tab i { font-size: 0.85rem; }

/* ── Cards ── */
.pc-card { 
    background: white; 
    border-radius: 16px; 
    border: 1px solid #e2e8f0; 
    margin-bottom: 2rem; 
    overflow: hidden; 
    box-shadow: 0 4px 20px rgba(0,0,0,0.03); 
    transition: all 0.3s ease; 
}
.pc-card:hover { box-shadow: 0 10px 30px rgba(0,0,0,0.06); transform: translateY(-2px); border-color: #cbd5e1; }
.pc-card-header { 
    padding: 1.25rem 2rem; 
    background: linear-gradient(to right, #ffffff, #f8fafc); 
    border-bottom: 1px solid #e2e8f0; 
    display: flex; 
    align-items: center; 
    justify-content: space-between; 
    cursor: pointer; 
    user-select: none; 
    transition: background 0.2s; 
}
.pc-card-header:hover { background: #f8fafc; }
.pc-card-header h3 { margin: 0; font-size: 1.1rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 0.7rem; }
.pc-card-header .section-badge { 
    font-size: 0.7rem; 
    background: rgba(22,163,74,0.1); 
    color: var(--color-primary); 
    padding: 0.3rem 0.8rem; 
    border-radius: 20px; 
    font-weight: 700; 
    text-transform: uppercase; 
    letter-spacing: 0.5px; 
    border: 1px solid rgba(22,163,74,0.2);
}
.pc-card-body { padding: 2rem; display: block; animation: slideDown 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
.pc-card-body.collapsed { display: none; }
.toggle-icon { font-size: 0.9rem; color: #94a3b8; transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1); background: #f1f5f9; width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; }
.pc-card-header.open .toggle-icon { transform: rotate(180deg); background: rgba(22,163,74,0.1); color: var(--color-primary); }

/* ── Form Elements ── */
.form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem; }
.form-group { display: flex; flex-direction: column; gap: 0.5rem; }
.form-group label { font-size: 0.9rem; font-weight: 600; color: #334155; display: flex; align-items: center; gap: 0.5rem; }
.form-group label i { color: #64748b; font-size: 0.8rem; }
.form-group input, .form-group textarea, .form-group select { 
    width: 100%; 
    padding: 0.75rem 1rem; 
    border: 1.5px solid #e2e8f0; 
    border-radius: 12px; 
    font-family: inherit; 
    font-size: 0.95rem; 
    color: #0f172a; 
    box-sizing: border-box; 
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
    background: #f8fafc; 
}
.form-group input:hover, .form-group textarea:hover, .form-group select:hover { border-color: #cbd5e1; background: white; }
.form-group input:focus, .form-group textarea:focus, .form-group select:focus { 
    outline: none; 
    border-color: var(--color-primary); 
    background: white;
    box-shadow: 0 0 0 4px rgba(22,163,74,0.15); 
}
.form-group input::placeholder, .form-group textarea::placeholder { color: #94a3b8; }
.form-group textarea { resize: vertical; min-height: 100px; line-height: 1.5; }
.hint { font-size: 0.8rem; color: #64748b; margin-top: 0.3rem; line-height: 1.4; display: flex; gap: 0.4rem; }
.hint::before { content: '•'; color: #cbd5e1; }

/* ── Section Panel ── */
.section-panel { display: none; }
.section-panel.active { display: block; animation: slideRight 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
@keyframes slideRight { from { opacity: 0; transform: translateX(10px); } to { opacity: 1; transform: translateX(0); } }
@keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

/* ── Help Tip ── */
.help-tip { 
    background: linear-gradient(135deg, #eff6ff, #dbeafe); 
    border: 1px solid #bfdbfe; 
    border-radius: 12px; 
    padding: 1rem 1.4rem; 
    margin-bottom: 1.5rem; 
    display: flex; 
    align-items: flex-start; 
    gap: 0.8rem; 
    font-size: 0.9rem; 
    color: #1e40af; 
    line-height: 1.6; 
}
.help-tip i { margin-top: 0.2rem; font-size: 1.1rem; flex-shrink: 0; color: #3b82f6; }

/* ── Success Toast ── */
.toast-success { position: fixed; top: 1.5rem; right: 1.5rem; background: #065f46; color: white; padding: 1rem 1.5rem; border-radius: 14px; font-weight: 600; font-size: 0.95rem; display: flex; align-items: center; gap: 0.8rem; z-index: 9999; box-shadow: 0 10px 40px rgba(0,0,0,0.2); animation: slideIn 0.5s cubic-bezier(0.16, 1, 0.3, 1), fadeOut 0.4s ease 3.5s forwards; border: 1px solid rgba(255,255,255,0.1); }
@keyframes slideIn { from { transform: translateX(100%) scale(0.9); opacity: 0; } to { transform: translateX(0) scale(1); opacity: 1; } }
@keyframes fadeOut { to { transform: translateX(100%); opacity: 0; } }

/* ── Quick Link ── */
.quick-link-card { 
    display: flex; 
    align-items: center; 
    gap: 1.2rem; 
    padding: 1.2rem 1.5rem; 
    background: white; 
    border: 1px solid #e2e8f0; 
    border-radius: 16px; 
    text-decoration: none; 
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
    box-shadow: 0 2px 10px rgba(0,0,0,0.02);
}
.quick-link-card:hover { 
    border-color: var(--color-primary); 
    background: #f8fafc; 
    transform: translateY(-3px); 
    box-shadow: 0 8px 25px rgba(22,163,74,0.1);
}
.quick-link-card .ql-icon { 
    width: 46px; 
    height: 46px; 
    border-radius: 12px; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    font-size: 1.2rem; 
    flex-shrink: 0; 
}
.quick-link-card .ql-text { flex: 1; }
.quick-link-card .ql-text strong { display: block; font-size: 0.95rem; color: #0f172a; margin-bottom: 0.2rem; }
.quick-link-card .ql-text span { font-size: 0.8rem; color: #64748b; }

/* ── Inner Cards (Activities, Stats) ── */
.inner-card {
    border: 1px solid #e2e8f0; 
    border-radius: 14px; 
    padding: 1.5rem; 
    margin-bottom: 1.2rem; 
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    transition: all 0.2s;
}
.inner-card:hover { border-color: #cbd5e1; box-shadow: 0 4px 15px rgba(0,0,0,0.04); }
.inner-card-header {
    display: flex; 
    align-items: center; 
    gap: 0.8rem; 
    margin-bottom: 1rem;
    padding-bottom: 0.8rem;
    border-bottom: 1px dashed #e2e8f0;
}
.inner-card-number {
    width: 36px; 
    height: 36px; 
    background: linear-gradient(135deg, var(--color-primary), #059669); 
    color: white; 
    border-radius: 10px; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    font-size: 0.9rem; 
    font-weight: 800; 
    flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(22,163,74,0.2);
}
.inner-card-title { font-size: 1rem; color: #0f172a; margin: 0; font-weight: 700; }

/* ── Typography Helpers ── */
.section-heading-small {
    font-size: 0.95rem; 
    font-weight: 700; 
    color: #475569; 
    margin: 1.5rem 0 1rem; 
    display: flex; 
    align-items: center; 
    gap: 0.6rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.section-heading-small i { color: var(--color-primary); font-size: 1.1rem; }

/* ── Responsive ── */
@media (max-width: 768px) {
    .section-tabs { flex-wrap: nowrap; overflow-x: auto; -webkit-overflow-scrolling: touch; padding: 0.5rem; }
    .form-row { grid-template-columns: 1fr; gap: 1rem; }
    .editor-toolbar { flex-direction: column; text-align: center; padding: 1.5rem; }
    .pc-card-header, .pc-card-body { padding: 1.25rem; }
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
        <i class="fa-solid fa-users-rectangle"></i>
        Editing: <strong>NACOS Section</strong>
        <span style="color: #475569; font-size: 0.8rem; margin-left: 0.5rem;">Customize the NACOS section on the homepage & NACOS pages</span>
    </div>
    <div class="toolbar-actions">
        <a href="{{ route('home') }}" target="_blank" class="toolbar-btn toolbar-btn-preview">
            <i class="fa-solid fa-external-link"></i> Preview Live
        </a>
        <a href="{{ route('admin.nacos-presidents.index') }}" class="toolbar-btn toolbar-btn-preview">
            <i class="fa-solid fa-crown"></i> Manage Presidents
        </a>
        <button type="submit" form="nacosPageForm" class="toolbar-btn toolbar-btn-save">
            <i class="fa-solid fa-save"></i> Save Changes
        </button>
    </div>
</div>

<!-- ══════════════════════════════════════
     SECTION TABS
     ══════════════════════════════════════ -->
<div class="section-tabs" id="sectionTabs">
    <button type="button" class="section-tab active" data-section="homepage"><i class="fa-solid fa-house"></i> Homepage Section</button>
    <button type="button" class="section-tab" data-section="about"><i class="fa-solid fa-circle-info"></i> About Card</button>
    <button type="button" class="section-tab" data-section="stats"><i class="fa-solid fa-chart-bar"></i> Stats</button>
    <button type="button" class="section-tab" data-section="cta"><i class="fa-solid fa-arrow-right"></i> CTA</button>
    <button type="button" class="section-tab" data-section="page-about"><i class="fa-solid fa-file-lines"></i> Page: About</button>
    <button type="button" class="section-tab" data-section="page-activities"><i class="fa-solid fa-laptop-code"></i> Page: Activities</button>
    <button type="button" class="section-tab" data-section="page-cta"><i class="fa-solid fa-paper-plane"></i> Page: CTA</button>
    <button type="button" class="section-tab" data-section="presidents"><i class="fa-solid fa-crown"></i> Presidents</button>
    <button type="button" class="section-tab" data-section="official-site"><i class="fa-solid fa-globe"></i> Official Website</button>
</div>

<form method="POST" id="nacosPageForm" action="{{ route('admin.page-content.update', 'nacos') }}" enctype="multipart/form-data">
@csrf

<!-- ══════════════════════════════════════
     PANEL: HOMEPAGE SECTION HEADER
     ══════════════════════════════════════ -->
<div class="section-panel active" id="panel-homepage">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-house" style="color: var(--color-primary);"></i>
                Homepage Section Header
                <span class="section-badge">Hero Area</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>This controls the NACOS spotlight section that appears on the homepage. The section features a dark background with the association info, past leaders, and stats.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fa-solid fa-tag"></i> Badge Text</label>
                    <input type="text" name="home_nacos_badge" value="{{ $s('home_nacos_badge', 'Student Association') }}" placeholder="Student Association">
                    <span class="hint">Small label above the title (e.g. "Student Association")</span>
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-heading"></i> Section Title</label>
                    <input type="text" name="home_nacos_title" value="{{ $s('home_nacos_title', 'NACOS') }}" placeholder="NACOS">
                    <span class="hint">Main heading — typically "NACOS" or the full name</span>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label><i class="fa-solid fa-align-left"></i> Section Subtitle</label>
                <textarea name="home_nacos_subtitle" rows="2" placeholder="Brief description of NACOS...">{{ $s('home_nacos_subtitle', 'The National Association of Computing Students (NUK Chapter) — empowering students through leadership, innovation and community.') }}</textarea>
                <span class="hint">Appears below the title. Keep it 1-2 sentences.</span>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: ABOUT CARD
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-about">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-circle-info" style="color: var(--color-primary);"></i>
                About NACOS Card
                <span class="section-badge">Left Column</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>This card appears on the left side of the NACOS homepage section. It provides a quick overview of what NACOS is about.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fa-solid fa-heading"></i> Card Title</label>
                    <input type="text" name="home_nacos_about_title" value="{{ $s('home_nacos_about_title', 'About NACOS') }}" placeholder="About NACOS">
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-tag"></i> Tag Line</label>
                    <input type="text" name="home_nacos_about_tag" value="{{ $s('home_nacos_about_tag', 'NUK Chapter') }}" placeholder="NUK Chapter">
                    <span class="hint">Small text below the title (e.g. chapter name)</span>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label><i class="fa-solid fa-paragraph"></i> About Text</label>
                <textarea name="home_nacos_about_text" rows="4" placeholder="Describe what NACOS is and does...">{{ $s('home_nacos_about_text', 'NACOS is the umbrella body for all computing students. We foster academic excellence, professional development, and social bonds among members through events, workshops, competitions, and community service.') }}</textarea>
                <span class="hint">Main description paragraph. Aim for 2-3 sentences.</span>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: STATS
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-stats">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-chart-bar" style="color: var(--color-primary);"></i>
                NACOS Statistics
                <span class="section-badge">3 Stats</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>These stats appear in the bottom-left of the NACOS homepage section. The first stat ("Past Leaders") is automatically counted from your NACOS Presidents records. Stats 2 and 3 are manually set.</span>
            </div>

            {{-- Stat 1: Auto-counted --}}
            <div class="inner-card">
                <div class="inner-card-header">
                    <div class="inner-card-number">1</div>
                    <h4 class="inner-card-title">Past Leaders <span style="font-weight: 400; color: #94a3b8;">(auto-counted)</span></h4>
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-font"></i> Label</label>
                    <input type="text" name="home_nacos_stat1_label" value="{{ $s('home_nacos_stat1_label', 'Past Leaders') }}" placeholder="Past Leaders">
                    <span class="hint">The value for this stat is automatically counted from your NACOS Presidents records.</span>
                </div>
            </div>

            {{-- Stat 2: Events Hosted --}}
            <div class="inner-card">
                <div class="inner-card-header">
                    <div class="inner-card-number">2</div>
                    <h4 class="inner-card-title">Stat #2</h4>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fa-solid fa-hashtag"></i> Value</label>
                        <input type="text" name="home_nacos_stat2_value" value="{{ $s('home_nacos_stat2_value', '50+') }}" placeholder="50+">
                        <span class="hint">The number to display (e.g. "50+", "1000", "20+")</span>
                    </div>
                    <div class="form-group">
                        <label><i class="fa-solid fa-font"></i> Label</label>
                        <input type="text" name="home_nacos_stat2_label" value="{{ $s('home_nacos_stat2_label', 'Events Hosted') }}" placeholder="Events Hosted">
                    </div>
                </div>
            </div>

            {{-- Stat 3: Active Members --}}
            <div class="inner-card">
                <div class="inner-card-header">
                    <div class="inner-card-number">3</div>
                    <h4 class="inner-card-title">Stat #3</h4>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fa-solid fa-hashtag"></i> Value</label>
                        <input type="text" name="home_nacos_stat3_value" value="{{ $s('home_nacos_stat3_value', '500+') }}" placeholder="500+">
                    </div>
                    <div class="form-group">
                        <label><i class="fa-solid fa-font"></i> Label</label>
                        <input type="text" name="home_nacos_stat3_label" value="{{ $s('home_nacos_stat3_label', 'Active Members') }}" placeholder="Active Members">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: CTA
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-cta">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-arrow-right" style="color: var(--color-primary);"></i>
                Call-to-Action Banner
                <span class="section-badge">Bottom Banner</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>This CTA banner appears at the bottom of the NACOS section on the homepage. It encourages visitors to explore the full NACOS Presidents page.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fa-solid fa-heading"></i> CTA Title</label>
                    <input type="text" name="home_nacos_cta_title" value="{{ $s('home_nacos_cta_title', 'Explore NACOS History') }}" placeholder="Explore NACOS History">
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-align-left"></i> CTA Description</label>
                    <input type="text" name="home_nacos_cta_desc" value="{{ $s('home_nacos_cta_desc', 'See all past leaders, their tenure and achievements') }}" placeholder="See all past leaders...">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: PAGE ABOUT
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-page-about">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-file-lines" style="color: var(--color-primary);"></i>
                About NACOS Section (Public Page)
                <span class="section-badge">Page Content</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>This controls the "About NACOS" section on the public NACOS page including the description text, stats, and mission/vision/values cards.</span>
            </div>

            <h4 class="section-heading-small"><i class="fa-solid fa-paragraph"></i> About Text</h4>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label><i class="fa-solid fa-heading"></i> Section Title</label>
                <input type="text" name="nacos_page_about_title" value="{{ $s('nacos_page_about_title', 'About NACOS') }}" placeholder="About NACOS">
            </div>
            <div class="form-group" style="margin-bottom: 1rem;">
                <label><i class="fa-solid fa-align-left"></i> First Paragraph</label>
                <textarea name="nacos_page_about_text" rows="3" placeholder="Main description...">{{ $s('nacos_page_about_text', 'The National Association of Computing Students (NACOS) is the umbrella body for all students studying computing-related disciplines. Our NUK Chapter is dedicated to fostering academic excellence, professional development, and strong social bonds among members.') }}</textarea>
            </div>
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label><i class="fa-solid fa-align-left"></i> Second Paragraph</label>
                <textarea name="nacos_page_about_text2" rows="3" placeholder="Additional description...">{{ $s('nacos_page_about_text2', 'Through workshops, hackathons, seminars, and community outreach, NACOS prepares students for the ever-evolving tech industry while building a supportive network that extends well beyond graduation.') }}</textarea>
            </div>

            <h4 class="section-heading-small"><i class="fa-solid fa-chart-bar"></i> Page Stats (Stat 2-4, Stat 1 is auto-counted)</h4>

            <div class="form-row" style="margin-bottom: 1rem;">
                <div class="form-group">
                    <label>Stat 2: Value</label>
                    <input type="text" name="nacos_page_stat_events" value="{{ $s('nacos_page_stat_events', '50+') }}" placeholder="50+">
                </div>
                <div class="form-group">
                    <label>Stat 2: Label</label>
                    <input type="text" name="nacos_page_stat_events_label" value="{{ $s('nacos_page_stat_events_label', 'Events Hosted') }}" placeholder="Events Hosted">
                </div>
            </div>
            <div class="form-row" style="margin-bottom: 1rem;">
                <div class="form-group">
                    <label>Stat 3: Value</label>
                    <input type="text" name="nacos_page_stat_members" value="{{ $s('nacos_page_stat_members', '500+') }}" placeholder="500+">
                </div>
                <div class="form-group">
                    <label>Stat 3: Label</label>
                    <input type="text" name="nacos_page_stat_members_label" value="{{ $s('nacos_page_stat_members_label', 'Active Members') }}" placeholder="Active Members">
                </div>
            </div>
            <div class="form-row" style="margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label>Stat 4: Value</label>
                    <input type="text" name="nacos_page_stat_awards" value="{{ $s('nacos_page_stat_awards', '20+') }}" placeholder="20+">
                </div>
                <div class="form-group">
                    <label>Stat 4: Label</label>
                    <input type="text" name="nacos_page_stat_awards_label" value="{{ $s('nacos_page_stat_awards_label', 'Awards Won') }}" placeholder="Awards Won">
                </div>
            </div>

            <h4 class="section-heading-small"><i class="fa-solid fa-bullseye"></i> Mission / Vision / Values Cards</h4>

            @foreach([['num' => 1, 'default_title' => 'Our Mission', 'default_text' => 'To promote academic excellence, advance computing knowledge, and nurture future tech leaders through hands-on learning, mentorship, and industry collaboration.'], ['num' => 2, 'default_title' => 'Our Vision', 'default_text' => 'To be the foremost student body shaping innovative, ethical, and globally competitive computing professionals in Nigeria and beyond.'], ['num' => 3, 'default_title' => 'Our Values', 'default_text' => 'Innovation, integrity, collaboration, inclusivity, and continuous learning form the bedrock of everything we do as an association.']] as $card)
            <div class="inner-card">
                <div class="inner-card-header">
                    <div class="inner-card-number">{{ $card['num'] }}</div>
                    <strong class="inner-card-title">Card #{{ $card['num'] }}</strong>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="nacos_page_pillar{{ $card['num'] }}_title" value="{{ $s('nacos_page_pillar'.$card['num'].'_title', $card['default_title']) }}" placeholder="{{ $card['default_title'] }}">
                    </div>
                    <div class="form-group">
                        <label>Text</label>
                        <textarea name="nacos_page_pillar{{ $card['num'] }}_text" rows="2" placeholder="Description...">{{ $s('nacos_page_pillar'.$card['num'].'_text', $card['default_text']) }}</textarea>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: PAGE ACTIVITIES
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-page-activities">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-laptop-code" style="color: var(--color-primary);"></i>
                Activities Section (Public Page)
                <span class="section-badge">6 Cards</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>Customize the 6 activity cards shown in the "What We Do" section on the public NACOS page.</span>
            </div>

            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label><i class="fa-solid fa-heading"></i> Section Title</label>
                <input type="text" name="nacos_page_activities_title" value="{{ $s('nacos_page_activities_title', 'Our Activities') }}" placeholder="Our Activities">
            </div>

            @foreach([
                ['num' => 1, 'title' => 'Hackathons & Coding Contests', 'desc' => 'Regular programming competitions that test skills and encourage creative problem-solving among members.'],
                ['num' => 2, 'title' => 'Workshops & Seminars', 'desc' => 'Industry-led training sessions on trending technologies like AI, cloud computing, and cybersecurity.'],
                ['num' => 3, 'title' => 'Mentorship Programme', 'desc' => 'Pairing junior students with senior peers and alumni for academic guidance and career advice.'],
                ['num' => 4, 'title' => 'Community Service', 'desc' => 'Giving back through IT literacy drives, school outreach, and digital empowerment projects.'],
                ['num' => 5, 'title' => 'Social & Sports Events', 'desc' => 'Building bonds beyond the classroom with get-togethers, game nights, and inter-departmental sports.'],
                ['num' => 6, 'title' => 'Annual NACOS Week', 'desc' => 'A week-long celebration with talks, exhibitions, awards, and cultural events showcasing computing talent.'],
            ] as $act)
            <div class="inner-card">
                <div class="inner-card-header">
                    <div class="inner-card-number">{{ $act['num'] }}</div>
                    <strong class="inner-card-title">Activity #{{ $act['num'] }}</strong>
                </div>
                <div class="form-row" style="margin-bottom: 0;">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="nacos_act{{ $act['num'] }}_title" value="{{ $s('nacos_act'.$act['num'].'_title', $act['title']) }}" placeholder="{{ $act['title'] }}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="nacos_act{{ $act['num'] }}_desc" value="{{ $s('nacos_act'.$act['num'].'_desc', $act['desc']) }}" placeholder="{{ $act['desc'] }}">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: PAGE CTA
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-page-cta">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-paper-plane" style="color: var(--color-primary);"></i>
                Page CTA Banner
                <span class="section-badge">Bottom</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>This green CTA bar at the bottom of the NACOS page encourages visitors to get in touch or go back home.</span>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label><i class="fa-solid fa-heading"></i> CTA Title</label>
                    <input type="text" name="nacos_page_cta_title" value="{{ $s('nacos_page_cta_title', 'Want to Know More?') }}" placeholder="Want to Know More?">
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-align-left"></i> CTA Subtitle</label>
                    <input type="text" name="nacos_page_cta_subtitle" value="{{ $s('nacos_page_cta_subtitle', 'Reach out to us for questions, collaborations, or if you want to get involved with NACOS.') }}" placeholder="Reach out to us...">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: PRESIDENTS
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-presidents">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-crown" style="color: var(--color-primary);"></i>
                Presidents Grid Section
                <span class="section-badge">Leaders</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>Customize the headings for the "Past Leaders" grid section on the public NACOS page.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fa-solid fa-heading"></i> Section Title</label>
                    <input type="text" name="nacos_page_leaders_title" value="{{ $s('nacos_page_leaders_title', 'Past NACOS Presidents') }}" placeholder="Past NACOS Presidents">
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-align-left"></i> Section Subtitle</label>
                    <input type="text" name="nacos_page_leaders_subtitle" value="{{ $s('nacos_page_leaders_subtitle', 'Honoring the visionaries who led our chapter and shaped its legacy.') }}" placeholder="Honoring the visionaries...">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label><i class="fa-solid fa-paragraph"></i> Intro Text (Optional)</label>
                <textarea name="nacos_presidents_intro" rows="3" placeholder="An optional introductory paragraph displayed above the leaders grid...">{{ $s('nacos_presidents_intro', '') }}</textarea>
                <span class="hint">If set, this will appear as a paragraph above the presidents grid.</span>
            </div>

            <h4 class="section-heading-small">
                <i class="fa-solid fa-link"></i> Quick Actions
            </h4>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.8rem;">
                <a href="{{ route('admin.nacos-presidents.index') }}" class="quick-link-card">
                    <div class="ql-icon" style="background: rgba(22,163,74,0.1); color: var(--color-primary);"><i class="fa-solid fa-crown"></i></div>
                    <div class="ql-text">
                        <strong>Manage Presidents</strong>
                        <span>Add, edit, or remove records</span>
                    </div>
                </a>
                <a href="{{ route('nacos-presidents') }}" target="_blank" class="quick-link-card">
                    <div class="ql-icon" style="background: rgba(8,145,178,0.1); color: #0891b2;"><i class="fa-solid fa-eye"></i></div>
                    <div class="ql-text">
                        <strong>View Public Page</strong>
                        <span>See what visitors see</span>
                    </div>
                </a>
                <a href="{{ route('home') }}#nacos" target="_blank" class="quick-link-card">
                    <div class="ql-icon" style="background: rgba(124,58,237,0.1); color: #7c3aed;"><i class="fa-solid fa-house"></i></div>
                    <div class="ql-text">
                        <strong>View on Homepage</strong>
                        <span>See the NACOS section live</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════
     PANEL: OFFICIAL WEBSITE
     ══════════════════════════════════════ -->
<div class="section-panel" id="panel-official-site">
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3>
                <i class="fa-solid fa-globe" style="color: var(--color-primary);"></i>
                Major NACOS Website Link
                <span class="section-badge">External Link</span>
            </h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="help-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>This adds a prominent button linking to the Major/Official NACOS Website in the hero banner of the public Presidents page. If left blank, the button will not be displayed.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fa-solid fa-link"></i> Website URL</label>
                    <input type="url" name="nacos_official_website_url" value="{{ $s('nacos_official_website_url', '') }}" placeholder="https://nacos.org.ng">
                    <span class="hint">The full web address, e.g. https://nacos.org.ng</span>
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-tag"></i> Button Label</label>
                    <input type="text" name="nacos_official_website_label" value="{{ $s('nacos_official_website_label', 'Visit Major NACOS Website') }}" placeholder="Visit Major NACOS Website">
                    <span class="hint">The text displayed on the button</span>
                </div>
            </div>
        </div>
    </div>
</div>

</form>

<script>
// ── Tab Switching ──
document.querySelectorAll('.section-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.section-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.section-panel').forEach(p => p.classList.remove('active'));
        this.classList.add('active');
        const panel = document.getElementById('panel-' + this.dataset.section);
        if (panel) panel.classList.add('active');
    });
});

// ── Toggle Collapse ──
function toggleSection(header) {
    header.classList.toggle('open');
    const body = header.nextElementSibling;
    body.classList.toggle('collapsed');
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
