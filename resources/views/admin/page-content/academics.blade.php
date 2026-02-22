@extends('layouts.admin')
@section('title', 'Academics Page Content')
@section('header', 'Academics Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    $steps = json_decode($s('academics_admission_steps', '[{"number":1,"title":"Check Requirements","description":""},{"number":2,"title":"University Portal","description":""},{"number":3,"title":"Screening","description":""}]'), true) ?? [];
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
.form-group input, .form-group textarea { width: 100%; padding: 0.6rem 0.9rem; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.95rem; color: #334155; box-sizing: border-box; transition: border-color 0.2s; }
.form-group input:focus, .form-group textarea:focus { outline: none; border-color: var(--color-primary); box-shadow: 0 0 0 3px rgba(22,163,74,0.1); }
.form-group textarea { resize: vertical; min-height: 80px; }
.toggle-icon { font-size: 0.8rem; color: #64748b; transition: transform 0.2s; }
.pc-card-header.open .toggle-icon { transform: rotate(180deg); }
.step-row { border: 1px solid #e2e8f0; border-radius: 10px; padding: 1rem; margin-bottom: 0.8rem; background: #fafafa; }
.step-row h4 { margin: 0 0 0.8rem; font-size: 0.9rem; color: #475569; font-weight: 700; }
</style>

<div style="background: #1e293b; padding: 0.8rem 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
    <span style="color: #94a3b8; font-size: 0.9rem;"><i class="fa-solid fa-graduation-cap" style="margin-right: 6px;"></i>Editing: <strong style="color: white;">Academics Page</strong></span>
    <a href="{{ route('academics') }}" target="_blank" style="background: var(--color-primary); color: white; padding: 0.4rem 1rem; border-radius: 8px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;"><i class="fa-solid fa-eye"></i> Preview</a>
</div>

<form method="POST" action="{{ route('admin.page-content.update', 'academics') }}" enctype="multipart/form-data">
@csrf

{{-- ── HERO ── --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-image" style="color: var(--color-primary);"></i> Hero Section</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <div class="form-row">
            <div class="form-group">
                <label>Badge Text</label>
                <input type="text" name="academics_hero_badge" value="{{ $s('academics_hero_badge', 'Explore Our Programs') }}">
            </div>
            <div class="form-group">
                <label>Hero Title</label>
                <input type="text" name="academics_hero_title" value="{{ $s('academics_hero_title', 'Discover Academic Excellence') }}">
            </div>
        </div>
        <div class="form-group">
            <label>Hero Subtitle</label>
            <textarea name="academics_hero_subtitle" rows="2">{{ $s('academics_hero_subtitle', 'Rigorous computing programmes designed to equip you with cutting-edge skills.') }}</textarea>
        </div>
        <div class="form-group">
            <label>Hero Background Image</label>
            @if($s('hero_academics'))
            <div style="margin-bottom: 0.5rem;"><img src="{{ asset('storage/'.$s('hero_academics')) }}" style="height: 80px; border-radius: 8px; object-fit: cover;"></div>
            @endif
            <input type="file" name="hero_academics" accept="image/jpeg,image/png,image/webp">
        </div>
    </div>
</div>

{{-- ── PAGE INTRO ── --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-align-left" style="color: var(--color-primary);"></i> Page Introduction Text</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <div class="form-group">
            <label>Introduction Paragraph</label>
            <textarea name="academics_intro" rows="4">{{ $s('academics_intro', 'We offer rigorous academic paths ranging from undergraduate to doctoral studies.') }}</textarea>
        </div>
    </div>
</div>

{{-- ── ADMISSION PROCESS ── --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-list-ol" style="color: var(--color-primary);"></i> Admission Process Steps</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        @foreach($steps as $i => $step)
        <div class="step-row">
            <h4>Step {{ $step['number'] ?? ($i + 1) }}</h4>
            <div class="form-row">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="academics_admission_steps[{{ $i }}][number]" value="{{ $step['number'] ?? ($i + 1) }}" type="hidden" style="display:none">
                    <input type="text" name="academics_admission_steps[{{ $i }}][title]" value="{{ $step['title'] ?? '' }}">
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="academics_admission_steps[{{ $i }}][description]" rows="2">{{ $step['description'] ?? '' }}</textarea>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ── COURSE STRUCTURE ── --}}
<div class="pc-card">
    <div class="pc-card-header" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-diagram-project" style="color: var(--color-primary);"></i> Course Structure Section</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body collapsed">
        <div class="form-group">
            <label>Intro Text below "Course Structure" heading</label>
            <textarea name="academics_course_structure_intro" rows="3">{{ $s('academics_course_structure_intro', 'Browse the unified curriculum outline showing core and elective courses across different academic levels.') }}</textarea>
        </div>
    </div>
</div>

{{-- SAVE --}}
<div style="display: flex; justify-content: flex-end; gap: 1rem; padding: 1rem 0;">
    <a href="{{ route('academics') }}" target="_blank" class="btn btn-secondary">Preview</a>
    <button type="submit" class="btn" style="background: var(--color-primary); color: white; padding: 0.75rem 2rem; border: none; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer;">
        <i class="fa-solid fa-save"></i> Save Academics Page
    </button>
</div>
</form>

<script>
function toggleSection(header) {
    header.classList.toggle('open');
    header.nextElementSibling.classList.toggle('collapsed');
}
</script>
@endsection
