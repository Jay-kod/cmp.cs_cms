<div class="navbar">
    @php
        $externalSystems = \App\Models\ExternalSystem::active()->ordered()->get();
    @endphp
    <div class="container navbar-inner">
        <!-- Brand Wrapper -->
        <div class="navbar-brand-wrapper">
            <a href="{{ url('/') }}" class="navbar-brand" style="margin-left: 0; gap: 0.75rem;">
                <img src="{{ asset(config('university.logo', 'build/assets/logo.png')) }}" alt="Logo" class="navbar-logo" style="width: 48px; height: 48px; object-fit: contain;" onerror="this.src='https://via.placeholder.com/44?text=Logo'">
                <div class="navbar-brand-text" style="display: flex; flex-direction: column;">
                    <strong style="color: #047857; font-size: 1.125rem; font-weight: 700; line-height: 1.2;">{{ config('university.name', 'Department of Computer Science') }}</strong>
                    <span style="color: #6b7280; font-size: 0.875rem; font-weight: 400; line-height: 1.2; margin-top: 0.125rem;">{{ config('university.university', 'Nasarawa State University, Keffi') }}</span>
                </div>
            </a>
        </div>

                <!-- Navigation & Actions Wrapper -->
        <div class="navbar-nav-wrapper" style="display: flex; align-items: center; justify-content: flex-end; flex: 1; gap: 1rem;">
            @php
            $isHomeActive = request()->is('/');
            $isAboutActive = request()->is('about*') || request()->is('nacos-presidents*');
            $isAcademicsActive = request()->is('academics*') || request()->is('programmes*') || request()->is('pages/programmes*') || request()->is('siwes*') || request()->is('projects*') || request()->is('pages/sub-departments*') || request()->is('sub-departments*');
            $isPeopleActive = request()->is('people*') || request()->is('gallery*');
            $isNewsActive = request()->is('research-news*') || request()->is('events*') || request()->is('research-innovations*') || request()->is('pages/academic-calendar*');
        @endphp
        <!-- Desktop Nav -->
            <nav class="navbar-nav desktop-only" id="primary-nav" style="display: flex; align-items: center; justify-content: flex-end; gap: 1.5rem; flex: 1;">
                <a href="{{ url('/') }}" class="nav-link {{ $isHomeActive ? 'active' : '' }}" style="font-weight: 600; font-size: 1rem; color: {{ $isHomeActive ? '#059669' : '#374151' }}; text-decoration: none; position: relative; padding: 0.25rem 0.1rem; display: inline-block;">
                    Home
                    @if($isHomeActive)<div style="position: absolute; bottom: -8px; left: 0; right: 0; height: 3px; border-radius: 3px; background-color: #059669;"></div>@endif
                </a>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ $isAboutActive ? 'active' : '' }}" aria-label="About dropdown" style="font-weight: 500; font-size: 1rem; color: {{ $isAboutActive ? '#059669' : '#374151' }}; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.1rem; position: relative;">
                        About <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 0.85rem; height: 0.85rem; opacity: 0.6;"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        @if($isAboutActive)<div style="position: absolute; bottom: -8px; left: 0; right: 0; height: 3px; border-radius: 3px; background-color: #059669;"></div>@endif
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: calc(100% + 15px); left: 50%; transform: translateX(-50%); background: white; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border-radius: 0.5rem; padding: 0.5rem; min-width: 220px; z-index: 50; border: 1px solid #f3f4f6;">
                        <a href="{{ url('/about') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">About the Department</a>
                        <a href="{{ url('/nacos-presidents') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Our Association</a>
                    </div>
                </details>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ $isAcademicsActive ? 'active' : '' }}" aria-label="Academics dropdown" style="font-weight: 500; font-size: 1rem; color: {{ $isAcademicsActive ? '#059669' : '#374151' }}; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.1rem; position: relative;">
                        Academics <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 0.85rem; height: 0.85rem; opacity: 0.6;"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        @if($isAcademicsActive)<div style="position: absolute; bottom: -8px; left: 0; right: 0; height: 3px; border-radius: 3px; background-color: #059669;"></div>@endif
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: calc(100% + 15px); left: 50%; transform: translateX(-50%); background: white; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border-radius: 0.5rem; padding: 0.5rem; min-width: 320px; z-index: 50; border: 1px solid #f3f4f6;">
                        <a href="{{ route('page.show', 'programmes') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Programmes (BSc, MSc, PhD)</a>
                        <a href="{{ route('page.show', 'sub-departments') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Sub-departments (Cyber Security, Data Science)</a>
                        <a href="{{ route('siwes') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">SIWES Information</a>
                        <a href="{{ route('projects') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Final Year Projects</a>
                        <a href="{{ url('/resources') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Student Resources</a>
                    </div>
                </details>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ $isPeopleActive ? 'active' : '' }}" aria-label="People dropdown" style="font-weight: 500; font-size: 1rem; color: {{ $isPeopleActive ? '#059669' : '#374151' }}; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.1rem; position: relative;">
                        People <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 0.85rem; height: 0.85rem; opacity: 0.6;"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        @if($isPeopleActive)<div style="position: absolute; bottom: -8px; left: 0; right: 0; height: 3px; border-radius: 3px; background-color: #059669;"></div>@endif
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: calc(100% + 15px); left: 50%; transform: translateX(-50%); background: white; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border-radius: 0.5rem; padding: 0.5rem; min-width: 200px; z-index: 50; border: 1px solid #f3f4f6;">
                        <a href="{{ url('/people') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Staff Directory</a>
                        <a href="{{ url('/gallery') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Gallery</a>
                    </div>
                </details>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ $isNewsActive ? 'active' : '' }}" aria-label="News dropdown" style="font-weight: 500; font-size: 1rem; color: {{ $isNewsActive ? '#059669' : '#374151' }}; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.1rem; position: relative;">
                        News <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 0.85rem; height: 0.85rem; opacity: 0.6;"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        @if($isNewsActive)<div style="position: absolute; bottom: -8px; left: 0; right: 0; height: 3px; border-radius: 3px; background-color: #059669;"></div>@endif
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: calc(100% + 15px); right: 0; left: auto; background: white; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border-radius: 0.5rem; padding: 0.5rem; min-width: 250px; z-index: 50; border: 1px solid #f3f4f6;">
                        <a href="{{ url('/research-news') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">News</a>
                        <a href="{{ url('/research-innovations') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Research &amp; Innovations</a>
                        <a href="{{ url('/events') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Events &amp; Seminars</a>
                        <a href="{{ route('page.show', 'academic-calendar') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Academic Calendar</a>
                    </div>
                </details>
                <a href="{{ url('/contact') }}" class="nav-link btn btn-primary {{ request()->is('contact') ? 'active' : '' }}" style="background-color: #2e8b57; color: white; padding: 0.5rem 1.25rem; border-radius: 0.375rem; border: none; font-weight: 600; font-size: 0.95rem; margin-left: 1rem; transition: background-color 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05);" onmouseover="this.style.backgroundColor='#1f6b45'" onmouseout="this.style.backgroundColor='#2e8b57'">
                    Contact Us
                </a>
            <span></span><span></span><span></span>
        </button>
        </div>
    </div>

    <div class="navbar-mobile-overlay" id="mobileDrawerOverlay"></div>

    <!-- Mobile Drawer -->
    <div class="navbar-mobile-drawer" id="mobileDrawer">
        <div class="mobile-drawer-header">
            <img src="{{ asset(config('university.logo', 'build/assets/logo.png')) }}" alt="Logo" class="mobile-drawer-logo" onerror="this.src='https://via.placeholder.com/44?text=Logo'">
            <div class="mobile-drawer-brand">
                <strong>DEPARTMENT OF COMPUTER SCIENCE</strong>
                <span>NASARAWA STATE UNIVERSITY, KEFFI</span>
            </div>
            <button
                type="button"
                class="mobile-drawer-close-btn"
                id="mobile-drawer-close-btn"
                aria-label="Close menu"
            >
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
        </div>
        <div class="mobile-drawer-content">
            <a href="{{ url('/') }}" class="mobile-link {{ $isHomeActive ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i> Home
            </a>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary {{ $isAboutActive ? 'active' : '' }}" aria-label="About dropdown (mobile)">
                    <i class="fa-solid fa-circle-info"></i> About
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="{{ url('/about') }}" class="mobile-link mobile-sub-link">About the Department</a>
                    <a href="{{ url('/nacos-presidents') }}" class="mobile-link mobile-sub-link">Our Association</a>
                </div>
            </details>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary {{ $isAcademicsActive ? 'active' : '' }}" aria-label="Academics dropdown (mobile)">
                    <i class="fa-solid fa-graduation-cap"></i> Academics
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="{{ route('page.show', 'programmes') }}" class="mobile-link mobile-sub-link">Programmes (BSc, MSc, PhD)</a>
                    <a href="{{ route('page.show', 'sub-departments') }}" class="mobile-link mobile-sub-link">Sub-departments (Cyber Security, Data Science)</a>
                    <a href="{{ route('siwes') }}" class="mobile-link mobile-sub-link">SIWES Information</a>
                    <a href="{{ route('projects') }}" class="mobile-link mobile-sub-link">Final Year Projects</a>
                </div>
            </details>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary {{ $isPeopleActive ? 'active' : '' }}" aria-label="People dropdown (mobile)">
                    <i class="fa-solid fa-users"></i> People
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="{{ url('/people') }}" class="mobile-link mobile-sub-link">Staff Directory</a>
                      <a href="{{ url('/gallery') }}" class="mobile-link mobile-sub-link">Gallery</a>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary {{ $isNewsActive ? 'active' : '' }}" aria-label="News dropdown (mobile)">
                    <i class="fa-regular fa-newspaper"></i> News
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="{{ url('/research-news') }}" class="mobile-link mobile-sub-link">News</a>
                    <a href="{{ url('/research-innovations') }}" class="mobile-link mobile-sub-link">Research &amp; Innovations</a>
                    <a href="{{ url('/events') }}" class="mobile-link mobile-sub-link">Events &amp; Seminars</a>
                    <a href="{{ route('page.show', 'academic-calendar') }}" class="mobile-link mobile-sub-link">Academic Calendar</a>
                </div>
            </details>

            <a href="{{ url('/contact') }}" class="mobile-cta">
                <i class="fa-solid fa-envelope" style="margin-right:0.5rem;"></i> Contact Us
            </a>
        </div>

        <div class="mobile-drawer-footer">
            @php
                $__drawerPhone = \App\Models\DepartmentSetting::getCached('contact_phone') ?? '+234 (0) 123 456 7890';
                $__drawerEmail = \App\Models\DepartmentSetting::getCached('contact_email') ?? 'info@dcms.nsuk.edu.ng';
                $__drawerSocials = \App\Models\SocialLink::active()->ordered()->get();
            @endphp
            <div class="mobile-contact-info">
                <a href="tel:{{ preg_replace('/[^+0-9]/', '', $__drawerPhone) }}">
                    <i class="fa-solid fa-phone"></i> {{ $__drawerPhone }}
                </a>
                <a href="mailto:{{ $__drawerEmail }}">
                    <i class="fa-solid fa-envelope"></i> {{ $__drawerEmail }}
                </a>
            </div>
            
            @if($__drawerSocials->count())
            <div class="mobile-social-links">
                @foreach($__drawerSocials as $social)
                <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer" title="{{ $social->name }}">
                    <i class="{{ $social->icon }}"></i>
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    
    <style>
        .navbar-brand-wrapper {
            display: flex;
            align-items: center;
        }

        .desktop-only { display: none !important; }
        .mobile-only { display: block !important; }
        
        @media (min-width: 1024px) {
            .desktop-only { display: flex !important; }
            .mobile-only { display: none !important; }
        }

        /* Hover behavior for details on desktop */
        @media (min-width: 1024px) {
            #primary-nav details.nav-dropdown {
                position: relative;
            }
            #primary-nav details.nav-dropdown > summary::after {
                content: none;
            }
            #primary-nav details.nav-dropdown summary::-webkit-details-marker {
                display: none;
            }
            #primary-nav details.nav-dropdown > summary ~ div.nav-dropdown-menu {
                display: none;
            }
            #primary-nav details.nav-dropdown:hover > summary ~ div.nav-dropdown-menu,
            #primary-nav details.nav-dropdown[open] > summary ~ div.nav-dropdown-menu {
                display: block;
                animation: fade-in 0.2s ease-in-out forwards;
            }
            #primary-nav details.nav-dropdown:hover > summary,
            #primary-nav details.nav-dropdown.active > summary {
                color: #047857 !important;
            }
            #primary-nav details.nav-dropdown:hover > summary::after,
            #primary-nav details.nav-dropdown.active > summary::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 0;
                right: 0;
                height: 2px;
                background-color: #047857;
                display: block !important;
            }
        }
        @keyframes fade-in {
            from { opacity: 0; transform: translate(-50%, 10px); }
            to { opacity: 1; transform: translate(-50%, 0); }
        }
    </style>
</div>
