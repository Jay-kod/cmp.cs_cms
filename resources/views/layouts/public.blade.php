<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
<body class="antialiased {{ request()->routeIs('home') ? 'is-home' : '' }}">
    
    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 z-[99999] bg-white flex flex-col items-center justify-center transition-all duration-500">
        <img src="{{ asset('images/logo.png') }}" alt="NSUK Logo" class="w-[120px] h-[120px] animate-[heartbeat_1.2s_ease-in-out_infinite]">
        <h2 class="mt-6 font-heading text-[1.6rem] font-bold text-[#1B2A4A] tracking-[2px]">CMP NSUK</h2>
    </div>
    <style>
        @keyframes heartbeat { 
            0%, 100% { transform: scale(1); } 
            50% { transform: scale(1.15); } 
        }
        
        /* Transparent Header styles for Homepage */
        body.is-home header.is-transparent > div,
        body.is-home header.is-transparent .navbar,
        body.is-home header.is-transparent .topbar {
            background-color: transparent !important;
            box-shadow: none !important;
            border-bottom: 1px solid rgba(255,255,255,0.05) !important;
        }
        body.is-home header.is-transparent .bg-\[\#047857\] {
            background-color: transparent !important;
        }
        body.is-home header.is-transparent .text-white {
            color: rgba(255,255,255,0.9) !important;
        }
        body.is-home header.is-transparent .nav-link,
        body.is-home header.is-transparent .brand-title,
        body.is-home header.is-transparent .brand-subtitle,
        body.is-home header.is-transparent .navbar-hamburger i {
            color: #ffffff !important;
        }
        body.is-home header.is-transparent .navbar-logo {
            background-color: #ffffff !important;
            padding: 4px !important;
            border-radius: 6px !important;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1) !important;
        }
        body.is-home header.is-transparent .nav-link.active span.text-primary,
        body.is-home header.is-transparent .nav-dropdown-summary.active span.text-primary {
            color: #ffffff !important;
        }
        body.is-home header.is-transparent .nav-link.active div.bg-primary,
        body.is-home header.is-transparent .nav-dropdown-summary.active div.bg-primary {
            background-color: #22c55e !important;
        }
        body.is-home header.is-transparent .btn-primary {
            background-color: rgba(255,255,255,0.15) !important;
            border: 1px solid rgba(255,255,255,0.3) !important;
            color: #ffffff !important;
        }
        body.is-home header.is-transparent .btn-primary:hover {
            background-color: rgba(255,255,255,0.25) !important;
        }
        body.is-home header.is-transparent .nav-dropdown-menu {
            background-color: #ffffff !important;
            border-color: rgba(0,0,0,0.05) !important;
        }
        body.is-home header.is-transparent .nav-dropdown-menu .nav-dropdown-item {
            color: #4b5563 !important;
        }
        body.is-home header.is-transparent .nav-dropdown-menu .nav-dropdown-item:hover {
            color: var(--color-primary) !important;
            background-color: #f0fdf4 !important;
        }
        body.is-home header.is-transparent .nav-dropdown-summary svg {
            color: #ffffff !important;
            opacity: 0.8;
        }
    </style>

    <!-- Fixed Header -->
    <header id="main-header" class="fixed top-0 left-0 w-full z-50 transition-all duration-500 {{ request()->routeIs('home') ? 'is-transparent' : '' }}">
        <div class="bg-white shadow-[0_1px_3px_rgba(0,0,0,0.06),0_6px_16px_rgba(0,0,0,0.04)] transition-all duration-500">
            <x-nav.layer-1 />
            <x-nav.layer-2 />
            <x-nav.layer-3 />
        </div>
    </header>
    @if(!request()->routeIs('home'))
    <div class="h-[68px] lg:h-[88px]"></div>
    @endif
    <style>
        .mobile-only { display: none; }
        p { text-align: justify; }
        @media(max-width:991px) {
            .mobile-only { display: inline !important; }
        }
    </style>

    <!-- Search overlay removed - search is now inline on individual pages -->

    @if (!request()->is('/') && Breadcrumbs::exists())
    <div class="bg-[#f8faf9] border-b border-gray-200 pt-4">
        <div class="container py-2.5" data-aos="fade-up">
            <nav aria-label="Breadcrumb">
                <ol class="flex items-center flex-wrap m-0 p-0 list-none">
                    @foreach(Breadcrumbs::generate() as $i => $crumb)
                        @if($i > 0)
                        <li class="flex items-center text-gray-400 mx-1.5">
                            <i class="fa-solid fa-chevron-right text-[0.6rem]"></i>
                        </li>
                        @endif
                        @if($crumb->url && !$loop->last)
                        <li>
                            <a href="{{ $crumb->url }}" class="text-[0.85rem] text-[var(--color-primary)] hover:underline font-medium font-heading transition-colors duration-150">
                                @if($i === 0)<i class="fa-solid fa-house text-[0.75rem] mr-1"></i>@endif{{ $crumb->title }}
                            </a>
                        </li>
                        @else
                        <li class="text-[0.85rem] text-gray-500 font-semibold font-heading">
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
    <footer class="mt-[var(--spacing-xl)]">
        <!-- Main Footer -->
        @php
            $firstCarousel = \App\Models\CarouselSlide::where('is_active', true)->orderBy('sort_order', 'asc')->first();
            if ($firstCarousel && $firstCarousel->image) {
                $footerBgUrl = str_starts_with($firstCarousel->image, 'http') ? $firstCarousel->image : asset('storage/' . $firstCarousel->image);
            } else {
                $footerBgSetting = (object)['value' => \App\Models\DepartmentSetting::getCached('footer_bg_image')];
                $footerBgPath = $footerBgSetting ? $footerBgSetting->value : 'site/footer-bg.jpg';
                $footerBgUrl = file_exists(storage_path('app/public/' . $footerBgPath)) ? asset('storage/' . $footerBgPath) : '';
            }
        @endphp
        <div class="relative text-[#f1f5f9] py-14" style="{{ $footerBgUrl ? "background: url('".$footerBgUrl."') center/cover no-repeat;" : 'background: #031E10;' }}">
            <div class="absolute inset-0 bg-[#031e10]/95 z-0"></div>
            <div class="container relative z-10" data-aos="fade-up">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                    
                    <!-- Brand Column -->
                    <div>
                        <div class="flex items-center gap-3 mb-5">
                            <img src="{{ asset(config('university.logo', 'images/logo.png')) }}" alt="Logo" class="w-[46px] h-[46px] rounded-lg bg-white p-[3px]" onerror="this.src='https://via.placeholder.com/46?text=Logo'">
                            <div>
                                <strong class="text-white font-heading text-[1.05rem] block leading-tight">{{ config('university.short_name') }}</strong>
                                <span class="text-[0.75rem] text-[#f1f5f9]">{{ config('university.university') }}</span>
                            </div>
                        </div>
                        <p class="text-[0.88rem] leading-relaxed text-[#f1f5f9] mb-5 text-justify">
                            {{ config('university.tagline', 'Pioneering Innovation in Computing') }}. Established {{ config('university.established') }}, dedicated to producing world-class computing professionals.
                        </p>
                        <!-- Social Icons -->
                        @php $socialLinks = \App\Models\SocialLink::active()->ordered()->get(); @endphp
                        <div class="flex gap-2.5">
                            @forelse($socialLinks as $social)
                            <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-white/10 text-[#f1f5f9] text-[0.9rem] hover:bg-primary hover:text-white transition-colors duration-200" title="{{ $social->name }}"><i class="{{ $social->icon }}"></i></a>
                            @empty
                            <span class="text-[0.8rem] text-gray-500">No social links configured.</span>
                            @endforelse
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-white font-heading text-[0.95rem] font-semibold mb-5 relative pb-2.5">
                            Quick Links
                            <span class="absolute bottom-0 left-0 w-[30px] h-[2.5px] bg-primary rounded-sm"></span>
                        </h4>
                        <ul class="list-none p-0 m-0 flex flex-col gap-2">
                            <li><a href="{{ url('/past-hods') }}" class="text-[#f1f5f9] text-[0.88rem] hover:text-accent hover:pl-1 transition-all duration-150 inline-block"><i class="fa-solid fa-chevron-right text-[0.6rem] mr-1.5"></i>Past HODs</a></li>
                            <li><a href="{{ url('/people') }}" class="text-[#f1f5f9] text-[0.88rem] hover:text-accent hover:pl-1 transition-all duration-150 inline-block"><i class="fa-solid fa-chevron-right text-[0.6rem] mr-1.5"></i>Faculty & Staff</a></li>
                            <li><a href="{{ url('/nacos-presidents') }}" class="text-[#f1f5f9] text-[0.88rem] hover:text-accent hover:pl-1 transition-all duration-150 inline-block"><i class="fa-solid fa-chevron-right text-[0.6rem] mr-1.5"></i>NACOS Presidents</a></li>
                            <li><a href="{{ url('/page/student-handbook') }}" class="text-[#f1f5f9] text-[0.88rem] hover:text-accent hover:pl-1 transition-all duration-150 inline-block"><i class="fa-solid fa-chevron-right text-[0.6rem] mr-1.5"></i>Student Handbook</a></li>
                            <li><a href="{{ url('/page/research-innovation') }}" class="text-[#f1f5f9] text-[0.88rem] hover:text-accent hover:pl-1 transition-all duration-150 inline-block"><i class="fa-solid fa-chevron-right text-[0.6rem] mr-1.5"></i>Research & Innovation</a></li>

                        </ul>

                        {{-- Department Systems --}}
                        @php $externalSystems = \App\Models\ExternalSystem::active()->ordered()->get(); @endphp
                        @if($externalSystems->count())
                        <h4 class="text-white font-heading text-[0.95rem] font-semibold mt-6 mb-5 relative pb-2.5">
                            Department Systems
                            <span class="absolute bottom-0 left-0 w-[30px] h-[2.5px] bg-primary rounded-sm"></span>
                        </h4>
                        <ul class="list-none p-0 m-0 flex flex-col gap-2">
                            @foreach($externalSystems as $extSys)
                            <li><a href="{{ $extSys->url }}" {{ $extSys->open_in_new_tab ? 'target="_blank" rel="noopener noreferrer"' : '' }} class="text-[#f1f5f9] text-[0.88rem] hover:text-accent hover:pl-1 transition-all duration-150 inline-block"><i class="{{ $extSys->icon }} text-[0.6rem] mr-1.5"></i>{{ $extSys->name }}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </div>

                    <!-- Programmes -->
                    @php
                        $footerProgrammes = \App\Models\Programme::where('is_active', true)->take(4)->get();
                    @endphp
                    <div>
                        <h4 class="text-white font-heading text-[0.95rem] font-semibold mb-5 relative pb-2.5">
                            Programmes
                            <span class="absolute bottom-0 left-0 w-[30px] h-[2.5px] bg-primary rounded-sm"></span>
                        </h4>
                        <ul class="list-none p-0 m-0 flex flex-col gap-2">
                            @foreach($footerProgrammes as $fProg)
                            <li><a href="{{ route('programmes.show', $fProg->slug) }}" class="text-[#f1f5f9] text-[0.88rem] hover:text-accent hover:pl-1 transition-all duration-150 inline-block"><i class="fa-solid fa-chevron-right text-[0.6rem] mr-1.5"></i>{{ $fProg->name }}</a></li>
                            @endforeach
                            <li><a href="{{ route('page.show', 'programmes') }}" class="text-[#f1f5f9] text-[0.88rem] hover:text-accent hover:pl-1 transition-all duration-150 inline-block"><i class="fa-solid fa-chevron-right text-[0.6rem] mr-1.5"></i>View All Programmes</a></li>
                            <li><a href="{{ url('/academics#course-structure') }}" class="text-[#f1f5f9] text-[0.88rem] hover:text-accent hover:pl-1 transition-all duration-150 inline-block"><i class="fa-solid fa-chevron-right text-[0.6rem] mr-1.5"></i>Course Structure</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    @php
                        $__ftPhone = \App\Models\DepartmentSetting::getCached('contact_phone') ?? '+234 (0) 123 456 7890';
                        $__ftEmail = \App\Models\DepartmentSetting::getCached('contact_email') ?? 'info@dcms.nsuk.edu.ng';
                        $__ftAddr  = \App\Models\DepartmentSetting::getCached('contact_address') ?? (config('university.university') . ', Keffi, Nasarawa State, Nigeria');
                        $__ftHours = \App\Models\DepartmentSetting::getCached('contact_hours') ?? 'Mon – Fri: 8:00 AM – 4:00 PM';
                        $__session = \App\Models\DepartmentSetting::getCached('academic_session') ?? '2024/2025';
                        $__semester= \App\Models\DepartmentSetting::getCached('academic_semester') ?? 'First';
                    @endphp
                    <div>
                        <h4 class="text-white font-heading text-[0.95rem] font-semibold mb-5 relative pb-2.5">
                            Get in Touch
                            <span class="absolute bottom-0 left-0 w-[30px] h-[2.5px] bg-primary rounded-sm"></span>
                        </h4>
                        <ul class="list-none p-0 m-0 flex flex-col gap-3">
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-location-dot text-primary mt-1 w-4 text-center"></i>
                                <span class="text-[0.88rem] leading-relaxed">{!! $__ftAddr !!}</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i class="fa-solid fa-graduation-cap text-primary w-4 text-center"></i>
                                <span class="text-[0.88rem] text-[#f1f5f9]">Academic Session: <strong class="text-white font-semibold">{{ $__session }} ({{ $__semester }} Semester)</strong></span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i class="fa-solid fa-phone text-primary w-4 text-center"></i>
                                <a href="tel:{{ preg_replace('/[^+0-9]/', '', $__ftPhone) }}" class="text-[#f1f5f9] text-[0.88rem] hover:text-accent transition-colors duration-150">{{ $__ftPhone }}</a>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i class="fa-solid fa-envelope text-primary w-4 text-center"></i>
                                <a href="mailto:{{ $__ftEmail }}" class="text-[#f1f5f9] text-[0.88rem] hover:text-accent transition-colors duration-150">{{ $__ftEmail }}</a>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i class="fa-solid fa-clock text-primary w-4 text-center"></i>
                                <span class="text-[0.88rem]">{{ $__ftHours }}</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="bg-[#0a0f1a] py-4 border-t border-white/5">
            <div class="container flex flex-col md:flex-row items-center justify-between gap-3 sm:gap-2" data-aos="fade-up">
                <p class="m-0 text-[0.7rem] sm:text-[0.8rem] text-[#f1f5f9] text-center md:text-left !text-center md:!text-left leading-relaxed opacity-80 sm:opacity-100">&copy; {{ date('Y') }} {{ config('university.name') }}, {{ config('university.university') }}. All rights reserved.</p>
                <div class="flex items-center justify-center gap-2 sm:gap-5 text-[0.7rem] sm:text-[0.8rem] opacity-90 sm:opacity-100">
                    <a href="{{ url('/page/privacy-policy') }}" class="text-[#f1f5f9] hover:text-accent transition-colors duration-150">Privacy Policy</a>
                    <span class="text-white/20 sm:hidden">|</span>
                    <a href="{{ url('/page/terms-of-use') }}" class="text-[#f1f5f9] hover:text-accent transition-colors duration-150">Terms of Use</a>
                    <span class="text-white/20 sm:hidden">|</span>
                    <a href="{{ url('/page/sitemap') }}" class="text-[#f1f5f9] hover:text-accent transition-colors duration-150">Sitemap</a>
                </div>
            </div>
        </div>

        <!-- Back to Top -->
        <a href="#" id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'}); return false;" class="fixed bottom-6 right-6 w-[42px] h-[42px] hidden items-center justify-center bg-primary text-white rounded-lg text-base shadow-[0_4px_14px_rgba(0,0,0,0.2)] z-[999] transition-all hover:bg-secondary" title="Back to top">
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
            const overlay = document.getElementById('mobileDrawerOverlay');
            const closeBtn = document.getElementById('mobile-drawer-close-btn');
            
            if(menuBtn && drawer) {
                const toggleMenu = () => {
                    drawer.classList.toggle('open');
                    menuBtn.classList.toggle('is-active');
                    if(overlay) overlay.classList.toggle('open');
                };

                menuBtn.addEventListener('click', toggleMenu);
                if(overlay) overlay.addEventListener('click', toggleMenu);

                if(closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        if(drawer.classList.contains('open')) toggleMenu();
                    });
                }

                document.addEventListener('keydown', (e) => {
                    if(e.key === 'Escape' && drawer.classList.contains('open')) {
                        toggleMenu();
                    }
                });
            }
            
            // Accordion for Nav Dropdowns & click outside to close
            const navDropdowns = document.querySelectorAll('details.nav-dropdown, details.mobile-details');
            navDropdowns.forEach((targetDetail) => {
                targetDetail.addEventListener('toggle', (e) => {
                    if (targetDetail.open) {
                        navDropdowns.forEach((detail) => {
                            if (detail !== targetDetail) {
                                detail.removeAttribute('open');
                            }
                        });
                    }
                });
            });

            document.addEventListener('click', (e) => {
                if (!e.target.closest('details.nav-dropdown') && !e.target.closest('details.mobile-details') && !e.target.closest('#mobile-menu-btn')) {
                    navDropdowns.forEach((detail) => {
                        detail.removeAttribute('open');
                    });
                }
            });

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

            // Transparent Header logic
            const header = document.getElementById('main-header');
            if (document.body.classList.contains('is-home') && header) {
                const updateHeader = () => {
                    if (window.scrollY > 50) {
                        header.classList.remove('is-transparent');
                    } else {
                        header.classList.add('is-transparent');
                    }
                };
                window.addEventListener('scroll', updateHeader);
                updateHeader();
            }
        });
    </script>
    {{-- Auto-refresh: poll every 10 minutes, reload if content changed --}}
    <script>
    (function() {
        var POLL_INTERVAL = 10 * 60 * 1000; // 10 minutes
        var lastTs = null;

        function checkForUpdates() {
            fetch('/api/content-updated', { cache: 'no-store' })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (lastTs === null) {
                        // First check — just record the baseline
                        lastTs = data.ts;
                    } else if (data.ts > lastTs) {
                        // Content has been updated since we last checked
                        location.reload();
                    }
                })
                .catch(function() { /* network error — skip this cycle */ });
        }

        // Initial baseline after 5 seconds (let the page finish loading)
        setTimeout(checkForUpdates, 5000);
        // Then poll every 10 minutes
        setInterval(checkForUpdates, POLL_INTERVAL);
    })();
    </script>
</body>
</html>
