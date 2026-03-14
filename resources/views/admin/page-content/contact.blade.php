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
@endphp

<style>
.pc-card{background:white;border-radius:12px;border:1px solid #e2e8f0;margin-bottom:1.5rem;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04)}
.pc-card-header{padding:1rem 1.5rem;background:#f8fafc;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;cursor:pointer;user-select:none}
.pc-card-header h3{margin:0;font-size:1rem;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:.6rem}
.pc-card-body{padding:1.5rem}
.pc-card-body.collapsed{display:none}
.form-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:1rem;margin-bottom:1rem}
.form-group{display:flex;flex-direction:column;gap:.4rem;margin-bottom:.8rem}
.form-group label{font-size:.85rem;font-weight:600;color:#475569;display:flex;align-items:center;gap:.4rem}
.form-group input,.form-group textarea{width:100%;padding:.6rem .9rem;border:1px solid #cbd5e1;border-radius:8px;font-family:inherit;font-size:.95rem;color:#334155;box-sizing:border-box;transition:border-color .2s}
.form-group input:focus,.form-group textarea:focus{border-color:var(--color-primary);outline:none}
.form-group textarea{resize:vertical;min-height:80px}
.form-group .hint{font-size:.75rem;color:#94a3b8;margin-top:2px}
.toggle-icon{font-size:.8rem;color:#64748b;transition:transform .2s}
.pc-card-header.open .toggle-icon{transform:rotate(180deg)}
.section-badge{display:inline-flex;align-items:center;gap:.3rem;background:#f0fdf4;color:var(--color-primary);font-size:.7rem;font-weight:700;padding:.15rem .5rem;border-radius:6px;border:1px solid rgba(22,163,74,.15);margin-left:.5rem}
</style>

{{-- Toast --}}
@if(session('success'))
<div style="background:#dcfce7;color:#166534;padding:.8rem 1.2rem;border-radius:10px;border:1px solid #bbf7d0;margin-bottom:1.2rem;font-size:.88rem;display:flex;align-items:center;gap:.5rem;animation:fadeIn .3s">
    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
</div>
@endif

{{-- Header Bar --}}
<div style="background:#1e293b;padding:.8rem 1.5rem;border-radius:12px;margin-bottom:1.5rem;display:flex;align-items:center;justify-content:space-between">
    <span style="color:#94a3b8;font-size:.9rem"><i class="fa-solid fa-address-book" style="margin-right:6px"></i>Editing: <strong style="color:white">Contact Page</strong></span>
    <a href="{{ route('contact') }}" target="_blank" style="background:var(--color-primary);color:white;padding:.4rem 1rem;border-radius:8px;font-size:.85rem;font-weight:600;text-decoration:none"><i class="fa-solid fa-eye"></i> Preview</a>
</div>

<form method="POST" action="{{ route('admin.page-content.update', 'contact') }}" enctype="multipart/form-data">@csrf

{{-- ═══════════════ HERO SECTION ═══════════════ --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-image" style="color:var(--color-primary)"></i> Hero Section</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <div class="form-row">
            <div class="form-group">
                <label><i class="fa-solid fa-tag"></i> Badge Text</label>
                <input type="text" name="contact_hero_badge" value="{{ $s('contact_hero_badge','Get in Touch') }}" placeholder="Get in Touch">
            </div>
            <div class="form-group">
                <label><i class="fa-solid fa-heading"></i> Page Title</label>
                <input type="text" name="contact_hero_title" value="{{ $s('contact_hero_title','Contact the Department') }}" placeholder="Contact the Department">
            </div>
        </div>
        <div class="form-group">
            <label><i class="fa-solid fa-align-left"></i> Subtitle</label>
            <textarea name="contact_hero_subtitle" rows="2" placeholder="Have questions, feedback, or...">{{ $s('contact_hero_subtitle','Have questions, feedback, or partnership inquiries? We\'d love to hear from you.') }}</textarea>
        </div>
    </div>
</div>

{{-- ═══════════════ CONTACT INFO CARDS ═══════════════ --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-id-card" style="color:var(--color-primary)"></i> Contact Information Cards <span class="section-badge">4 Cards</span></h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <p style="font-size:.82rem;color:#64748b;margin:0 0 1.2rem;line-height:1.5"><i class="fa-solid fa-circle-info" style="color:var(--color-primary)"></i> These 4 cards appear at the top of the contact page showing your department's key contact details.</p>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            {{-- Address --}}
            <div style="border:1.5px solid #e2e8f0;border-radius:10px;padding:1rem;background:#fafbfc">
                <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.7rem">
                    <div style="width:28px;height:28px;background:#dcfce7;border-radius:6px;display:flex;align-items:center;justify-content:center"><i class="fa-solid fa-location-dot" style="color:#16a34a;font-size:.75rem"></i></div>
                    <strong style="font-size:.85rem;color:#334155">Address</strong>
                </div>
                <div class="form-group" style="margin:0">
                    <textarea name="contact_address" rows="2" placeholder="University name, Keffi, Nasarawa State">{{ $s('contact_address', config('university.university').',\nKeffi, Nasarawa State') }}</textarea>
                    <span class="hint">HTML allowed (e.g. &lt;br&gt; for line breaks)</span>
                </div>
            </div>

            {{-- Email --}}
            <div style="border:1.5px solid #e2e8f0;border-radius:10px;padding:1rem;background:#fafbfc">
                <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.7rem">
                    <div style="width:28px;height:28px;background:#cffafe;border-radius:6px;display:flex;align-items:center;justify-content:center"><i class="fa-solid fa-envelope" style="color:#0891b2;font-size:.75rem"></i></div>
                    <strong style="font-size:.85rem;color:#334155">Email</strong>
                </div>
                <div class="form-group" style="margin:0">
                    <input type="text" name="contact_email" value="{{ $s('contact_email','info@dcms.nsuk.edu.ng') }}" placeholder="info@dcms.nsuk.edu.ng">
                    <span class="hint">Also used as the recipient for contact form submissions</span>
                </div>
            </div>

            {{-- Phone --}}
            <div style="border:1.5px solid #e2e8f0;border-radius:10px;padding:1rem;background:#fafbfc">
                <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.7rem">
                    <div style="width:28px;height:28px;background:#ede9fe;border-radius:6px;display:flex;align-items:center;justify-content:center"><i class="fa-solid fa-phone" style="color:#7c3aed;font-size:.75rem"></i></div>
                    <strong style="font-size:.85rem;color:#334155">Phone</strong>
                </div>
                <div class="form-group" style="margin:0">
                    <input type="text" name="contact_phone" value="{{ $s('contact_phone','+234 (0) 123 456 7890') }}" placeholder="+234 (0) 123 456 7890">
                </div>
            </div>

            {{-- Office Hours --}}
            <div style="border:1.5px solid #e2e8f0;border-radius:10px;padding:1rem;background:#fafbfc">
                <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.7rem">
                    <div style="width:28px;height:28px;background:#ffedd5;border-radius:6px;display:flex;align-items:center;justify-content:center"><i class="fa-solid fa-clock" style="color:#ea580c;font-size:.75rem"></i></div>
                    <strong style="font-size:.85rem;color:#334155">Office Hours</strong>
                </div>
                <div class="form-group" style="margin:0">
                    <input type="text" name="contact_hours" value="{{ $s('contact_hours','Mon – Fri: 8 AM – 4 PM') }}" placeholder="Mon – Fri: 8 AM – 4 PM">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════ CONTACT FORM TEXT ═══════════════ --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-pen-to-square" style="color:var(--color-primary)"></i> Contact Form Text</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <p style="font-size:.82rem;color:#64748b;margin:0 0 1rem;line-height:1.5"><i class="fa-solid fa-circle-info" style="color:var(--color-primary)"></i> The heading and description shown above the contact form.</p>
        <div class="form-row">
            <div class="form-group">
                <label><i class="fa-solid fa-heading"></i> Form Title</label>
                <input type="text" name="contact_form_title" value="{{ $s('contact_form_title','Send Us a Message') }}" placeholder="Send Us a Message">
            </div>
            <div class="form-group">
                <label><i class="fa-solid fa-align-left"></i> Form Subtitle</label>
                <input type="text" name="contact_form_subtitle" value="{{ $s('contact_form_subtitle','Fill out the form below and we\'ll get back to you as soon as possible.') }}" placeholder="Fill out the form below...">
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════ ABOUT SIDEBAR CARD ═══════════════ --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-building-columns" style="color:var(--color-primary)"></i> About Department Card <span class="section-badge">Sidebar</span></h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <p style="font-size:.82rem;color:#64748b;margin:0 0 1rem;line-height:1.5"><i class="fa-solid fa-circle-info" style="color:var(--color-primary)"></i> The "About the Department" card shown on the right side of the contact form.</p>
        <div class="form-group">
            <label><i class="fa-solid fa-heading"></i> Card Title</label>
            <input type="text" name="contact_about_title" value="{{ $s('contact_about_title','About the Department') }}" placeholder="About the Department">
        </div>
        <div class="form-group">
            <label><i class="fa-solid fa-align-left"></i> Description</label>
            <textarea name="contact_about_text" rows="3" placeholder="Brief description of the department...">{{ $s('contact_about_text','The Department of Computer Science at Nasarawa State University, Keffi is dedicated to producing world-class computing professionals through quality education, research, and community engagement.') }}</textarea>
        </div>
    </div>
</div>

{{-- ═══════════════ PARTNERSHIP CARD ═══════════════ --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-handshake" style="color:var(--color-primary)"></i> Partnership Card <span class="section-badge">Sidebar</span></h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <p style="font-size:.82rem;color:#64748b;margin:0 0 1rem;line-height:1.5"><i class="fa-solid fa-circle-info" style="color:var(--color-primary)"></i> The green "Partner With Us" card in the sidebar.</p>
        <div class="form-group">
            <label><i class="fa-solid fa-heading"></i> Card Title</label>
            <input type="text" name="contact_partner_title" value="{{ $s('contact_partner_title','Partner With Us') }}" placeholder="Partner With Us">
        </div>
        <div class="form-group">
            <label><i class="fa-solid fa-align-left"></i> Description</label>
            <textarea name="contact_partner_text" rows="3" placeholder="We collaborate with tech companies...">{{ $s('contact_partner_text','We collaborate with tech companies and organizations for internships, joint research, and curriculum development. Let\'s shape the next generation of IT leaders together.') }}</textarea>
        </div>
        <div class="form-group">
            <label><i class="fa-solid fa-mouse-pointer"></i> Button Text</label>
            <input type="text" name="contact_partner_btn" value="{{ $s('contact_partner_btn','Propose Partnership') }}" placeholder="Propose Partnership">
        </div>
    </div>
</div>

{{-- ═══════════════ MAP ═══════════════ --}}
<div class="pc-card">
    <div class="pc-card-header" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-map-location-dot" style="color:var(--color-primary)"></i> Map Settings</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body collapsed">

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

        {{-- ── Option 1: Embed URL ── --}}
        <div id="mapModeEmbed">
            <p style="font-size:.82rem;color:#64748b;margin:0 0 1rem;line-height:1.5">
                <i class="fa-solid fa-circle-info" style="color:var(--color-primary)"></i>
                Paste the full iframe embed URL from Google Maps. Go to <a href="https://maps.google.com" target="_blank" style="color:var(--color-primary);font-weight:600">Google Maps</a> → Share → Embed a map → copy the <code>src="..."</code> URL.
            </p>
            <div class="form-group">
                <label><i class="fa-solid fa-code"></i> Map Embed URL or Iframe Code</label>
                <textarea name="contact_map_embed" id="contact_map_embed" rows="3" placeholder="Paste the embed URL or the full <iframe> code from Google Maps" oninput="cleanEmbedInput();updateMapPreview()">{{ $s('contact_map_embed','') }}</textarea>
                <span class="hint">You can paste either just the URL or the entire <code>&lt;iframe&gt;</code> code — the system will extract the URL automatically.</span>
            </div>
        </div>

        {{-- ── Option 2: Coordinates ── --}}
        <div id="mapModeCoords">
            <p style="font-size:.82rem;color:#64748b;margin:0 0 1rem;line-height:1.5">
                <i class="fa-solid fa-circle-info" style="color:var(--color-primary)"></i>
                Enter latitude and longitude. Right-click any spot on <a href="https://maps.google.com" target="_blank" style="color:var(--color-primary);font-weight:600">Google Maps</a> to copy coordinates.
            </p>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
                <div class="form-group" style="margin-bottom:0">
                    <label><i class="fa-solid fa-arrows-up-down"></i> Latitude</label>
                    <input type="text" name="contact_map_lat" id="contact_map_lat" value="{{ $s('contact_map_lat','8.8467') }}" placeholder="e.g. 8.8467" oninput="updateMapPreview()">
                    <span class="hint">North/South position (e.g. 8.8467)</span>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label><i class="fa-solid fa-arrows-left-right"></i> Longitude</label>
                    <input type="text" name="contact_map_lng" id="contact_map_lng" value="{{ $s('contact_map_lng','7.8736') }}" placeholder="e.g. 7.8736" oninput="updateMapPreview()">
                    <span class="hint">East/West position (e.g. 7.8736)</span>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:1rem">
                <label><i class="fa-solid fa-search-plus"></i> Zoom Level</label>
                <div style="display:flex;align-items:center;gap:1rem">
                    <input type="range" name="contact_map_zoom" id="contact_map_zoom" min="1" max="20" step="1" value="{{ $s('contact_map_zoom','15') }}" oninput="document.getElementById('zoomValue').textContent=this.value;updateMapPreview()" style="flex:1;accent-color:var(--color-primary)">
                    <span id="zoomValue" style="font-weight:700;font-size:.9rem;color:#334155;min-width:24px;text-align:center">{{ $s('contact_map_zoom','15') }}</span>
                </div>
                <span class="hint">1 = world view, 20 = building-level detail. Recommended: 14–17.</span>
            </div>
        </div>

        {{-- Live Preview --}}
        <div style="border:1.5px solid #e2e8f0;border-radius:12px;overflow:hidden;margin-top:.5rem">
            <div style="padding:.6rem 1rem;background:#f8fafc;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between">
                <span style="font-size:.8rem;font-weight:600;color:#475569"><i class="fa-solid fa-eye" style="color:var(--color-primary);margin-right:.3rem"></i> Live Preview</span>
                <button type="button" onclick="updateMapPreview()" style="font-size:.75rem;padding:.25rem .7rem;border-radius:6px;border:1px solid #e2e8f0;background:white;color:#475569;cursor:pointer;display:flex;align-items:center;gap:.3rem;transition:all .15s" onmouseover="this.style.borderColor='var(--color-primary)';this.style.color='var(--color-primary)'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569'">
                    <i class="fa-solid fa-rotate"></i> Refresh
                </button>
            </div>
            <iframe id="mapPreview" width="100%" height="250" style="border:0;display:block" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <script>
        function extractSrcFromIframe(val) {
            val = val.trim();
            if (val.toLowerCase().startsWith('<iframe')) {
                const m = val.match(/src=["']([^"']+)["']/i);
                return m ? m[1] : val;
            }
            return val;
        }
        function cleanEmbedInput() {
            const ta = document.getElementById('contact_map_embed');
            const raw = ta.value.trim();
            if (raw.toLowerCase().startsWith('<iframe')) {
                const extracted = extractSrcFromIframe(raw);
                if (extracted !== raw) {
                    ta.value = extracted;
                }
            }
        }
        function getMapMode() {
            return document.querySelector('input[name="contact_map_mode"]:checked')?.value || 'embed';
        }
        function toggleMapMode() {
            const mode = getMapMode();
            document.getElementById('mapModeEmbed').style.display = mode === 'embed' ? 'block' : 'none';
            document.getElementById('mapModeCoords').style.display = mode === 'coords' ? 'block' : 'none';
            // Style the selected label
            document.getElementById('mapModeLabel_embed').style.borderColor = mode === 'embed' ? 'var(--color-primary)' : '#e2e8f0';
            document.getElementById('mapModeLabel_embed').style.background = mode === 'embed' ? 'var(--color-primary-light, #f0fdf4)' : '#fafbfc';
            document.getElementById('mapModeLabel_coords').style.borderColor = mode === 'coords' ? 'var(--color-primary)' : '#e2e8f0';
            document.getElementById('mapModeLabel_coords').style.background = mode === 'coords' ? 'var(--color-primary-light, #f0fdf4)' : '#fafbfc';
            updateMapPreview();
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
                if (lat && lng && !isNaN(lat) && !isNaN(lng)) {
                    url = 'https://www.google.com/maps?q=' + lat + ',' + lng + '&z=' + zoom + '&output=embed';
                }
            }
            if (url) {
                document.getElementById('mapPreview').src = url;
            }
        }
        document.addEventListener('DOMContentLoaded', function() { toggleMapMode(); });
        </script>
    </div>
</div>

{{-- ═══════════════ SECTION VISIBILITY ═══════════════ --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-eye" style="color:var(--color-primary)"></i> Section Visibility <span class="section-badge">Toggles</span></h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <p style="font-size:.82rem;color:#64748b;margin:0 0 1.2rem;line-height:1.5"><i class="fa-solid fa-circle-info" style="color:var(--color-primary)"></i> Control which sections appear on the public contact page. Toggle off any section to hide it.</p>
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

{{-- ═══════════════ KEY DEPARTMENT CONTACTS ═══════════════ --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-user-tie" style="color:var(--color-primary)"></i> Key Department Contacts <span class="section-badge">{{ count($keyContacts) }} Contacts</span></h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <p style="font-size:.82rem;color:#64748b;margin:0 0 1rem;line-height:1.5"><i class="fa-solid fa-circle-info" style="color:var(--color-primary)"></i> Show key department contacts with their roles, emails, and phone numbers. Visitors can click to directly email or call.</p>
        <div class="form-row">
            <div class="form-group">
                <label><i class="fa-solid fa-heading"></i> Section Title</label>
                <input type="text" name="contact_key_contacts_title" value="{{ $s('contact_key_contacts_title','Key Department Contacts') }}" placeholder="Key Department Contacts">
            </div>
            <div class="form-group">
                <label><i class="fa-solid fa-align-left"></i> Section Subtitle</label>
                <input type="text" name="contact_key_contacts_subtitle" value="{{ $s('contact_key_contacts_subtitle','Reach out directly to the relevant office for faster assistance.') }}" placeholder="Reach out directly...">
            </div>
        </div>
        <div id="keyContactsContainer">
            @foreach($keyContacts as $i => $contact)
            <div class="kc-row" style="border:1.5px solid #e2e8f0;border-radius:10px;padding:1rem;background:#fafbfc;margin-bottom:.8rem;position:relative">
                <button type="button" onclick="this.closest('.kc-row').remove();updateKeyContactsJson()" style="position:absolute;top:.5rem;right:.5rem;background:#fee2e2;color:#dc2626;border:none;border-radius:6px;width:28px;height:28px;cursor:pointer;font-size:.75rem;display:flex;align-items:center;justify-content:center" title="Remove"><i class="fa-solid fa-trash"></i></button>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.8rem">
                    <div class="form-group" style="margin:0">
                        <label style="font-size:.78rem"><i class="fa-solid fa-user"></i> Role / Title</label>
                        <input type="text" class="kc-role" value="{{ $contact['role'] ?? '' }}" placeholder="e.g. Head of Department" oninput="updateKeyContactsJson()">
                    </div>
                    <div class="form-group" style="margin:0">
                        <label style="font-size:.78rem"><i class="fa-solid fa-id-badge"></i> Name</label>
                        <input type="text" class="kc-name" value="{{ $contact['name'] ?? '' }}" placeholder="e.g. Dr. John Doe" oninput="updateKeyContactsJson()">
                    </div>
                    <div class="form-group" style="margin:0">
                        <label style="font-size:.78rem"><i class="fa-solid fa-envelope"></i> Email</label>
                        <input type="email" class="kc-email" value="{{ $contact['email'] ?? '' }}" placeholder="e.g. hod@cs.nsuk.edu.ng" oninput="updateKeyContactsJson()">
                    </div>
                    <div class="form-group" style="margin:0">
                        <label style="font-size:.78rem"><i class="fa-solid fa-phone"></i> Phone</label>
                        <input type="text" class="kc-phone" value="{{ $contact['phone'] ?? '' }}" placeholder="e.g. +234 800 000 0001" oninput="updateKeyContactsJson()">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <input type="hidden" name="contact_key_contacts" id="keyContactsHidden" value="{{ json_encode($keyContacts) }}">
        <button type="button" onclick="addKeyContact()" style="display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.2rem;border-radius:8px;border:1.5px dashed #cbd5e1;background:white;color:#475569;font-size:.85rem;font-weight:600;cursor:pointer;transition:all .15s" onmouseover="this.style.borderColor='var(--color-primary)';this.style.color='var(--color-primary)'" onmouseout="this.style.borderColor='#cbd5e1';this.style.color='#475569'">
            <i class="fa-solid fa-plus"></i> Add Contact
        </button>
    </div>
</div>

{{-- ═══════════════ FAQ SECTION ═══════════════ --}}
<div class="pc-card">
    <div class="pc-card-header open" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-circle-question" style="color:var(--color-primary)"></i> Frequently Asked Questions <span class="section-badge">{{ count($faqs) }} FAQs</span></h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body">
        <p style="font-size:.82rem;color:#64748b;margin:0 0 1rem;line-height:1.5"><i class="fa-solid fa-circle-info" style="color:var(--color-primary)"></i> Add common questions and answers. These appear as an accordion on the contact page.</p>
        <div class="form-row">
            <div class="form-group">
                <label><i class="fa-solid fa-heading"></i> FAQ Section Title</label>
                <input type="text" name="contact_faq_title" value="{{ $s('contact_faq_title','Frequently Asked Questions') }}" placeholder="Frequently Asked Questions">
            </div>
            <div class="form-group">
                <label><i class="fa-solid fa-align-left"></i> FAQ Section Subtitle</label>
                <input type="text" name="contact_faq_subtitle" value="{{ $s('contact_faq_subtitle','Quick answers to common questions about the department.') }}" placeholder="Quick answers to common questions...">
            </div>
        </div>
        <div id="faqContainer">
            @foreach($faqs as $i => $faq)
            <div class="faq-row" style="border:1.5px solid #e2e8f0;border-radius:10px;padding:1rem;background:#fafbfc;margin-bottom:.8rem;position:relative">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.6rem">
                    <span style="font-size:.78rem;font-weight:700;color:var(--color-primary);background:rgba(22,163,74,.08);padding:.15rem .5rem;border-radius:5px">Q{{ $i + 1 }}</span>
                    <button type="button" onclick="this.closest('.faq-row').remove();updateFaqsJson()" style="background:#fee2e2;color:#dc2626;border:none;border-radius:6px;width:28px;height:28px;cursor:pointer;font-size:.75rem;display:flex;align-items:center;justify-content:center" title="Remove"><i class="fa-solid fa-trash"></i></button>
                </div>
                <div class="form-group" style="margin-bottom:.6rem">
                    <label style="font-size:.78rem"><i class="fa-solid fa-question"></i> Question</label>
                    <input type="text" class="faq-q" value="{{ $faq['q'] ?? '' }}" placeholder="e.g. How do I apply for admission?" oninput="updateFaqsJson()">
                </div>
                <div class="form-group" style="margin:0">
                    <label style="font-size:.78rem"><i class="fa-solid fa-comment-dots"></i> Answer</label>
                    <textarea class="faq-a" rows="2" placeholder="Provide a clear, helpful answer..." oninput="updateFaqsJson()">{{ $faq['a'] ?? '' }}</textarea>
                </div>
            </div>
            @endforeach
        </div>
        <input type="hidden" name="contact_faqs" id="faqsHidden" value="{{ json_encode($faqs) }}">
        <button type="button" onclick="addFaq()" style="display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.2rem;border-radius:8px;border:1.5px dashed #cbd5e1;background:white;color:#475569;font-size:.85rem;font-weight:600;cursor:pointer;transition:all .15s" onmouseover="this.style.borderColor='var(--color-primary)';this.style.color='var(--color-primary)'" onmouseout="this.style.borderColor='#cbd5e1';this.style.color='#475569'">
            <i class="fa-solid fa-plus"></i> Add FAQ
        </button>
    </div>
</div>

{{-- ═══════════════ QUICK ACTIONS ═══════════════ --}}
<div class="pc-card">
    <div class="pc-card-header" onclick="toggleSection(this)">
        <h3><i class="fa-solid fa-bolt" style="color:var(--color-primary)"></i> Quick Actions</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body collapsed">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:.8rem">
            <a href="{{ route('admin.social-links.index') }}" style="display:flex;align-items:center;gap:.8rem;padding:.9rem;border-radius:10px;border:1.5px solid #e2e8f0;text-decoration:none;color:#334155;transition:all .15s;background:#fafbfc" onmouseover="this.style.borderColor='var(--color-primary)';this.style.background='#f0fdf4'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fafbfc'">
                <div style="width:36px;height:36px;background:rgba(22,163,74,.1);border-radius:8px;display:flex;align-items:center;justify-content:center"><i class="fa-solid fa-share-nodes" style="color:var(--color-primary)"></i></div>
                <div><strong style="font-size:.85rem;display:block">Social Links</strong><span style="font-size:.75rem;color:#64748b">Manage icons & URLs</span></div>
            </a>
            <a href="{{ route('contact') }}" target="_blank" style="display:flex;align-items:center;gap:.8rem;padding:.9rem;border-radius:10px;border:1.5px solid #e2e8f0;text-decoration:none;color:#334155;transition:all .15s;background:#fafbfc" onmouseover="this.style.borderColor='#0891b2';this.style.background='#ecfeff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fafbfc'">
                <div style="width:36px;height:36px;background:rgba(8,145,178,.1);border-radius:8px;display:flex;align-items:center;justify-content:center"><i class="fa-solid fa-eye" style="color:#0891b2"></i></div>
                <div><strong style="font-size:.85rem;display:block">View Public Page</strong><span style="font-size:.75rem;color:#64748b">See what visitors see</span></div>
            </a>
            @if(auth()->user()->isSuperAdmin())
            <a href="{{ route('super-admin.settings.index') }}" style="display:flex;align-items:center;gap:.8rem;padding:.9rem;border-radius:10px;border:1.5px solid #e2e8f0;text-decoration:none;color:#334155;transition:all .15s;background:#fafbfc" onmouseover="this.style.borderColor='#7c3aed';this.style.background='#f5f3ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fafbfc'">
                <div style="width:36px;height:36px;background:rgba(124,58,237,.1);border-radius:8px;display:flex;align-items:center;justify-content:center"><i class="fa-solid fa-gear" style="color:#7c3aed"></i></div>
                <div><strong style="font-size:.85rem;display:block">Site Settings</strong><span style="font-size:.75rem;color:#64748b">Global contact & metadata</span></div>
            </a>
            @endif
        </div>
    </div>
</div>

{{-- ═══════════════ SAVE BUTTON ═══════════════ --}}
<div style="display:flex;justify-content:flex-end;gap:1rem;padding:1rem 0">
    <a href="{{ route('contact') }}" target="_blank" style="padding:.65rem 1.5rem;border-radius:10px;font-weight:600;font-size:.9rem;text-decoration:none;color:#475569;border:1.5px solid #e2e8f0;display:inline-flex;align-items:center;gap:.4rem;transition:all .15s" onmouseover="this.style.borderColor='#94a3b8'" onmouseout="this.style.borderColor='#e2e8f0'"><i class="fa-solid fa-eye"></i> Preview</a>
    <button type="submit" style="background:var(--color-primary);color:white;padding:.65rem 2rem;border:none;border-radius:10px;font-weight:700;font-size:.95rem;cursor:pointer;display:inline-flex;align-items:center;gap:.5rem;transition:all .2s;box-shadow:0 2px 8px rgba(22,163,74,.25)" onmouseover="this.style.background='#15803d'" onmouseout="this.style.background='var(--color-primary)'"><i class="fa-solid fa-save"></i> Save Contact Page</button>
</div>
</form>

<script>
function toggleSection(h){h.classList.toggle('open');h.nextElementSibling.classList.toggle('collapsed')}
document.addEventListener('DOMContentLoaded',function(){const t=document.querySelector('[style*="animation:fadeIn"]');if(t)setTimeout(()=>t.remove(),4000)});

// ── FAQ Management ──
function updateFaqsJson() {
    const rows = document.querySelectorAll('#faqContainer .faq-row');
    const faqs = [];
    rows.forEach(row => {
        const q = row.querySelector('.faq-q')?.value?.trim() || '';
        const a = row.querySelector('.faq-a')?.value?.trim() || '';
        if (q || a) faqs.push({ q, a });
    });
    document.getElementById('faqsHidden').value = JSON.stringify(faqs);
    // Update badge numbers
    rows.forEach((row, i) => {
        const badge = row.querySelector('span[style*="color:var(--color-primary)"]');
        if (badge) badge.textContent = 'Q' + (i + 1);
    });
}

function addFaq() {
    const container = document.getElementById('faqContainer');
    const idx = container.querySelectorAll('.faq-row').length + 1;
    const html = `<div class="faq-row" style="border:1.5px solid #e2e8f0;border-radius:10px;padding:1rem;background:#fafbfc;margin-bottom:.8rem;position:relative">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.6rem">
            <span style="font-size:.78rem;font-weight:700;color:var(--color-primary);background:rgba(22,163,74,.08);padding:.15rem .5rem;border-radius:5px">Q${idx}</span>
            <button type="button" onclick="this.closest('.faq-row').remove();updateFaqsJson()" style="background:#fee2e2;color:#dc2626;border:none;border-radius:6px;width:28px;height:28px;cursor:pointer;font-size:.75rem;display:flex;align-items:center;justify-content:center" title="Remove"><i class="fa-solid fa-trash"></i></button>
        </div>
        <div class="form-group" style="margin-bottom:.6rem">
            <label style="font-size:.78rem"><i class="fa-solid fa-question"></i> Question</label>
            <input type="text" class="faq-q" value="" placeholder="e.g. How do I apply for admission?" oninput="updateFaqsJson()">
        </div>
        <div class="form-group" style="margin:0">
            <label style="font-size:.78rem"><i class="fa-solid fa-comment-dots"></i> Answer</label>
            <textarea class="faq-a" rows="2" placeholder="Provide a clear, helpful answer..." oninput="updateFaqsJson()"></textarea>
        </div>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
    container.lastElementChild.querySelector('.faq-q').focus();
    updateFaqsJson();
}

// ── Key Contacts Management ──
function updateKeyContactsJson() {
    const rows = document.querySelectorAll('#keyContactsContainer .kc-row');
    const contacts = [];
    rows.forEach(row => {
        const role = row.querySelector('.kc-role')?.value?.trim() || '';
        const name = row.querySelector('.kc-name')?.value?.trim() || '';
        const email = row.querySelector('.kc-email')?.value?.trim() || '';
        const phone = row.querySelector('.kc-phone')?.value?.trim() || '';
        if (role || name || email || phone) contacts.push({ role, name, email, phone });
    });
    document.getElementById('keyContactsHidden').value = JSON.stringify(contacts);
}

function addKeyContact() {
    const container = document.getElementById('keyContactsContainer');
    const html = `<div class="kc-row" style="border:1.5px solid #e2e8f0;border-radius:10px;padding:1rem;background:#fafbfc;margin-bottom:.8rem;position:relative">
        <button type="button" onclick="this.closest('.kc-row').remove();updateKeyContactsJson()" style="position:absolute;top:.5rem;right:.5rem;background:#fee2e2;color:#dc2626;border:none;border-radius:6px;width:28px;height:28px;cursor:pointer;font-size:.75rem;display:flex;align-items:center;justify-content:center" title="Remove"><i class="fa-solid fa-trash"></i></button>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.8rem">
            <div class="form-group" style="margin:0">
                <label style="font-size:.78rem"><i class="fa-solid fa-user"></i> Role / Title</label>
                <input type="text" class="kc-role" value="" placeholder="e.g. Head of Department" oninput="updateKeyContactsJson()">
            </div>
            <div class="form-group" style="margin:0">
                <label style="font-size:.78rem"><i class="fa-solid fa-id-badge"></i> Name</label>
                <input type="text" class="kc-name" value="" placeholder="e.g. Dr. John Doe" oninput="updateKeyContactsJson()">
            </div>
            <div class="form-group" style="margin:0">
                <label style="font-size:.78rem"><i class="fa-solid fa-envelope"></i> Email</label>
                <input type="email" class="kc-email" value="" placeholder="e.g. hod@cs.nsuk.edu.ng" oninput="updateKeyContactsJson()">
            </div>
            <div class="form-group" style="margin:0">
                <label style="font-size:.78rem"><i class="fa-solid fa-phone"></i> Phone</label>
                <input type="text" class="kc-phone" value="" placeholder="e.g. +234 800 000 0001" oninput="updateKeyContactsJson()">
            </div>
        </div>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
    container.lastElementChild.querySelector('.kc-role').focus();
    updateKeyContactsJson();
}

// Initialize hidden fields on page load
document.addEventListener('DOMContentLoaded', function() {
    updateFaqsJson();
    updateKeyContactsJson();
    // Handle checkbox toggle - ensure hidden field is disabled when checkbox is checked
    document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
        const hidden = cb.previousElementSibling;
        if (hidden && hidden.type === 'hidden') hidden.disabled = cb.checked;
    });
});
</script>
@endsection
