<style>
    /* ── Blog / Research-News Page Responsive ── */

    /* Tablet landscape (≤1024px) */
    @media (max-width: 1024px) {
        .blog-hero h1 { font-size: 2.6rem !important; }
        .blog-main { padding: 2.5rem 2.5rem !important; }
        .blog-research-grid { grid-template-columns: 1fr !important; }
        .blog-news-grid { grid-template-columns: repeat(2, 1fr) !important; }
    }

    /* Tablet portrait (≤768px) */
    @media (max-width: 768px) {
        .page-layout { flex-direction: column; }
        .blog-hero { padding: 3.5rem 0 5.5rem !important; }
        .blog-hero h1 { font-size: 2rem !important; }
        .blog-hero p { font-size: 1rem !important; }
        .blog-main { padding: 1.5rem 1.2rem !important; border-radius: 12px !important; }
        .blog-main section { margin-bottom: 2.5rem !important; }
        .blog-section-heading h2 { font-size: 1.5rem !important; }
        .blog-section-icon { width: 40px !important; height: 40px !important; font-size: 1.1rem !important; border-radius: 10px !important; }
        .blog-research-grid { grid-template-columns: 1fr !important; gap: 1rem !important; }
        .blog-research-grid > div { padding: 1.5rem 1.2rem !important; }
        .blog-pub-list > div { padding: 1.2rem !important; }
        .blog-pub-list > div h4 { font-size: 1rem !important; }
        .blog-pub-list > div > div:last-of-type { flex-direction: column !important; gap: 0.5rem !important; }
        .blog-news-grid { grid-template-columns: 1fr !important; gap: 1.2rem !important; }
        .blog-news-grid > div img, .blog-news-grid > div > div:first-child > div { height: 180px !important; }
        .blog-event-card { flex-direction: column !important; border-radius: 16px !important; }
        .blog-event-date { flex-direction: row !important; justify-content: center !important; gap: 0.6rem !important; align-items: baseline !important; padding: 1rem 1.5rem !important; min-width: unset !important; border-radius: 16px 16px 0 0 !important; }
        .blog-event-date > span { font-size: 1.1rem !important; margin: 0 !important; letter-spacing: 1px !important; }
        .blog-event-date > span:nth-child(3) { font-size: 1.8rem !important; }
        .blog-event-date > span:nth-child(4) { font-size: 1.1rem !important; }
        .blog-event-details { padding: 1.5rem !important; min-width: 0 !important; }
        .blog-event-details h3 { font-size: 1.25rem !important; margin-bottom: 0.4rem !important; }
        .blog-event-details p { font-size: 0.95rem !important; margin-bottom: 1.2rem !important; }
        .blog-event-details > div { gap: 0.8rem !important; }
        .blog-gallery-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 0.8rem !important; }
        .blog-gallery-grid > div { height: 180px !important; }
    }

    /* Mobile (≤576px) */
    @media (max-width: 576px) {
        .blog-hero { padding: 2.5rem 0 5rem !important; }
        .blog-hero h1 { font-size: 1.6rem !important; }
        .blog-hero p { font-size: 0.88rem !important; }
        .blog-main { padding: 1.2rem 1rem !important; margin-top: -1.5rem !important; }
        .blog-section-heading h2 { font-size: 1.3rem !important; }
        .blog-research-grid > div { padding: 1.2rem 1rem !important; }
        .blog-research-grid > div div[style*="width: 56px"] { width: 44px !important; height: 44px !important; font-size: 1.2rem !important; }
        .blog-research-grid > div h3 { font-size: 1.1rem !important; }
        .blog-research-grid > div p { font-size: 0.88rem !important; }
        .blog-pub-list > div { padding: 1rem !important; border-left-width: 3px !important; }
        .blog-pub-list > div h4 { font-size: 0.95rem !important; }
        .blog-pub-list > div > div:first-child { flex-direction: column !important; align-items: flex-start !important; }
        .blog-news-grid > div img, .blog-news-grid > div > div:first-child > div { height: 160px !important; }
        .blog-news-grid > div h3 { font-size: 1.1rem !important; }
        .blog-news-grid > div p { font-size: 0.88rem !important; }
        .blog-event-date > span:nth-child(3) { font-size: 1.5rem !important; }
        .blog-event-details { padding: 1.25rem !important; }
        .blog-event-details h3 { font-size: 1.1rem !important; line-height: 1.4 !important; }
        .blog-event-details p { font-size: 0.9rem !important; margin-bottom: 1rem !important; }
        .blog-event-details > div { gap: 0.6rem !important; }
        .blog-event-details > div > div { font-size: 0.8rem !important; padding: 0.3rem 0.8rem 0.3rem 0.3rem !important; }
        .blog-gallery-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 0.6rem !important; }
        .blog-gallery-grid > div { height: 150px !important; }
        .blog-gallery-grid > div h4 { font-size: 0.95rem !important; }
    }

    /* Small mobile (≤400px) */
    @media (max-width: 400px) {
        .blog-hero h1 { font-size: 1.35rem !important; }
        .blog-research-grid > div { padding: 1rem 0.8rem !important; }
        .blog-news-grid > div img, .blog-news-grid > div > div:first-child > div { height: 140px !important; }
        .blog-gallery-grid { grid-template-columns: 1fr 1fr !important; }
        .blog-gallery-grid > div { height: 130px !important; }
        .blog-pub-list > div > div:last-of-type span { font-size: 0.8rem !important; }
    }
</style>
