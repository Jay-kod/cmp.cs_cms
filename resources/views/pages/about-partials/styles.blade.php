<style>
    /* ── Objectives Timeline ── */
    .obj-timeline {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 0;
    }
    .obj-row {
        display: grid;
        grid-template-columns: 1fr 50px 1fr;
        align-items: start;
        min-height: 120px;
    }
    .obj-row-reverse .obj-number-side { order: 3; }
    .obj-row-reverse .obj-connector { order: 2; }
    .obj-row-reverse .obj-content-side { order: 1; }
    .obj-row-reverse .obj-content-card { border-left: none !important; border-right: 3px solid; border-right-color: inherit; }
    .obj-row-reverse .obj-content-card { text-align: right; }
    .obj-row-reverse .obj-content-header { flex-direction: row-reverse; }
    .obj-number-side {
        display: flex;
        align-items: flex-start;
        padding-top: 0.6rem;
    }
    .obj-row:not(.obj-row-reverse) .obj-number-side { justify-content: flex-end; padding-right: 1.5rem; }
    .obj-row-reverse .obj-number-side { justify-content: flex-start; padding-left: 1.5rem; }
    .obj-big-num {
        font-size: 3rem;
        font-weight: 900;
        font-family: var(--font-heading);
        line-height: 1;
        opacity: 0.25;
    }
    .obj-row:hover .obj-big-num { opacity: 0.6; }
    .obj-connector {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }
    .obj-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 1rem;
        z-index: 2;
        transition: transform 0.3s;
    }
    .obj-row:hover .obj-dot { transform: scale(1.3); }
    .obj-line {
        width: 2px;
        flex: 1;
        background: linear-gradient(to bottom, #bbf7d0, #dcfce7);
        min-height: 30px;
    }
    .obj-content-side {
        padding-top: 0.3rem;
        padding-bottom: 1.5rem;
    }
    .obj-row:not(.obj-row-reverse) .obj-content-side { padding-left: 1.5rem; }
    .obj-row-reverse .obj-content-side { padding-right: 1.5rem; }
    .obj-content-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 1.4rem 1.6rem;
        box-shadow: 0 2px 12px -2px rgba(0,0,0,0.05);
        border: 1px solid #f0fdf4;
        transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
    }
    .obj-row:hover .obj-content-card {
        transform: translateY(-3px);
        box-shadow: 0 14px 32px -8px rgba(22,163,74,0.12);
        border-color: #dcfce7;
    }
    .obj-content-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 0.6rem;
    }
    .obj-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
        transition: transform 0.3s;
    }
    .obj-row:hover .obj-icon { transform: scale(1.1); }
    .obj-title {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 700;
        color: #0f172a;
        font-family: var(--font-heading);
        line-height: 1.3;
    }
    .obj-text {
        margin: 0;
        color: #475569;
        font-size: 0.9rem;
        line-height: 1.7;
    }

    /* Vision/Mission & Programmes Hover Effects */
    .vision-card:hover .bg-icon, .mission-card:hover .bg-icon { transform: rotate(0deg) scale(1.1) !important; color: rgba(22, 163, 74, 0.12) !important; }
    .vision-card:hover .main-icon, .mission-card:hover .main-icon { transform: scale(1.15) !important; }
    .mission-card:hover .bg-icon { color: rgba(16, 185, 129, 0.12) !important; }
    
    .about-prog-card:hover .bg-circle { transform: scale(1.5) !important; }
    .about-prog-card:hover .main-icon { transform: rotate(-10deg) scale(1.1) !important; }

    .about-board-card:hover .board-icon { transform: scale(1.15) !important; }

    .about-req-card:hover .req-icon { transform: scale(1.1) !important; }
    
    .about-facilities-card:hover .fac-icon { transform: scale(1.1) rotate(5deg) !important; }

    /* ── About Page Responsive ── */

    /* Tablet landscape (≤1024px) */
    @media (max-width: 1024px) {
        .about-hero h1 { font-size: 2.6rem !important; }
        .about-main { padding: 2.5rem 2.5rem !important; }
        .about-facilities-grid { grid-template-columns: 1fr !important; }
    }

    /* Tablet portrait (≤768px) */
    @media (max-width: 768px) {
        .page-layout { flex-direction: column; }
        .about-hero { padding: 3.5rem 0 5.5rem !important; }
        .about-hero h1 { font-size: 2rem !important; }
        .about-hero p { font-size: 1rem !important; }
        .about-main { padding: 1.5rem 1.2rem !important; border-radius: 12px !important; }
        .about-main section { margin-bottom: 2.5rem !important; }
        .about-main .section-heading h2 { font-size: 1.5rem !important; }
        .about-main .section-heading-icon { width: 40px !important; height: 40px !important; font-size: 1.1rem !important; border-radius: 10px !important; }
        .about-story-layout { flex-direction: column !important; align-items: center !important; gap: 1.5rem !important; }
        .about-hod-card { flex: none !important; max-width: 220px !important; }
        .about-story-text { min-width: 0 !important; font-size: 0.95rem !important; }
        .about-story-text .about-quote { font-size: 0.95rem !important; padding: 1rem 1.2rem !important; }
        .about-milestones { grid-template-columns: repeat(2, 1fr) !important; gap: 0.8rem !important; }
        .about-milestones > div { padding: 1rem !important; }
        .about-milestones .milestone-year { font-size: 1.5rem !important; }
        .about-vm-grid { grid-template-columns: 1fr !important; }
        .about-vm-card { padding: 1.8rem !important; }
        /* Objectives: collapse to left-aligned single-column */
        .obj-row,
        .obj-row.obj-row-reverse {
            grid-template-columns: 40px 1fr !important;
        }
        .obj-row .obj-number-side,
        .obj-row-reverse .obj-number-side { display: none !important; }
        .obj-row-reverse .obj-content-side { order: unset; }
        .obj-row-reverse .obj-connector { order: unset; }
        .obj-row-reverse .obj-content-card { border-right: none !important; border-left: 3px solid !important; text-align: left !important; }
        .obj-row-reverse .obj-content-header { flex-direction: row !important; }
        .obj-content-side { padding-left: 1rem !important; padding-right: 0 !important; }
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
        .about-hero { padding: 2.5rem 0 5rem !important; }
        .about-hero h1 { font-size: 1.6rem !important; }
        .about-hero p { font-size: 0.88rem !important; }
        .about-main { padding: 1.2rem 1rem !important; margin-top: -1.5rem !important; }
        .about-main .section-heading h2 { font-size: 1.3rem !important; }
        .about-hod-card { max-width: 200px !important; }
        .about-milestones { grid-template-columns: repeat(2, 1fr) !important; }
        .about-objectives-wrap h3 { font-size: 1.4rem !important; }
        .obj-content-card { padding: 1rem 1.2rem !important; }
        .obj-title { font-size: 0.95rem !important; }
        .obj-text { font-size: 0.84rem !important; }
        .about-values-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 0.8rem !important; }
        .about-values-grid > div { padding: 1rem 0.8rem !important; }
        .about-values-grid > div .val-icon { width: 40px !important; height: 40px !important; font-size: 1.1rem !important; margin-bottom: 0.6rem !important; }
        .about-values-grid > div h4 { font-size: 0.95rem !important; }
        .about-values-grid > div p { font-size: 0.78rem !important; line-height: 1.4 !important; }
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
        .obj-row, .obj-row.obj-row-reverse { grid-template-columns: 30px 1fr !important; }
        .obj-dot { width: 10px !important; height: 10px !important; }
        .obj-content-card { padding: 0.8rem 1rem !important; }
        .about-values-grid { grid-template-columns: 1fr 1fr !important; }
        .about-req-grid { grid-template-columns: 1fr !important; }
    }
</style>
