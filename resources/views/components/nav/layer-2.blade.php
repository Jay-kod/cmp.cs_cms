<div class="navbar">
    @php
        $externalSystems = \App\Models\ExternalSystem::active()->ordered()->get();
    @endphp
    <div class="container navbar-inner">
        <!-- Brand Wrapper -->
        <div class="navbar-brand-wrapper">
            <a href="/" class="navbar-brand" style="margin-left: -0.6rem; gap: 0.3rem;">
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
                <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="/about" class="nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>

            <details class="nav-dropdown">
                <summary class="nav-link nav-dropdown-summary" aria-label="Departments dropdown">
                    Departments <i class="fa-solid fa-chevron-down" style="font-size:0.75rem;"></i>
                </summary>
                <div class="nav-dropdown-menu" role="menu">
                    <a href="{{ route('department.show', 'computer-science') }}" class="nav-dropdown-item" role="menuitem">Computer Science</a>
                    <a href="{{ route('department.show', 'cyber-security') }}" class="nav-dropdown-item" role="menuitem">Cyber Security</a>
                    <a href="{{ route('department.show', 'data-science') }}" class="nav-dropdown-item" role="menuitem">Data Science</a>
                </div>
            </details>

            <details class="nav-dropdown">
                <summary class="nav-link nav-dropdown-summary {{ request()->is('academics*') ? 'active' : '' }}" aria-label="Academics dropdown">
                    Academics <i class="fa-solid fa-chevron-down" style="font-size:0.75rem;"></i>
                </summary>
                <div class="nav-dropdown-menu" role="menu">
                    <a href="/academics" class="nav-dropdown-item" role="menuitem">Academics Overview</a>
                    <a href="/resources#handbook" class="nav-dropdown-item" role="menuitem">Department Handbook</a>
                    <a href="/resources#timetable" class="nav-dropdown-item" role="menuitem">Timetable</a>
                    <a href="/resources#rules" class="nav-dropdown-item" role="menuitem">Rules &amp; Regulations</a>
                    <a href="/resources#forms" class="nav-dropdown-item" role="menuitem">Forms</a>
                </div>
            </details>

            <details class="nav-dropdown">
                <summary class="nav-link nav-dropdown-summary" aria-label="News and Events dropdown">
                    News &amp; Events <i class="fa-solid fa-chevron-down" style="font-size:0.75rem;"></i>
                </summary>
                <div class="nav-dropdown-menu" role="menu">
                    <a href="/research-news" class="nav-dropdown-item" role="menuitem">News</a>
                    <a href="/events" class="nav-dropdown-item" role="menuitem">Events</a>
                    <a href="/gallery" class="nav-dropdown-item" role="menuitem">Gallery</a>
                    <a href="/nacos-presidents" class="nav-dropdown-item" role="menuitem">NACOS</a>
                </div>
            </details>

            <details class="nav-dropdown">
                <summary class="nav-link nav-dropdown-summary" aria-label="Systems dropdown">
                    Systems <i class="fa-solid fa-chevron-down" style="font-size:0.75rem;"></i>
                </summary>
                <div class="nav-dropdown-menu" role="menu" style="right: 0; left: auto;">
                    @forelse($externalSystems as $sys)
                        <a
                            href="{{ $sys->url }}"
                            class="nav-dropdown-item"
                            role="menuitem"
                            @if($sys->open_in_new_tab) target="_blank" rel="noopener noreferrer" @endif
                        >
                            @if(!empty($sys->icon))
                                <i class="{{ $sys->icon }}" style="font-size:0.95rem;"></i>
                            @endif
                            {{ $sys->name }}
                        </a>
                    @empty
                        <span class="nav-dropdown-empty" role="note">Systems coming soon</span>
                    @endforelse
                </div>
            </details>

            <a href="/contact" class="nav-link btn btn-primary {{ request()->is('contact') ? 'active' : '' }}" style="background-color: #2e7d32; color: white; padding: 0.5rem 1rem; border-radius: 4px; border: none; font-weight: 500;">
                Contact Us
            </a>
        </nav>

        <button class="navbar-hamburger" id="mobile-menu-btn" aria-label="Toggle menu" style="margin-left: auto;">
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
            <a href="/" class="mobile-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i> Home
            </a>
            <a href="/about" class="mobile-link {{ request()->is('about') ? 'active' : '' }}">
                <i class="fa-solid fa-circle-info"></i> About
            </a>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary" aria-label="Departments dropdown (mobile)">
                    <i class="fa-solid fa-layer-group"></i> Departments
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="{{ route('department.show', 'computer-science') }}" class="mobile-link mobile-sub-link">Computer Science</a>
                    <a href="{{ route('department.show', 'cyber-security') }}" class="mobile-link mobile-sub-link">Cyber Security</a>
                    <a href="{{ route('department.show', 'data-science') }}" class="mobile-link mobile-sub-link">Data Science</a>
                </div>
            </details>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary {{ request()->is('academics*') ? 'active' : '' }}" aria-label="Academics dropdown (mobile)">
                    <i class="fa-solid fa-graduation-cap"></i> Academics
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="/academics" class="mobile-link mobile-sub-link">Academics Overview</a>
                    <a href="/resources#handbook" class="mobile-link mobile-sub-link">Department Handbook</a>
                    <a href="/resources#timetable" class="mobile-link mobile-sub-link">Timetable</a>
                    <a href="/resources#rules" class="mobile-link mobile-sub-link">Rules &amp; Regulations</a>
                    <a href="/resources#forms" class="mobile-link mobile-sub-link">Forms</a>
                </div>
            </details>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary" aria-label="News and Events dropdown (mobile)">
                    <i class="fa-regular fa-newspaper"></i> News &amp; Events
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="/research-news" class="mobile-link mobile-sub-link">News</a>
                    <a href="/events" class="mobile-link mobile-sub-link">Events</a>
                    <a href="/gallery" class="mobile-link mobile-sub-link">Gallery</a>
                    <a href="/nacos-presidents" class="mobile-link mobile-sub-link">NACOS</a>
                </div>
            </details>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary" aria-label="Systems dropdown (mobile)">
                    <i class="fa-solid fa-table-cells"></i> Systems
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    @forelse($externalSystems as $sys)
                        <a
                            href="{{ $sys->url }}"
                            class="mobile-link mobile-sub-link"
                            @if($sys->open_in_new_tab) target="_blank" rel="noopener noreferrer" @endif
                        >
                            @if(!empty($sys->icon))
                                <i class="{{ $sys->icon }}" style="width:1.2rem; text-align:center;"></i>
                            @endif
                            {{ $sys->name }}
                        </a>
                    @empty
                        <span class="mobile-systems-empty" role="note">Systems coming soon</span>
                    @endforelse
                </div>
            </details>

            <a href="/contact" class="mobile-cta">
                <i class="fa-solid fa-envelope" style="margin-right:0.5rem;"></i> Contact Us
            </a>
        </div>

        <div class="mobile-drawer-footer">
            @php
                $__drawerPhone = \App\Models\DepartmentSetting::where('key', 'contact_phone')->value('value') ?? '+234 (0) 123 456 7890';
                $__drawerEmail = \App\Models\DepartmentSetting::where('key', 'contact_email')->value('value') ?? 'info@dcms.nsuk.edu.ng';
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
