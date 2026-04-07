<?php
$html = file_get_contents(__DIR__ . '/resources/views/components/nav/layer-2.blade.php');

$newNav = <<<HTML
        <!-- Navigation & Actions Wrapper -->
        <div class="navbar-nav-wrapper" style="display: flex; align-items: center; justify-content: flex-end; flex: 1; gap: 1rem;">
            <!-- Desktop Nav -->
            <nav class="navbar-nav desktop-only" id="primary-nav" style="display: flex; align-items: center; justify-content: flex-end; gap: 1.5rem; flex: 1;">
                <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}" style="font-weight: 600; font-size: 1rem; color: {{ request()->is('/') ? '#059669' : '#374151' }}; text-decoration: none; position: relative; padding: 0.25rem 0.1rem; display: inline-block;">
                    Home
                    @if(request()->is('/'))<div style="position: absolute; bottom: -8px; left: 0; right: 0; height: 3px; border-radius: 3px; background-color: #059669;"></div>@endif
                </a>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('about*') ? 'active' : '' }}" aria-label="About dropdown" style="font-weight: 500; font-size: 1rem; color: {{ request()->is('about*') ? '#059669' : '#374151' }}; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.1rem; position: relative;">
                        About <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 0.85rem; height: 0.85rem; opacity: 0.6;"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        @if(request()->is('about*'))<div style="position: absolute; bottom: -8px; left: 0; right: 0; height: 3px; border-radius: 3px; background-color: #059669;"></div>@endif
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: calc(100% + 15px); left: 50%; transform: translateX(-50%); background: white; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border-radius: 0.5rem; padding: 0.5rem; min-width: 220px; z-index: 50; border: 1px solid #f3f4f6;">
                        <a href="{{ url('/about') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">About the Department</a>
                        <a href="{{ url('/about#vision-mission') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Vision &amp; Mission</a>
                        <a href="{{ url('/about#hod-message') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">HOD's Message</a>
                        <a href="{{ url('/nacos-presidents') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Our Association</a>
                    </div>
                </details>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('academics*') ? 'active' : '' }}" aria-label="Academics dropdown" style="font-weight: 500; font-size: 1rem; color: {{ request()->is('academics*') ? '#059669' : '#374151' }}; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.1rem; position: relative;">
                        Academics <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 0.85rem; height: 0.85rem; opacity: 0.6;"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        @if(request()->is('academics*'))<div style="position: absolute; bottom: -8px; left: 0; right: 0; height: 3px; border-radius: 3px; background-color: #059669;"></div>@endif
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: calc(100% + 15px); left: 50%; transform: translateX(-50%); background: white; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border-radius: 0.5rem; padding: 0.5rem; min-width: 320px; z-index: 50; border: 1px solid #f3f4f6;">
                        <a href="{{ url('/academics#programmes') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Programmes (BSc, MSc, PhD)</a>
                        <a href="{{ url('/academics#sub-departments') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Sub-departments (Cyber Security, Data Science)</a>
                        <a href="{{ url('/academics#siwes') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">SIWES Information</a>
                        <a href="{{ url('/academics#projects') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Final Year Projects</a>
                    </div>
                </details>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('people*') ? 'active' : '' }}" aria-label="People dropdown" style="font-weight: 500; font-size: 1rem; color: {{ request()->is('people*') ? '#059669' : '#374151' }}; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.1rem; position: relative;">
                        People <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 0.85rem; height: 0.85rem; opacity: 0.6;"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        @if(request()->is('people*'))<div style="position: absolute; bottom: -8px; left: 0; right: 0; height: 3px; border-radius: 3px; background-color: #059669;"></div>@endif
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: calc(100% + 15px); left: 50%; transform: translateX(-50%); background: white; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border-radius: 0.5rem; padding: 0.5rem; min-width: 200px; z-index: 50; border: 1px solid #f3f4f6;">
                        <a href="{{ url('/people') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Staff Directory</a>
                    </div>
                </details>

                <details class="nav-dropdown" style="position: relative;">
                    <summary class="nav-link nav-dropdown-summary {{ request()->is('research-news*') || request()->is('events*') ? 'active' : '' }}" aria-label="News dropdown" style="font-weight: 500; font-size: 1rem; color: {{ request()->is('research-news*') || request()->is('events*') ? '#059669' : '#374151' }}; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.1rem; position: relative;">
                        News <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 0.85rem; height: 0.85rem; opacity: 0.6;"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        @if(request()->is('research-news*') || request()->is('events*'))<div style="position: absolute; bottom: -8px; left: 0; right: 0; height: 3px; border-radius: 3px; background-color: #059669;"></div>@endif
                    </summary>
                    <div class="nav-dropdown-menu" role="menu" style="position: absolute; top: calc(100% + 15px); right: 0; left: auto; background: white; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border-radius: 0.5rem; padding: 0.5rem; min-width: 250px; z-index: 50; border: 1px solid #f3f4f6;">
                        <a href="{{ url('/research-news') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">News &amp; Announcements</a>
                        <a href="{{ url('/events') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Events &amp; Seminars</a>
                        <a href="{{ url('/academic-calendar') }}" class="nav-dropdown-item" role="menuitem" style="display: block; padding: 0.6rem 1rem; color: #4b5563; font-size: 0.95rem; font-weight: 500; text-decoration: none; border-radius: 0.375rem; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f0fdf4'; this.style.color='#059669'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4b5563'">Academic Calendar</a>
                    </div>
                </details>
HTML;

// Find the start of Navigation & Actions Wrapper
$startPos = strpos($html, '<!-- Navigation & Actions Wrapper -->');

// Find the end of Desktop Nav (before the mobile drawer button)
$endPos = strpos($html, '<a href="{{ url(\'/contact\') }}"', $startPos);

if ($startPos !== false && $endPos !== false) {
    // Replace the specific section
    $html = substr_replace($html, $newNav . "\n                ", $startPos, $endPos - $startPos);
    file_put_contents(__DIR__ . '/resources/views/components/nav/layer-2.blade.php', $html);
    echo "Updated nav links perfectly.\n";
} else {
    echo "Could not find start/end positions.\n";
}
