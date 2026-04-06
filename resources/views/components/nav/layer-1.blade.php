@php
    $__topPhone = \App\Models\DepartmentSetting::getCached('contact_phone') ?? '+234 (0) 123 456 7890';
    $__topEmail = \App\Models\DepartmentSetting::getCached('contact_email') ?? 'info@dcms.nsuk.edu.ng';
    $__session  = \App\Models\DepartmentSetting::getCached('academic_session') ?? '2024/2025';
    $__semester = \App\Models\DepartmentSetting::getCached('academic_semester') ?? 'First';
@endphp
<div class="topbar">
    <div class="container topbar-inner">
        <div class="topbar-left">
            <span class="topbar-badge">{{ config('university.short_name') }}</span>
            <span class="topbar-divider desktop-only"></span>
            <span class="desktop-only topbar-faculty">Faculty of Natural &amp; Applied Sciences</span>
            <span class="topbar-divider desktop-only" style="margin: 0 10px; border-left: 1px solid rgba(255,255,255,0.2); height: 16px;"></span>
            <span class="desktop-only" style="font-size: 0.85rem; font-weight: 500; color: #fff;"><i class="fa-solid fa-graduation-cap" style="margin-right: 4px; color: var(--color-primary-light, #fbbf24);"></i> {{ $__session }} Session ({{ $__semester }} Semester)</span>
        </div>
        <div class="topbar-right">
            <a href="tel:{{ preg_replace('/[^+0-9]/', '', $__topPhone) }}" class="topbar-link">
                <i class="fa-solid fa-phone-flip"></i>
                <span class="desktop-only">{{ $__topPhone }}</span>
            </a>
            <a href="mailto:{{ $__topEmail }}" class="topbar-link">
                <i class="fa-solid fa-envelope"></i>
                <span class="desktop-only">{{ $__topEmail }}</span>
            </a>
        </div>
    </div>
</div>
