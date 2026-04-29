@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Admissions Page Content')
@section('header', 'Admissions Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    
    $navSections = [
        'sec-hero'       => ['icon' => 'fa-image',          'label' => 'Hero Banner',     'color' => '#6366f1'],
        'sec-status'     => ['icon' => 'fa-door-open',      'label' => 'Admission Status','color' => '#f59e0b'],
        'sec-subjects'   => ['icon' => 'fa-file-pdf',       'label' => 'Subject Combinations', 'color' => '#8b5cf6'],
        'sec-programmes' => ['icon' => 'fa-clipboard-check','label' => 'Requirements',    'color' => '#ec4899'],
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
    align-self: flex-start;
    max-height: calc(100vh - 110px);
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: thin;
    scrollbar-color: #e2e8f0 transparent;
    z-index: 40;
}
.apc-sidenav.is-fixed { position: fixed; top: 95px; }
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
    display: flex; align-items: center; gap: 0.6rem; padding: 0.6rem 1rem;
    font-size: 0.82rem; font-weight: 500; color: #475569; text-decoration: none;
    border-left: 3px solid transparent; transition: all 0.15s;
}
.apc-sidenav a:hover { background: #f8fafc; color: #0f172a; }
.apc-sidenav a.active { background: #f0f9ff; color: #0284c7; border-left-color: #0284c7; font-weight: 600; }
.apc-sidenav-icon { width: 22px; height: 22px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; flex-shrink: 0; }

/* ── Main form area ── */
.apc-main { flex: 1; min-width: 0; }

/* ── Section cards ── */
.apc-section {
    background: white; border-radius: 14px; border: 1px solid #e2e8f0;
    margin-bottom: 1.25rem; box-shadow: 0 1px 4px rgba(0,0,0,0.03);
    overflow: hidden; scroll-margin-top: 90px;
}
.apc-section-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1rem 1.25rem; cursor: pointer; user-select: none;
    background: #fafafa; border-bottom: 1px solid #f1f5f9; gap: 0.8rem;
}
.apc-section-header:hover { background: #f8fafc; }
.apc-section-header-left { display: flex; align-items: center; gap: 0.9rem; }
.apc-section-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.1rem; flex-shrink: 0; }
.apc-section-title { margin: 0; font-size: 1.05rem; font-weight: 700; color: #1e293b; }
.apc-section-subtitle { margin: 0; font-size: 0.75rem; color: #64748b; margin-top: 0.1rem; }
.apc-chevron { color: #94a3b8; transition: transform 0.3s; font-size: 0.85rem; padding: 0.4rem; }
.apc-section-header.open .apc-chevron { transform: rotate(180deg); }
.apc-section-body { padding: 1.5rem 1.25rem; display: block; }
.apc-section-body.collapsed { display: none; }

/* ── Forms ── */
.apc-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 0.9rem; }
@media(max-width: 800px) { .apc-row { grid-template-columns: 1fr; } }
.apc-field { display: flex; flex-direction: column; gap: 0.4rem; margin-bottom: 0.9rem; }
.apc-label { font-size: 0.8rem; font-weight: 700; color: #475569; display: flex; align-items: center; justify-content: space-between; }
.apc-hint { font-size: 0.7rem; color: #94a3b8; font-weight: 400; margin-top: -0.2rem; }
.apc-input, .apc-textarea, .apc-select {
    width: 100%; padding: 0.65rem 0.8rem; font-size: 0.9rem; font-family: inherit;
    border: 1px solid #cbd5e1; border-radius: 8px; background: #fff;
    transition: all 0.2s; box-sizing: border-box; color: #0f172a;
}
.apc-input:focus, .apc-textarea:focus, .apc-select:focus { border-color: #3b82f6; outline: none; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
.apc-file { font-size: 0.82rem; }
.apc-img-preview { max-width: 140px; border-radius: 6px; border: 1px solid #e2e8f0; margin-bottom: 0.5rem; }

/* ── Save Bar ── */
.apc-save-bar {
    background: white; border-top: 1px solid #e2e8f0; padding: 1rem 2rem;
    display: flex; justify-content: flex-end; align-items: center;
    position: sticky; bottom: 0; z-index: 50;
    box-shadow: 0 -4px 12px rgba(0,0,0,0.03);
    margin: 1.5rem -2rem -2rem -2rem;
}
.apc-btn-save {
    background: #0f172a; color: white; border: none; padding: 0.7rem 1.5rem;
    font-size: 0.9rem; font-weight: 600; border-radius: 8px; cursor: pointer;
    display: inline-flex; align-items: center; gap: 0.5rem; transition: background 0.2s;
}
.apc-btn-save:hover { background: #1e293b; }

/* ── Read-only Panels ── */
.apc-info-panel {
    background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 1.25rem;
    display: flex; gap: 1rem; align-items: flex-start;
}
.apc-info-icon {
    width: 40px; height: 40px; border-radius: 8px; background: #e0e7ff; color: #4f46e5;
    display: flex; items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; margin-top: 0.2rem;
}
.apc-info-content h4 { margin: 0 0 0.4rem 0; font-size: 1rem; font-weight: 700; color: #1e293b; }
.apc-info-content p { margin: 0 0 1rem 0; font-size: 0.9rem; color: #475569; line-height: 1.5; }
.apc-info-btn {
    display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1rem;
    background: white; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.85rem;
    font-weight: 600; color: #334155; text-decoration: none; transition: all 0.2s;
}
.apc-info-btn:hover { background: #f1f5f9; border-color: #94a3b8; color: #0f172a; }
</style>

<form action="{{ route('admin.page-content.update', 'admissions') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="apc-shell">
    {{-- Left Navigation --}}
    <nav class="apc-sidenav" id="apcSidenav">
        <div class="apc-sidenav-head">Page Sections</div>
        @foreach($navSections as $id => $nav)
            <a href="#{{ $id }}" onclick="smoothScrollTo('{{ $id }}', this); return false;">
                <div class="apc-sidenav-icon" style="color: {{ $nav['color'] }}; background: {{ $nav['color'] }}15;">
                    <i class="fa-solid {{ $nav['icon'] }}"></i>
                </div>
                {{ $nav['label'] }}
            </a>
        @endforeach
    </nav>

    {{-- Main Content Window --}}
    <div class="apc-main">

        {{-- ── HERO SECTION ── --}}
        <div class="apc-section" id="sec-hero">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #6366f1;"><i class="fa-solid fa-image"></i></div>
                    <div>
                        <p class="apc-section-title">Hero Section</p>
                        <p class="apc-section-subtitle">Top banner image and background</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body">
                <div class="apc-field">
                    <label class="apc-label">Background Image</label>
                    @if($s('hero_admissions'))
                    <img src="{{ asset('storage/'.$s('hero_admissions')) }}" class="apc-img-preview" alt="Current hero">
                    @endif
                    <input class="apc-file" type="file" name="hero_admissions" accept="image/jpeg,image/png,image/webp">
                    <span class="apc-hint">JPEG, PNG or WebP — recommended 1920×600px</span>
                </div>
            </div>
        </div>

        {{-- ── ADMISSION STATUS ── --}}
        <div class="apc-section" id="sec-status">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #f59e0b;"><i class="fa-solid fa-door-open"></i></div>
                    <div>
                        <p class="apc-section-title">Admission Status</p>
                        <p class="apc-section-subtitle">Toggle whether admissions are currently open</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body">
                <div class="apc-field">
                    <label class="apc-label">Current Admission Status</label>
                    <select class="apc-select" name="admission_status">
                        <option value="open" {{ $s('admission_status', 'open') === 'open' ? 'selected' : '' }}>🟢 Open - Accepting Applications</option>
                        <option value="closed" {{ $s('admission_status') === 'closed' ? 'selected' : '' }}>🔴 Closed - Not Currently Enrolling</option>
                    </select>
                    <span class="apc-hint">This updates the badge displayed in the hero section across the site.</span>
                </div>
            </div>
        </div>

        {{-- ── SUBJECT COMBINATIONS ── --}}
        <div class="apc-section" id="sec-subjects">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #8b5cf6;"><i class="fa-solid fa-file-pdf"></i></div>
                    <div>
                        <p class="apc-section-title">Subject Combinations</p>
                        <p class="apc-section-subtitle">Upload the official subject combinations PDF</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body">
                <div class="apc-field">
                    <label class="apc-label">Upload PDF</label>
                    @if($s('admissions_subject_combination_pdf'))
                    <div style="margin-bottom: 0.5rem;">
                        <a href="{{ asset('storage/'.$s('admissions_subject_combination_pdf')) }}" target="_blank" style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 0.85rem; font-weight: 600; color: #334155; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                            <i class="fa-solid fa-file-pdf" style="color: #ef4444;"></i> View Current PDF
                        </a>
                    </div>
                    @endif
                    <input class="apc-file" type="file" name="admissions_subject_combination_pdf" accept="application/pdf">
                    <span class="apc-hint">Upload a PDF document. This will be available for students to download on the Admissions page.</span>
                </div>
            </div>
        </div>

        {{-- ── ENTRY REQUIREMENTS (Delegated) ── --}}
        <div class="apc-section" id="sec-programmes">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #ec4899;"><i class="fa-solid fa-clipboard-check"></i></div>
                    <div>
                        <p class="apc-section-title">Entry Requirements</p>
                        <p class="apc-section-subtitle">UTME and Direct Entry Requirements</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body">
                <div class="apc-info-panel">
                    <div class="apc-info-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                    <div class="apc-info-content">
                        <h4>Programmes & Requirements</h4>
                        <p>
                            Entry requirements (UTME and Direct Entry) are managed dynamically through the Programmes directory. 
                            The Admissions page automatically displays the requirements for all active academic programmes.
                            To add, edit, or update admission requirements, please manage them directly in the Programmes module.
                        </p>
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.programmes.index') : route('super-admin.programmes.index') }}" class="apc-info-btn">
                            <i class="fa-solid fa-link"></i> Manage Programmes
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- end .apc-main --}}
</div>{{-- end .apc-shell --}}

{{-- Floating Save Bar --}}
<div class="apc-save-bar">
    <button type="submit" class="apc-btn-save"><i class="fa-solid fa-floppy-disk"></i> Save Admissions Content</button>
</div>

</form>

<script>
function toggleSection(header) {
    header.classList.toggle('open');
    header.nextElementSibling.classList.toggle('collapsed');
}

function smoothScrollTo(id, linkElem) {
    document.querySelectorAll('.apc-sidenav a').forEach(a => a.classList.remove('active'));
    linkElem.classList.add('active');
    
    const target = document.getElementById(id);
    if(target) {
        const offset = 85; 
        const y = target.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({top: y, behavior: 'smooth'});
        
        // ensure it's open
        const header = target.querySelector('.apc-section-header');
        if(header && !header.classList.contains('open')) { toggleSection(header); }
    }
}

// Intercept form submit to show a loading state
document.querySelector('form').addEventListener('submit', function(e) {
    const btn = this.querySelector('.apc-btn-save');
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Saving...';
    btn.style.opacity = '0.8';
    btn.style.pointerEvents = 'none';
});
</script>
@endsection
