<style>
    /* ── About Page Responsive ── */

    /* Tablet landscape (≤1024px) */
    @media (max-width: 1024px) {
        .about-hero h1 { font-size: 2.6rem !important; }
        .about-main { padding: 2.5rem 2.5rem !important; }
        .about-objectives-grid { grid-template-columns: repeat(2, 1fr) !important; }
        .about-facilities-grid { grid-template-columns: 1fr !important; }
    }

    /* Tablet portrait (≤768px) */
    @media (max-width: 768px) {
        .page-layout { flex-direction: column; }
        .about-hero { padding: 3.5rem 0 4.5rem !important; }
        .about-hero h1 { font-size: 2rem !important; }
        .about-hero p { font-size: 1rem !important; }
        .about-main { padding: 1.5rem 1.2rem !important; border-radius: 12px !important; }
        .about-main section { margin-bottom: 2.5rem !important; }
        .about-main .section-heading h2 { font-size: 1.5rem !important; }
        .about-main .section-heading-icon { width: 40px !important; height: 40px !important; font-size: 1.1rem !important; border-radius: 10px !important; }
        .about-story-layout { flex-direction: column !important; align-items: center !important; gap: 1.5rem !important; }
        .about-hod-card { flex: none !important; max-width: 180px !important; }
        .about-story-text { min-width: 0 !important; font-size: 0.95rem !important; }
        .about-story-text .about-quote { font-size: 0.95rem !important; padding: 1rem 1.2rem !important; }
        .about-milestones { grid-template-columns: repeat(2, 1fr) !important; gap: 0.8rem !important; }
        .about-milestones > div { padding: 1rem !important; }
        .about-milestones .milestone-year { font-size: 1.5rem !important; }
        .about-vm-grid { grid-template-columns: 1fr !important; }
        .about-vm-card { padding: 1.8rem !important; }
        .about-objectives-wrap { padding: 1.5rem !important; }
        .about-objectives-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 0.8rem !important; }
        .about-values-grid { grid-template-columns: repeat(3, 1fr) !important; gap: 0.8rem !important; }
        .about-values-grid > div { padding: 1.2rem 0.8rem !important; }
        .about-programmes-grid { grid-template-columns: 1fr !important; }
        .about-board-grid { grid-template-columns: 1fr !important; }
        .about-req-grid { grid-template-columns: repeat(3, 1fr) !important; }
        .about-facilities-grid { grid-template-columns: 1fr !important; }
        .about-faculty-cta { padding: 2.5rem 1.5rem !important; }
        .about-faculty-cta h2 { font-size: 1.6rem !important; }
        .about-faculty-cta p { font-size: 0.95rem !important; }
    }

    /* Mobile (≤576px) */
    @media (max-width: 576px) {
        .about-hero { padding: 2.5rem 0 3.5rem !important; }
        .about-hero h1 { font-size: 1.6rem !important; }
        .about-hero p { font-size: 0.88rem !important; }
        .about-main { padding: 1.2rem 1rem !important; margin-top: -1.5rem !important; }
        .about-main .section-heading h2 { font-size: 1.3rem !important; }
        .about-hod-card { max-width: 150px !important; }
        .about-milestones { grid-template-columns: repeat(2, 1fr) !important; }
        .about-objectives-grid { grid-template-columns: 1fr 1fr !important; }
        .about-objectives-grid > div { padding: 1rem 0.7rem !important; }
        .about-values-grid { grid-template-columns: repeat(2, 1fr) !important; }
        .about-values-grid > div .val-icon { width: 44px !important; height: 44px !important; font-size: 1.2rem !important; }
        .about-values-grid > div h4 { font-size: 0.95rem !important; }
        .about-req-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 0.6rem !important; }
        .about-req-grid > div { padding: 1rem 0.6rem !important; }
        .about-facilities-card { flex-direction: column !important; gap: 0.8rem !important; padding: 1.2rem !important; }
        .about-faculty-cta { padding: 2rem 1.2rem !important; border-radius: 12px !important; }
        .about-faculty-cta h2 { font-size: 1.4rem !important; }
        .about-faculty-cta .cta-buttons { flex-direction: column !important; gap: 0.6rem !important; }
        .about-faculty-cta .cta-buttons a { width: 100%; justify-content: center; padding: 0.8rem 1.5rem !important; font-size: 0.88rem !important; }
    }

    /* Small mobile (≤400px) */
    @media (max-width: 400px) {
        .about-hero h1 { font-size: 1.35rem !important; }
        .about-milestones { grid-template-columns: 1fr 1fr !important; }
        .about-milestones .milestone-year { font-size: 1.3rem !important; }
        .about-objectives-grid { grid-template-columns: 1fr !important; }
        .about-values-grid { grid-template-columns: 1fr 1fr !important; }
        .about-req-grid { grid-template-columns: 1fr !important; }
    }
</style>
