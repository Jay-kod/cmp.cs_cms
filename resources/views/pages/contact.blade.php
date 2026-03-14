@extends('layouts.public')
@section('title', 'Contact Us')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::where('key', $key)->value('value') ?? $default;
    $faqsJson = $gs('contact_faqs', '');
    $faqs = $faqsJson ? json_decode($faqsJson, true) : [];
    if (!$faqs || !is_array($faqs)) {
        $faqs = [
            ['q' => 'How do I apply for admission into the department?', 'a' => 'Visit the university\'s admission portal at the start of each academic session. Select Computer Science as your preferred course and follow the application steps.'],
            ['q' => 'What are the requirements for admission?', 'a' => 'You need at least 5 O\'Level credits including Mathematics and English Language, plus a minimum UTME score as set by JAMB for the session.'],
            ['q' => 'Can I visit the department in person?', 'a' => 'Yes! Our offices are open Monday to Friday, 8 AM – 4 PM. We recommend scheduling an appointment for specific inquiries.'],
            ['q' => 'How can I get my transcript or academic records?', 'a' => 'Visit the department\'s administrative office with a formal request letter. Processing typically takes 2-4 weeks.'],
        ];
    }

    $keyContactsJson = $gs('contact_key_contacts', '');
    $keyContacts = $keyContactsJson ? json_decode($keyContactsJson, true) : [];
    if (!$keyContacts || !is_array($keyContacts)) {
        $keyContacts = [
            ['role' => 'Head of Department', 'name' => 'Dr. Example Name', 'email' => 'hod@cs.nsuk.edu.ng', 'phone' => '+234 800 000 0001'],
            ['role' => 'Departmental Secretary', 'name' => 'Mrs. Example Name', 'email' => 'secretary@cs.nsuk.edu.ng', 'phone' => '+234 800 000 0002'],
            ['role' => 'Exam Officer', 'name' => 'Mr. Example Name', 'email' => 'exams@cs.nsuk.edu.ng', 'phone' => '+234 800 000 0003'],
        ];
    }

    $showFaqs = $gs('contact_show_faqs', '1') === '1';
    $showKeyContacts = $gs('contact_show_key_contacts', '1') === '1';
    $showMap = $gs('contact_show_map', '1') === '1';
    $showPartnership = $gs('contact_show_partnership', '1') === '1';
@endphp

<style>
.contact-hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
    color: white;
    padding: 4rem 0 3.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.contact-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 50%, rgba(22,163,74,0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(8,145,178,0.10) 0%, transparent 50%);
}
.contact-hero::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: repeating-linear-gradient(
        45deg,
        transparent,
        transparent 30px,
        rgba(255,255,255,0.01) 30px,
        rgba(255,255,255,0.01) 60px
    );
    animation: heroPattern 20s linear infinite;
}
@keyframes heroPattern { from { transform: translate(0,0); } to { transform: translate(60px,60px); } }
.contact-hero .hero-content { position: relative; z-index: 2; }

.contact-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(22,163,74,0.15);
    border: 1px solid rgba(22,163,74,0.3);
    padding: 0.35rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    color: #4ade80;
    margin-bottom: 1.2rem;
}
.contact-hero h1 {
    font-family: var(--font-heading);
    font-size: 2.4rem;
    font-weight: 800;
    margin: 0 0 0.7rem;
    color: white;
    letter-spacing: -0.02em;
}
.contact-hero .hero-sub {
    font-size: 1.05rem;
    color: rgba(255,255,255,0.6);
    max-width: 540px;
    margin: 0 auto;
    line-height: 1.7;
}

