@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Labs Page Content')
@section('header', 'Labs Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    $facilities  = json_decode($s('about_facilities', '[]'), true) ?? [];

    $navSections = [
        'sec-desc'  => ['icon' => 'fa-server',   'label' => 'Description', 'color' => '#6366f1'],
        'sec-fac'   => ['icon' => 'fa-building', 'label' => 'Facilities',  'color' => '#10b981'],
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

/* ── Save bar ── */
.apc-save-bar { position: sticky; bottom: 1rem; background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 0.9rem 1.25rem; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 8px 25px -5px rgba(0,0,0,0.1); margin-top: 1.25rem; z-index: 10; }
.apc-save-btn { background: linear-gradient(135deg, #059669, #10b981); color: white; border: none; padding: 0.65rem 2rem; border-radius: 9px; font-size: 0.9rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 12px rgba(16,185,129,0.35); transition: all 0.2s; }
.apc-save-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(16,185,129,0.45); }

/* Toast */
.toast-success { position: fixed; top: 1.5rem; right: 1.5rem; background: #065f46; color: white; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 600; font-size: 0.95rem; display: flex; align-items: center; gap: 0.6rem; z-index: 9999; box-shadow: 0 10px 40px rgba(0,0,0,0.2); animation: slideIn 0.4s ease, fadeOut 0.4s ease 3.5s forwards; }
@keyframes slideIn { from { transform: translateX(100%) scale(0.9); opacity: 0; } to { transform: translateX(0) scale(1); opacity: 1; } }
@keyframes fadeOut { to { transform: translateX(100%); opacity: 0; } }

.repeater-row { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 1.25rem; margin-bottom: 1rem; background: #fafafa; position: relative; }
.remove-btn { position: absolute; top: 0.75rem; right: 0.75rem; background: #fee2e2; color: #ef4444; border: none; border-radius: 6px; width: 30px; height: 30px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s; }
.remove-btn:hover { background: #fca5a5; color: #991b1b; }
.add-btn { background: #f0fdf4; border: 1px dashed #10b981; color: #10b981; padding: 0.75rem; border-radius: 10px; font-weight: 600; cursor: pointer; width: 100%; transition: all 0.2s; display: flex; justify-content: center; align-items: center; gap: 0.5rem; }
.add-btn:hover { background: #dcfce7; border-color: #059669; color: #059669; }
</style>

@if(session('success'))
<div class="toast-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
@endif

{{-- Top bar --}}
<div style="background: #0f172a; padding: 0.8rem 1.25rem; border-radius: 12px; margin-bottom: 1.25rem; margin-left: calc(190px + 1.5rem); display: flex; align-items: center; justify-content: space-between;">
    <div style="display: flex; align-items: center; gap: 0.7rem;">
        <div style="width: 8px; height: 8px; background: #06b6d4; border-radius: 50%;"></div>
        <span style="color: #94a3b8; font-size: 0.85rem;">Editing: <strong style="color: white;">Labs Page</strong></span>
    </div>
    <a href="{{ route('labs') }}" target="_blank" style="background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.4rem 1rem; border-radius: 8px; font-size: 0.82rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.1); display: inline-flex; align-items: center; gap: 0.4rem; transition: background 0.15s;" onmouseover="this.style.background='rgba(255,255,255,0.14)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
        <i class="fa-solid fa-up-right-from-square" style="font-size: 0.75rem;"></i> Preview Page
    </a>
</div>

<form action="{{ route('admin.page-content.update', $page ?? 'labs') }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

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

        {{-- ── DESCRIPTION SECTION ── --}}
        <div class="apc-section" id="sec-desc">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-desc']['color'] }};"><i class="fa-solid {{ $navSections['sec-desc']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Labs Description</p>
                        <p class="apc-section-subtitle">Overall intro text for the Labs section</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body">
                <div class="apc-field">
                    <label class="apc-label">Description</label>
                    <textarea class="apc-textarea" name="about_facilities_desc" rows="3">{{ $s('about_facilities_desc', 'Our department boasts state-of-the-art laboratories to support practical learning and research across various IT domains.') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── FACILITIES ── --}}
        <div class="apc-section" id="sec-fac">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-fac']['color'] }};"><i class="fa-solid {{ $navSections['sec-fac']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Facilities</p>
                        <p class="apc-section-subtitle">Manage laboratory listings</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div id="facilitiesRepeater">
                    @foreach($facilities as $i => $f)
                    <div class="repeater-row">
                        <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                        <div style="font-size: 0.8rem; font-weight: 800; color: #64748b; margin-bottom: 0.8rem;">FACILITY</div>
                        <div class="apc-row">
                            <div class="apc-field">
                                <label class="apc-label">Icon (FA class)</label>
                                <input class="apc-input" type="text" name="about_facilities[{{ $i }}][icon]" value="{{ $f['icon'] ?? '' }}" placeholder="fa-solid fa-desktop">
                            </div>
                            <div class="apc-field">
                                <label class="apc-label">Name</label>
                                <input class="apc-input" type="text" name="about_facilities[{{ $i }}][name]" value="{{ $f['name'] ?? '' }}">
                            </div>
                        </div>
                        <div class="apc-field">
                            <label class="apc-label">Description</label>
                            <textarea class="apc-textarea" name="about_facilities[{{ $i }}][description]" rows="2">{{ $f['description'] ?? '' }}</textarea>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="add-btn" onclick="addFacility()">
                    <i class="fa-solid fa-plus"></i> Add Facility
                </button>
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

// ── Repeater Logic ──
let facIdx = {{ count($facilities) }};
function addFacility() {
    const html = `
    <div class="repeater-row">
        <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div style="font-size: 0.8rem; font-weight: 800; color: #64748b; margin-bottom: 0.8rem;">FACILITY</div>
        <div class="apc-row">
            <div class="apc-field">
                <label class="apc-label">Icon (FA Class)</label>
                <input class="apc-input" type="text" name="about_facilities[${facIdx}][icon]" placeholder="fa-solid fa-desktop">
            </div>
            <div class="apc-field">
                <label class="apc-label">Lab Name</label>
                <input class="apc-input" type="text" name="about_facilities[${facIdx}][name]">
            </div>
        </div>
        <div class="apc-field">
            <label class="apc-label">Description</label>
            <textarea class="apc-textarea" name="about_facilities[${facIdx}][description]" rows="2"></textarea>
        </div>
    </div>`;
    document.getElementById('facilitiesRepeater').insertAdjacentHTML('beforeend', html);
    facIdx++;
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

// ── Auto-dismiss toast ──
document.addEventListener('DOMContentLoaded', function() {
    const toast = document.querySelector('.toast-success');
    if (toast) {
        setTimeout(() => toast.remove(), 4000);
    }
});
</script>
@endsection