<section style="padding: 6rem 0; background: #F0F9F3; position: relative;">
    <div class="container reveal reveal-up">
        <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
            <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                <i class="fa-solid fa-microscope"></i>
            </div>
            <h2 style="margin: 0; font-size: 2.2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800;">Research & Publications</h2>
        </div>
        <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 2.5rem; border-radius: 2px;"></div>

        <div style="font-size: 1.05rem; line-height: 1.8; color: #475569; margin-bottom: 2.5rem;">
            {!! nl2br(e($gs("{$deptPrefix}_research_text", "Our department engages in cutting-edge research across multiple domains. Our faculty and postgraduate students actively publish in top-tier journals and conference proceedings."))) !!}
        </div>
        
        <div style="text-align: left;">
            <a href="{{ route('research-news') }}?department={{ $deptPrefix }}" class="btn btn-primary" style="background: var(--color-primary); color: white; padding: 0.8rem 1.8rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: background 0.3s ease; border: none; box-shadow: 0 4px 15px rgba(22,163,74,0.3);">
                Explore Our Research <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>