@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Academics Page Content')
@section('header', 'Academics Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    
    // Application Steps Fallback
    $applySteps = json_decode($s('academics_apply_steps', '[]'), true) ?? [];
    if (empty($applySteps)) {
        $applySteps = [
            ['title' => 'Check Requirements', 'desc' => 'Review the entry requirements for your desired programme under its details below.'],
            ['title' => 'University Portal', 'desc' => 'Visit the central NSUK admissions portal to purchase forms during the intake window.'],
            ['title' => 'Screening', 'desc' => 'Attend the departmental screening exercise with your credentials.']
        ];
    }

    $navSections = [
        'sec-hero'      => ['icon' => 'fa-image',          'label' => 'Hero',           'color' => '#6366f1'],
        'sec-overview'  => ['icon' => 'fa-layer-group',    'label' => 'Overview',       'color' => '#3b82f6'],
        'sec-apply'     => ['icon' => 'fa-clipboard-check','label' => 'How to Apply',   'color' => '#10b981'],
        'sec-courses'   => ['icon' => 'fa-diagram-project','label' => 'Courses Header', 'color' => '#ec4899'],
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
.apc-sidenav.is-fixed {
    position: fixed;
    top: 95px;
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
.apc-input, .apc-textarea {
    width: 100%; padding: 0.65rem 0.8rem; font-size: 0.9rem; font-family: inherit;
    border: 1px solid #cbd5e1; border-radius: 8px; background: #fff;
    transition: all 0.2s; box-sizing: border-box; color: #0f172a;
}
.apc-input:focus, .apc-textarea:focus { border-color: #3b82f6; outline: none; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
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

/* ── Repeater (JSON) ── */
.apc-repeater { display: flex; flex-direction: column; gap: 0.8rem; margin-bottom: 1rem; border: 1px solid #e2e8f0; border-radius: 10px; padding: 0.8rem; background: #f8fafc; }
.apc-rep-row { display: flex; gap: 0.8rem; align-items: flex-start; background: white; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px; position: relative; }
.apc-rep-row-content { flex: 1; min-width: 0; }
.apc-rep-num { font-size: 0.7rem; font-weight: 800; color: #cbd5e1; position: absolute; top: -8px; left: -8px; background: white; border: 1px solid #e2e8f0; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; border-radius: 50%; }
.apc-remove-btn { background: transparent; color: #ef4444; border: 1px dotted #fda4af; width: 28px; height: 28px; border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; }
.apc-remove-btn:hover { background: #fef2f2; border-style: solid; }
.apc-add-btn { background: white; border: 1px dashed #cbd5e1; color: #475569; width: 100%; padding: 0.6rem; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 0.5rem; transition: all 0.2s; }
.apc-add-btn:hover { border-color: #94a3b8; background: #f8fafc; color: #0f172a; }
.apc-subsection-title { font-size: 0.85rem; font-weight: 800; color: #334155; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.4rem; margin: 1.5rem 0 1rem; display: flex; justify-content: flex-start; align-items: center; gap: 0.5rem;}
</style>

<form action="{{ route('admin.page-content.update', 'academics') }}" method="POST" enctype="multipart/form-data">
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
                        <p class="apc-section-subtitle">Top banner text and background</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Badge Text</label>
                        <input class="apc-input" type="text" name="academics_hero_badge" value="{{ $s('academics_hero_badge', 'Explore Our Programs') }}" placeholder="Explore Our Programs">
                        <span class="apc-hint">Small label above the heading</span>
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Hero Title</label>
                        <input class="apc-input" type="text" name="academics_hero_title" value="{{ $s('academics_hero_title', 'Discover Academic Excellence') }}" placeholder="Discover Academic Excellence">
                    </div>
                </div>
                <div class="apc-field" style="margin-bottom: 0.9rem;">
                    <label class="apc-label">Hero Subtitle</label>
                    <textarea class="apc-textarea" name="academics_hero_subtitle" rows="2" placeholder="Rigorous computing programmes...">{{ $s('academics_hero_subtitle', 'Rigorous computing programmes designed to equip you with cutting-edge skills for the technology-driven world.') }}</textarea>
                </div>
                <div class="apc-field">
                    <label class="apc-label">Background Image</label>
                    @if($s('hero_academics'))
                    <img src="{{ asset('storage/'.$s('hero_academics')) }}" class="apc-img-preview" alt="Current hero">
                    @endif
                    <input class="apc-file" type="file" name="hero_academics" accept="image/jpeg,image/png,image/webp">
                    <span class="apc-hint">JPEG, PNG or WebP — recommended 1920×600px</span>
                </div>
            </div>
        </div>

        {{-- ── OVERVIEW SECTION (Degree Programmes) ── --}}
        <div class="apc-section" id="sec-overview">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #3b82f6;"><i class="fa-solid fa-layer-group"></i></div>
                    <div>
                        <p class="apc-section-title">Programme Overview</p>
                        <p class="apc-section-subtitle">Degree Programmes section introductory text</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body">
                <div class="apc-row" style="margin-bottom: 0.9rem;">
                    <div class="apc-field">
                        <label class="apc-label">Section Heading</label>
                        <input class="apc-input" type="text" name="academics_overview_title" value="{{ $s('academics_overview_title', 'Degree Programmes') }}" placeholder="Degree Programmes">
                    </div>
                </div>
                <div class="apc-field">
                    <label class="apc-label">Overview Description</label>
                    <textarea class="apc-textarea" name="academics_overview_desc" rows="3" placeholder="We offer rigorous academic paths...">{{ $s('academics_overview_desc', 'We offer rigorous academic paths ranging from undergraduate to doctoral studies, customized to meet global technology demands and equip our graduates with both theoretical depth and practical prowess.') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── HOW TO APPLY SECTION ── --}}
        <div class="apc-section" id="sec-apply">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #10b981;"><i class="fa-solid fa-clipboard-check"></i></div>
                    <div>
                        <p class="apc-section-title">How to Apply (Admission Process)</p>
                        <p class="apc-section-subtitle">Application steps and header text</p>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:0.6rem;">
                    <span style="background:#dcfce7; color:#065f46; font-size:0.7rem; font-weight:700; padding:0.2rem 0.6rem; border-radius:20px;">{{ count($applySteps) }} steps</span>
                    <i class="fa-solid fa-chevron-down apc-chevron"></i>
                </div>
            </div>
            <div class="apc-section-body">
                <div class="apc-row" style="margin-bottom: 1rem;">
                    <div class="apc-field">
                        <label class="apc-label">Badge Text</label>
                        <input class="apc-input" type="text" name="academics_apply_badge" value="{{ $s('academics_apply_badge', 'Admissions') }}" placeholder="Admissions">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Section Heading</label>
                        <input class="apc-input" type="text" name="academics_apply_title" value="{{ $s('academics_apply_title', 'How to Apply') }}" placeholder="How to Apply">
                    </div>
                </div>
                <div class="apc-field" style="margin-bottom: 1.25rem;">
                    <label class="apc-label">Section Subtitle</label>
                    <textarea class="apc-textarea" name="academics_apply_subtitle" rows="2" placeholder="Join our vibrant academic community...">{{ $s('academics_apply_subtitle', 'Join our vibrant academic community in three simple steps.') }}</textarea>
                </div>

                <div class="apc-subsection-title"><i class="fa-solid fa-list-ol"></i> Application Steps</div>
                <div class="apc-repeater" id="stepsRepeater">
                    @foreach($applySteps as $i => $step)
                    <div class="apc-rep-row">
                        <span class="apc-rep-num">{{ $i+1 }}</span>
                        <button type="button" class="apc-remove-btn" onclick="this.closest('.apc-rep-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                        <div class="apc-rep-row-content">
                            <div class="apc-field" style="margin-bottom:0.8rem;"><label class="apc-label">Step Title</label><input class="apc-input" type="text" name="academics_apply_steps[{{ $i }}][title]" value="{{ $step['title'] ?? '' }}"></div>
                            <div class="apc-field"><label class="apc-label">Description</label><textarea class="apc-textarea" name="academics_apply_steps[{{ $i }}][desc]" rows="2">{{ $step['desc'] ?? '' }}</textarea></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="apc-add-btn" onclick="addStep()"><i class="fa-solid fa-plus"></i> Add Another Step</button>
            </div>
        </div>

        {{-- ── COURSE STRUCTURE HEADER ── --}}
        <div class="apc-section" id="sec-courses">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: #ec4899;"><i class="fa-solid fa-diagram-project"></i></div>
                    <div>
                        <p class="apc-section-title">Course Structure</p>
                        <p class="apc-section-subtitle">Introductory text for the curriculum tables</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body">
                <div class="apc-row" style="margin-bottom: 0.9rem;">
                    <div class="apc-field">
                        <label class="apc-label">Section Heading</label>
                        <input class="apc-input" type="text" name="academics_courses_title" value="{{ $s('academics_courses_title', 'Course Structure') }}" placeholder="Course Structure">
                    </div>
                </div>
                <div class="apc-field">
                    <label class="apc-label">Description</label>
                    <textarea class="apc-textarea" name="academics_courses_desc" rows="3" placeholder="Browse the unified curriculum outline...">{{ $s('academics_courses_desc', 'Browse the unified curriculum outline showing core and elective courses across different academic levels.') }}</textarea>
                </div>
            </div>
        </div>

    </div>{{-- end .apc-main --}}
</div>{{-- end .apc-shell --}}

{{-- Floating Save Bar --}}
<div class="apc-save-bar">
    <button type="submit" class="apc-btn-save"><i class="fa-solid fa-floppy-disk"></i> Save Academics Content</button>
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

let stepIdx = {{ count($applySteps) }};

function addStep() {
    const list = document.getElementById('stepsRepeater');
    list.insertAdjacentHTML('beforeend', `
    <div class="apc-rep-row">
        <span class="apc-rep-num">${stepIdx+1}</span>
        <button type="button" class="apc-remove-btn" onclick="this.closest('.apc-rep-row').remove()"><i class="fa-solid fa-xmark"></i></button>
        <div class="apc-rep-row-content">
            <div class="apc-field" style="margin-bottom:0.8rem;"><label class="apc-label">Step Title</label><input class="apc-input" type="text" name="academics_apply_steps[${stepIdx}][title]"></div>
            <div class="apc-field"><label class="apc-label">Description</label><textarea class="apc-textarea" name="academics_apply_steps[${stepIdx}][desc]" rows="2"></textarea></div>
        </div>
    </div>`);
    stepIdx++;
    updateRepNums('stepsRepeater');
}

function updateRepNums(id) {
    document.querySelectorAll('#' + id + ' .apc-rep-row').forEach((row, i) => {
        row.querySelector('.apc-rep-num').innerText = i + 1;
    });
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
