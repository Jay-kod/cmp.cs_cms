<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-favicon.png') }}">

    <title>@yield('title', 'Super Admin') - {{ config('app.name', 'DCMS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])

    {{-- Super Admin always uses red theme --}}
    <style>
        :root {
            --color-primary: #b91c1c;
            --color-primary-light: #ef4444;
            --color-secondary: #991b1b;
            --color-accent: #ef4444;
        }
    </style>
</head>
<body class="antialiased" style="background-color: #f3f4f6;">
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

    <div class="admin-layout" style="display: flex; min-height: 100vh;">
        
        <!-- Super Admin Sidebar (Dark Red) -->
        <aside class="admin-sidebar" id="adminSidebar" style="width: 260px; background: linear-gradient(180deg, #7f1d1d 0%, #991b1b 100%); color: #fecaca; flex-shrink: 0; display: flex; flex-direction: column; transition: width 0.3s ease; position: sticky; top: 0; height: 100vh; z-index: 100;">
            <div style="padding: 1.5rem; display: flex; align-items: center; gap: 0.8rem; border-bottom: 1px solid rgba(255,255,255,0.08); height: 75px; box-sizing: border-box; overflow: hidden; white-space: nowrap;">
                <div style="width: 42px; height: 42px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; padding: 4px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 100%; height: auto; border-radius: 6px;">
                </div>
                <div class="brand-text" style="transition: opacity 0.2s;">
                    <h2 style="color: white; margin: 0; font-size: 1.15rem; font-family: var(--font-heading); font-weight: 700; letter-spacing: 0.5px;">{{ config('university.short_name') }}</h2>
                    <div style="font-size: 0.6rem; color: #fbbf24; font-weight: 800; letter-spacing: 2px; margin-top: 2px;">SUPER ADMIN</div>
                </div>
            </div>
            
            <nav style="flex: 1; overflow-y: auto; overflow-x: hidden; padding: 1.5rem 0;">
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.25rem;">
                    
                    {{-- ── OVERVIEW ── --}}
                    <li class="nav-section-title"><span>Overview</span></li>
                    <li>
                        <a href="{{ route('admin.super-dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.super-dashboard') ? 'active' : '' }}">
                            <div class="nav-icon"><i class="fa-solid fa-shield-halved"></i></div>
                            <span>System Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.analytics.index') }}" class="admin-nav-item {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}" title="Analytics & Reports">
                            <div class="nav-icon"><i class="fa-solid fa-chart-line"></i></div>
                            <span>Analytics & Reports</span>
                        </a>
                    </li>
                    
                    {{-- ── MANAGEMENT (Super admin has full access) ── --}}
                    <li class="nav-section-title"><span>Management</span></li>
                    <li>
                        <a href="{{ route('admin.programmes.index') }}" class="admin-nav-item {{ request()->routeIs('admin.programmes.*') || request()->routeIs('admin.programme-categories.*') ? 'active' : '' }}" title="Programmes">
                            <div class="nav-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                            <span>Programmes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.courses.index') }}" class="admin-nav-item {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}" title="Courses">
                            <div class="nav-icon"><i class="fa-solid fa-book"></i></div>
                            <span>Courses</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.staff.index') }}" class="admin-nav-item {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}" title="Staff Directory">
                            <div class="nav-icon"><i class="fa-solid fa-user-tie"></i></div>
                            <span>Staff Directory</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.staff-roles.index') }}" class="admin-nav-item {{ request()->routeIs('admin.staff-roles.*') ? 'active' : '' }}" title="Staff Roles">
                            <div class="nav-icon"><i class="fa-solid fa-id-badge"></i></div>
                            <span>Staff Roles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.past-hods.index') }}" class="admin-nav-item {{ request()->routeIs('admin.past-hods.*') ? 'active' : '' }}" title="Past HODs">
                            <div class="nav-icon"><i class="fa-solid fa-landmark"></i></div>
                            <span>Past HODs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.nacos-presidents.index') }}" class="admin-nav-item {{ request()->routeIs('admin.nacos-presidents.*') ? 'active' : '' }}" title="NACOS Presidents">
                            <div class="nav-icon"><i class="fa-solid fa-users"></i></div>
                            <span>NACOS Presidents</span>
                        </a>
                    </li>
                    
                    {{-- ── CONTENT & MEDIA ── --}}
                    <li class="nav-section-title"><span>Content & Media</span></li>
                    <li>
                        <a href="{{ route('admin.carousel.index') }}" class="admin-nav-item {{ request()->routeIs('admin.carousel.*') ? 'active' : '' }}" title="Carousel & Media">
                            <div class="nav-icon"><i class="fa-solid fa-photo-film"></i></div>
                            <span>Carousel & Media</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.news.index') }}" class="admin-nav-item {{ request()->routeIs('admin.news.*') ? 'active' : '' }}" title="News & Blog">
                            <div class="nav-icon"><i class="fa-solid fa-newspaper"></i></div>
                            <span>News & Blog</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.events.index') }}" class="admin-nav-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" title="Events">
                            <div class="nav-icon"><i class="fa-solid fa-calendar-days"></i></div>
                            <span>Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.announcements.index') }}" class="admin-nav-item {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}" title="Announcements">
                            <div class="nav-icon"><i class="fa-solid fa-bullhorn"></i></div>
                            <span>Announcements</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.gallery.index') }}" class="admin-nav-item {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}" title="Gallery">
                            <div class="nav-icon"><i class="fa-solid fa-images"></i></div>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.partners.index') }}" class="admin-nav-item {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}" title="Partners">
                            <div class="nav-icon"><i class="fa-solid fa-handshake"></i></div>
                            <span>Partners</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.publications.index') }}" class="admin-nav-item {{ request()->routeIs('admin.publications.*') ? 'active' : '' }}" title="Publications">
                            <div class="nav-icon"><i class="fa-solid fa-book-open"></i></div>
                            <span>Publications</span>
                        </a>
                    </li>

                    {{-- ── PAGES ── --}}
                    <li class="nav-section-title"><span>Pages</span></li>
                    <li>
                        <a href="{{ route('admin.page-content.show', 'home') }}" class="admin-nav-item {{ request()->is('admin/page-content/home') ? 'active' : '' }}" title="Home Page">
                            <div class="nav-icon"><i class="fa-solid fa-house"></i></div>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.page-content.show', 'about') }}" class="admin-nav-item {{ request()->is('admin/page-content/about') ? 'active' : '' }}" title="About Page">
                            <div class="nav-icon"><i class="fa-solid fa-circle-info"></i></div>
                            <span>About</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.page-content.show', 'academics') }}" class="admin-nav-item {{ request()->is('admin/page-content/academics') ? 'active' : '' }}" title="Academics Page">
                            <div class="nav-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                            <span>Academics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.page-content.show', 'people') }}" class="admin-nav-item {{ request()->is('admin/page-content/people') ? 'active' : '' }}" title="Faculty & People Page">
                            <div class="nav-icon"><i class="fa-solid fa-users"></i></div>
                            <span>Faculty & People</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.page-content.show', 'gallery') }}" class="admin-nav-item {{ request()->is('admin/page-content/gallery') ? 'active' : '' }}" title="Gallery Page">
                            <div class="nav-icon"><i class="fa-solid fa-images"></i></div>
                            <span>Gallery Page</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.page-content.show', 'past-hods') }}" class="admin-nav-item {{ request()->is('admin/page-content/past-hods') ? 'active' : '' }}" title="Past HODs Page">
                            <div class="nav-icon"><i class="fa-solid fa-landmark"></i></div>
                            <span>Past HODs Page</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.page-content.show', 'blog') }}" class="admin-nav-item {{ request()->is('admin/page-content/blog') ? 'active' : '' }}" title="Blog / Research Page">
                            <div class="nav-icon"><i class="fa-solid fa-flask"></i></div>
                            <span>Blog / Research</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.page-content.show', 'contact') }}" class="admin-nav-item {{ request()->is('admin/page-content/contact') ? 'active' : '' }}" title="Contact & NACOS Page">
                            <div class="nav-icon"><i class="fa-solid fa-address-book"></i></div>
                            <span>Contact</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.page-content.show', 'nacos') }}" class="admin-nav-item {{ request()->is('admin/page-content/nacos') ? 'active' : '' }}" title="NACOS Section">
                            <div class="nav-icon"><i class="fa-solid fa-users-rectangle"></i></div>
                            <span>NACOS</span>
                        </a>
                    </li>

                    {{-- ── SYSTEM ── --}}
                    <li class="nav-section-title"><span>System</span></li>
                    <li>
                        <a href="{{ route('admin.pages.index') }}" class="admin-nav-item {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}" title="Pages">
                            <div class="nav-icon"><i class="fa-solid fa-file-lines"></i></div>
                            <span>Pages</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.external-systems.index') }}" class="admin-nav-item {{ request()->routeIs('admin.external-systems.*') ? 'active' : '' }}" title="External Systems">
                            <div class="nav-icon"><i class="fa-solid fa-up-right-from-square"></i></div>
                            <span>External Systems</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.social-links.index') }}" class="admin-nav-item {{ request()->routeIs('admin.social-links.*') ? 'active' : '' }}" title="Social Links">
                            <div class="nav-icon"><i class="fa-solid fa-share-nodes"></i></div>
                            <span>Social Links</span>
                        </a>
                    </li>

                    {{-- ── SUPER ADMIN EXCLUSIVE ── --}}
                    <li class="nav-section-title"><span style="color: #fbbf24;">Super Admin</span></li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="admin-nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" title="User Management">
                            <div class="nav-icon" style="background: rgba(251,191,36,0.15); color: #fbbf24;"><i class="fa-solid fa-users-gear"></i></div>
                            <span>User Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings.index') }}" class="admin-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" title="Settings">
                            <div class="nav-icon" style="background: rgba(251,191,36,0.15); color: #fbbf24;"><i class="fa-solid fa-gear"></i></div>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.backup.index') }}" class="admin-nav-item {{ request()->routeIs('admin.backup.*') ? 'active' : '' }}" title="System Backup">
                            <div class="nav-icon" style="background: rgba(251,191,36,0.15); color: #fbbf24;"><i class="fa-solid fa-database"></i></div>
                            <span>System Backup</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div style="padding: 1rem; border-top: 1px solid rgba(255,255,255,0.08); display: flex; flex-direction: column; gap: 0.5rem; overflow: hidden; white-space: nowrap;">
                <a href="{{ route('profile.edit') }}" class="admin-nav-item" style="padding: 0.5rem;" title="{{ Auth::user()->name }}">
                    <div class="nav-icon" style="width: 32px; height: 32px; border-radius: 50%; overflow: hidden; background: rgba(251,191,36,0.2); padding: 0;">
                        <i class="fa-solid fa-user-shield" style="font-size: 0.8rem; color: #fbbf24;"></i>
                    </div>
                    <span style="display:flex;flex-direction:column;line-height:1.2">
                        {{ Auth::user()->name }}
                        <small style="font-size:.6rem;color:#fbbf24;font-weight:700;text-transform:uppercase;letter-spacing:.5px">Super Admin</small>
                    </span>
                </a>
                <form id="logoutForm" method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="button" onclick="document.getElementById('logoutModal').style.display='flex'" class="admin-nav-item" style="width: 100%; border: none; background: transparent; cursor: pointer; text-align: left; font-family: inherit; padding: 0.5rem;" title="Logout">
                        <div class="nav-icon" style="background: rgba(239, 68, 68, 0.15); color: #fca5a5;"><i class="fa-solid fa-arrow-right-from-bracket" style="font-size: 0.8rem;"></i></div>
                        <span style="color: #fca5a5;">Logout</span>
                    </button>
                </form>
            </div>
        </aside>
        
        <!-- Main Content area -->
        <main style="flex: 1; min-width: 0; display: flex; flex-direction: column; transition: all 0.3s ease; position: relative;">
            <header style="background: white; padding: 1rem 2rem; border-bottom: 1px solid var(--color-border); display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.02); height: 75px; box-sizing: border-box; position: sticky; top: 0; z-index: 50;">
                <div style="display: flex; align-items: center;">
                    <button id="sidebarToggle" class="sidebar-toggle-btn" title="Toggle Sidebar">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <h1 style="margin: 0; font-size: 1.25rem; color: var(--color-primary);">@yield('header', 'System Dashboard')</h1>
                        <span style="background: linear-gradient(135deg, #b91c1c, #dc2626); color: white; font-size: 0.6rem; font-weight: 800; padding: 0.2rem 0.6rem; border-radius: 4px; letter-spacing: 1px; text-transform: uppercase;">Super Admin</span>
                    </div>
                </div>
                <div style="display: flex; gap: 1rem;">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;"><i class="fa-solid fa-gauge"></i> Admin View</a>
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;"><i class="fa-solid fa-external-link"></i> View Website</a>
                </div>
            </header>
            
            <div style="padding: 2rem; flex: 1; overflow-y: auto;">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Custom Logout Confirmation Modal -->
    <div id="logoutModal" style="display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 1rem;">
        <div style="background: white; width: 100%; max-width: 420px; border-radius: 16px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); overflow: hidden; animation: slideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
            <div style="padding: 2rem 2rem 1.5rem 2rem; text-align: center;">
                <div style="width: 64px; height: 64px; background: rgba(239, 68, 68, 0.1); color: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; margin: 0 auto 1.5rem auto;">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </div>
                <h3 style="margin: 0 0 0.5rem 0; font-family: var(--font-heading); font-size: 1.25rem; color: #1f2937; font-weight: 700;">Ready to Leave?</h3>
                <p style="margin: 0; color: #6b7280; font-size: 0.95rem; line-height: 1.5;">You are about to end your Super Admin session. You will need to sign in again to access the system.</p>
            </div>
            <div style="background: #f8fafc; padding: 1.25rem 2rem; display: flex; gap: 1rem; border-top: 1px solid #e2e8f0;">
                <button type="button" onclick="document.getElementById('logoutModal').style.display='none'" style="flex: 1; padding: 0.75rem; border: 1px solid #cbd5e1; background: white; color: #475569; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='white'">Cancel</button>
                <button type="button" onclick="document.getElementById('logoutForm').submit()" style="flex: 1; padding: 0.75rem; border: none; background: #ef4444; color: white; border-radius: 8px; font-weight: 600; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.2); transition: all 0.2s;" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">Yes, Log Out</button>
            </div>
        </div>
    </div>

    <!-- Global Custom Confirmation Modal -->
    <div id="confirmModal" style="display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(15, 23, 42, 0); backdrop-filter: blur(0px); align-items: center; justify-content: center; padding: 1rem; transition: background 0.3s ease, backdrop-filter 0.3s ease;">
        <div id="confirmModalCard" style="background: white; width: 100%; max-width: 420px; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); overflow: hidden; transform: translateY(20px) scale(0.95); opacity: 0; transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1);">
            <div style="padding: 2rem 2rem 1.5rem 2rem; text-align: center;">
                <div style="width: 64px; height: 64px; background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.05)); color: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; margin: 0 auto 1.5rem auto; box-shadow: 0 0 0 8px rgba(239, 68, 68, 0.05);">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h3 style="margin: 0 0 0.5rem 0; font-family: var(--font-heading); font-size: 1.25rem; color: #1f2937; font-weight: 700;">Confirm Delete</h3>
                <p id="confirmModalMessage" style="margin: 0; color: #6b7280; font-size: 0.95rem; line-height: 1.6;"></p>
            </div>
            <div style="background: #f8fafc; padding: 1.25rem 2rem; display: flex; gap: 1rem; border-top: 1px solid #e2e8f0;">
                <button type="button" id="confirmModalCancel" style="flex: 1; padding: 0.75rem; border: 1px solid #cbd5e1; background: white; color: #475569; border-radius: 10px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9';this.style.borderColor='#94a3b8'" onmouseout="this.style.background='white';this.style.borderColor='#cbd5e1'">
                    <i class="fa-solid fa-xmark" style="margin-right: 0.35rem;"></i> Cancel
                </button>
                <button type="button" id="confirmModalOk" style="flex: 1; padding: 0.75rem; border: none; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border-radius: 10px; font-weight: 600; font-size: 0.9rem; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.3); transition: all 0.2s;" onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 6px 12px -2px rgba(239, 68, 68, 0.4)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 6px -1px rgba(239, 68, 68, 0.3)'">
                    <i class="fa-solid fa-trash-can" style="margin-right: 0.35rem;"></i> Yes, Delete
                </button>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                setTimeout(() => {
                    preloader.style.opacity = '0';
                    preloader.style.visibility = 'hidden';
                    setTimeout(() => preloader.remove(), 500);
                }, 600);
            }

            const sidebar = document.getElementById('adminSidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('collapsed');
            }
            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('collapsed');
                    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                });
            }
            
            const logoutModal = document.getElementById('logoutModal');
            if(logoutModal) {
                logoutModal.addEventListener('click', function(e) {
                    if (e.target === this) this.style.display = 'none';
                });
            }

            const confirmModal   = document.getElementById('confirmModal');
            const confirmCard    = document.getElementById('confirmModalCard');
            const confirmMsg     = document.getElementById('confirmModalMessage');
            const confirmOk      = document.getElementById('confirmModalOk');
            const confirmCancel  = document.getElementById('confirmModalCancel');
            let pendingForm      = null;

            function showConfirmModal(form, message) {
                pendingForm = form;
                confirmMsg.textContent = message;
                confirmModal.style.display = 'flex';
                requestAnimationFrame(() => {
                    confirmModal.style.background = 'rgba(15, 23, 42, 0.7)';
                    confirmModal.style.backdropFilter = 'blur(4px)';
                    confirmCard.style.transform = 'translateY(0) scale(1)';
                    confirmCard.style.opacity = '1';
                });
                confirmOk.focus();
            }

            function hideConfirmModal() {
                confirmCard.style.transform = 'translateY(20px) scale(0.95)';
                confirmCard.style.opacity = '0';
                confirmModal.style.background = 'rgba(15, 23, 42, 0)';
                confirmModal.style.backdropFilter = 'blur(0px)';
                setTimeout(() => { confirmModal.style.display = 'none'; pendingForm = null; }, 300);
            }

            document.addEventListener('submit', function(e) {
                const form = e.target;
                const msg  = form.getAttribute('data-confirm');
                if (msg && !form._confirmed) { e.preventDefault(); showConfirmModal(form, msg); }
            });

            if (confirmOk) confirmOk.addEventListener('click', function() { if (pendingForm) { pendingForm._confirmed = true; pendingForm.submit(); } hideConfirmModal(); });
            if (confirmCancel) confirmCancel.addEventListener('click', hideConfirmModal);
            if (confirmModal) confirmModal.addEventListener('click', function(e) { if (e.target === this) hideConfirmModal(); });
            document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && confirmModal && confirmModal.style.display === 'flex') hideConfirmModal(); });
        });
    </script>

    {{-- Toast Notification System --}}
    @if(session('success') || session('error'))
    <div id="toastContainer" style="position: fixed; top: 1.5rem; right: 1.5rem; z-index: 99999; display: flex; flex-direction: column; gap: 0.75rem; pointer-events: none;">
        @if(session('success'))
        <div class="admin-toast" data-type="success" style="pointer-events: auto; min-width: 250px; max-width: 350px; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; box-shadow: 0 15px 35px -5px rgba(0,0,0,0.3); overflow: hidden; animation: toastSlideIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; transform: translateX(120%);">
            <div style="display: flex; align-items: center; gap: 0.8rem; padding: 0.85rem 1rem;">
                <div style="width: 28px; height: 28px; border-radius: 50%; background: rgba(34, 197, 94, 0.15); color: #4ade80; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0;">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <p style="margin: 0; font-weight: 500; font-size: 0.88rem; color: #f8fafc; line-height: 1.4;">{{ session('success') }}</p>
                </div>
                <button onclick="dismissToast(this.closest('.admin-toast'))" style="background: none; border: none; color: #64748b; cursor: pointer; font-size: 0.95rem; padding: 0.2rem; line-height: 1; flex-shrink: 0;" title="Dismiss"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div style="height: 2px; background: rgba(255,255,255,0.05); overflow: hidden;">
                <div class="toast-progress" style="height: 100%; background: #4ade80; width: 100%; animation: toastCountdown 10s linear forwards;"></div>
            </div>
        </div>
        @endif
        @if(session('error'))
        <div class="admin-toast" data-type="error" style="pointer-events: auto; min-width: 250px; max-width: 350px; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; box-shadow: 0 15px 35px -5px rgba(0,0,0,0.3); overflow: hidden; animation: toastSlideIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; transform: translateX(120%);">
            <div style="display: flex; align-items: center; gap: 0.8rem; padding: 0.85rem 1rem;">
                <div style="width: 28px; height: 28px; border-radius: 50%; background: rgba(239, 68, 68, 0.15); color: #f87171; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0;">
                    <i class="fa-solid fa-exclamation"></i>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <p style="margin: 0; font-weight: 500; font-size: 0.88rem; color: #f8fafc; line-height: 1.4;">{{ session('error') }}</p>
                </div>
                <button onclick="dismissToast(this.closest('.admin-toast'))" style="background: none; border: none; color: #64748b; cursor: pointer; font-size: 0.95rem; padding: 0.2rem; line-height: 1; flex-shrink: 0;" title="Dismiss"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div style="height: 2px; background: rgba(255,255,255,0.05); overflow: hidden;">
                <div class="toast-progress" style="height: 100%; background: #f87171; width: 100%; animation: toastCountdown 10s linear forwards;"></div>
            </div>
        </div>
        @endif
    </div>
    <style>
        @keyframes toastSlideIn { from { transform: translateX(120%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes toastSlideOut { from { transform: translateX(0); opacity: 1; } to { transform: translateX(120%); opacity: 0; } }
        @keyframes toastCountdown { from { width: 100%; } to { width: 0%; } }
    </style>
    <script>
        function dismissToast(el) { el.style.animation = 'toastSlideOut 0.4s cubic-bezier(0.55, 0, 1, 0.45) forwards'; setTimeout(function() { el.remove(); }, 400); }
        document.querySelectorAll('.admin-toast').forEach(function(toast) { setTimeout(function() { dismissToast(toast); }, 10000); });
    </script>
    @endif
</body>
</html>
