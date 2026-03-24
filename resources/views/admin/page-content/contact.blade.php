@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Contact Page Content')
@section('header', 'Contact Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    $faqsJson = $s('contact_faqs', '');
    $faqs = $faqsJson ? json_decode($faqsJson, true) : [];
    if (!$faqs || !is_array($faqs)) {
        $faqs = [
            ['q' => 'How do I apply for admission into the department?', 'a' => 'Visit the university\'s admission portal at the start of each academic session. Select Computer Science as your preferred course and follow the application steps.'],
            ['q' => 'What are the requirements for admission?', 'a' => 'You need at least 5 O\'Level credits including Mathematics and English Language, plus a minimum UTME score as set by JAMB for the session.'],
            ['q' => 'Can I visit the department in person?', 'a' => 'Yes! Our offices are open Monday to Friday, 8 AM – 4 PM. We recommend scheduling an appointment for specific inquiries.'],
            ['q' => 'How can I get my transcript or academic records?', 'a' => 'Visit the department\'s administrative office with a formal request letter. Processing typically takes 2-4 weeks.'],
        ];
    }
    $keyContactsJson = $s('contact_key_contacts', '');
    $keyContacts = $keyContactsJson ? json_decode($keyContactsJson, true) : [];
    if (!$keyContacts || !is_array($keyContacts)) {
        $keyContacts = [
            ['role' => 'Head of Department', 'name' => 'Dr. Example Name', 'email' => 'hod@cs.nsuk.edu.ng', 'phone' => '+234 800 000 0001'],
            ['role' => 'Departmental Secretary', 'name' => 'Mrs. Example Name', 'email' => 'secretary@cs.nsuk.edu.ng', 'phone' => '+234 800 000 0002'],
            ['role' => 'Exam Officer', 'name' => 'Mr. Example Name', 'email' => 'exams@cs.nsuk.edu.ng', 'phone' => '+234 800 000 0003'],
        ];
    }

    $navSections = [
        'sec-hero'    => ['icon' => 'fa-image',          'label' => 'Hero Section', 'color' => '#6366f1'],
        'sec-cards'   => ['icon' => 'fa-id-card',        'label' => 'Info Cards',   'color' => '#ec4899'],
        'sec-form'    => ['icon' => 'fa-pen-to-square',  'label' => 'Form Text',    'color' => '#10b981'],
        'sec-about'   => ['icon' => 'fa-building-columns','label' => 'About Sidebar', 'color' => '#8b5cf6'],
        'sec-partner' => ['icon' => 'fa-handshake',      'label' => 'Partnership',  'color' => '#06b6d4'],
        'sec-map'     => ['icon' => 'fa-map-location-dot','label' => 'Map Settings','color' => '#f59e0b'],
        'sec-vis'     => ['icon' => 'fa-eye',            'label' => 'Visibility',   'color' => '#64748b'],
        'sec-contacts'=> ['icon' => 'fa-user-tie',       'label' => 'Key Contacts', 'color' => '#ef4444'],
        'sec-faqs'    => ['icon' => 'fa-circle-question','label' => 'FAQs',         'color' => '#a855f7'],
        'sec-quick'   => ['icon' => 'fa-bolt',           'label' => 'Quick Actions','color' => '#3b82f6'],
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
.apc-field { display: flex; flex-direction: column; gap: 0.35rem; margin-bottom: 0.8rem; }
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

/* Repeaters */
.repeater-row { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 1rem; margin-bottom: 0.8rem; background: #fafafa; position: relative; }
.remove-btn { position: absolute; top: 0.5rem; right: 0.5rem; background: #fee2e2; color: #ef4444; border: none; border-radius: 6px; width: 28px; height: 28px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s; }
.remove-btn:hover { background: #fca5a5; color: #991b1b; }
.add-btn { background: #f0fdf4; border: 1px dashed var(--color-primary); color: var(--color-primary); padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%; transition: all 0.2s; display: flex; justify-content: center; align-items: center; gap: 0.5rem; margin-top: 0.5rem; }
.add-btn:hover { background: #dcfce7; }
</style>

@if(session('success'))
<div class="toast-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
@endif

{{-- Top bar --}}
<div style="background: #0f172a; padding: 0.8rem 1.25rem; border-radius: 12px; margin-bottom: 1.25rem; margin-left: calc(190px + 1.5rem); display: flex; align-items: center; justify-content: space-between;">
    <div style="display: flex; align-items: center; gap: 0.7rem;">
        <div style="width: 8px; height: 8px; background: #16a34a; border-radius: 50%;"></div>
        <span style="color: #94a3b8; font-size: 0.85rem;">Editing: <strong style="color: white;">Contact Page</strong></span>
    </div>
    <a href="{{ route('contact') }}" target="_blank" style="background: rgba(255,255,255,0.08); color: #e2e8f0; padding: 0.4rem 1rem; border-radius: 8px; font-size: 0.82rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.1); display: inline-flex; align-items: center; gap: 0.4rem; transition: background 0.15s;" onmouseover="this.style.background='rgba(255,255,255,0.14)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
        <i class="fa-solid fa-up-right-from-square" style="font-size: 0.75rem;"></i> Preview Page
    </a>
</div>

<form method="POST" action="{{ route('admin.page-content.update', 'contact') }}" enctype="multipart/form-data">
@csrf

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

        {{-- ── HERO SECTION ── --}}
        <div class="apc-section" id="sec-hero">
            <div class="apc-section-header open" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-hero']['color'] }};"><i class="fa-solid {{ $navSections['sec-hero']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Hero Section</p>
                        <p class="apc-section-subtitle">Top header banner for the contact page</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Badge Text</label>
                        <input class="apc-input" type="text" name="contact_hero_badge" value="{{ $s('contact_hero_badge', 'Get in Touch') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Page Title</label>
                        <input class="apc-input" type="text" name="contact_hero_title" value="{{ $s('contact_hero_title', 'Contact the Department') }}">
                    </div>
                </div>
                <div class="apc-field">
                    <label class="apc-label">Subtitle</label>
                    <textarea class="apc-textarea" name="contact_hero_subtitle" rows="2">{{ $s('contact_hero_subtitle', 'Have questions, feedback, or partnership inquiries? We\'d love to hear from you.') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── CONTACT INFO CARDS ── --}}
        <div class="apc-section" id="sec-cards">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-cards']['color'] }};"><i class="fa-solid {{ $navSections['sec-cards']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Contact Info Cards</p>
                        <p class="apc-section-subtitle">Address, Email, Phone, Office Hours</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
                    <div style="border:1.5px solid #e2e8f0;border-radius:10px;padding:1rem;background:#fafbfc">
                        <strong style="font-size:.85rem;color:#334155;display:block;margin-bottom:0.5rem">Office Address</strong>
                        <textarea class="apc-textarea" name="contact_address" rows="2">{{ $s('contact_address', config('university.university').',\nKeffi, Nasarawa State') }}</textarea>
                    </div>
                    <div style="border:1.5px solid #e2e8f0;border-radius:10px;padding:1rem;background:#fafbfc">
                        <strong style="font-size:.85rem;color:#334155;display:block;margin-bottom:0.5rem">Email Address</strong>
                        <input class="apc-input" type="text" name="contact_email" value="{{ $s('contact_email','info@dcms.nsuk.edu.ng') }}">
                    </div>
                    <div style="border:1.5px solid #e2e8f0;border-radius:10px;padding:1rem;background:#fafbfc">
                        <strong style="font-size:.85rem;color:#334155;display:block;margin-bottom:0.5rem">Phone Number</strong>
                        <input class="apc-input" type="text" name="contact_phone" value="{{ $s('contact_phone','+234 (0) 123 456 7890') }}">
                    </div>
                    <div style="border:1.5px solid #e2e8f0;border-radius:10px;padding:1rem;background:#fafbfc">
                        <strong style="font-size:.85rem;color:#334155;display:block;margin-bottom:0.5rem">Office Hours</strong>
                        <input class="apc-input" type="text" name="contact_hours" value="{{ $s('contact_hours','Mon – Fri: 8 AM – 4 PM') }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- ── FORM TEXT ── --}}
        <div class="apc-section" id="sec-form">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-form']['color'] }};"><i class="fa-solid {{ $navSections['sec-form']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Contact Form Text</p>
                        <p class="apc-section-subtitle">Heading above the main contact form</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Form Title</label>
                        <input class="apc-input" type="text" name="contact_form_title" value="{{ $s('contact_form_title','Send Us a Message') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Form Subtitle</label>
                        <input class="apc-input" type="text" name="contact_form_subtitle" value="{{ $s('contact_form_subtitle','Fill out the form below and we\'ll get back to you as soon as possible.') }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- ── ABOUT SIDEBAR ── --}}
        <div class="apc-section" id="sec-about">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-about']['color'] }};"><i class="fa-solid {{ $navSections['sec-about']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">About Department Card</p>
                        <p class="apc-section-subtitle">Sidebar widget over the form</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-field">
                    <label class="apc-label">Card Title</label>
                    <input class="apc-input" type="text" name="contact_about_title" value="{{ $s('contact_about_title','About the Department') }}">
                </div>
                <div class="apc-field">
                    <label class="apc-label">Description</label>
                    <textarea class="apc-textarea" name="contact_about_text" rows="3">{{ $s('contact_about_text','The Department of Computer Science at Nasarawa State University, Keffi is dedicated to producing world-class computing professionals through quality education, research, and community engagement.') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── PARTNERSHIP ── --}}
        <div class="apc-section" id="sec-partner">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-partner']['color'] }};"><i class="fa-solid {{ $navSections['sec-partner']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Partnership Card</p>
                        <p class="apc-section-subtitle">Call-to-action block for partners</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-field">
                    <label class="apc-label">Card Title</label>
                    <input class="apc-input" type="text" name="contact_partner_title" value="{{ $s('contact_partner_title','Partner With Us') }}">
                </div>
                <div class="apc-field">
                    <label class="apc-label">Description</label>
                    <textarea class="apc-textarea" name="contact_partner_text" rows="3">{{ $s('contact_partner_text','We collaborate with tech companies and organizations for internships, joint research, and curriculum development. Let\'s shape the next generation of IT leaders together.') }}</textarea>
                </div>
                <div class="apc-field">
                    <label class="apc-label">Button Text</label>
                    <input class="apc-input" type="text" name="contact_partner_btn" value="{{ $s('contact_partner_btn','Propose Partnership') }}">
                </div>
            </div>
        </div>

        {{-- ── MAP SETTINGS ── --}}
        <div class="apc-section" id="sec-map">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-map']['color'] }};"><i class="fa-solid {{ $navSections['sec-map']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Map Settings</p>
                        <p class="apc-section-subtitle">Google Maps location configuration</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                {{-- Map Mode Toggle --}}
                <div style="display:flex;gap:.6rem;margin-bottom:1.2rem">
                    @foreach(['embed' => ['icon' => 'fa-solid fa-code', 'label' => 'Embed URL'], 'coords' => ['icon' => 'fa-solid fa-location-crosshairs', 'label' => 'Coordinates']] as $mode => $info)
                    <label style="flex:1;display:flex;align-items:center;gap:.6rem;padding:.75rem 1rem;border-radius:10px;border:2px solid #e2e8f0;cursor:pointer;transition:all .2s;background:#fafbfc;user-select:none" id="mapModeLabel_{{ $mode }}">
                        <input type="radio" name="contact_map_mode" value="{{ $mode }}" {{ $s('contact_map_mode','embed') === $mode ? 'checked' : '' }} onchange="toggleMapMode()" style="accent-color:var(--color-primary);width:16px;height:16px">
                        <i class="{{ $info['icon'] }}" style="color:var(--color-primary);font-size:.9rem"></i>
                        <strong style="font-size:.85rem;color:#334155">{{ $info['label'] }}</strong>
                    </label>
                    @endforeach
                </div>

                {{-- Option 1: Embed URL --}}
                <div id="mapModeEmbed">
                    <div class="apc-field">
                        <label class="apc-label">Map Embed URL or Iframe Code</label>
                        <textarea class="apc-textarea" name="contact_map_embed" id="contact_map_embed" rows="3" oninput="cleanEmbedInput();updateMapPreview()">{{ $s('contact_map_embed','') }}</textarea>
                    </div>
                </div>

                {{-- Option 2: Coordinates --}}
                <div id="mapModeCoords">
                    <div class="apc-row">
                        <div class="apc-field">
                            <label class="apc-label">Latitude</label>
                            <input class="apc-input" type="text" name="contact_map_lat" id="contact_map_lat" value="{{ $s('contact_map_lat','8.8467') }}" oninput="updateMapPreview()">
                        </div>
                        <div class="apc-field">
                            <label class="apc-label">Longitude</label>
                            <input class="apc-input" type="text" name="contact_map_lng" id="contact_map_lng" value="{{ $s('contact_map_lng','7.8736') }}" oninput="updateMapPreview()">
                        </div>
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Zoom Level</label>
                        <input type="range" name="contact_map_zoom" id="contact_map_zoom" min="1" max="20" step="1" value="{{ $s('contact_map_zoom','15') }}" oninput="updateMapPreview()">
                    </div>
                </div>

                <iframe id="mapPreview" width="100%" height="200" style="border:1px solid #e2e8f0; border-radius: 8px; margin-top: 1rem; display:block" loading="lazy"></iframe>
            </div>
        </div>

        {{-- ── VISIBILITY ── --}}
        <div class="apc-section" id="sec-vis">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-vis']['color'] }};"><i class="fa-solid {{ $navSections['sec-vis']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Section Visibility</p>
                        <p class="apc-section-subtitle">Toggle sections on the live page</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem">
                    @foreach([
                        ['key' => 'contact_show_partnership', 'label' => 'Partnership Card', 'icon' => 'fa-solid fa-handshake', 'color' => '#16a34a'],
                        ['key' => 'contact_show_key_contacts', 'label' => 'Key Contacts', 'icon' => 'fa-solid fa-user-tie', 'color' => '#0891b2'],
                        ['key' => 'contact_show_faqs', 'label' => 'FAQ Section', 'icon' => 'fa-solid fa-circle-question', 'color' => '#7c3aed'],
                        ['key' => 'contact_show_map', 'label' => 'Google Map', 'icon' => 'fa-solid fa-map-location-dot', 'color' => '#ea580c'],
                    ] as $toggle)
                    <label style="display:flex;align-items:center;gap:.8rem;padding:.9rem;border-radius:10px;border:1.5px solid #e2e8f0;background:#fafbfc;cursor:pointer;transition:all .15s;user-select:none" onmouseover="this.style.borderColor='{{ $toggle['color'] }}';this.style.background='{{ $toggle['color'] }}08'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fafbfc'">
                        <input type="hidden" name="{{ $toggle['key'] }}" value="0">
                        <input type="checkbox" name="{{ $toggle['key'] }}" value="1" {{ $s($toggle['key'], '1') === '1' ? 'checked' : '' }} style="width:18px;height:18px;accent-color:{{ $toggle['color'] }};cursor:pointer" onchange="this.previousElementSibling.disabled=this.checked">
                        <div style="display:flex;align-items:center;gap:.5rem">
                            <i class="{{ $toggle['icon'] }}" style="color:{{ $toggle['color'] }};font-size:.85rem"></i>
                            <strong style="font-size:.85rem;color:#334155">{{ $toggle['label'] }}</strong>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ── KEY CONTACTS ── --}}
        <div class="apc-section" id="sec-contacts">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-contacts']['color'] }};"><i class="fa-solid {{ $navSections['sec-contacts']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Key Contacts</p>
                        <p class="apc-section-subtitle">Important staff or roles shown in a list</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Section Title</label>
                        <input class="apc-input" type="text" name="contact_key_contacts_title" value="{{ $s('contact_key_contacts_title','Key Department Contacts') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Section Subtitle</label>
                        <input class="apc-input" type="text" name="contact_key_contacts_subtitle" value="{{ $s('contact_key_contacts_subtitle','Reach out directly to the relevant office for faster assistance.') }}">
                    </div>
                </div>
                <div id="keyContactsContainer">
                    @foreach($keyContacts as $i => $contact)
                    <div class="repeater-row kc-row">
                        <button type="button" class="remove-btn" onclick="this.closest('.kc-row').remove();updateKeyContactsJson()"><i class="fa-solid fa-xmark"></i></button>
                        <div class="apc-row">
                            <div class="apc-field">
                                <label class="apc-label">Role</label>
                                <input class="apc-input kc-role" type="text" value="{{ $contact['role'] ?? '' }}" oninput="updateKeyContactsJson()">
                            </div>
                            <div class="apc-field">
                                <label class="apc-label">Name</label>
                                <input class="apc-input kc-name" type="text" value="{{ $contact['name'] ?? '' }}" oninput="updateKeyContactsJson()">
                            </div>
                        </div>
                        <div class="apc-row">
                            <div class="apc-field">
                                <label class="apc-label">Email</label>
                                <input class="apc-input kc-email" type="email" value="{{ $contact['email'] ?? '' }}" oninput="updateKeyContactsJson()">
                            </div>
                            <div class="apc-field">
                                <label class="apc-label">Phone</label>
                                <input class="apc-input kc-phone" type="text" value="{{ $contact['phone'] ?? '' }}" oninput="updateKeyContactsJson()">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <input type="hidden" name="contact_key_contacts" id="keyContactsHidden" value="{{ json_encode($keyContacts) }}">
                <button type="button" class="add-btn" onclick="addKeyContact()">
                    <i class="fa-solid fa-plus"></i> Add Key Contact
                </button>
            </div>
        </div>

        {{-- ── FAQS ── --}}
        <div class="apc-section" id="sec-faqs">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-faqs']['color'] }};"><i class="fa-solid {{ $navSections['sec-faqs']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">FAQs</p>
                        <p class="apc-section-subtitle">Frequently Asked Questions list</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div class="apc-row">
                    <div class="apc-field">
                        <label class="apc-label">Section Title</label>
                        <input class="apc-input" type="text" name="contact_faq_title" value="{{ $s('contact_faq_title','Frequently Asked Questions') }}">
                    </div>
                    <div class="apc-field">
                        <label class="apc-label">Section Subtitle</label>
                        <input class="apc-input" type="text" name="contact_faq_subtitle" value="{{ $s('contact_faq_subtitle','Quick answers to common questions about the department.') }}">
                    </div>
                </div>
                <div id="faqContainer">
                    @foreach($faqs as $i => $faq)
                    <div class="repeater-row faq-row">
                        <button type="button" class="remove-btn" onclick="this.closest('.faq-row').remove();updateFaqsJson()"><i class="fa-solid fa-xmark"></i></button>
                        <div class="apc-field">
                            <label class="apc-label">Question</label>
                            <input class="apc-input faq-q" type="text" value="{{ $faq['q'] ?? '' }}" oninput="updateFaqsJson()">
                        </div>
                        <div class="apc-field">
                            <label class="apc-label">Answer</label>
                            <textarea class="apc-textarea faq-a" rows="2" oninput="updateFaqsJson()">{{ $faq['a'] ?? '' }}</textarea>
                        </div>
                    </div>
                    @endforeach
                </div>
                <input type="hidden" name="contact_faqs" id="faqsHidden" value="{{ json_encode($faqs) }}">
                <button type="button" class="add-btn" onclick="addFaq()">
                    <i class="fa-solid fa-plus"></i> Add FAQ
                </button>
            </div>
        </div>

        {{-- ── QUICK ACTIONS ── --}}
        <div class="apc-section" id="sec-quick">
            <div class="apc-section-header" onclick="toggleSection(this)">
                <div class="apc-section-header-left">
                    <div class="apc-section-icon" style="background: {{ $navSections['sec-quick']['color'] }};"><i class="fa-solid {{ $navSections['sec-quick']['icon'] }}"></i></div>
                    <div>
                        <p class="apc-section-title">Quick Actions</p>
                        <p class="apc-section-subtitle">Relevant system links</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down apc-chevron"></i>
            </div>
            <div class="apc-section-body collapsed">
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:.8rem">
                    <a href="{{ route('admin.social-links.index') }}" style="display:flex;align-items:center;gap:.8rem;padding:.9rem;border-radius:10px;border:1.5px solid #e2e8f0;text-decoration:none;color:#334155;transition:all .15s;background:#fafbfc">
                        <div style="width:36px;height:36px;background:rgba(22,163,74,.1);border-radius:8px;display:flex;align-items:center;justify-content:center"><i class="fa-solid fa-share-nodes" style="color:var(--color-primary)"></i></div>
                        <div><strong style="font-size:.85rem;display:block">Social Links</strong></div>
                    </a>
                </div>
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

// ── Map Preview ──
function getMapMode() {
    return document.querySelector('input[name="contact_map_mode"]:checked')?.value || 'embed';
}
function toggleMapMode() {
    const mode = getMapMode();
    document.getElementById('mapModeEmbed').style.display = mode === 'embed' ? 'block' : 'none';
    document.getElementById('mapModeCoords').style.display = mode === 'coords' ? 'block' : 'none';
    
    document.getElementById('mapModeLabel_embed').style.borderColor = mode === 'embed' ? 'var(--color-primary)' : '#e2e8f0';
    document.getElementById('mapModeLabel_coords').style.borderColor = mode === 'coords' ? 'var(--color-primary)' : '#e2e8f0';
    updateMapPreview();
}
function cleanEmbedInput() {
    const ta = document.getElementById('contact_map_embed');
    const raw = ta.value.trim();
    if (raw.toLowerCase().startsWith('<iframe')) {
        const m = raw.match(/src=["']([^"']+)["']/i);
        if (m) ta.value = m[1];
    }
}
function updateMapPreview() {
    const mode = getMapMode();
    let url = '';
    if (mode === 'embed') {
        url = document.getElementById('contact_map_embed').value.trim();
    } else {
        const lat = document.getElementById('contact_map_lat').value.trim();
        const lng = document.getElementById('contact_map_lng').value.trim();
        const zoom = document.getElementById('contact_map_zoom').value;
        if (lat && lng) {
            url = 'https://www.google.com/maps?q=' + lat + ',' + lng + '&z=' + zoom + '&output=embed';
        }
    }
    document.getElementById('mapPreview').src = url;
}

// ── Repeater Utils ──
function updateKeyContactsJson() {
    const rows = document.querySelectorAll('.kc-row');
    const contacts = Array.from(rows).map(row => ({
        role: row.querySelector('.kc-role').value.trim(),
        name: row.querySelector('.kc-name').value.trim(),
        email: row.querySelector('.kc-email').value.trim(),
        phone: row.querySelector('.kc-phone').value.trim()
    })).filter(c => c.role || c.name || c.email || c.phone);
    document.getElementById('keyContactsHidden').value = JSON.stringify(contacts);
}
function addKeyContact() {
    const html = `
    <div class="repeater-row kc-row">
        <button type="button" class="remove-btn" onclick="this.closest('.kc-row').remove();updateKeyContactsJson()"><i class="fa-solid fa-xmark"></i></button>
        <div class="apc-row">
            <div class="apc-field">
                <label class="apc-label">Role</label>
                <input class="apc-input kc-role" type="text" value="" oninput="updateKeyContactsJson()">
            </div>
            <div class="apc-field">
                <label class="apc-label">Name</label>
                <input class="apc-input kc-name" type="text" value="" oninput="updateKeyContactsJson()">
            </div>
        </div>
        <div class="apc-row">
            <div class="apc-field">
                <label class="apc-label">Email</label>
                <input class="apc-input kc-email" type="email" value="" oninput="updateKeyContactsJson()">
            </div>
            <div class="apc-field">
                <label class="apc-label">Phone</label>
                <input class="apc-input kc-phone" type="text" value="" oninput="updateKeyContactsJson()">
            </div>
        </div>
    </div>`;
    document.getElementById('keyContactsContainer').insertAdjacentHTML('beforeend', html);
    updateKeyContactsJson();
}

function updateFaqsJson() {
    const rows = document.querySelectorAll('.faq-row');
    const faqs = Array.from(rows).map(row => ({
        q: row.querySelector('.faq-q').value.trim(),
        a: row.querySelector('.faq-a').value.trim()
    })).filter(c => c.q || c.a);
    document.getElementById('faqsHidden').value = JSON.stringify(faqs);
}
function addFaq() {
    const html = `
    <div class="repeater-row faq-row">
        <button type="button" class="remove-btn" onclick="this.closest('.faq-row').remove();updateFaqsJson()"><i class="fa-solid fa-xmark"></i></button>
        <div class="apc-field">
            <label class="apc-label">Question</label>
            <input class="apc-input faq-q" type="text" value="" oninput="updateFaqsJson()">
        </div>
        <div class="apc-field">
            <label class="apc-label">Answer</label>
            <textarea class="apc-textarea faq-a" rows="2" oninput="updateFaqsJson()"></textarea>
        </div>
    </div>`;
    document.getElementById('faqContainer').insertAdjacentHTML('beforeend', html);
    updateFaqsJson();
}

// ── Fix sidenav to viewport on load ──
document.addEventListener('DOMContentLoaded', () => {
    toggleMapMode();

    const nav = document.querySelector('.apc-sidenav');
    const shell = document.querySelector('.apc-shell');
    if (!nav || !shell) return;
    function pinNav() {
        nav.style.position = ''; nav.style.left = ''; nav.style.width = ''; nav.style.top = '';
        const rect = nav.getBoundingClientRect();
        nav.style.position = 'fixed'; nav.style.top = '85px'; nav.style.left = rect.left + 'px'; nav.style.width = rect.width + 'px';
        let spacer = shell.querySelector('.apc-sidenav-spacer');
        if (!spacer) {
            spacer = document.createElement('div'); spacer.className = 'apc-sidenav-spacer'; spacer.style.flexShrink = '0';
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

// ── Auto dismiss toast ──
document.addEventListener('DOMContentLoaded', function() {
    const toast = document.querySelector('.toast-success');
    if (toast) setTimeout(() => toast.remove(), 4000);
});
</script>
@endsection