/* Info Cards */
.contact-info-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem;
    margin-bottom: 2.5rem;
}
.contact-info-card {
    background: white;
    border-radius: 16px;
    padding: 1.8rem 1.4rem 1.6rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 20px rgba(0,0,0,0.04);
    border: 1px solid #f1f5f9;
    border-top: 3px solid var(--card-accent, #e2e8f0);
    text-align: center;
    transition: transform 0.3s cubic-bezier(.4,0,.2,1), box-shadow 0.3s cubic-bezier(.4,0,.2,1), border-color 0.3s ease;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}
.contact-info-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--card-accent, transparent) 0%, transparent 60%);
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: inherit;
}
.contact-info-card:hover::before { opacity: 0.04; }
.contact-info-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.10), 0 4px 12px rgba(0,0,0,0.04);
    border-top-color: var(--card-accent, #e2e8f0);
}
.info-card-icon {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.1rem;
    font-size: 1.25rem;
    transition: transform 0.3s cubic-bezier(.4,0,.2,1), box-shadow 0.3s ease;
    position: relative;
    z-index: 1;
}
.contact-info-card:hover .info-card-icon {
    transform: scale(1.12) translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
.info-card-title {
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 0.95rem;
    margin: 0 0 0.45rem;
    color: #1e293b;
    position: relative;
    z-index: 1;
    letter-spacing: -0.01em;
}
.info-card-text {
    font-size: 0.85rem;
    color: #64748b;
    margin: 0;
    line-height: 1.55;
    position: relative;
    z-index: 1;
}

/* Main Layout */
.contact-main { display: grid; grid-template-columns: 1.15fr 1fr; gap: 2rem; align-items: start; }

/* Contact Form */
.contact-form-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 24px rgba(0,0,0,0.05);
    border: 1px solid #f1f5f9;
}
.contact-form-card h2 {
    font-family: var(--font-heading);
    font-size: 1.25rem;
    font-weight: 800;
    margin: 0 0 0.3rem;
    color: #0f172a;
}
.contact-form-card .subtitle {
    font-size: 0.88rem;
    color: #64748b;
    margin: 0 0 1.5rem;
    line-height: 1.5;
}
.c-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
.c-form-field { display: flex; flex-direction: column; gap: 0.3rem; }
.c-form-field label {
    font-size: 0.82rem;
    font-weight: 600;
    color: #334155;
}
.c-form-field label .req { color: #ef4444; }
.c-form-field input,
.c-form-field textarea,
.c-form-field select {
    width: 100%;
    padding: 0.7rem 0.9rem;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-size: 0.9rem;
    font-family: var(--font-body);
    transition: border-color 0.2s, box-shadow 0.2s;
    outline: none;
    background: #fafbfc;
    color: #1e293b;
    box-sizing: border-box;
}
.c-form-field input:focus,
.c-form-field textarea:focus,
.c-form-field select:focus {
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(22,163,74,0.08);
    background: white;
}
.c-form-field textarea { resize: vertical; min-height: 120px; }
.contact-submit-btn {
    width: 100%;
    padding: 0.8rem;
    background: linear-gradient(135deg, var(--color-primary), #15803d);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 0.95rem;
    font-weight: 700;
    font-family: var(--font-heading);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.25s ease;
    box-shadow: 0 4px 14px rgba(22,163,74,0.25);
    margin-top: 0.3rem;
}
.contact-submit-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(22,163,74,0.35);
}

/* Alert Boxes */
.contact-alert {
    padding: 0.85rem 1.1rem;
    border-radius: 10px;
    margin-bottom: 1.2rem;
    font-size: 0.88rem;
    display: flex;
    align-items: center;
    gap: 0.6rem;
    animation: cSlideIn 0.3s ease;
}
.contact-alert.success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
.contact-alert.error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
@keyframes cSlideIn { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }

/* Sidebar panels */
.contact-sidebar { display: flex; flex-direction: column; gap: 1.2rem; }
.sidebar-card {
    background: white;
    border-radius: 14px;
    padding: 1.5rem;
    box-shadow: 0 4px 24px rgba(0,0,0,0.05);
    border: 1px solid #f1f5f9;
}
.sidebar-card h3 {
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    margin: 0 0 0.8rem;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.sidebar-card h3 i { color: var(--color-primary); }

.partner-card {
    background: linear-gradient(135deg, var(--color-primary), #047857, #0f766e);
    border-radius: 14px;
    padding: 1.5rem;
    color: white;
    position: relative;
    overflow: hidden;
}
.partner-card::before {
    content: '';
    position: absolute;
    top: -30px;
    right: -30px;
    width: 120px;
    height: 120px;
    background: rgba(255,255,255,0.06);
    border-radius: 50%;
}
.partner-card h3 {
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    margin: 0 0 0.6rem;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.partner-card .partner-desc { font-size: 0.85rem; color: rgba(255,255,255,0.8); line-height: 1.6; margin: 0 0 1rem; }
.partner-cta {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(255,255,255,0.15);
    color: white;
    padding: 0.55rem 1.1rem;
    border-radius: 8px;
    font-size: 0.84rem;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.2s;
}
.partner-cta:hover { background: rgba(255,255,255,0.25); }

/* Quick Links */
.quick-link {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.55rem 0.75rem;
    border-radius: 8px;
    text-decoration: none;
    color: #334155;
    font-size: 0.86rem;
    font-weight: 500;
    transition: all 0.15s;
    background: #f8fafc;
}
.quick-link:hover { background: #f0fdf4; color: var(--color-primary); }
.quick-link i { font-size: 0.75rem; width: 18px; text-align: center; color: var(--color-primary); }

/* Social links */
.c-social-link {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #f1f5f9;
    color: #475569;
    text-decoration: none;
    font-size: 1rem;
    transition: all 0.2s;
}
.c-social-link:hover { background: var(--color-primary); color: white; transform: translateY(-2px); }

/* Key Contacts Section */
.key-contacts-section { margin-top: 2.5rem; }
.key-contacts-section h2 {
    font-family: var(--font-heading);
    font-size: 1.3rem;
    font-weight: 800;
    margin: 0 0 0.4rem;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
.key-contacts-section h2 i { color: var(--color-primary); font-size: 1.1rem; }
.key-contacts-section .section-desc { font-size: 0.9rem; color: #64748b; margin: 0 0 1.5rem; }
.key-contacts-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; }
.key-contact-card {
    background: white;
    border-radius: 14px;
    padding: 1.4rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    border: 1px solid #f1f5f9;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    transition: transform 0.2s, box-shadow 0.2s;
}
.key-contact-card:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,0,0,0.08); }
.key-contact-avatar {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(22,163,74,0.1), rgba(8,145,178,0.1));
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.key-contact-avatar i { font-size: 1.2rem; color: var(--color-primary); }
.key-contact-info h4 { font-family: var(--font-heading); font-size: 0.92rem; font-weight: 700; margin: 0 0 0.15rem; color: #1e293b; }
.key-contact-info .role { font-size: 0.78rem; color: var(--color-primary); font-weight: 600; margin: 0 0 0.5rem; }
.key-contact-info .contact-detail {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.8rem;
    color: #64748b;
    text-decoration: none;
    margin-bottom: 0.2rem;
    transition: color 0.15s;
}
.key-contact-info a.contact-detail:hover { color: var(--color-primary); }

/* FAQ Section */
.faq-section { margin-top: 2.5rem; }
.faq-section h2 {
    font-family: var(--font-heading);
    font-size: 1.3rem;
    font-weight: 800;
    margin: 0 0 0.4rem;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
.faq-section h2 i { color: var(--color-primary); font-size: 1.1rem; }
.faq-section .section-desc { font-size: 0.9rem; color: #64748b; margin: 0 0 1.5rem; }
.faq-list { display: flex; flex-direction: column; gap: 0.8rem; }
.faq-item {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    border: 1px solid #f1f5f9;
    overflow: hidden;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.faq-item.open { border-color: rgba(22,163,74,0.2); box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
.faq-question {
    padding: 1.1rem 1.3rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    user-select: none;
    gap: 1rem;
    transition: background 0.15s;
}
.faq-question:hover { background: #fafbfc; }
.faq-question h4 {
    font-family: var(--font-heading);
    font-size: 0.92rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
.faq-question h4 .faq-num {
    width: 26px;
    height: 26px;
    border-radius: 7px;
    background: rgba(22,163,74,0.08);
    color: var(--color-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 700;
    flex-shrink: 0;
}
.faq-question .faq-toggle {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    font-size: 0.7rem;
    transition: transform 0.3s, background 0.2s, color 0.2s;
    flex-shrink: 0;
}
.faq-item.open .faq-toggle { transform: rotate(180deg); background: var(--color-primary); color: white; }
.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.35s ease, padding 0.35s ease;
}
.faq-item.open .faq-answer { max-height: 300px; }
.faq-answer-inner {
    padding: 0 1.3rem 1.2rem 1.3rem;
    padding-left: calc(1.3rem + 26px + 0.6rem);
    font-size: 0.88rem;
    color: #475569;
    line-height: 1.7;
}

/* Map Section */
.c-map-section {
    margin-top: 2.5rem;
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(0,0,0,0.05);
    border: 1px solid #f1f5f9;
}
.c-map-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.c-map-header h3 {
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.c-map-header h3 i { color: var(--color-primary); }
.map-directions {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--color-primary);
    text-decoration: none;
    padding: 0.35rem 0.8rem;
    border-radius: 6px;
    transition: background 0.15s;
}
.map-directions:hover { background: #f0fdf4; }

/* Responsive */
@media (max-width: 900px) {
    .contact-main { grid-template-columns: 1fr !important; }
    .contact-info-grid { grid-template-columns: repeat(2, 1fr); }
    .contact-hero h1 { font-size: 1.8rem; }
}
@media (max-width: 550px) {
    .contact-info-grid { grid-template-columns: 1fr; }
    .c-form-grid { grid-template-columns: 1fr; }
    .key-contacts-grid { grid-template-columns: 1fr; }
    .contact-hero { padding: 2.5rem 0 2rem; }
    .contact-hero h1 { font-size: 1.5rem; }
}
</style>

{{-- ── Hero ── --}}
<div class="contact-hero">
    <div class="hero-content container">
        <div class="contact-badge">
            <i class="fa-solid fa-envelope"></i> {{ $gs('contact_hero_badge', 'Get in Touch') }}
        </div>
        <h1>{{ $gs('contact_hero_title', 'Contact the Department') }}</h1>
        <p class="hero-sub">{{ $gs('contact_hero_subtitle', 'Have questions, feedback, or partnership inquiries? We\'d love to hear from you.') }}</p>
    </div>
</div>

<div class="container" style="max-width: 1100px; margin-top: -1.5rem; padding-bottom: 3rem; position: relative; z-index: 2;">

    {{-- ── Quick Info Cards ── --}}
    <div class="contact-info-grid">
        @php
            $cards = [
                ['icon' => 'fa-solid fa-location-dot', 'title' => 'Visit Us', 'text' => $gs('contact_address', config('university.university').',<br>Keffi, Nasarawa State'), 'color' => '#16a34a', 'bg' => '#dcfce7', 'href' => '#map-section'],
                ['icon' => 'fa-solid fa-envelope', 'title' => 'Email Us', 'text' => $gs('contact_email', 'info@dcms.nsuk.edu.ng'), 'color' => '#0891b2', 'bg' => '#cffafe', 'href' => 'mailto:'.$gs('contact_email', 'info@dcms.nsuk.edu.ng')],
                ['icon' => 'fa-solid fa-phone', 'title' => 'Call Us', 'text' => $gs('contact_phone', '+234 (0) 123 456 7890'), 'color' => '#7c3aed', 'bg' => '#ede9fe', 'href' => 'tel:'.preg_replace('/[^+0-9]/', '', $gs('contact_phone', '+2340123456789'))],
                ['icon' => 'fa-solid fa-clock', 'title' => 'Office Hours', 'text' => $gs('contact_hours', 'Mon – Fri: 8 AM – 4 PM'), 'color' => '#ea580c', 'bg' => '#ffedd5', 'href' => null],
            ];
        @endphp
        @foreach($cards as $card)
        <a @if($card['href']) href="{{ $card['href'] }}" @endif class="contact-info-card" style="--card-accent: {{ $card['color'] }};" @if($card['href'] && str_starts_with($card['href'], 'mailto:')) target="_blank" @endif>
            <div class="info-card-icon" style="background: {{ $card['bg'] }};">
                <i class="{{ $card['icon'] }}" style="color: {{ $card['color'] }};"></i>
            </div>
            <h4 class="info-card-title">{{ $card['title'] }}</h4>
            <p class="info-card-text">{!! $card['text'] !!}</p>
        </a>
        @endforeach
    </div>

    {{-- ── Main Content: Form + Sidebar ── --}}
    <div class="contact-main">
        {{-- Contact Form --}}
        <div class="contact-form-card">
            @if(session('success'))
            <div class="contact-alert success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="contact-alert error">
                <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
            </div>
            @endif

            <h2>{{ $gs('contact_form_title', 'Send Us a Message') }}</h2>
            <p class="subtitle">{{ $gs('contact_form_subtitle', 'Fill out the form below and we\'ll get back to you as soon as possible.') }}</p>

            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="c-form-grid">
                    <div class="c-form-field">
                        <label>Full Name <span class="req">*</span></label>
                        <input type="text" name="name" required value="{{ old('name') }}" placeholder="e.g. John Doe">
                    </div>
                    <div class="c-form-field">
                        <label>Email Address <span class="req">*</span></label>
                        <input type="email" name="email" required value="{{ old('email') }}" placeholder="e.g. john@example.com">
                    </div>
                </div>

                <div class="c-form-field" style="margin-bottom: 1rem;">
                    <label>Subject <span class="req">*</span></label>
                    <select name="subject" required style="appearance: auto;">
                        <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select a topic...</option>
                        @foreach([
                            'General Inquiry',
                            'Admission Inquiry',
                            'Academic Records / Transcripts',
                            'Partnership / Collaboration',
                            'Feedback / Suggestion',
                            'Complaint',
                            'Other',
                        ] as $topic)
                        <option value="{{ $topic }}" {{ old('subject') === $topic ? 'selected' : '' }}>{{ $topic }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="c-form-field" style="margin-bottom: 1.2rem;">
                    <label>Message <span class="req">*</span></label>
                    <textarea name="message" rows="5" required placeholder="Write your message here...">{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="contact-submit-btn">
                    <i class="fa-solid fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>

        {{-- Sidebar --}}
        <div class="contact-sidebar">

            {{-- About the Department --}}
            <div class="sidebar-card">
                <h3>
                    <i class="fa-solid fa-building-columns"></i> {{ $gs('contact_about_title', 'About the Department') }}
                </h3>
                <p style="font-size: 0.86rem; color: #475569; line-height: 1.7; margin: 0;">
                    {{ $gs('contact_about_text', 'The '.config('university.name').' at '.config('university.university').' is dedicated to producing world-class computing professionals through quality education, research, and community engagement.') }}
                </p>
            </div>

            {{-- Partnership Card --}}
            @if($showPartnership)
            <div class="partner-card">
                <h3><i class="fa-solid fa-handshake"></i> {{ $gs('contact_partner_title', 'Partner With Us') }}</h3>
                <p class="partner-desc">{{ $gs('contact_partner_text', 'We collaborate with tech companies and organizations for internships, joint research, and curriculum development. Let\'s shape the next generation of IT leaders together.') }}</p>
                <a href="#" class="partner-cta" onclick="document.querySelector('select[name=subject]').value='Partnership / Collaboration'; document.querySelector('textarea[name=message]').focus(); return false;">
                    <i class="fa-solid fa-arrow-right" style="font-size: 0.7rem;"></i> {{ $gs('contact_partner_btn', 'Propose Partnership') }}
                </a>
            </div>
            @endif

            {{-- Quick Links --}}
            <div class="sidebar-card">
                <h3><i class="fa-solid fa-link"></i> Useful Links</h3>
                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    @foreach([
                        ['url' => '/about', 'label' => 'About the Department', 'icon' => 'fa-solid fa-building-columns'],
                        ['url' => '/academics', 'label' => 'Academic Programmes', 'icon' => 'fa-solid fa-graduation-cap'],
                        ['url' => '/people', 'label' => 'Faculty & Staff', 'icon' => 'fa-solid fa-users'],
                        ['url' => '/gallery', 'label' => 'Photo Gallery', 'icon' => 'fa-solid fa-images'],
                    ] as $link)
                    <a href="{{ $link['url'] }}" class="quick-link">
                        <i class="{{ $link['icon'] }}"></i> {{ $link['label'] }}
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Social Links --}}
            @php $socialLinks = \App\Models\SocialLink::where('is_active', true)->orderBy('sort_order')->get(); @endphp
            @if($socialLinks->count())
            <div class="sidebar-card">
                <h3><i class="fa-solid fa-share-nodes"></i> Connect With Us</h3>
                <div style="display: flex; gap: 0.6rem; flex-wrap: wrap;">
                    @foreach($socialLinks as $sl)
                    <a href="{{ $sl->url }}" target="_blank" rel="noopener noreferrer" class="c-social-link" title="{{ $sl->platform }}">
                        <i class="{{ $sl->icon }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- ── Key Department Contacts ── --}}
    @if($showKeyContacts && count($keyContacts) > 0)
    <div class="key-contacts-section">
        <h2><i class="fa-solid fa-user-tie"></i> {{ $gs('contact_key_contacts_title', 'Key Department Contacts') }}</h2>
        <p class="section-desc">{{ $gs('contact_key_contacts_subtitle', 'Reach out directly to the relevant office for faster assistance.') }}</p>
        <div class="key-contacts-grid">
            @foreach($keyContacts as $contact)
            <div class="key-contact-card">
                <div class="key-contact-avatar">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div class="key-contact-info">
                    <h4>{{ $contact['name'] ?? 'N/A' }}</h4>
                    <p class="role">{{ $contact['role'] ?? '' }}</p>
                    @if(!empty($contact['email']))
                    <a href="mailto:{{ $contact['email'] }}" class="contact-detail"><i class="fa-solid fa-envelope" style="font-size: 0.7rem;"></i> {{ $contact['email'] }}</a>
                    @endif
                    @if(!empty($contact['phone']))
                    <a href="tel:{{ preg_replace('/[^+0-9]/', '', $contact['phone']) }}" class="contact-detail"><i class="fa-solid fa-phone" style="font-size: 0.7rem;"></i> {{ $contact['phone'] }}</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ── FAQ Section ── --}}
    @if($showFaqs && count($faqs) > 0)
    <div class="faq-section">
        <h2><i class="fa-solid fa-circle-question"></i> {{ $gs('contact_faq_title', 'Frequently Asked Questions') }}</h2>
        <p class="section-desc">{{ $gs('contact_faq_subtitle', 'Quick answers to common questions about the department.') }}</p>
        <div class="faq-list">
            @foreach($faqs as $i => $faq)
            <div class="faq-item{{ $i === 0 ? ' open' : '' }}">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <h4><span class="faq-num">{{ $i + 1 }}</span> {{ $faq['q'] }}</h4>
                    <div class="faq-toggle"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-answer">
                    <div class="faq-answer-inner">{{ $faq['a'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ── Map Section ── --}}
    @if($showMap)
    @php
        $mapMode     = $gs('contact_map_mode', 'embed');
        $mapEmbed    = $gs('contact_map_embed', '');
        $mapLat      = $gs('contact_map_lat', '8.8467');
        $mapLng      = $gs('contact_map_lng', '7.8736');
        $mapZoom     = $gs('contact_map_zoom', '15');

        if ($mapMode === 'embed' && !empty(trim($mapEmbed))) {
            // Auto-extract src from full <iframe> tag if pasted
            $raw = trim($mapEmbed);
            if (stripos($raw, '<iframe') === 0 && preg_match('/src=["\']([^"\']+)["\']/', $raw, $m)) {
                $mapEmbedUrl = $m[1];
            } else {
                $mapEmbedUrl = $raw;
            }
            $mapProvider = 'custom';
        } else {
            // Use OpenStreetMap embed (no API key required, always works)
            $bbox = [
                (float)$mapLng - 0.012,
                (float)$mapLat - 0.008,
                (float)$mapLng + 0.012,
                (float)$mapLat + 0.008,
            ];
            $mapEmbedUrl = 'https://www.openstreetmap.org/export/embed.html?bbox='
                . implode(',', $bbox)
                . '&layer=mapnik&marker=' . $mapLat . ',' . $mapLng;
            $mapProvider = 'osm';
        }

        $mapDirectionsUrl = 'https://www.google.com/maps/dir/?api=1&destination=' . $mapLat . ',' . $mapLng;
    @endphp
    <div class="c-map-section" id="map-section">
        <div class="c-map-header">
            <h3><i class="fa-solid fa-map-location-dot"></i> Find Us on the Map</h3>
            <a href="{{ $mapDirectionsUrl }}" target="_blank" rel="noopener" class="map-directions">
                <i class="fa-solid fa-diamond-turn-right"></i> Get Directions
            </a>
        </div>
        <iframe src="{{ $mapEmbedUrl }}" width="100%" height="350" style="border:0; display:block; border-radius: 0 0 16px 16px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    @endif
</div>

<script>
function toggleFaq(el) {
    const item = el.closest('.faq-item');
    const wasOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach(i => i.classList.remove('open'));
    if (!wasOpen) item.classList.add('open');
}
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.contact-alert').forEach(el => {
        setTimeout(() => { el.style.opacity = '0'; el.style.transform = 'translateY(-8px)'; setTimeout(() => el.remove(), 300); }, 5000);
    });
});
</script>
@endsection
