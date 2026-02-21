<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('university.name')) - {{ config('university.short_name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    
    <header>
        <x-nav.layer-1 />
        <x-nav.layer-2 />
        <x-nav.layer-3 />
    </header>

    @if (!request()->is('/'))
        <div class="container" style="padding-top: var(--spacing-md); padding-bottom: var(--spacing-sm); font-size: 0.9rem; color: var(--color-text-muted);">
            {{ Breadcrumbs::render() }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer style="background: var(--color-primary); color: white; padding: var(--spacing-xl) 0; margin-top: var(--spacing-xl);">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} {{ config('university.name') }}, {{ config('university.university') }}. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
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

            const menuBtn = document.getElementById('mobile-menu-btn');
            const primaryNav = document.getElementById('primary-nav');
            
            if(menuBtn && primaryNav) {
                menuBtn.addEventListener('click', () => {
                    primaryNav.classList.toggle('active');
                });
            }
        });
    </script>
</body>
</html>
