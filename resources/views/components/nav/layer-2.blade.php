<div class="navbar">
    @php
        $externalSystems = \App\Models\ExternalSystem::active()->ordered()->get();
    @endphp
    <div class="container navbar-inner">
        <!-- Brand Wrapper -->
        <div class="navbar-brand-wrapper">
            <a href="{{ url('/') }}" class="navbar-brand" style="margin-left: -0.6rem; gap: 0.3rem;">
                <img src="{{ asset(config('university.logo', 'build/assets/logo.png')) }}" alt="Logo" class="navbar-logo" onerror="this.src='https://via.placeholder.com/44?text=Logo'">
                <div class="navbar-brand-text">
                    <strong class="desktop-only text-base">{{ config('university.name') }}</strong>
                    <strong class="mobile-only" style="font-size: 0.65rem; white-space: normal; line-height: 1.15; max-width: 220px;">DEPARTMENT OF COMPUTER SCIENCE</strong>
                    <span class="desktop-only">{{ config('university.university') }}</span>
                    <span class="mobile-only" style="font-size: 0.5rem; color: #6b7280; font-weight: 500; white-space: normal; line-height: 1.15; max-width: 220px; margin-top: 1px; letter-spacing: 0.2px;">NASARAWA STATE UNIVERSITY, KEFFI</span>
                </div>
            </a>
        </div>

        <!-- Navigation & Actions Wrapper -->
        <div class="navbar-nav-wrapper" style="display: flex; align-items: center; justify-content: flex-end; flex: 1; gap: 1rem;">
            <!-- Desktop Nav -->
            <nav class="navbar-nav desktop-only" id="primary-nav" style="display: flex; justify-content: flex-end; gap: 0; flex: 1;">
                <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>

                <details class="nav-dropdown">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('about*') ? 'active' : '' }}" aria-label="About dropdown">
                        About <i class="fa-solid fa-chevron-down" style="font-size:0.75rem;"></i>
                    </summary>
                    <div class="nav-dropdown-menu" role="menu">
                        <a href="{{ url('/about') }}" class="nav-dropdown-item" role="menuitem">About the Department</a>
                        <a href="{{ url('/about#vision-mission') }}" class="nav-dropdown-item" role="menuitem">Vision &amp; Mission</a>
                        <a href="{{ url('/about#hod-message') }}" class="nav-dropdown-item" role="menuitem">HOD's Message</a>
                        <a href="{{ url('/nacos-presidents') }}" class="nav-dropdown-item" role="menuitem">Our Association</a>
                    </div>
                </details>

                <details class="nav-dropdown">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('academics*') ? 'active' : '' }}" aria-label="Academics dropdown">
                        Academics <i class="fa-solid fa-chevron-down" style="font-size:0.75rem;"></i>
                    </summary>
                    <div class="nav-dropdown-menu" role="menu">
                        <a href="{{ url('/academics#programmes') }}" class="nav-dropdown-item" role="menuitem">Programmes (BSc, MSc, PhD)</a>
                        <a href="{{ url('/academics#sub-departments') }}" class="nav-dropdown-item" role="menuitem">Sub-departments (Cyber Security, Data Science)</a>
                        <a href="{{ url('/academics#siwes') }}" class="nav-dropdown-item" role="menuitem">SIWES Information</a>
                        <a href="{{ url('/academics#projects') }}" class="nav-dropdown-item" role="menuitem">Final Year Projects</a>
                    </div>
                </details>

                <details class="nav-dropdown">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('people*') ? 'active' : '' }}" aria-label="People dropdown">
                        People <i class="fa-solid fa-chevron-down" style="font-size:0.75rem;"></i>
                    </summary>
                    <div class="nav-dropdown-menu" role="menu">
                        <a href="{{ url('/people') }}" class="nav-dropdown-item" role="menuitem">Staff Directory</a>
                    </div>
                </details>

                <details class="nav-dropdown">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('research-news*') || request()->is('events*') ? 'active' : '' }}" aria-label="News dropdown">
                        News <i class="fa-solid fa-chevron-down" style="font-size:0.75rem;"></i>
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="right: 0; left: auto;">
                        <a href="{{ url('/research-news') }}" class="nav-dropdown-item" role="menuitem">News &amp; Announcements</a>
                        <a href="{{ url('/events') }}" class="nav-dropdown-item" role="menuitem">Events &amp; Seminars</a>
                        <a href="{{ url('/academic-calendar') }}" class="nav-dropdown-item" role="menuitem">Academic Calendar</a>
                    </div>
                </details>

                <a href="{{ url('/contact') }}" class="nav-link btn btn-primary {{ request()->is('contact') ? 'active' : '' }}" style="background-color: #2e7d32; color: white; padding: 0.5rem 1rem; border-radius: 4px; border: none; font-weight: 500;">
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
</div>
