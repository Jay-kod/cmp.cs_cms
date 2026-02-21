<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'DCMS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
</head>
<body class="antialiased" style="background-color: #f3f4f6;">
    <div class="admin-layout" style="display: flex; min-height: 100vh;">
        
        <!-- Sidebar -->
        <aside class="admin-sidebar" style="width: 250px; background: var(--color-primary); color: white; flex-shrink: 0; display: flex; flex-direction: column;">
            <div style="padding: 1.5rem; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <h2 style="color: white; margin: 0; font-size: 1.5rem;">DCMS Admin</h2>
                <div style="font-size: 0.8rem; color: var(--color-accent); margin-top: 5px;">{{ Auth::user()->name }}</div>
            </div>
            
            <nav style="flex: 1; overflow-y: auto; padding: 1rem 0;">
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li><a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                    
                    <li class="nav-heading">Academics</li>
                    <li><a href="{{ route('admin.programmes.index') }}" class="admin-nav-item {{ request()->routeIs('admin.programmes.*') ? 'active' : '' }}"><i class="fa-solid fa-graduation-cap"></i> Programmes</a></li>
                    <li><a href="{{ route('admin.courses.index') }}" class="admin-nav-item {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}"><i class="fa-solid fa-book"></i> Courses</a></li>
                    
                    <li class="nav-heading">People</li>
                    <li><a href="{{ route('admin.staff.index') }}" class="admin-nav-item {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}"><i class="fa-solid fa-users"></i> Staff Directory</a></li>
                    <li><a href="{{ route('admin.alumni.index') }}" class="admin-nav-item {{ request()->routeIs('admin.alumni.*') ? 'active' : '' }}"><i class="fa-solid fa-user-graduate"></i> Alumni</a></li>
                    
                    <li class="nav-heading">Content</li>
                    <li><a href="{{ route('admin.news.index') }}" class="admin-nav-item {{ request()->routeIs('admin.news.*') ? 'active' : '' }}"><i class="fa-solid fa-newspaper"></i> News Items</a></li>
                    <li><a href="{{ route('admin.events.index') }}" class="admin-nav-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}"><i class="fa-solid fa-calendar"></i> Events</a></li>
                    <li><a href="{{ route('admin.announcements.index') }}" class="admin-nav-item {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}"><i class="fa-solid fa-bullhorn"></i> Announcements</a></li>
                    <li><a href="{{ route('admin.gallery.index') }}" class="admin-nav-item {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}"><i class="fa-solid fa-images"></i> Photo Gallery</a></li>
                    
                    <li class="nav-heading">System</li>
                    <li><a href="{{ route('admin.settings.index') }}" class="admin-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><i class="fa-solid fa-cog"></i> Settings</a></li>
                </ul>
            </nav>
            
            <div style="padding: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="width: 100%; background: transparent; border: 1px solid rgba(255,255,255,0.3); color: white; padding: 0.5rem; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px;">
                        <i class="fa-solid fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>
        
        <!-- Main Content area -->
        <main style="flex: 1; min-width: 0; display: flex; flex-direction: column;">
            <header style="background: white; padding: 1rem 2rem; border-bottom: 1px solid var(--color-border); display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                <h1 style="margin: 0; font-size: 1.25rem; color: var(--color-primary);">@yield('header', 'Dashboard')</h1>
                <div style="display: flex; gap: 1rem;">
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;"><i class="fa-solid fa-external-link"></i> View Website</a>
                </div>
            </header>
            
            <div style="padding: 2rem; flex: 1; overflow-y: auto;">
                @if(session('success'))
                    <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 4px; margin-bottom: 1rem; border: 1px solid #c3e6cb;">
                        <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 4px; margin-bottom: 1rem; border: 1px solid #f5c6cb;">
                        <i class="fa-solid fa-exclamation-triangle"></i> {{ session('error') }}
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
