<!-- Hero Section -->
<div class="blog-hero" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.96) 0%, rgba(4, 120, 87, 0.9) 50%, rgba(15, 23, 42, 0.95) 100%), url('{{ $heroUrl }}') center/cover; padding: 5.5rem 0 6.5rem; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.15), transparent 50%), radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.1), transparent 50%); pointer-events: none;"></div>
    
    <!-- Floating Decorative Elements -->
    <div style="position: absolute; top: 15%; left: 10%; width: 150px; height: 150px; border: 1px solid rgba(255,255,255,0.05); border-radius: 50%; pointer-events: none;"></div>
    <div style="position: absolute; bottom: 10%; right: 5%; width: 250px; height: 250px; border: 1px solid rgba(255,255,255,0.04); border-radius: 50%; pointer-events: none;"></div>
    <div style="position: absolute; bottom: 15%; right: 25%; font-size: 8rem; color: rgba(255,255,255,0.02); transform: rotate(-15deg); pointer-events: none;"><i class="fa-solid fa-microscope"></i></div>
    
    <div class="container" data-aos="fade-up" style="position: relative; z-index: 10; text-align: center; display: flex; flex-direction: column; align-items: center;">
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.4rem 1.2rem; background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); color: #a7f3d0; border-radius: 20px; font-size: 0.8rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.1);">
            <i class="fa-solid fa-newspaper" style="font-size: 0.7rem;"></i> {{ $gs('blog_hero_badge', 'Innovation & Insights') }}
        </div>
        <h1 style="text-align: center; color: white; font-size: 3.2rem; font-family: var(--font-heading); margin: 0 0 1rem 0; font-weight: 800; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">{{ $gs('blog_hero_title', 'Research, News & Events') }}</h1>
        <p style="text-align: center; color: #cbd5e1; font-size: 1.15rem; max-width: 680px; margin: 0 auto; line-height: 1.7;">{{ $gs('blog_hero_subtitle', 'Stay updated with our latest technological breakthroughs, departmental highlights, and upcoming academic events.') }}</p>
    </div>
</div>
