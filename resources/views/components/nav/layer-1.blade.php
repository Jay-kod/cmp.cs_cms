@php
    $__topPhone = \App\Models\DepartmentSetting::getCached('contact_phone') ?? '+234 (0) 123 456 7890';
    $__topEmail = \App\Models\DepartmentSetting::getCached('contact_email') ?? 'info@dcms.nsuk.edu.ng';
    $__session  = \App\Models\DepartmentSetting::getCached('academic_session') ?? '2024/2025';
    $__semester = \App\Models\DepartmentSetting::getCached('academic_semester') ?? 'First';
@endphp
<div class="topbar">
    <div class="container topbar-inner">
        <div class="topbar-left flex items-center gap-2">
            <span class="topbar-badge text-[0.75rem]">{{ config('university.short_name') }}</span>
            <span class="topbar-divider desktop-only"></span>
            <span class="desktop-only topbar-faculty text-[0.75rem]">Faculty of Natural &amp; Applied Sciences</span>
            <span class="desktop-only mx-2.5 h-3.5 border-l border-white/20 block"></span>
            <span class="desktop-only text-[0.75rem] font-normal text-white"><i class="fa-solid fa-graduation-cap mr-1 text-[var(--color-primary-light,#fbbf24)]"></i> {{ $__session }} Session ({{ $__semester }} Semester)</span>
        </div>
        <div class="topbar-right flex items-center gap-4">
            <a href="tel:{{ preg_replace('/[^+0-9]/', '', $__topPhone) }}" class="topbar-link text-[0.75rem] font-normal flex items-center gap-1.5">
                <i class="fa-solid fa-phone-flip"></i>
                <span class="desktop-only">{{ $__topPhone }}</span>
            </a>
            <a href="mailto:{{ $__topEmail }}" class="topbar-link text-[0.75rem] font-normal flex items-center gap-1.5">
                <i class="fa-solid fa-envelope"></i>
                <span class="desktop-only">{{ $__topEmail }}</span>
            </a>
        </div>
    </div>
</div>
