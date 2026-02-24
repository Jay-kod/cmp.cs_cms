@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Faculty & People Page Content')
@section('header', 'Faculty & People Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
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
</style>

<div style="background: #1e293b; padding: 0.8rem 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
    <span style="color: #94a3b8; font-size: 0.9rem;"><i class="fa-solid fa-circle-info" style="margin-right: 6px;"></i>Editing: <strong style="color: white;">Faculty & People Page</strong></span>
    <a href="{{ route('people.index') }}" target="_blank" style="background: var(--color-primary); color: white; padding: 0.4rem 1rem; border-radius: 8px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;"><i class="fa-solid fa-eye"></i> Preview</a>
</div>

<form method="POST" action="{{ route('admin.page-content.update', 'people') }}" enctype="multipart/form-data">
@csrf

<div class="pc-card">
    <div class="pc-card-header open">
        <h3><i class="fa-solid fa-image" style="color: var(--color-primary);"></i> Hero Section</h3>
    </div>
    <div class="pc-card-body">
        <div class="form-group">
            <label>Hero Title</label>
            <input type="text" name="people_hero_title" value="{{ $s('people_hero_title', 'Our People') }}">
        </div>
        <div class="form-group">
            <label>Hero Subtitle (Optional)</label>
            <textarea name="people_hero_subtitle" rows="2">{{ $s('people_hero_subtitle', '') }}</textarea>
        </div>
        <div class="form-group">
            <label>Hero Background Image</label>
            @if($s('hero_people'))
            <div style="margin-bottom: 0.5rem;"><img src="{{ asset('storage/'.$s('hero_people')) }}" style="height: 80px; border-radius: 8px; object-fit: cover;"></div>
            @endif
            <input type="file" name="hero_people" accept="image/jpeg,image/png,image/webp">
        </div>
    </div>
</div>

<div style="display: flex; justify-content: flex-end; gap: 1rem; padding: 1rem 0;">
    <button type="submit" class="btn" style="background: var(--color-primary); color: white; padding: 0.75rem 2rem; border: none; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer;">
        <i class="fa-solid fa-save"></i> Save Page Content
    </button>
</div>
</form>
@endsection
