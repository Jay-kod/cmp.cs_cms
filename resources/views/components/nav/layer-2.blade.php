<div class="navbar">
    @php
    $externalSystems = \App\Models\ExternalSystem::active()->ordered()->get();
    @endphp
    <div class="container navbar-inner">
        <!-- Brand Wrapper -->
        <div class="navbar-brand-wrapper" style="min-width: 0; flex: 0 1 auto;">
            <a href="{{ url('/') }}" class="navbar-brand" style="margin-left: 0; gap: 0.75rem; min-width: 0; overflow: hidden; text-decoration: none;">
                <img src="{{ asset(config('university.logo', 'build/assets/logo.png')) }}" alt="Logo" class="navbar-logo" style="width: 48px; height: 48px; object-fit: contain; flex-shrink: 0;" onerror="this.src='https://via.placeholder.com/44?text=Logo'">
                <div class="navbar-brand-text" style="display: flex; flex-direction: column; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    <strong class="brand-title" style="color: #047857; font-weight: 700; line-height: 1.2; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ config('university.name', 'Department of Computer Science') }}</strong>
                    <span class="brand-subtitle" style="color: #6b7280; font-weight: 400; line-height: 1.2; margin-top: 0.125rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ config('university.university', 'Nasarawa State University, Keffi') }}</span>
                </div>
            </a>
        </div>

        <!-- Navigation & Actions Wrapper -->
        <div class="navbar-nav-wrapper" style="display: flex; align-items: center; justify-content: flex-end; flex: 1; gap: 1rem;">
            @php
            $isHomeActive = request()->is('/');
            $isAboutActive = request()->is('about*') || request()->is('nacos-presidents*');
            $isAcademicsActive = request()->is('academics*') || request()->is('programmes*') || request()->is('pages/programmes*') || request()->is('siwes*') || request()->is('projects*') || request()->is('sub-department/*') || request()->is('resources*');
            $isPeopleActive = request()->is('people*') || request()->is('gallery*');
            $isNewsActive = request()->is('research-news*') || request()->is('announcements*') || request()->is('events*') || request()->is('research-innovations*') || request()->is('pages/academic-calendar*');
            $navSubDepts = \App\Models\SubDepartment::where('is_active', true)->where('slug', '!=', 'computer-science')->get();
            @endphp
            <!-- Desktop Nav -->
            <nav class="navbar-nav desktop-only hidden lg:flex items-center justify-end gap-6 flex-1" id="primary-nav">
                <a href="{{ url('/') }}" class="nav-link {{ $isHomeActive ? 'active' : '' }} font-semibold text-base relative py-1 px-0.5 inline-block text-gray-700 hover:text-primary transition-colors">
                    <span class="{{ $isHomeActive ? 'text-primary' : '' }}">Home</span>
                    @if($isHomeActive)<div class="absolute -bottom-2 left-0 right-0 h-[3px] rounded-full bg-primary"></div>@endif
                </a>

                <details class="nav-dropdown relative group">
                    <summary class="nav-link nav-dropdown-summary {{ $isAboutActive ? 'active' : '' }} font-medium text-base cursor-pointer flex items-center gap-1.5 py-1 px-0.5 relative text-gray-700 hover:text-primary transition-colors" aria-label="About dropdown">
                        <span class="{{ $isAboutActive ? 'text-primary' : '' }}">About</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 opacity-60">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                        @if($isAboutActive)<div class="absolute -bottom-2 left-0 right-0 h-[3px] rounded-full bg-primary"></div>@endif
                    </summary>
                    <div class="nav-dropdown-menu absolute top-[calc(100%+15px)] left-1/2 -translate-x-1/2 bg-white shadow-[0_10px_15px_-3px_rgba(0,0,0,0.1),0_4px_6px_-2px_rgba(0,0,0,0.05)] rounded-lg p-2 min-w-[220px] z-50 border border-gray-100" role="menu">
                        <a href="{{ url('/about') }}" class="nav-dropdown-item  block py-2.5 px-4  text-[0.95rem]  no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->is('about') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">About the Department</a>
                        <a href="{{ url('/nacos-presidents') }}" class="nav-dropdown-item  block py-2.5 px-4  text-[0.95rem]  no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->is('nacos-presidents*') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">Our Association</a>
                    </div>
                </details>

                <details class="nav-dropdown relative group">
                    <summary class="nav-link nav-dropdown-summary {{ $isAcademicsActive ? 'active' : '' }} font-medium text-base cursor-pointer flex items-center gap-1.5 py-1 px-0.5 relative text-gray-700 hover:text-primary transition-colors" aria-label="Academics dropdown">
                        <span class="{{ $isAcademicsActive ? 'text-primary' : '' }}">Academics</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 opacity-60">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                        @if($isAcademicsActive)<div class="absolute -bottom-2 left-0 right-0 h-[3px] rounded-full bg-primary"></div>@endif
                    </summary>
                    <div class="nav-dropdown-menu absolute top-[calc(100%+15px)] left-1/2 -translate-x-1/2 bg-white shadow-[0_10px_15px_-3px_rgba(0,0,0,0.1),0_4px_6px_-2px_rgba(0,0,0,0.05)] rounded-lg p-2 min-w-[320px] z-50 border border-gray-100" role="menu">
                        <a href="{{ route('page.show', 'programmes') }}" class="nav-dropdown-item block py-2.5 px-4 text-[0.95rem] no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->is('pages/programmes') || request()->is('programmes*') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">Academic Programmes</a>
                        @foreach($navSubDepts as $subDept)
                        <a href="{{ route('sub-department.show', $subDept->slug) }}" class="nav-dropdown-item  block py-2.5 px-4  text-[0.95rem]  no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->is('sub-department/'.$subDept->slug.'*') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">{{ $subDept->name }}</a>
                        @endforeach
                        <a href="{{ route('siwes') }}" class="nav-dropdown-item  block py-2.5 px-4  text-[0.95rem]  no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->routeIs('siwes*') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">SIWES Information</a>
                        <a href="{{ route('projects') }}" class="nav-dropdown-item  block py-2.5 px-4  text-[0.95rem]  no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->routeIs('projects*') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">Final Year Projects</a>
                        <a href="{{ url('/resources') }}" class="nav-dropdown-item  block py-2.5 px-4  text-[0.95rem]  no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->is('resources*') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">Student Resources</a>
                    </div>
                </details>

                <details class="nav-dropdown relative group">
                    <summary class="nav-link nav-dropdown-summary {{ $isPeopleActive ? 'active' : '' }} font-medium text-base cursor-pointer flex items-center gap-1.5 py-1 px-0.5 relative text-gray-700 hover:text-primary transition-colors" aria-label="People dropdown">
                        <span class="{{ $isPeopleActive ? 'text-primary' : '' }}">People</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 opacity-60">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                        @if($isPeopleActive)<div class="absolute -bottom-2 left-0 right-0 h-[3px] rounded-full bg-primary"></div>@endif
                    </summary>
                    <div class="nav-dropdown-menu absolute top-[calc(100%+15px)] left-1/2 -translate-x-1/2 bg-white shadow-[0_10px_15px_-3px_rgba(0,0,0,0.1),0_4px_6px_-2px_rgba(0,0,0,0.05)] rounded-lg p-2 min-w-[200px] z-50 border border-gray-100" role="menu">
                        <a href="{{ url('/people') }}" class="nav-dropdown-item  block py-2.5 px-4  text-[0.95rem]  no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->is('people') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">Staff Directory</a>
                        <a href="{{ url('/gallery') }}" class="nav-dropdown-item  block py-2.5 px-4  text-[0.95rem]  no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->is('gallery*') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">Gallery</a>
                    </div>
                </details>

                <details class="nav-dropdown relative group">
                    <summary class="nav-link nav-dropdown-summary {{ $isNewsActive ? 'active' : '' }} font-medium text-base cursor-pointer flex items-center gap-1.5 py-1 px-0.5 relative text-gray-700 hover:text-primary transition-colors" aria-label="Blog dropdown">
                        <span class="{{ $isNewsActive ? 'text-primary' : '' }}">Blog</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 opacity-60">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                        @if($isNewsActive)<div class="absolute -bottom-2 left-0 right-0 h-[3px] rounded-full bg-primary"></div>@endif
                    </summary>
                    <div class="nav-dropdown-menu absolute top-[calc(100%+15px)] left-1/2 -translate-x-1/2 bg-white shadow-[0_10px_15px_-3px_rgba(0,0,0,0.1),0_4px_6px_-2px_rgba(0,0,0,0.05)] rounded-lg p-2 min-w-[250px] z-50 border border-gray-100" role="menu">
                        <a href="{{ url('/research-news') }}" class="nav-dropdown-item  block py-2.5 px-4  text-[0.95rem]  no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->is('research-news*') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">News</a>
                        <a href="{{ url('/research-news#announcements') }}" class="nav-dropdown-item  block py-2.5 px-4  text-[0.95rem]  no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->is('announcements*') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">Announcements</a>
                        <a href="{{ url('/research-innovations') }}" class="nav-dropdown-item  block py-2.5 px-4  text-[0.95rem]  no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->is('research-innovations*') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">Research &amp; Innovations</a>
                        <a href="{{ url('/events') }}" class="nav-dropdown-item  block py-2.5 px-4  text-[0.95rem]  no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->is('events*') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">Events &amp; Seminars</a>
                        <a href="{{ route('page.show', 'academic-calendar') }}" class="nav-dropdown-item  block py-2.5 px-4  text-[0.95rem]  no-underline rounded-md transition-all duration-200 hover:bg-green-50 hover:text-primary {{ request()->is('pages/academic-calendar*') ? 'bg-green-50 text-primary font-bold shadow-sm' : 'text-gray-600 font-medium' }}" role="menuitem">Academic Calendar</a>
                    </div>
                </details>
                <a href="{{ url('/contact') }}" class="nav-link btn btn-primary {{ request()->is('contact') ? 'active' : '' }} bg-[#2e8b57] text-white py-2 px-5 rounded-md border-none font-semibold text-[0.95rem] ml-4 transition-colors duration-200 shadow-sm hover:bg-[#1f6b45]">
                    Contact Us
                </a>
            </nav>
            <button class="navbar-hamburger" id="mobile-menu-btn" aria-label="Toggle navigation">
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
            <button type="button" class="mobile-drawer-close-btn" id="mobile-drawer-close-btn" aria-label="Close menu">
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
                    <a href="{{ url('/about') }}" class="mobile-link mobile-sub-link {{ request()->is('about') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">About the Department</a>
                    <a href="{{ url('/nacos-presidents') }}" class="mobile-link mobile-sub-link {{ request()->is('nacos-presidents*') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">Our Association</a>
                </div>
            </details>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary {{ $isAcademicsActive ? 'active' : '' }}" aria-label="Academics dropdown (mobile)">
                    <i class="fa-solid fa-graduation-cap"></i> Academics
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="{{ route('page.show', 'programmes') }}" class="mobile-link mobile-sub-link {{ request()->is('pages/programmes') || request()->is('programmes*') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">Academic Programmes</a>
                    @foreach($navSubDepts as $subDept)
                    <a href="{{ route('sub-department.show', $subDept->slug) }}" class="mobile-link mobile-sub-link {{ request()->is('sub-department/'.$subDept->slug.'*') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">{{ $subDept->name }}</a>
                    @endforeach
                    <a href="{{ route('siwes') }}" class="mobile-link mobile-sub-link {{ request()->routeIs('siwes*') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">SIWES Information</a>
                    <a href="{{ route('projects') }}" class="mobile-link mobile-sub-link {{ request()->routeIs('projects*') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">Final Year Projects</a>
                    <a href="{{ url('/resources') }}" class="mobile-link mobile-sub-link {{ request()->is('resources*') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">Student Resources</a>
                </div>
            </details>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary {{ $isPeopleActive ? 'active' : '' }}" aria-label="People dropdown (mobile)">
                    <i class="fa-solid fa-users"></i> People
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="{{ url('/people') }}" class="mobile-link mobile-sub-link {{ request()->is('people') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">Staff Directory</a>
                    <a href="{{ url('/gallery') }}" class="mobile-link mobile-sub-link {{ request()->is('gallery*') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">Gallery</a>
                </div>
            </details>

            <details class="mobile-details">
                <summary class="mobile-link mobile-details-summary {{ $isNewsActive ? 'active' : '' }}" aria-label="Blog dropdown (mobile)">
                    <i class="fa-regular fa-newspaper"></i> Blog
                    <i class="fa-solid fa-chevron-down" style="margin-left:auto; opacity:0.9;"></i>
                </summary>
                <div class="mobile-details-menu">
                    <a href="{{ url('/research-news') }}" class="mobile-link mobile-sub-link {{ request()->is('research-news*') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">News</a>
                    <a href="{{ url('/research-news#announcements') }}" class="mobile-link mobile-sub-link {{ request()->is('announcements*') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">Announcements</a>
                    <a href="{{ url('/research-innovations') }}" class="mobile-link mobile-sub-link {{ request()->is('research-innovations*') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">Research &amp; Innovations</a>
                    <a href="{{ url('/events') }}" class="mobile-link mobile-sub-link {{ request()->is('events*') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">Events &amp; Seminars</a>
                    <a href="{{ route('page.show', 'academic-calendar') }}" class="mobile-link mobile-sub-link {{ request()->is('pages/academic-calendar*') ? 'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3' : '' }}">Academic Calendar</a>
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

        .desktop-only {
            display: none !important;
        }

        .mobile-only {
            display: block !important;
        }

        @media (min-width: 1024px) {
            .desktop-only {
                display: flex !important;
            }

            .mobile-only {
                display: none !important;
            }
        }

        /* Hover behavior for details on desktop */
        @media (min-width: 1024px) {
            #primary-nav details.nav-dropdown {
                position: relative;
            }

            #primary-nav details.nav-dropdown>summary::after {
                content: none;
            }

            #primary-nav details.nav-dropdown summary::-webkit-details-marker {
                display: none;
            }

            #primary-nav details.nav-dropdown>summary~div.nav-dropdown-menu {
                display: none;
            }

            #primary-nav details.nav-dropdown:hover>summary~div.nav-dropdown-menu,
            #primary-nav details.nav-dropdown[open]>summary~div.nav-dropdown-menu {
                display: block;
                animation: fade-in 0.2s ease-in-out forwards;
            }

            #primary-nav details.nav-dropdown:hover>summary,
            #primary-nav details.nav-dropdown.active>summary {
                color: #047857 !important;
            }

            #primary-nav details.nav-dropdown:hover>summary::after,
            #primary-nav details.nav-dropdown.active>summary::after {
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
            from {
                opacity: 0;
                transform: translate(-50%, 10px);
            }

            to {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }
    </style>
</div>