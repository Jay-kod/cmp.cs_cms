@extends('layouts.admin')
@section('title', 'Contact & NACOS Page Content')
@section('header', 'Contact & NACOS Page Editor')

@section('content')
@php $s = fn(string $key, string $default = '') => $settings[$key] ?? $default; @endphp

<style>
.pc-card{background:white;border-radius:12px;border:1px solid #e2e8f0;margin-bottom:1.5rem;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04)}
.pc-card-header{padding:1rem 1.5rem;background:#f8fafc;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;cursor:pointer;user-select:none}
.pc-card-header h3{margin:0;font-size:1rem;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:.6rem}
.pc-card-body{padding:1.5rem}
.pc-card-body.collapsed{display:none}
.form-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:1rem;margin-bottom:1rem}
.form-group{display:flex;flex-direction:column;gap:.4rem;margin-bottom:.8rem}
.form-group label{font-size:.85rem;font-weight:600;color:#475569}
.form-group input,.form-group textarea{width:100%;padding:.6rem .9rem;border:1px solid #cbd5e1;border-radius:8px;font-family:inherit;font-size:.95rem;color:#334155;box-sizing:border-box}
.form-group textarea{resize:vertical;min-height:80px}
.toggle-icon{font-size:.8rem;color:#64748b;transition:transform .2s}
.pc-card-header.open .toggle-icon{transform:rotate(180deg)}
</style>

<div style="background:#1e293b;padding:.8rem 1.5rem;border-radius:12px;margin-bottom:1.5rem;display:flex;align-items:center;justify-content:space-between">
    <span style="color:#94a3b8;font-size:.9rem"><i class="fa-solid fa-address-book" style="margin-right:6px"></i>Editing: <strong style="color:white">Contact & NACOS Page</strong></span>
    <a href="{{ route('contact-alumni') }}" target="_blank" style="background:var(--color-primary);color:white;padding:.4rem 1rem;border-radius:8px;font-size:.85rem;font-weight:600;text-decoration:none"><i class="fa-solid fa-eye"></i> Preview</a>
</div>

<form method="POST" action="{{ route('admin.page-content.update', 'contact') }}" enctype="multipart/form-data">@csrf

{{-- HERO --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-image" style="color:var(--color-primary)"></i> Hero Section</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <div class="form-row">
            <div class="form-group"><label>Badge Text</label><input type="text" name="contact_hero_badge" value="{{ $s('contact_hero_badge','Connect With Us') }}"></div>
            <div class="form-group"><label>Hero Title</label><input type="text" name="contact_hero_title" value="{{ $s('contact_hero_title','Contact & NACOS') }}"></div>
        </div>
        <div class="form-group"><label>Hero Subtitle</label><textarea name="contact_hero_subtitle" rows="2">{{ $s('contact_hero_subtitle','We\'d love to hear from you. Whether you are a student, alumnus, or partner, let\'s start a conversation.') }}</textarea></div>
        <div class="form-group">
            <label>Hero Background Image</label>
            @if($s('hero_contact'))<div style="margin-bottom:.5rem"><img src="{{ asset('storage/'.$s('hero_contact')) }}" style="height:80px;border-radius:8px;object-fit:cover"></div>@endif
            <input type="file" name="hero_contact" accept="image/jpeg,image/png,image/webp">
        </div>
    </div>
</div>

{{-- CONTACT INFO --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-phone" style="color:var(--color-primary)"></i> Contact Information</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <div class="form-group"><label>Address</label><textarea name="contact_address" rows="2">{{ $s('contact_address') }}</textarea></div>
        <div class="form-row">
            <div class="form-group"><label>Email Address</label><input type="email" name="contact_email" value="{{ $s('contact_email') }}" placeholder="dept@university.edu.ng"></div>
            <div class="form-group"><label>Phone Number</label><input type="text" name="contact_phone" value="{{ $s('contact_phone') }}" placeholder="+234 ..."></div>
        </div>
    </div>
</div>

{{-- NACOS SECTION --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-users" style="color:var(--color-primary)"></i> NACOS Section</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <div class="form-group"><label>NACOS Section Intro</label><textarea name="contact_nacos_intro" rows="3">{{ $s('contact_nacos_intro','Meet our department association leaders and join our growing network of computing professionals.') }}</textarea></div>
        <div class="form-group"><label>NACOS CTA Button Text</label><input type="text" name="contact_nacos_cta_text" value="{{ $s('contact_nacos_cta_text','View NACOS Network') }}"></div>
    </div>
</div>

{{-- PARTNERSHIP CTA --}}
<div class="pc-card">
    <div class="pc-card-header" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-handshake" style="color:var(--color-primary)"></i> Partnership / CTA Section</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body collapsed">
        <div class="form-group"><label>Partnership Section Title</label><input type="text" name="partnership_title" value="{{ $s('partnership_title','Partner With Us') }}"></div>
        <div class="form-group"><label>Partnership Section Subtitle</label><textarea name="partnership_subtitle" rows="2">{{ $s('partnership_subtitle','Collaborate with our department for research, internships, and industry partnerships.') }}</textarea></div>
    </div>
</div>

<div style="display:flex;justify-content:flex-end;gap:1rem;padding:1rem 0">
    <a href="{{ route('contact-alumni') }}" target="_blank" class="btn btn-secondary">Preview</a>
    <button type="submit" class="btn" style="background:var(--color-primary);color:white;padding:.75rem 2rem;border:none;border-radius:10px;font-weight:700;font-size:1rem;cursor:pointer"><i class="fa-solid fa-save"></i> Save Contact Page</button>
</div>
</form>

<script>
function toggleSection(h){h.classList.toggle('open');h.nextElementSibling.classList.toggle('collapsed')}
</script>
@endsection
