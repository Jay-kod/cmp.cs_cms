<section data-aos="fade-up" style="padding: 6rem 0; background: #FFFFFF; position: relative;">
    <div class="container" data-aos="fade-up">
        <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
            <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                <i class="fa-solid fa-building"></i>
            </div>
            <h2 style="margin: 0; font-size: 2.2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800;">About the Department</h2>
        </div>
        <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 2.5rem; border-radius: 2px;"></div>

        <div style="font-size: 1.05rem; line-height: 1.8; color: #475569;">
            {!! nl2br(e($gs("{$deptPrefix}_about_text", 'Welcome to the department. We focus on delivering high-quality education and fostering a culture of innovation and research among our students and faculty.'))) !!}
        </div>
    </div>
</section>