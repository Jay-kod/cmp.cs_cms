<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-favicon.png') }}">
    <title>@yield('title', config('university.name')) - {{ config('university.short_name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Dynamic branding colors from CMS settings --}}
    <style>
        :root {
            --color-primary: {{ $brandColors['primary'] ?? '#16a34a' }};
            --color-primary-light: {{ $brandColors['accent'] ?? '#22c55e' }};
            --color-secondary: {{ $brandColors['secondary'] ?? '#15803d' }};
            --color-accent: {{ $brandColors['accent'] ?? '#22c55e' }};
        }
    </style>
</head>
<body class="antialiased">
    
    <!-- Preloader -->
    <div id="preloader" style="position: fixed; inset: 0; z-index: 99999; background: white; display: flex; flex-direction: column; align-items: center; justify-content: center; transition: opacity 0.5s ease, visibility 0.5s ease;">
        <img src="{{ asset('images/logo.png') }}" alt="NSUK Logo" style="width: 120px; height: 120px; animation: heartbeat 1.2s cubic-bezier(0.4, 0, 0.6, 1) infinite;">
        <h2 style="margin: 1.5rem 0 0 0; font-family: 'Outfit', sans-serif; font-size: 1.6rem; font-weight: 700; color: #1B2A4A; letter-spacing: 2px;">CMP NSUK</h2>
    </div>
    <style>
        @keyframes heartbeat { 
            0%, 100% { transform: scale(1); } 
            50% { transform: scale(1.15); } 
        }
    </style>

    <!-- Fixed Header -->
    <header class="fixed-header">
        <div class="fixed-header-inner">
            <x-nav.layer-1 />
            <x-nav.layer-2 />
            <x-nav.layer-3 />
        </div>
    </header>
    <div class="header-spacer"></div>
    <style>
        .header-spacer { height: 88px; }
        .mobile-only { display: none; }
        p { text-align: justify; }
        @media(max-width:991px) {
            .header-spacer { height: 68px; }
            .mobile-only { display: inline !important; }
        }
    </style>

    <!-- Search Overlay -->
    <div id="search-overlay" style="display:none; position:fixed; inset:0; z-index:100000; background:rgba(0,0,0,0.55); backdrop-filter:blur(4px); align-items:flex-start; justify-content:center; padding-top:15vh; transition:opacity 0.25s;">
        <div style="background:#fff; width:92%; max-width:620px; border-radius:14px; box-shadow:0 20px 60px rgba(0,0,0,0.25); overflow:hidden; animation:searchSlideIn 0.25s ease;">
            <form action="/search" method="GET" autocomplete="off" style="display:flex; align-items:center; gap:0; border-bottom:1px solid #e5e7eb;">
                <i class="fa-solid fa-magnifying-glass" style="padding:0 0 0 1.2rem; color:#9ca3af; font-size:1.1rem;"></i>
                <input type="text" name="q" id="search-input" placeholder="Search programmes, news, staff, events..." style="flex:1; padding:1.1rem 1rem; border:none; outline:none; font-size:1.05rem; font-family:var(--font-body); background:transparent;">
                <button type="button" id="search-close-btn" style="padding:1rem 1.2rem; background:none; border:none; cursor:pointer; color:#6b7280; font-size:1.1rem;" title="Close"><i class="fa-solid fa-xmark"></i></button>
            </form>
            <div id="search-results" style="max-height:340px; overflow-y:auto; padding:0.5rem;">
                <div style="text-align:center; padding:2rem 1rem; color:#9ca3af; font-size:0.9rem;">
                    <i class="fa-solid fa-keyboard" style="font-size:1.3rem; display:block; margin-bottom:0.5rem;"></i>
                    Start typing to search...
                </div>
            </div>
        </div>
    </div>
    <style>
        @keyframes searchSlideIn { from { opacity:0; transform:translateY(-20px); } to { opacity:1; transform:translateY(0); } }
        #search-overlay.open { display:flex !important; }
    </style>

    @if (!request()->is('/') && Breadcrumbs::exists())
    <div style="background: #f8faf9; border-bottom: 1px solid #e5e7eb;">
        <div class="container" style="padding: 0.65rem 0;">
            <nav aria-label="Breadcrumb">
                <ol style="display: flex; align-items: center; gap: 0; margin: 0; padding: 0; list-style: none; flex-wrap: wrap;">
                    @foreach(Breadcrumbs::generate() as $i => $crumb)
                        @if($i > 0)
                        <li style="display:flex; align-items:center; color:#9ca3af; margin: 0 0.35rem;">
                            <i class="fa-solid fa-chevron-right" style="font-size:0.6rem;"></i>
                        </li>
                        @endif
                        @if($crumb->url && !$loop->last)
                        <li>
                            <a href="{{ $crumb->url }}" style="font-size:0.85rem; color:var(--color-primary); text-decoration:none; font-weight:500; font-family:var(--font-heading); transition:color 0.15s;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                                @if($i === 0)<i class="fa-solid fa-house" style="font-size:0.75rem; margin-right:0.25rem;"></i>@endif{{ $crumb->title }}
                            </a>
                        </li>
                        @else
                        <li style="font-size:0.85rem; color:#6b7280; font-weight:600; font-family:var(--font-heading);">
                            {{ $crumb->title }}
                        </li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
    @endif

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="margin-top: var(--spacing-xl);">
        <!-- Main Footer -->
        @php
            $footerBgSetting = \App\Models\DepartmentSetting::where('key', 'footer_bg_image')->first();
            $footerBgPath = $footerBgSetting ? $footerBgSetting->value : 'site/footer-bg.jpg';
            $footerBgUrl = file_exists(storage_path('app/public/' . $footerBgPath)) ? asset('storage/' . $footerBgPath) : '';
        @endphp
        <div style="position: relative; color: #d1d5db; padding: 3.5rem 0 2.5rem; {{ $footerBgUrl ? "background: url('".$footerBgUrl."') center/cover no-repeat fixed;" : 'background: #111827;' }}">
            @if($footerBgUrl)
            <div style="position: absolute; inset: 0; background: rgba(17,24,39,0.88);"></div>
            @endif
            <div class="container" style="position: relative; z-index: 1;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 2.5rem;">
                    
                    <!-- Brand Column -->
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.7rem; margin-bottom: 1.2rem;">
                            <img src="{{ asset(config('university.logo', 'images/logo.png')) }}" alt="Logo" style="width: 46px; height: 46px; border-radius: 8px; background: white; padding: 3px;" onerror="this.src='https://via.placeholder.com/46?text=Logo'">
                            <div>
                                <strong style="color: #fff; font-family: var(--font-heading); font-size: 1.05rem; display: block; line-height: 1.2;">{{ config('university.short_name') }}</strong>
                                <span style="font-size: 0.75rem; color: #9ca3af;">{{ config('university.university') }}</span>
                            </div>
                        </div>
                        <p style="font-size: 0.88rem; line-height: 1.7; color: #9ca3af; margin-bottom: 1.2rem;">
                            {{ config('university.tagline', 'Pioneering Innovation in Computing') }}. Established {{ config('university.established') }}, dedicated to producing world-class computing professionals.
                        </p>
                        <!-- Social Icons -->
                        @php $socialLinks = \App\Models\SocialLink::active()->ordered()->get(); @endphp
                        <div style="display: flex; gap: 0.6rem;">
                            @forelse($socialLinks as $social)
                            <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: rgba(255,255,255,0.08); color: #9ca3af; font-size: 0.9rem; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,0.08)'; this.style.color='#9ca3af'" title="{{ $social->name }}"><i class="{{ $social->icon }}"></i></a>
                            @empty
                            <span style="font-size: 0.8rem; color: #6b7280;">No social links configured.</span>
                            @endforelse
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 style="color: #fff; font-family: var(--font-heading); font-size: 0.95rem; font-weight: 600; margin-bottom: 1.2rem; position: relative; padding-bottom: 0.6rem;">
                            Quick Links
                            <span style="position: absolute; bottom: 0; left: 0; width: 30px; height: 2.5px; background: var(--color-primary); border-radius: 2px;"></span>
                        </h4>
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.55rem;">
                            <li><a href="/past-hods" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s, padding-left 0.15s; display: inline-block;" onmouseover="this.style.color='var(--color-accent)'; this.style.paddingLeft='4px'" onmouseout="this.style.color='#9ca3af'; this.style.paddingLeft='0'"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem;"></i>Past HODs</a></li>
                            <li><a href="/people" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s, padding-left 0.15s; display: inline-block;" onmouseover="this.style.color='var(--color-accent)'; this.style.paddingLeft='4px'" onmouseout="this.style.color='#9ca3af'; this.style.paddingLeft='0'"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem;"></i>Faculty & Staff</a></li>
                            <li><a href="/gallery" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s, padding-left 0.15s; display: inline-block;" onmouseover="this.style.color='var(--color-accent)'; this.style.paddingLeft='4px'" onmouseout="this.style.color='#9ca3af'; this.style.paddingLeft='0'"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem;"></i>Gallery</a></li>
                            <li><a href="/nacos-presidents" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s, padding-left 0.15s; display: inline-block;" onmouseover="this.style.color='var(--color-accent)'; this.style.paddingLeft='4px'" onmouseout="this.style.color='#9ca3af'; this.style.paddingLeft='0'"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem;"></i>NACOS Presidents</a></li>
                            <li><a href="/page/student-handbook" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s, padding-left 0.15s; display: inline-block;" onmouseover="this.style.color='var(--color-accent)'; this.style.paddingLeft='4px'" onmouseout="this.style.color='#9ca3af'; this.style.paddingLeft='0'"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem;"></i>Student Handbook</a></li>
                            <li><a href="/page/research-innovation" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s, padding-left 0.15s; display: inline-block;" onmouseover="this.style.color='var(--color-accent)'; this.style.paddingLeft='4px'" onmouseout="this.style.color='#9ca3af'; this.style.paddingLeft='0'"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem;"></i>Research & Innovation</a></li>
                            <li><a href="/page/alumni-network" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s, padding-left 0.15s; display: inline-block;" onmouseover="this.style.color='var(--color-accent)'; this.style.paddingLeft='4px'" onmouseout="this.style.color='#9ca3af'; this.style.paddingLeft='0'"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem;"></i>Alumni Network</a></li>
                        </ul>

                        {{-- Department Systems --}}
                        @php $externalSystems = \App\Models\ExternalSystem::active()->ordered()->get(); @endphp
                        @if($externalSystems->count())
                        <h4 style="color: #fff; font-family: var(--font-heading); font-size: 0.95rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 1.2rem; position: relative; padding-bottom: 0.6rem;">
                            Department Systems
                            <span style="position: absolute; bottom: 0; left: 0; width: 30px; height: 2.5px; background: var(--color-primary); border-radius: 2px;"></span>
                        </h4>
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.55rem;">
                            @foreach($externalSystems as $extSys)
                            <li><a href="{{ $extSys->url }}" {{ $extSys->open_in_new_tab ? 'target="_blank" rel="noopener noreferrer"' : '' }} style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s, padding-left 0.15s; display: inline-block;" onmouseover="this.style.color='var(--color-accent)'; this.style.paddingLeft='4px'" onmouseout="this.style.color='#9ca3af'; this.style.paddingLeft='0'"><i class="{{ $extSys->icon }}" style="font-size: 0.6rem; margin-right: 0.4rem;"></i>{{ $extSys->name }}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </div>

                    <!-- Programmes -->
                    <div>
                        <h4 style="color: #fff; font-family: var(--font-heading); font-size: 0.95rem; font-weight: 600; margin-bottom: 1.2rem; position: relative; padding-bottom: 0.6rem;">
                            Programmes
                            <span style="position: absolute; bottom: 0; left: 0; width: 30px; height: 2.5px; background: var(--color-primary); border-radius: 2px;"></span>
                        </h4>
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.55rem;">
                            <li><a href="/academics#undergraduate-full-time" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s, padding-left 0.15s; display: inline-block;" onmouseover="this.style.color='var(--color-accent)'; this.style.paddingLeft='4px'" onmouseout="this.style.color='#9ca3af'; this.style.paddingLeft='0'"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem;"></i>B.Sc. Computer Science</a></li>
                            <li><a href="/academics#undergraduate-part-time" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s, padding-left 0.15s; display: inline-block;" onmouseover="this.style.color='var(--color-accent)'; this.style.paddingLeft='4px'" onmouseout="this.style.color='#9ca3af'; this.style.paddingLeft='0'"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem;"></i>Part-Time Programmes</a></li>
                            <li><a href="/academics#masters" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s, padding-left 0.15s; display: inline-block;" onmouseover="this.style.color='var(--color-accent)'; this.style.paddingLeft='4px'" onmouseout="this.style.color='#9ca3af'; this.style.paddingLeft='0'"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem;"></i>M.Sc. Computer Science</a></li>
                            <li><a href="/academics#phd" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s, padding-left 0.15s; display: inline-block;" onmouseover="this.style.color='var(--color-accent)'; this.style.paddingLeft='4px'" onmouseout="this.style.color='#9ca3af'; this.style.paddingLeft='0'"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem;"></i>Ph.D. Computer Science</a></li>
                            <li><a href="/academics#course-structure" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s, padding-left 0.15s; display: inline-block;" onmouseover="this.style.color='var(--color-accent)'; this.style.paddingLeft='4px'" onmouseout="this.style.color='#9ca3af'; this.style.paddingLeft='0'"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem;"></i>Course Structure</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h4 style="color: #fff; font-family: var(--font-heading); font-size: 0.95rem; font-weight: 600; margin-bottom: 1.2rem; position: relative; padding-bottom: 0.6rem;">
                            Get in Touch
                            <span style="position: absolute; bottom: 0; left: 0; width: 30px; height: 2.5px; background: var(--color-primary); border-radius: 2px;"></span>
                        </h4>
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.85rem;">
                            <li style="display: flex; align-items: flex-start; gap: 0.7rem;">
                                <i class="fa-solid fa-location-dot" style="color: var(--color-primary); margin-top: 3px; width: 16px; text-align: center;"></i>
                                <span style="font-size: 0.88rem; line-height: 1.5;">{{ config('university.university') }}, Keffi, Nasarawa State, Nigeria</span>
                            </li>
                            <li style="display: flex; align-items: center; gap: 0.7rem;">
                                <i class="fa-solid fa-phone" style="color: var(--color-primary); width: 16px; text-align: center;"></i>
                                <a href="tel:+234123456789" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s;" onmouseover="this.style.color='var(--color-accent)'" onmouseout="this.style.color='#9ca3af'">+234 (0) 123 456 7890</a>
                            </li>
                            <li style="display: flex; align-items: center; gap: 0.7rem;">
                                <i class="fa-solid fa-envelope" style="color: var(--color-primary); width: 16px; text-align: center;"></i>
                                <a href="mailto:info@dcms.nsuk.edu.ng" style="color: #9ca3af; text-decoration: none; font-size: 0.88rem; transition: color 0.15s;" onmouseover="this.style.color='var(--color-accent)'" onmouseout="this.style.color='#9ca3af'">info@dcms.nsuk.edu.ng</a>
                            </li>
                            <li style="display: flex; align-items: center; gap: 0.7rem;">
                                <i class="fa-solid fa-clock" style="color: var(--color-primary); width: 16px; text-align: center;"></i>
                                <span style="font-size: 0.88rem;">Mon – Fri: 8:00 AM – 4:00 PM</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div style="background: #0a0f1a; padding: 1rem 0; border-top: 1px solid rgba(255,255,255,0.06);">
            <div class="container" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 0.5rem;">
                <p style="margin: 0; font-size: 0.8rem; color: #6b7280;">&copy; {{ date('Y') }} {{ config('university.name') }}, {{ config('university.university') }}. All rights reserved.</p>
                <div style="display: flex; gap: 1.2rem;">
                    <a href="/page/privacy-policy" style="color: #6b7280; font-size: 0.8rem; text-decoration: none; transition: color 0.15s;" onmouseover="this.style.color='#9ca3af'" onmouseout="this.style.color='#6b7280'">Privacy Policy</a>
                    <a href="/page/terms-of-use" style="color: #6b7280; font-size: 0.8rem; text-decoration: none; transition: color 0.15s;" onmouseover="this.style.color='#9ca3af'" onmouseout="this.style.color='#6b7280'">Terms of Use</a>
                    <a href="/page/sitemap" style="color: #6b7280; font-size: 0.8rem; text-decoration: none; transition: color 0.15s;" onmouseover="this.style.color='#9ca3af'" onmouseout="this.style.color='#6b7280'">Sitemap</a>
                </div>
            </div>
        </div>

        <!-- Back to Top -->
        <a href="#" id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'}); return false;" style="position: fixed; bottom: 1.5rem; right: 1.5rem; width: 42px; height: 42px; display: none; align-items: center; justify-content: center; background: var(--color-primary); color: #fff; border-radius: 10px; font-size: 1rem; text-decoration: none; box-shadow: 0 4px 14px rgba(0,0,0,0.2); z-index: 999; transition: opacity 0.3s, transform 0.3s;" title="Back to top">
            <i class="fa-solid fa-arrow-up"></i>
        </a>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Dismiss preloader
            const preloader = document.getElementById('preloader');
            if (preloader) {
                setTimeout(() => {
                    preloader.style.opacity = '0';
                    preloader.style.visibility = 'hidden';
                    setTimeout(() => preloader.remove(), 500);
                }, 600);
            }

            const toggle = document.getElementById('theme-toggle');
            const html = document.documentElement;
            const currentTheme = localStorage.getItem('theme') || 'light';
            
            if (currentTheme === 'dark') {
                html.setAttribute('data-theme', 'dark');
                if(toggle) toggle.innerHTML = '<i class="fa-solid fa-sun"></i>';
            }
            
            if(toggle) {
                toggle.addEventListener('click', () => {
                    const isDark = html.getAttribute('data-theme') === 'dark';
                    const newTheme = isDark ? 'light' : 'dark';
                    
                    html.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    
                    toggle.innerHTML = isDark ? '<i class="fa-solid fa-moon"></i>' : '<i class="fa-solid fa-sun"></i>';
                });
            }

            // Mobile drawer toggle
            const menuBtn = document.getElementById('mobile-menu-btn');
            const drawer = document.getElementById('mobileDrawer');
            
            if(menuBtn && drawer) {
                menuBtn.addEventListener('click', () => {
                    drawer.classList.toggle('open');
                    menuBtn.classList.toggle('is-active');
                });
            }

            // Search overlay
            const searchOverlay = document.getElementById('search-overlay');
            const searchToggleBtn = document.getElementById('search-toggle-btn');
            const searchCloseBtn = document.getElementById('search-close-btn');
            const searchInput = document.getElementById('search-input');
            const searchResults = document.getElementById('search-results');
            let searchTimer = null;

            function openSearch() {
                if (searchOverlay) {
                    searchOverlay.classList.add('open');
                    document.body.style.overflow = 'hidden';
                    setTimeout(() => searchInput && searchInput.focus(), 150);
                }
            }
            function closeSearch() {
                if (searchOverlay) {
                    searchOverlay.classList.remove('open');
                    document.body.style.overflow = '';
                    if (searchInput) searchInput.value = '';
                    if (searchResults) searchResults.innerHTML = '<div style="text-align:center; padding:2rem 1rem; color:#9ca3af; font-size:0.9rem;"><i class="fa-solid fa-keyboard" style="font-size:1.3rem; display:block; margin-bottom:0.5rem;"></i>Start typing to search...</div>';
                }
            }

            if (searchToggleBtn) searchToggleBtn.addEventListener('click', (e) => { e.preventDefault(); openSearch(); });
            if (searchCloseBtn) searchCloseBtn.addEventListener('click', closeSearch);
            if (searchOverlay) searchOverlay.addEventListener('click', (e) => { if (e.target === searchOverlay) closeSearch(); });
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeSearch(); if ((e.ctrlKey || e.metaKey) && e.key === 'k') { e.preventDefault(); openSearch(); } });

            // Live search
            if (searchInput) {
                searchInput.addEventListener('input', () => {
                    clearTimeout(searchTimer);
                    const q = searchInput.value.trim();
                    if (q.length < 2) {
                        searchResults.innerHTML = '<div style="text-align:center; padding:2rem 1rem; color:#9ca3af; font-size:0.9rem;"><i class="fa-solid fa-keyboard" style="font-size:1.3rem; display:block; margin-bottom:0.5rem;"></i>Start typing to search...</div>';
                        return;
                    }
                    searchResults.innerHTML = '<div style="text-align:center; padding:1.5rem; color:#9ca3af;"><i class="fa-solid fa-spinner fa-spin"></i> Searching...</div>';
                    searchTimer = setTimeout(() => {
                        fetch('/api/search?q=' + encodeURIComponent(q))
                            .then(r => r.json())
                            .then(data => {
                                if (!data.results || data.results.length === 0) {
                                    searchResults.innerHTML = '<div style="text-align:center; padding:2rem 1rem; color:#9ca3af;"><i class="fa-solid fa-magnifying-glass" style="font-size:1.3rem; display:block; margin-bottom:0.5rem;"></i>No results found for &ldquo;' + q + '&rdquo;</div>';
                                    return;
                                }
                                let html = '';
                                data.results.forEach(r => {
                                    html += '<a href="' + r.url + '" style="display:flex; align-items:center; gap:0.8rem; padding:0.7rem 1rem; border-radius:8px; text-decoration:none; color:#374151; transition:background 0.15s;" onmouseover="this.style.background=\'#f3f4f6\'" onmouseout="this.style.background=\'transparent\'">';
                                    html += '<i class="' + (r.icon || 'fa-solid fa-link') + '" style="color:var(--color-primary); font-size:1rem; width:20px; text-align:center;"></i>';
                                    html += '<div><strong style="font-size:0.92rem;">' + r.title + '</strong>';
                                    if (r.subtitle) html += '<br><span style="font-size:0.8rem; color:#9ca3af;">' + r.subtitle + '</span>';
                                    html += '</div></a>';
                                });
                                searchResults.innerHTML = html;
                            })
                            .catch(() => {
                                searchResults.innerHTML = '<div style="text-align:center; padding:1.5rem; color:#ef4444;">Search unavailable. Try again later.</div>';
                            });
                    }, 300);
                });
            }

            // Back to top button
            const backToTop = document.getElementById('back-to-top');
            if (backToTop) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 400) {
                        backToTop.style.display = 'flex';
                        backToTop.style.opacity = '1';
                        backToTop.style.transform = 'translateY(0)';
                    } else {
                        backToTop.style.opacity = '0';
                        backToTop.style.transform = 'translateY(10px)';
                        setTimeout(() => { if (window.scrollY <= 400) backToTop.style.display = 'none'; }, 300);
                    }
                });
            }
        });
    </script>
</body>
</html>
