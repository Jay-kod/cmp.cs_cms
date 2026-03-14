@php
    $__topPhone = \App\Models\DepartmentSetting::where('key', 'contact_phone')->value('value') ?? '+234 (0) 123 456 7890';
    $__topEmail = \App\Models\DepartmentSetting::where('key', 'contact_email')->value('value') ?? 'info@dcms.nsuk.edu.ng';
@endphp
<div class="topbar">
    <div class="container topbar-inner">
        <div class="topbar-left">
            <span class="topbar-badge">{{ config('university.short_name') }}</span>
            <span class="topbar-divider desktop-only"></span>
            <span class="desktop-only topbar-faculty">Faculty of Natural &amp; Applied Sciences</span>
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
