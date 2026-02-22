@extends('layouts.admin')
@section('title', 'About Page Content')
@section('header', 'About Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    $coreValues = json_decode($s('about_core_values', '[]'), true) ?? [];
    $facilities  = json_decode($s('about_facilities', '[]'), true) ?? [];
@endphp

<style>
.pc-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 1.5rem; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
.pc-card-header { padding: 1rem 1.5rem; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; cursor: pointer; user-select: none; }
.pc-card-header h3 { margin: 0; font-size: 1rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 0.6rem; }
.pc-card-body { padding: 1.5rem; display: block; }
.pc-card-body.collapsed { display: none; }
.form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; margin-bottom: 1rem; }
.form-group { display: flex; flex-direction: column; gap: 0.4rem; margin-bottom: 0.8rem; }
.form-group label { font-size: 0.85rem; font-weight: 600; color: #475569; }
.form-group input, .form-group textarea, .form-group select { width: 100%; padding: 0.6rem 0.9rem; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.95rem; color: #334155; box-sizing: border-box; transition: border-color 0.2s; }
.form-group input:focus, .form-group textarea:focus { outline: none; border-color: var(--color-primary); box-shadow: 0 0 0 3px rgba(22,163,74,0.1); }
.form-group textarea { resize: vertical; min-height: 80px; }
.toggle-icon { font-size: 0.8rem; color: #64748b; transition: transform 0.2s; }
.pc-card-header.open .toggle-icon { transform: rotate(180deg); }
.repeater-row { border: 1px solid #e2e8f0; border-radius: 10px; padding: 1rem; margin-bottom: 0.8rem; background: #fafafa; position: relative; }
.repeater-row .remove-btn { position: absolute; top: 0.6rem; right: 0.6rem; background: #fee2e2; color: #ef4444; border: none; border-radius: 6px; width: 28px; height: 28px; cursor: pointer; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; }
</style>

<div style="background: #1e293b; padding: 0.8rem 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
    <span style="color: #94a3b8; font-size: 0.9rem;"><i class="fa-solid fa-circle-info" style="margin-right: 6px;"></i>Editing: <strong style="color: white;">About Page</strong></span>
    <a href="{{ route('about') }}" target="_blank" style="background: var(--color-primary); color: white; padding: 0.4rem 1rem; border-radius: 8px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;"><i class="fa-solid fa-eye"></i> Preview</a>
</div>

<form method="POST" action="{{ route('admin.page-content.update', 'about') }}" enctype="multipart/form-data">
@csrf

{{-- ── HERO SECTION ── --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-image" style="color: var(--color-primary);"></i> Hero Section</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <div class="form-row">
            <div class="form-group">
                <label>Badge Text</label>
                <input type="text" name="about_hero_badge" value="{{ $s('about_hero_badge', 'About Us') }}">
            </div>
            <div class="form-group">
                <label>Hero Title</label>
                <input type="text" name="about_hero_title" value="{{ $s('about_hero_title', 'Excellence in Computing Education') }}">
            </div>
        </div>
        <div class="form-group">
            <label>Hero Subtitle</label>
            <textarea name="about_hero_subtitle" rows="2">{{ $s('about_hero_subtitle', 'Shaping the future through technology, research and innovation.') }}</textarea>
        </div>
        <div class="form-group">
            <label>Hero Background Image</label>
            @if($s('hero_about'))
            <div style="margin-bottom: 0.5rem;"><img src="{{ asset('storage/'.$s('hero_about')) }}" style="height: 80px; border-radius: 8px; object-fit: cover;"></div>
            @endif
            <input type="file" name="hero_about" accept="image/jpeg,image/png,image/webp">
        </div>
    </div>
</div>

{{-- ── INTRODUCTION ── --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-align-left" style="color: var(--color-primary);"></i> Introduction / Overview</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <div class="form-group">
            <label>Intro Title</label>
            <input type="text" name="about_intro_title" value="{{ $s('about_intro_title', 'About the Department') }}">
        </div>
        <div class="form-group">
            <label>Intro Body</label>
            <textarea name="about_intro_body" rows="6">{{ $s('about_intro_body') }}</textarea>
        </div>
    </div>
</div>

{{-- ── MISSION & VISION ── --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-bullseye" style="color: var(--color-primary);"></i> Mission & Vision</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <div class="form-row">
            <div class="form-group">
                <label>Mission Statement</label>
                <textarea name="about_mission" rows="4">{{ $s('about_mission') }}</textarea>
            </div>
            <div class="form-group">
                <label>Vision Statement</label>
                <textarea name="about_vision" rows="4">{{ $s('about_vision') }}</textarea>
            </div>
        </div>
    </div>
</div>

{{-- ── CORE VALUES ── --}}
<div class="pc-card">
    <div class="pc-card-header" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-star" style="color: var(--color-primary);"></i> Core Values</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body collapsed">
        <div id="coreValuesRepeater">
            @foreach($coreValues as $i => $cv)
            <div class="repeater-row" data-index="{{ $i }}">
                <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                <div class="form-row">
                    <div class="form-group">
                        <label>Icon (FA class)</label>
                        <input type="text" name="about_core_values[{{ $i }}][icon]" value="{{ $cv['icon'] ?? '' }}" placeholder="fa-solid fa-star">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="about_core_values[{{ $i }}][title]" value="{{ $cv['title'] ?? '' }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="about_core_values[{{ $i }}][description]" rows="2">{{ $cv['description'] ?? '' }}</textarea>
                </div>
            </div>
            @endforeach
        </div>
        <button type="button" onclick="addCoreValue()" style="background: #f0fdf4; border: 1px dashed var(--color-primary); color: var(--color-primary); padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.9rem; width: 100%; margin-top: 0.5rem;">
            <i class="fa-solid fa-plus"></i> Add Core Value
        </button>
    </div>
</div>

{{-- ── FACILITIES ── --}}
<div class="pc-card">
    <div class="pc-card-header" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-building" style="color: var(--color-primary);"></i> Facilities</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body collapsed">
        <div id="facilitiesRepeater">
            @foreach($facilities as $i => $f)
            <div class="repeater-row" data-index="{{ $i }}">
                <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                <div class="form-row">
                    <div class="form-group">
                        <label>Icon (FA class)</label>
                        <input type="text" name="about_facilities[{{ $i }}][icon]" value="{{ $f['icon'] ?? '' }}" placeholder="fa-solid fa-desktop">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="about_facilities[{{ $i }}][name]" value="{{ $f['name'] ?? '' }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="about_facilities[{{ $i }}][description]" rows="2">{{ $f['description'] ?? '' }}</textarea>
                </div>
            </div>
            @endforeach
        </div>
        <button type="button" onclick="addFacility()" style="background: #f0fdf4; border: 1px dashed var(--color-primary); color: var(--color-primary); padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.9rem; width: 100%; margin-top: 0.5rem;">
            <i class="fa-solid fa-plus"></i> Add Facility
        </button>
    </div>
</div>

{{-- ── HISTORY ── --}}
<div class="pc-card">
    <div class="pc-card-header" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-clock-rotate-left" style="color: var(--color-primary);"></i> Department History</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body collapsed">
        <div class="form-group">
            <label>History / Timeline Text</label>
            <textarea name="about_history" rows="8">{{ $s('about_history') }}</textarea>
        </div>
    </div>
</div>

{{-- SAVE --}}
<div style="display: flex; justify-content: flex-end; gap: 1rem; padding: 1rem 0;">
    <a href="{{ route('about') }}" target="_blank" class="btn btn-secondary">Preview</a>
    <button type="submit" class="btn" style="background: var(--color-primary); color: white; padding: 0.75rem 2rem; border: none; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer;">
        <i class="fa-solid fa-save"></i> Save About Page
    </button>
</div>
</form>

<script>
function toggleSection(header) {
    header.classList.toggle('open');
    header.nextElementSibling.classList.toggle('collapsed');
}

let cvIdx = {{ count($coreValues) }};
function addCoreValue() {
    const r = document.getElementById('coreValuesRepeater');
    r.insertAdjacentHTML('beforeend', `
      <div class="repeater-row">
        <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
        <div class="form-row">
          <div class="form-group"><label>Icon (FA class)</label><input type="text" name="about_core_values[${cvIdx}][icon]" placeholder="fa-solid fa-star"></div>
          <div class="form-group"><label>Title</label><input type="text" name="about_core_values[${cvIdx}][title]"></div>
        </div>
        <div class="form-group"><label>Description</label><textarea name="about_core_values[${cvIdx}][description]" rows="2"></textarea></div>
      </div>`);
    cvIdx++;
}

let facIdx = {{ count($facilities) }};
function addFacility() {
    const r = document.getElementById('facilitiesRepeater');
    r.insertAdjacentHTML('beforeend', `
      <div class="repeater-row">
        <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
        <div class="form-row">
          <div class="form-group"><label>Icon (FA class)</label><input type="text" name="about_facilities[${facIdx}][icon]" placeholder="fa-solid fa-desktop"></div>
          <div class="form-group"><label>Name</label><input type="text" name="about_facilities[${facIdx}][name]"></div>
        </div>
        <div class="form-group"><label>Description</label><textarea name="about_facilities[${facIdx}][description]" rows="2"></textarea></div>
      </div>`);
    facIdx++;
}
</script>
@endsection
