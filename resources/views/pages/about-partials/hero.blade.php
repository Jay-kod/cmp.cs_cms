<!-- Hero Section -->
<div class="about-hero" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.97) 0%, rgba(4, 120, 87, 0.92) 50%, rgba(15, 23, 42, 0.95) 100%), url('{{ $heroUrl }}') center/cover; padding: 5.5rem 0 6.5rem; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: radial-gradient(circle at 20% 80%, rgba(16, 185, 129, 0.15), transparent 50%), radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.1), transparent 50%); pointer-events: none;"></div>
    <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; border: 1px solid rgba(255,255,255,0.04); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -150px; left: -80px; width: 500px; height: 500px; border: 1px solid rgba(255,255,255,0.03); border-radius: 50%;"></div>
    <div class="container" style="position: relative; z-index: 10; text-align: center;">
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.4rem 1.2rem; background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); color: #a7f3d0; border-radius: 20px; font-size: 0.8rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.1);">
            <i class="fa-solid fa-landmark" style="font-size: 0.7rem;"></i> {{ $gs('about_hero_badge', 'About Us') }}
        </div>
        <h1 style="color: white; font-size: 3.2rem; font-family: var(--font-heading); margin: 0 0 1rem 0; font-weight: 800; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">{{ $gs('about_hero_title', 'About Our Department') }}</h1>
        <p style="color: #cbd5e1; font-size: 1.15rem; max-width: 680px; margin: 0 auto; line-height: 1.7;">{{ $gs('about_hero_subtitle', 'Department of Computer Science, Faculty of Natural and Applied Sciences — Nasarawa State University, Keffi') }}</p>
    </div>
</div>
