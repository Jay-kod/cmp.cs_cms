<?php
$html = file_get_contents(__DIR__ . '/resources/views/components/nav/layer-2.blade.php');

$newNav = <<<HTML
        <div class="navbar-brand-wrapper">
            <a href="{{ url('/') }}" class="navbar-brand" style="margin-left: 0; gap: 0.85rem; text-decoration: none;">
                <img src="{{ asset(config('university.logo', 'build/assets/logo.png')) }}" alt="Logo" class="navbar-logo" style="width: 55px; height: 55px; object-fit: contain; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));" onerror="this.src='https://via.placeholder.com/44?text=Logo'">
                <div class="navbar-brand-text" style="display: flex; flex-direction: column;">
                    <strong style="color: var(--color-primary); font-size: clamp(1rem, 1.5vw, 1.25rem); font-weight: 800; line-height: 1.1; letter-spacing: -0.01em;">{{ config('university.name', 'Department of Computer Science') }}</strong>
                    <span style="color: var(--color-text-muted); font-size: clamp(0.7rem, 1vw, 0.85rem); font-weight: 500; line-height: 1.2; margin-top: 0.2rem;">{{ config('university.university', 'Nasarawa State University, Keffi') }}</span>
                </div>
            </a>
        </div>

        <!-- Navigation & Actions Wrapper -->
        <div class="navbar-nav-wrapper" style="display: flex; align-items: center; justify-content: flex-end; flex: 1; gap: 1rem;">
            <!-- Desktop Nav -->
            <nav class="navbar-nav desktop-only" id="primary-nav" style="display: flex; align-items: center; justify-content: flex-end; gap: 1.5rem; flex: 1;">
                <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}" style="font-weight: 600; font-size: 0.95rem; color: {{ request()->is('/') ? 'var(--color-primary)' : 'var(--color-text-main)' }}; text-decoration: none; position: relative; padding: 0.5rem 0; transition: color var(--transition-fast);">
                    Home
                    @if(request()->is('/'))<div style="position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background-color: var(--color-primary);"></div>@endif
                </a>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('about*') ? 'active' : '' }}" aria-label="About dropdown" style="font-weight: 600; font-size: 0.95rem; color: {{ request()->is('about*') ? 'var(--color-primary)' : 'var(--color-text-main)' }}; cursor: pointer; display: flex; align-items: center; gap: 0.3rem; padding: 0.5rem 0; transition: color var(--transition-fast);">
                        About <i class="fa-solid fa-chevron-down" style="font-size:0.7rem; opacity: 0.7;"></i>
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: calc(100% + 5px); left: 50%; transform: translateX(-50%); background: var(--color-bg-main); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border-radius: 0.5rem; padding: 0.5rem; min-width: 220px; z-index: 50; border: 1px solid var(--color-border);">
                        <a href="{{ url('/about') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: var(--color-text-main); font-size: 0.9rem; font-weight: 500; text-decoration: none; border-radius: 0.25rem; transition: background-color var(--transition-fast), color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-bg-alt)'; this.style.color='var(--color-primary)'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--color-text-main)'">About the Department</a>
                        <a href="{{ url('/about#vision-mission') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: var(--color-text-main); font-size: 0.9rem; font-weight: 500; text-decoration: none; border-radius: 0.25rem; transition: background-color var(--transition-fast), color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-bg-alt)'; this.style.color='var(--color-primary)'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--color-text-main)'">Vision &amp; Mission</a>
                        <a href="{{ url('/about#hod-message') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: var(--color-text-main); font-size: 0.9rem; font-weight: 500; text-decoration: none; border-radius: 0.25rem; transition: background-color var(--transition-fast), color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-bg-alt)'; this.style.color='var(--color-primary)'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--color-text-main)'">HOD's Message</a>
                        <a href="{{ url('/nacos-presidents') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: var(--color-text-main); font-size: 0.9rem; font-weight: 500; text-decoration: none; border-radius: 0.25rem; transition: background-color var(--transition-fast), color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-bg-alt)'; this.style.color='var(--color-primary)'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--color-text-main)'">Our Association</a>
                    </div>
                </details>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('academics*') ? 'active' : '' }}" aria-label="Academics dropdown" style="font-weight: 600; font-size: 0.95rem; color: {{ request()->is('academics*') ? 'var(--color-primary)' : 'var(--color-text-main)' }}; cursor: pointer; display: flex; align-items: center; gap: 0.3rem; padding: 0.5rem 0; transition: color var(--transition-fast);">
                        Academics <i class="fa-solid fa-chevron-down" style="font-size:0.7rem; opacity: 0.7;"></i>
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: calc(100% + 5px); left: 50%; transform: translateX(-50%); background: var(--color-bg-main); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border-radius: 0.5rem; padding: 0.5rem; min-width: 320px; z-index: 50; border: 1px solid var(--color-border);">
                        <a href="{{ url('/academics#programmes') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: var(--color-text-main); font-size: 0.9rem; font-weight: 500; text-decoration: none; border-radius: 0.25rem; transition: background-color var(--transition-fast), color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-bg-alt)'; this.style.color='var(--color-primary)'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--color-text-main)'">Programmes (BSc, MSc, PhD)</a>
                        <a href="{{ url('/academics#sub-departments') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: var(--color-text-main); font-size: 0.9rem; font-weight: 500; text-decoration: none; border-radius: 0.25rem; transition: background-color var(--transition-fast), color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-bg-alt)'; this.style.color='var(--color-primary)'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--color-text-main)'">Sub-departments (Cyber Security, Data Science)</a>
                        <a href="{{ url('/academics#siwes') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: var(--color-text-main); font-size: 0.9rem; font-weight: 500; text-decoration: none; border-radius: 0.25rem; transition: background-color var(--transition-fast), color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-bg-alt)'; this.style.color='var(--color-primary)'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--color-text-main)'">SIWES Information</a>
                        <a href="{{ url('/academics#projects') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: var(--color-text-main); font-size: 0.9rem; font-weight: 500; text-decoration: none; border-radius: 0.25rem; transition: background-color var(--transition-fast), color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-bg-alt)'; this.style.color='var(--color-primary)'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--color-text-main)'">Final Year Projects</a>
                    </div>
                </details>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('people*') ? 'active' : '' }}" aria-label="People dropdown" style="font-weight: 600; font-size: 0.95rem; color: {{ request()->is('people*') ? 'var(--color-primary)' : 'var(--color-text-main)' }}; cursor: pointer; display: flex; align-items: center; gap: 0.3rem; padding: 0.5rem 0; transition: color var(--transition-fast);">
                        People <i class="fa-solid fa-chevron-down" style="font-size:0.7rem; opacity: 0.7;"></i>
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: calc(100% + 5px); left: 50%; transform: translateX(-50%); background: var(--color-bg-main); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border-radius: 0.5rem; padding: 0.5rem; min-width: 200px; z-index: 50; border: 1px solid var(--color-border);">
                        <a href="{{ url('/people') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: var(--color-text-main); font-size: 0.9rem; font-weight: 500; text-decoration: none; border-radius: 0.25rem; transition: background-color var(--transition-fast), color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-bg-alt)'; this.style.color='var(--color-primary)'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--color-text-main)'">Staff Directory</a>
                    </div>
                </details>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('research-news*') || request()->is('events*') ? 'active' : '' }}" aria-label="News dropdown" style="font-weight: 600; font-size: 0.95rem; color: {{ request()->is('research-news*') || request()->is('events*') ? 'var(--color-primary)' : 'var(--color-text-main)' }}; cursor: pointer; display: flex; align-items: center; gap: 0.3rem; padding: 0.5rem 0; transition: color var(--transition-fast);">
                        News <i class="fa-solid fa-chevron-down" style="font-size:0.7rem; opacity: 0.7;"></i>
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: calc(100% + 5px); right: 0; left: auto; background: var(--color-bg-main); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border-radius: 0.5rem; padding: 0.5rem; min-width: 250px; z-index: 50; border: 1px solid var(--color-border);">
                        <a href="{{ url('/research-news') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: var(--color-text-main); font-size: 0.9rem; font-weight: 500; text-decoration: none; border-radius: 0.25rem; transition: background-color var(--transition-fast), color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-bg-alt)'; this.style.color='var(--color-primary)'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--color-text-main)'">News &amp; Announcements</a>
                        <a href="{{ url('/events') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: var(--color-text-main); font-size: 0.9rem; font-weight: 500; text-decoration: none; border-radius: 0.25rem; transition: background-color var(--transition-fast), color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-bg-alt)'; this.style.color='var(--color-primary)'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--color-text-main)'">Events &amp; Seminars</a>
                        <a href="{{ url('/academic-calendar') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: var(--color-text-main); font-size: 0.9rem; font-weight: 500; text-decoration: none; border-radius: 0.25rem; transition: background-color var(--transition-fast), color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-bg-alt)'; this.style.color='var(--color-primary)'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--color-text-main)'">Academic Calendar</a>
                    </div>
                </details>

                <a href="{{ url('/contact') }}" class="nav-link btn btn-primary {{ request()->is('contact') ? 'active' : '' }}" style="background-color: var(--color-primary); color: white; padding: 0.5rem 1.5rem; border-radius: 2rem; border: none; font-weight: 600; font-size: 0.95rem; margin-left: 0.5rem; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(22, 101, 52, 0.2), 0 2px 4px -1px rgba(22, 101, 52, 0.1);" onmouseover="this.style.backgroundColor='var(--color-accent)'; this.style.color='var(--color-text-main)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.backgroundColor='var(--color-primary)'; this.style.color='white'; this.style.transform='translateY(0)';">
                    Contact Us
                </a>
            </nav>
HTML;

$html = preg_replace('/<div class="navbar-brand-wrapper">.*?<\/nav>/s', $newNav, $html);
file_put_contents(__DIR__ . '/resources/views/components/nav/layer-2.blade.php', $html);
echo "Done";
