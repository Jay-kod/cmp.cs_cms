<nav class="nav-layer-3" id="primary-nav">
    <div class="container">
        <ul class="main-menu">
            <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
            <li><a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
            <li><a href="/academics" class="{{ request()->is('academics*') ? 'active' : '' }}">Academics</a></li>
            <li><a href="/people" class="{{ request()->is('people*') ? 'active' : '' }}">People</a></li>
            <li><a href="/research-news" class="{{ request()->is('research-news*') ? 'active' : '' }}">Research & News</a></li>
            <li><a href="/contact-alumni" class="{{ request()->is('contact-alumni*') ? 'active' : '' }}">Contact & Alumni</a></li>
        </ul>
    </div>
</nav>
