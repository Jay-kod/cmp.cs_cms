import sys

with open("resources/views/pages/people/show.blade.php", "w", encoding="utf-8") as f:
    f.write("""@extends('layouts.public')
@section('title', $staff->name . ' - Staff Profile')

@section('content')
<style>
/* =========================================================================
   STAFF PROFILE: PREMIUM MODERN DESIGN
   ========================================================================= */
:root {
    --profile-primary: #1e3a8a;
    --profile-secondary: #0f172a;
    --profile-accent: #3b82f6;
    --profile-text: #334155;
    --profile-light: #f8fafc;
    --profile-border: rgba(226, 232, 240, 0.8);
    --profile-shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
    --profile-shadow-md: 0 10px 25px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
    --profile-shadow-lg: 0 20px 40px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
    --hero-pattern: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

/* 1. Hero Section */
.profile-hero {
    background: linear-gradient(135deg, var(--profile-secondary) 0%, var(--profile-primary) 100%);
    background-image: var(--hero-pattern), linear-gradient(135deg, var(--profile-secondary) 0%, var(--profile-primary) 100%);
    color: white;
    padding: 4rem 0 6.5rem;
    position: relative;
    overflow: hidden;
}

.hero-decoration {
    position: absolute;
    border-radius: 50%;
    filter: blur(40px);
    z-index: 0;
}
.hero-decoration.dec-1 {
    top: -100px; right: -50px; width: 300px; height: 300px;
    background: rgba(59, 130, 246, 0.25);
}
.hero-decoration.dec-2 {
    bottom: -150px; left: -100px; width: 400px; height: 400px;
    background: rgba(147, 197, 253, 0.15);
}

.profile-hero .container {
    position: relative;
    z-index: 10;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 2rem;
    padding: 8px 16px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.back-link:hover {
    color: white;
    background: rgba(255, 255, 255, 0.15);
    transform: translateX(-4px);
    border-color: rgba(255, 255, 255, 0.2);
}

.hero-content {
    display: flex;
    gap: 3rem;
    align-items: center;
}

/* Photo */
.hero-photo-container {
    flex-shrink: 0;
    position: relative;
}
.hero-photo-frame {
    width: 200px;
    height: 200px;
    border-radius: 24px;
    padding: 6px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(10px);
    transform: translateY(0);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}
.hero-photo-frame:hover {
    transform: translateY(-8px);
    box-shadow: 0 30px 50px rgba(0, 0, 0, 0.4);
}
.hero-photo-img {
    width: 100%;
    height: 100%;
    border-radius: 18px;
    object-fit: cover;
    background: var(--profile-secondary);
}

/* Profile Details */
.hero-details {
    flex: 1;
}

.hero-badges {
    display: flex;
    gap: 0.8rem;
    flex-wrap: wrap;
    margin-bottom: 1rem;
}

.badge {
    padding: 6px 16px;
    border-radius: 30px;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    backdrop-filter: blur(4px);
}
.badge-hod { background: var(--color-accent); color: var(--color-primary); box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3); }
.badge-status i { font-size: 0.4rem; }
.badge-tenure { background: rgba(34, 197, 94, 0.2); color: #86efac; border: 1px solid rgba(34, 197, 94, 0.3); }
.badge-visiting { background: rgba(59, 130, 246, 0.2); color: #93c5fd; border: 1px solid rgba(59, 130, 246, 0.3); }
.badge-sabbatical { background: rgba(245, 158, 11, 0.2); color: #fcd34d; border: 1px solid rgba(245, 158, 11, 0.3); }

.hero-name {
    font-size: 3rem;
    font-weight: 800;
    margin: 0 0 0.5rem;
    line-height: 1.1;
    letter-spacing: -1px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}
.hero-rank {
    font-size: 1.25rem;
    font-weight: 600;
    color: #93c5fd;
    margin: 0 0 1.2rem;
    display: flex;
    align-items: center;
    gap: 8px;
}
.hero-rank::before {
    content: '';
    display: inline-block;
    width: 24px;
    height: 3px;
    background: #93c5fd;
    border-radius: 2px;
}

.hero-role-wrapper {
    margin-bottom: 1.5rem;
}
.badge-role {
    background: rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(255, 255, 255, 0.2);
    font-weight: 600;
    text-transform: none;
    letter-spacing: 0;
}

.hero-contact {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    font-size: 0.95rem;
    background: rgba(0, 0, 0, 0.2);
    padding: 1rem 1.5rem;
    border-radius: 12px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.05);
}
.hero-contact-item {
    color: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}
.hero-contact-item i {
    color: #93c5fd;
}
.hero-contact-item.link:hover {
    color: white;
}
.hero-contact-item.link:hover i {
    color: white;
}

/* 2. Layout Container */
.main-profile-container {
    margin-top: -3.5rem;
    position: relative;
    z-index: 20;
    margin-bottom: 4rem;
}

/* 3. Quick Stats Cards Grid */
.stats-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2.5rem;
}
.stat-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: var(--profile-shadow-md);
    display: flex;
    align-items: center;
    gap: 1.2rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid var(--profile-border);
}
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--profile-shadow-lg);
    border-color: var(--profile-accent);
}
.stat-icon {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    background: #eef2ff;
    color: var(--profile-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}
.stat-card.success .stat-icon {
    background: #dcfce7;
    color: #16a34a;
}
.stat-info .stat-value {
    margin: 0;
    font-size: 1.6rem;
    font-weight: 800;
    color: var(--profile-primary);
    line-height: 1;
}
.stat-info .stat-label {
    margin: 0.3rem 0 0;
    font-size: 0.8rem;
    color: #64748b;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* 4. Main Grid: Content & Sidebar */
.profile-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 2.5rem;
    align-items: start;
}

/* Main Sections */
.profile-section {
    background: white;
    border-radius: 16px;
    padding: 2.5rem;
    margin-bottom: 2rem;
    box-shadow: var(--profile-shadow-sm);
    border: 1px solid var(--profile-border);
    position: relative;
    overflow: hidden;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.8rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f1f5f9;
}
.section-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}
.section-icon.blue { background: #eef2ff; color: var(--profile-accent); }
.section-icon.amber { background: #fef3c7; color: #d97706; }
.section-icon.purple { background: #f3e8ff; color: #9333ea; }
.section-icon.green { background: #dcfce7; color: #16a34a; }
.section-icon.red { background: #fee2e2; color: #dc2626; }

.section-title {
    margin: 0;
    font-size: 1.5rem;
    color: var(--profile-secondary);
    font-weight: 700;
}

.section-count {
    margin-left: auto;
    background: var(--profile-light);
    color: var(--profile-text);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 700;
    border: 1px solid #e2e8f0;
}

.section-content {
    font-size: 1.05rem;
    line-height: 1.8;
    color: var(--profile-text);
}

/* Sidebar Elements */
.sidebar-widget {
    background: white;
    border-radius: 16px;
    box-shadow: var(--profile-shadow-sm);
    border: 1px solid var(--profile-border);
    margin-bottom: 1.5rem;
    position: sticky;
    top: 2rem;
    overflow: hidden;
}

.widget-header {
    background: linear-gradient(135deg, var(--profile-primary), var(--profile-accent));
    padding: 1.2rem 1.5rem;
    color: white;
}
.widget-header h3 {
    margin: 0;
    font-size: 1.05rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 8px;
}
.widget-header.light {
    background: var(--profile-light);
    color: var(--profile-secondary);
    border-bottom: 1px solid var(--profile-border);
}

.widget-body {
    padding: 1.5rem;
}

.contact-list {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
}
.contact-item {
    display: flex;
    gap: 14px;
}
.contact-item-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #eef2ff;
    color: var(--profile-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}
.contact-item-info p.label {
    margin: 0 0 4px;
    color: #94a3b8;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.contact-item-info p.value, .contact-item-info a.value {
    margin: 0;
    color: var(--profile-text);
    font-size: 0.95rem;
    font-weight: 500;
    text-decoration: none;
    word-break: break-word;
}
.contact-item-info a.value:hover {
    color: var(--profile-accent);
    text-decoration: underline;
}

/* Courses Grid */
.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 1.2rem;
}
.course-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 1.5rem;
    border-radius: 12px;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.course-card:hover {
    background: white;
    box-shadow: var(--profile-shadow-md);
    border-color: var(--profile-accent);
    transform: translateY(-3px);
}
.course-code {
    color: var(--profile-accent);
    font-weight: 700;
    font-size: 0.9rem;
    margin: 0 0 0.5rem;
}
.course-title {
    color: var(--profile-secondary);
    font-weight: 600;
    font-size: 1.05rem;
    margin: 0 0 1rem;
    line-height: 1.4;
}
.course-level {
    display: inline-block;
    background: #eef2ff;
    color: #4338ca;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    align-self: flex-start;
}

/* Publications List */
.publications-list {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
}
.pub-card {
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    transition: all 0.2s ease;
}
.pub-card:hover {
    background: white;
    border-color: var(--profile-accent);
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.pub-title {
    margin: 0 0 0.8rem;
    font-size: 1.1rem;
    color: var(--profile-secondary);
    font-weight: 600;
    line-height: 1.5;
}
.pub-meta {
    font-size: 0.9rem;
    color: #64748b;
    margin: 0 0 1rem;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
}
.pub-type {
    background: #e2e8f0;
    color: #475569;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}
.pub-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--profile-accent);
    text-decoration: none;
    transition: color 0.2s;
}
.pub-link:hover {
    color: #1e40af;
    text-decoration: underline;
}

/* Nav Links */
.nav-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 14px;
    border-radius: 10px;
    color: var(--profile-text);
    text-decoration: none;
    font-weight: 500;
    margin-bottom: 6px;
    transition: all 0.2s;
}
.nav-link i {
    width: 20px;
    text-align: center;
    color: #94a3b8;
    font-size: 1.1rem;
    transition: color 0.2s;
}
.nav-link:hover {
    background: #f1f5f9;
    color: var(--profile-primary);
}
.nav-link:hover i {
    color: var(--profile-primary);
}
.nav-link.active {
    background: #eef2ff;
    color: var(--profile-accent);
    font-weight: 600;
}
.nav-link.active i {
    color: var(--profile-accent);
}

/* Academic Links */
.social-link-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 14px;
    background: white;
    border: 1px solid var(--profile-border);
    border-radius: 10px;
    text-decoration: none;
    color: var(--profile-text);
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s;
}
.social-link-btn i.fa-external-link-alt {
    margin-left: auto;
    color: #cbd5e1;
    font-size: 0.8rem;
}
.social-link-btn.scholar:hover {
    border-color: #4285F4;
    color: #4285F4;
    box-shadow: 0 4px 12px rgba(66, 133, 244, 0.15);
}
.social-link-btn.scholar .social-icon-box { background: #4285F4; }

.social-link-btn.researchgate:hover {
    border-color: #00CCBB;
    color: #00CCBB;
    box-shadow: 0 4px 12px rgba(0, 204, 187, 0.15);
}
.social-link-btn.researchgate .social-icon-box { background: #00CCBB; }

.social-icon-box {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

/* Responsive */
@media (max-width: 991px) {
    .profile-grid { grid-template-columns: 1fr; }
    .sidebar-widget { position: static; }
}

@media (max-width: 768px) {
    .hero-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }
    .hero-name { font-size: 2.2rem; }
    .hero-badges { justify-content: center; }
    .hero-rank { justify-content: center; }
    .hero-contact { justify-content: center; }
    .profile-hero { padding: 3rem 0 5rem; }
}
@media (max-width: 575px) {
    .hero-name { font-size: 1.8rem; }
    .hero-photo-frame { width: 160px; height: 160px; }
    .stats-wrapper { grid-template-columns: 1fr; gap: 1rem; }
    .profile-section { padding: 1.5rem; }
}
</style>

{{-- Profile Hero --}}
<div class="profile-hero">
    <div class="hero-decoration dec-1"></div>
    <div class="hero-decoration dec-2"></div>

    <div class="container relative">
        <a href="{{ route('people.index') }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Back to People
        </a>

        <div class="hero-content">
            {{-- Photo --}}
            <div class="hero-photo-container">
                <div class="hero-photo-frame">
                    <img src="{{ $staff->photo ? asset('storage/'.$staff->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($staff->name) . '&size=200&background=0f172a&color=fff&bold=true&format=svg' }}" alt="{{ $staff->name }}" class="hero-photo-img" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($staff->name) }}&size=200&background=0f172a&color=fff&bold=true&format=svg'">
                </div>
            </div>

            {{-- Name & Title --}}
            <div class="hero-details">
                <div class="hero-badges">
                    @if($staff->is_hod)
                    <span class="badge badge-hod">
                        <i class="fa-solid fa-star" style="font-size: 0.65rem;"></i> Head of Department
                    </span>
                    @endif
                    @if($staff->status)
                        <span class="badge badge-status badge-{{ strtolower($staff->status) }}">
                            <i class="fa-solid fa-circle"></i> {{ $staff->status }}
                        </span>
                    @endif
                </div>

                <h1 class="hero-name">{{ $staff->title }} {{ $staff->name }}</h1>
                <p class="hero-rank">{{ $staff->rank }}</p>

                @if($staff->role)
                <div class="hero-role-wrapper">
                    <span class="badge badge-role">
                        <i class="fa-solid fa-id-badge"></i> {{ $staff->role }}
                    </span>
                </div>
                @endif

                {{-- Quick contact --}}
                <div class="hero-contact">
                    @if($staff->email)
                    <a href="mailto:{{ $staff->email }}" class="hero-contact-item link">
                        <i class="fa-solid fa-envelope"></i> <span>{{ $staff->email }}</span>
                    </a>
                    @endif
                    @if($staff->phone)
                    <span class="hero-contact-item">
                        <i class="fa-solid fa-phone"></i> <span>{{ $staff->phone }}</span>
                    </span>
                    @endif
                    @if($staff->office_location)
                    <span class="hero-contact-item">
                        <i class="fa-solid fa-building"></i> <span>{{ $staff->office_location }}</span>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container main-profile-container">

    {{-- Quick Stats Bar --}}
    <div class="stats-wrapper">
        @if($staff->publications && $staff->publications->count() > 0)
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-book-open"></i></div>
            <div class="stat-info">
                <p class="stat-value">{{ $staff->publications->count() }}</p>
                <p class="stat-label">Publications</p>
            </div>
        </div>
        @endif
        @if($staff->courses && $staff->courses->count() > 0)
        <div class="stat-card">
            <div class="stat-icon" style="background: #fef3c7; color: #d97706;"><i class="fa-solid fa-chalkboard-user"></i></div>
            <div class="stat-info">
                <p class="stat-value">{{ $staff->courses->count() }}</p>
                <p class="stat-label">Courses</p>
            </div>
        </div>
        @endif
        @if($staff->specialisation)
        <div class="stat-card">
            <div class="stat-icon" style="background: #f3e8ff; color: #9333ea;"><i class="fa-solid fa-microchip"></i></div>
            <div class="stat-info">
                <p class="stat-value"><i class="fa-solid fa-check"></i></p>
                <p class="stat-label">Specialist</p>
            </div>
        </div>
        @endif
        @if($staff->accepting_pg)
        <div class="stat-card success">
            <div class="stat-icon"><i class="fa-solid fa-user-graduate"></i></div>
            <div class="stat-info">
                <p class="stat-value">Open</p>
                <p class="stat-label">Accepting PG</p>
            </div>
        </div>
        @endif
    </div>

    <div class="profile-grid">
        {{-- Main Content --}}
        <div>
            {{-- Biography --}}
            <section id="biography" class="profile-section">
                <div class="section-header">
                    <div class="section-icon blue">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <h2 class="section-title">Biography</h2>
                </div>
                <div class="section-content">
                    {!! nl2br(e($staff->bio ?? 'Biography information is currently unavailable.')) !!}
                </div>
            </section>

            {{-- Qualifications --}}
            @if($staff->qualifications)
            <section id="qualifications" class="profile-section">
                <div class="section-header">
                    <div class="section-icon amber">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h2 class="section-title">Qualifications</h2>
                </div>
                <div class="section-content">
                    <p style="margin:0;">{{ $staff->qualifications }}</p>
                </div>
            </section>
            @endif

            {{-- Specialisation --}}
            @if($staff->specialisation)
            <section id="specialisation" class="profile-section">
                <div class="section-header">
                    <div class="section-icon purple">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <h2 class="section-title">Specialisation / Research Areas</h2>
                </div>
                <div class="section-content">
                    <p style="margin:0;">{{ $staff->specialisation }}</p>
                </div>
            </section>
            @endif

            {{-- Courses --}}
            @if($staff->courses && $staff->courses->count() > 0)
            <section id="courses" class="profile-section">
                <div class="section-header">
                    <div class="section-icon green">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <h2 class="section-title">Courses Taught</h2>
                    <span class="section-count">{{ $staff->courses->count() }}</span>
                </div>
                <div class="courses-grid">
                    @foreach($staff->courses as $course)
                    <div class="course-card">
                        <div>
                            <p class="course-code">{{ $course->code }}</p>
                            <p class="course-title">{{ $course->title }}</p>
                        </div>
                        @if($course->level)
                        <span class="course-level">Level {{ $course->level }}</span>
                        @endif
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- Publications --}}
            @if($staff->publications && $staff->publications->count() > 0)
            <section id="publications" class="profile-section">
                <div class="section-header">
                    <div class="section-icon red">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <h2 class="section-title">Latest Publications</h2>
                    <span class="section-count">{{ $staff->publications->count() }}</span>
                </div>
                <div class="publications-list">
                    @foreach($staff->publications as $pub)
                    <div class="pub-card">
                        <h4 class="pub-title">{{ $pub->title }}</h4>
                        <div class="pub-meta">
                            @if($pub->journal)<span><i class="fa-regular fa-newspaper" style="margin-right:4px;"></i> {{ $pub->journal }}</span>@endif
                            @if($pub->year)<span>• {{ $pub->year }}</span>@endif
                            @if($pub->type)<span class="pub-type">{{ $pub->type }}</span>@endif
                        </div>
                        @if($pub->url)
                        <a href="{{ $pub->url }}" target="_blank" class="pub-link">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> View Publication
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </section>
            @endif
        </div>

        {{-- Sidebar --}}
        <div>
            {{-- Quick Navigation --}}
            <div class="sidebar-widget">
                <div class="widget-header light">
                    <h3><i class="fa-solid fa-compass" style="color:var(--profile-accent); margin-right:6px;"></i> Quick Navigation</h3>
                </div>
                <div class="widget-body" style="padding: 1rem;">
                    <a href="#biography" class="nav-link">
                        <i class="fa-solid fa-user"></i> Biography
                    </a>
                    @if($staff->qualifications)
                    <a href="#qualifications" class="nav-link">
                        <i class="fa-solid fa-graduation-cap"></i> Qualifications
                    </a>
                    @endif
                    @if($staff->specialisation)
                    <a href="#specialisation" class="nav-link">
                        <i class="fa-solid fa-microchip"></i> Specialisation
                    </a>
                    @endif
                    @if($staff->courses && $staff->courses->count() > 0)
                    <a href="#courses" class="nav-link">
                        <i class="fa-solid fa-book"></i> Courses
                    </a>
                    @endif
                    @if($staff->publications && $staff->publications->count() > 0)
                    <a href="#publications" class="nav-link">
                        <i class="fa-solid fa-book-open"></i> Publications
                    </a>
                    @endif
                </div>
            </div>

            {{-- Contact Card --}}
            <div class="sidebar-widget">
                <div class="widget-header">
                    <h3><i class="fa-solid fa-address-card" style="margin-right:6px;"></i> Contact Information</h3>
                </div>
                <div class="widget-body">
                    <div class="contact-list">
                        @if($staff->email)
                        <div class="contact-item">
                            <div class="contact-item-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="contact-item-info">
                                <p class="label">Email Address</p>
                                <a href="mailto:{{ $staff->email }}" class="value">{{ $staff->email }}</a>
                            </div>
                        </div>
                        @endif

                        @if($staff->phone)
                        <div class="contact-item">
                            <div class="contact-item-icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div class="contact-item-info">
                                <p class="label">Phone Number</p>
                                <p class="value">{{ $staff->phone }}</p>
                            </div>
                        </div>
                        @endif

                        @if($staff->office_location)
                        <div class="contact-item">
                            <div class="contact-item-icon">
                                <i class="fa-solid fa-building"></i>
                            </div>
                            <div class="contact-item-info">
                                <p class="label">Office Location</p>
                                <p class="value">{{ $staff->office_location }}</p>
                            </div>
                        </div>
                        @endif

                        @if($staff->address)
                        <div class="contact-item">
                            <div class="contact-item-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="contact-item-info">
                                <p class="label">Mailing Address</p>
                                <p class="value">{{ $staff->address }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Academic Profile Links --}}
                @if($staff->google_scholar_url || $staff->researchgate_url)
                <div class="widget-body" style="border-top: 1px solid var(--profile-border); background: #f8fafc; padding-top: 1.2rem;">
                    <p class="label" style="font-size:0.75rem; color:#94a3b8; font-weight:700; text-transform:uppercase; margin:0 0 1rem; letter-spacing:0.5px;">Academic Profiles</p>
                    <div style="display:flex; flex-direction:column; gap:0.8rem;">
                        @if($staff->google_scholar_url)
                        <a href="{{ $staff->google_scholar_url }}" target="_blank" class="social-link-btn scholar">
                            <div class="social-icon-box" style="background: #4285F4;">
                                <i class="fa-brands fa-google"></i>
                            </div>
                            Google Scholar
                            <i class="fa-solid fa-external-link-alt"></i>
                        </a>
                        @endif
                        @if($staff->researchgate_url)
                        <a href="{{ $staff->researchgate_url }}" target="_blank" class="social-link-btn researchgate">
                            <div class="social-icon-box" style="background: #00CCBB;">
                                <i class="fa-brands fa-researchgate"></i>
                            </div>
                            ResearchGate
                            <i class="fa-solid fa-external-link-alt"></i>
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for navigation links
    document.querySelectorAll('.nav-link').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                // Update active state
                document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
                this.classList.add('active');
                
                // Scroll
                const yOffset = -100; // Account for sticky header if any
                const y = targetElement.getBoundingClientRect().top + window.pageYOffset + yOffset;
                
                window.scrollTo({top: y, behavior: 'smooth'});
            }
        });
    });
    
    // Highlight active section on scroll
    const sections = document.querySelectorAll('.profile-section');
    const navLinks = document.querySelectorAll('.nav-link');
    
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (window.scrollY >= (sectionTop - 150)) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    });
});
</script>
@endsection
""")
