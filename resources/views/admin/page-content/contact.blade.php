@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Contact Page Content')
@section('header', 'Contact Page Editor')

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
        <h3><i class="fa-solid fa-map-location-dot" style="color:var(--color-primary)"></i> Google Map Embed</h3>
        <i class="fa-solid fa-chevron-down toggle-icon"></i>
    </div>
    <div class="pc-card-body collapsed">
        <p style="font-size:.82rem;color:#64748b;margin:0 0 1rem;line-height:1.5"><i class="fa-solid fa-circle-info" style="color:var(--color-primary)"></i> Paste the full Google Maps embed URL. Go to Google Maps → Share → Embed → copy the <code>src="..."</code> URL.</p>
        <div class="form-group">
            <label><i class="fa-solid fa-code"></i> Map Embed URL</label>
            <textarea name="contact_map_embed" rows="3" placeholder="https://www.google.com/maps?q=Your+Location&output=embed">{{ $s('contact_map_embed','https://www.google.com/maps?q=Nasarawa+State+University,+Keffi,+Nasarawa+State,+Nigeria&output=embed') }}</textarea>
            <span class="hint">The full iframe <code>src</code> value from Google Maps embed.</span>
        </div>
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
            <a href="{{ route('admin.settings.index') }}" style="display:flex;align-items:center;gap:.8rem;padding:.9rem;border-radius:10px;border:1.5px solid #e2e8f0;text-decoration:none;color:#334155;transition:all .15s;background:#fafbfc" onmouseover="this.style.borderColor='#7c3aed';this.style.background='#f5f3ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fafbfc'">
                <div style="width:36px;height:36px;background:rgba(124,58,237,.1);border-radius:8px;display:flex;align-items:center;justify-content:center"><i class="fa-solid fa-gear" style="color:#7c3aed"></i></div>
                <div><strong style="font-size:.85rem;display:block">Site Settings</strong><span style="font-size:.75rem;color:#64748b">Global contact & metadata</span></div>
            </a>
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
</script>
@endsection
