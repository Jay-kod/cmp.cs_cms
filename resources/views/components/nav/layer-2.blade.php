<div class="navbar">
    <div class="container navbar-inner">
        <!-- Brand -->
        <a href="/" class="navbar-brand">
            <img src="{{ asset(config('university.logo', 'build/assets/logo.png')) }}" alt="Logo" class="navbar-logo" onerror="this.src='https://via.placeholder.com/44?text=Logo'">
            <div class="navbar-brand-text">
                <strong class="desktop-only">{{ config('university.name') }}</strong>
                <strong class="mobile-only">CS Dept. NSUK</strong>
                <span class="desktop-only">{{ config('university.university') }}</span>
            </div>
        </a>

        <!-- Desktop Nav -->
        <nav class="navbar-nav desktop-only" id="primary-nav">
            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="/about" class="nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>
            <a href="/academics" class="nav-link {{ request()->is('academics*') ? 'active' : '' }}">Academics</a>
            <a href="/research-news" class="nav-link {{ request()->is('research-news*') ? 'active' : '' }}">Blog</a>
            <a href="/contact" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
            <span class="nav-divider"></span>
            <a href="#" class="nav-link nav-icon-link" id="search-toggle-btn" title="Search"><i class="fa-solid fa-magnifying-glass"></i></a>
            <a href="/contact" class="navbar-cta">Contact Us</a>
        </nav>

        <button class="navbar-hamburger" id="mobile-menu-btn" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </div>

    <!-- Mobile Drawer -->
    <div class="navbar-mobile-drawer" id="mobileDrawer">
        <a href="/" class="mobile-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
        <a href="/about" class="mobile-link {{ request()->is('about') ? 'active' : '' }}">About</a>
        <a href="/academics" class="mobile-link {{ request()->is('academics*') ? 'active' : '' }}">Academics</a>
        <a href="/research-news" class="mobile-link {{ request()->is('research-news*') ? 'active' : '' }}">Blog</a>
        <a href="/contact" class="mobile-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
        <a href="/contact" class="mobile-link mobile-cta">Contact Us</a>
    </div>
</div>
