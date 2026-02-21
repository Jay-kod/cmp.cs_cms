<div class="nav-layer-2">
    <div class="container">
        <div class="brand-identity">
            <img src="{{ asset(config('university.logo', 'build/assets/logo.png')) }}" alt="Logo" class="brand-logo" onerror="this.src='https://via.placeholder.com/60?text=Logo'">
            <div class="brand-text">
                <h1>{{ config('university.name') }}</h1>
                <p class="desktop-only">{{ config('university.university') }}</p>
            </div>
        </div>
        
        <div class="header-actions desktop-only">
            <div class="search-box">
                <input type="text" placeholder="Search..." style="padding: 0.5rem; border: 1px solid var(--color-border); border-radius: 4px;">
                <button class="btn btn-secondary" style="background: var(--color-primary); color: white;"><i class="fa-solid fa-search"></i></button>
            </div>
            <a href="#" class="btn btn-accent">Apply Now</a>
        </div>
        
        <button class="mobile-nav-toggle" id="mobile-menu-btn">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
</div>
