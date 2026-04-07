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
            <!-- Desktop Nav -->
            <nav class="navbar-nav desktop-only" id="primary-nav" style="display: flex; align-items: center; justify-content: flex-end; gap: 0.5rem; flex: 1;">
                <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}" style="font-weight: 600; font-size: 0.95rem; color: #047857; text-decoration: none; position: relative;">
                    Home
                    @if(request()->is('/'))<div style="position: absolute; bottom: -8px; left: 0; right: 0; height: 2px; background-color: #047857;"></div>@endif
                </a>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('about*') ? 'active' : '' }}" aria-label="About dropdown" style="font-weight: 500; font-size: 0.95rem; color: #374151; cursor: pointer; display: flex; align-items: center; gap: 0.25rem;">
                        About <i class="fa-solid fa-chevron-down" style="font-size:0.75rem; opacity: 0.7;"></i>
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: 100%; left: 50%; transform: translateX(-50%); background: white; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border-radius: 0.375rem; padding: 0.5rem 0; min-width: 200px; z-index: 50; margin-top: 0.5rem; border: 1px solid #f3f4f6;">
                        <a href="{{ url('/about') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.5rem 1rem; color: #4b5563; font-size: 0.9rem; text-decoration: none;" onmouseover="this.style.backgroundColor='#f9fafb'; this.style.color='#047857'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">About the Department</a>
                        <a href="{{ url('/about#vision-mission') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.5rem 1rem; color: #4b5563; font-size: 0.9rem; text-decoration: none;" onmouseover="this.style.backgroundColor='#f9fafb'; this.style.color='#047857'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Vision &amp; Mission</a>
                        <a href="{{ url('/about#hod-message') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.5rem 1rem; color: #4b5563; font-size: 0.9rem; text-decoration: none;" onmouseover="this.style.backgroundColor='#f9fafb'; this.style.color='#047857'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">HOD's Message</a>
                        <a href="{{ url('/nacos-presidents') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.5rem 1rem; color: #4b5563; font-size: 0.9rem; text-decoration: none;" onmouseover="this.style.backgroundColor='#f9fafb'; this.style.color='#047857'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Our Association</a>
                    </div>
                </details>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('academics*') ? 'active' : '' }}" aria-label="Academics dropdown" style="font-weight: 500; font-size: 0.95rem; color: #374151; cursor: pointer; display: flex; align-items: center; gap: 0.25rem;">
                        Academics <i class="fa-solid fa-chevron-down" style="font-size:0.75rem; opacity: 0.7;"></i>
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: 100%; left: 50%; transform: translateX(-50%); background: white; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border-radius: 0.375rem; padding: 0.5rem 0; min-width: 320px; z-index: 50; margin-top: 0.5rem; border: 1px solid #f3f4f6;">
                        <a href="{{ url('/academics#programmes') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.5rem 1rem; color: #4b5563; font-size: 0.9rem; text-decoration: none;" onmouseover="this.style.backgroundColor='#f9fafb'; this.style.color='#047857'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Programmes (BSc, MSc, PhD)</a>
                        <a href="{{ url('/academics#sub-departments') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.5rem 1rem; color: #4b5563; font-size: 0.9rem; text-decoration: none;" onmouseover="this.style.backgroundColor='#f9fafb'; this.style.color='#047857'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Sub-departments (Cyber Security, Data Science)</a>
                        <a href="{{ url('/academics#siwes') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.5rem 1rem; color: #4b5563; font-size: 0.9rem; text-decoration: none;" onmouseover="this.style.backgroundColor='#f9fafb'; this.style.color='#047857'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">SIWES Information</a>
                        <a href="{{ url('/academics#projects') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.5rem 1rem; color: #4b5563; font-size: 0.9rem; text-decoration: none;" onmouseover="this.style.backgroundColor='#f9fafb'; this.style.color='#047857'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Final Year Projects</a>
                    </div>
                </details>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('people*') ? 'active' : '' }}" aria-label="People dropdown" style="font-weight: 500; font-size: 0.95rem; color: #374151; cursor: pointer; display: flex; align-items: center; gap: 0.25rem;">
                        People <i class="fa-solid fa-chevron-down" style="font-size:0.75rem; opacity: 0.7;"></i>
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: 100%; left: 50%; transform: translateX(-50%); background: white; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border-radius: 0.375rem; padding: 0.5rem 0; min-width: 200px; z-index: 50; margin-top: 0.5rem; border: 1px solid #f3f4f6;">
                        <a href="{{ url('/people') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.5rem 1rem; color: #4b5563; font-size: 0.9rem; text-decoration: none;" onmouseover="this.style.backgroundColor='#f9fafb'; this.style.color='#047857'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Staff Directory</a>
                    </div>
                </details>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('research-news*') || request()->is('events*') ? 'active' : '' }}" aria-label="News dropdown" style="font-weight: 500; font-size: 0.95rem; color: #374151; cursor: pointer; display: flex; align-items: center; gap: 0.25rem;">
                        News <i class="fa-solid fa-chevron-down" style="font-size:0.75rem; opacity: 0.7;"></i>
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: 100%; right: 0; left: auto; background: white; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border-radius: 0.375rem; padding: 0.5rem 0; min-width: 240px; z-index: 50; margin-top: 0.5rem; border: 1px solid #f3f4f6;">
                        <a href="{{ url('/research-news') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.5rem 1rem; color: #4b5563; font-size: 0.9rem; text-decoration: none;" onmouseover="this.style.backgroundColor='#f9fafb'; this.style.color='#047857'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">News &amp; Announcements</a>
                        <a href="{{ url('/events') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.5rem 1rem; color: #4b5563; font-size: 0.9rem; text-decoration: none;" onmouseover="this.style.backgroundColor='#f9fafb'; this.style.color='#047857'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Events &amp; Seminars</a>
                        <a href="{{ url('/academic-calendar') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.5rem 1rem; color: #4b5563; font-size: 0.9rem; text-decoration: none;" onmouseover="this.style.backgroundColor='#f9fafb'; this.style.color='#047857'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Academic Calendar</a>
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
            <a href="{{ url('/') }}" class="mobile-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i> Home
            </a>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary {{ request()->is('about*') ? 'active' : '' }}" aria-label="About dropdown (mobile)">
                    <i class="fa-solid fa-circle-info"></i> About
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="{{ url('/about') }}" class="mobile-link mobile-sub-link">About the Department</a>
                    <a href="{{ url('/about#vision-mission') }}" class="mobile-link mobile-sub-link">Vision &amp; Mission</a>
                    <a href="{{ url('/about#hod-message') }}" class="mobile-link mobile-sub-link">HOD's Message</a>
                    <a href="{{ url('/nacos-presidents') }}" class="mobile-link mobile-sub-link">Our Association</a>
                </div>
            </details>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary {{ request()->is('academics*') ? 'active' : '' }}" aria-label="Academics dropdown (mobile)">
                    <i class="fa-solid fa-graduation-cap"></i> Academics
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="{{ url('/academics#programmes') }}" class="mobile-link mobile-sub-link">Programmes (BSc, MSc, PhD)</a>
                    <a href="{{ url('/academics#sub-departments') }}" class="mobile-link mobile-sub-link">Sub-departments (Cyber Security, Data Science)</a>
                    <a href="{{ url('/academics#siwes') }}" class="mobile-link mobile-sub-link">SIWES Information</a>
                    <a href="{{ url('/academics#projects') }}" class="mobile-link mobile-sub-link">Final Year Projects</a>
                </div>
            </details>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary {{ request()->is('people*') ? 'active' : '' }}" aria-label="People dropdown (mobile)">
                    <i class="fa-solid fa-users"></i> People
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="{{ url('/people') }}" class="mobile-link mobile-sub-link">Staff Directory</a>
                </div>
            </details>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary {{ request()->is('research-news*') || request()->is('events*') ? 'active' : '' }}" aria-label="News dropdown (mobile)">
                    <i class="fa-regular fa-newspaper"></i> News
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="{{ url('/research-news') }}" class="mobile-link mobile-sub-link">News &amp; Announcements</a>
                    <a href="{{ url('/events') }}" class="mobile-link mobile-sub-link">Events &amp; Seminars</a>
                    <a href="{{ url('/academic-calendar') }}" class="mobile-link mobile-sub-link">Academic Calendar</a>
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
