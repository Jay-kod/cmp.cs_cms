<!-- CAROUSEL JS + HOVER CARD CSS -->
<style>
/* Carousel */
.hero-carousel { background: var(--color-primary); }

/* Hover Cards */
.hover-card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
}

.hover-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1) !important;
}

.hover-card:hover .hover-icon-wrapper {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 8px 20px -5px rgba(0,0,0,0.15);
}

.hover-card:hover .hover-title {
    color: var(--color-primary) !important;
}

.hover-card:hover .hover-footer {
    background: #f8fafc !important;
}

.hover-card:hover .card-arrow {
    transform: translateX(4px);
    background: var(--color-primary) !important;
    color: white !important;
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
}

/* News Custom Hover Effects */
.news-card:hover .news-img {
    transform: scale(1.08);
}
.news-card:hover .news-title {
    color: var(--color-primary) !important;
}

/* Specific Stat Card Styles */
.stat-card {
    background: linear-gradient(135deg, #14532d 0%, #166534 50%, #15803d 100%);
    border: none;
    border-radius: 14px;
    padding: 1.8rem 1.2rem 1.4rem;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: all 0.35s ease;
    box-shadow: 0 4px 15px rgba(20,83,45,0.25);
    min-height: 130px;
}

.stat-bg-icon {
    position: absolute;
    bottom: 10px;
    right: 12px;
    font-size: 3rem;
    color: rgba(255,255,255,0.12);
    line-height: 1;
    pointer-events: none;
    transition: transform 0.35s ease, color 0.35s ease;
    opacity: 0.9;
}

.stat-number {
    font-size: 2.8rem;
    margin-bottom: 0.3rem;
    color: #ffffff;
    font-family: var(--font-heading);
    font-weight: 900;
    line-height: 1;
    position: relative;
    z-index: 2;
    transition: transform 0.3s ease;
}

.stat-card p {
    text-transform: uppercase;
    font-size: 0.7rem;
    letter-spacing: 1.5px;
    color: rgba(255,255,255,0.75);
    font-weight: 700;
    margin: 0;
    position: relative;
    z-index: 2;
    transition: color 0.3s ease;
}

/* Stat Card Hover Effects */
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(20,83,45,0.35);
    background: linear-gradient(135deg, #166534 0%, #15803d 50%, #16a34a 100%);
}
.stat-card:hover .stat-bg-icon {
    color: rgba(255,255,255,0.18);
    transform: scale(1.1);
}
.stat-card:hover .stat-number {
    transform: scale(1.05);
}
.stat-card:hover p {
    color: rgba(255,255,255,0.9);
}

/* Event Item Last */
.event-item:last-of-type {
    border-bottom: none !important;
    margin-bottom: 1rem !important;
    padding-bottom: 0 !important;
}

/* Staff Home Cards */
.staff-home-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    border-color: #cbd5e1;
}
.staff-home-card:hover img {
    transform: scale(1.08);
}

/* Gallery Home Items */
.gallery-home-item {
    transition: box-shadow 0.3s ease;
}
.gallery-home-item:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    z-index: 10;
}
.gallery-home-item:hover img {
    transform: scale(1.05) !important;
    filter: brightness(1) !important;
}
.gallery-home-item:hover .gallery-overlay {
    opacity: 1 !important;
}
.gallery-home-item:hover .gallery-caption {
    transform: translateY(0) !important;
}
.gallery-home-item:hover .gallery-line {
    transform: scaleX(1) !important;
}
@media (max-width: 991px) {
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        grid-auto-rows: 200px !important;
    }
    .gallery-home-item {
        grid-column: span 1 !important;
        grid-row: span 1 !important;
    }
}
@media (max-width: 575px) {
    .gallery-grid {
        grid-template-columns: 1fr !important;
        grid-auto-rows: 250px !important;
    }
}

/* System Cards */
.system-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    border-color: #cbd5e1;
}
.system-card:hover .sys-bar {
    transform: scaleX(1) !important;
}
.system-card:hover div[style*="border-radius: 14px"] {
    background: var(--color-primary) !important;
    color: white !important;
}

/* Quick Link Cards */
.quick-link-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    border-color: #cbd5e1;
}
.quick-link-card:hover div:first-child {
    transform: scale(1.1);
}

/* Announcement scroll */
@keyframes scrollAnnouncements {
    0% { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}

/* ═══════════════════════════════════════
   RESPONSIVE BREAKPOINTS
   ═══════════════════════════════════════ */

/* ── Tablet ≤ 991px ── */
@media (max-width: 991px) {
    /* Hero */
    .hero-carousel { height: 520px !important; }
    .hero-carousel h1 { font-size: 2.6rem !important; }
    .hero-carousel p { font-size: 1.05rem !important; }
    .carousel-arrow { width: 44px !important; height: 44px !important; font-size: 1.1rem !important; }

    /* Section headings */
    section h2[style*="font-size: 2.8rem"] { font-size: 2.2rem !important; }
    section h2[style*="font-size: 2.4rem"] { font-size: 2rem !important; }

    /* Section padding */
    section[style*="padding: 6rem"] { padding-top: 4rem !important; padding-bottom: 4rem !important; }
    section[style*="padding: 5rem"] { padding-top: 3.5rem !important; }

    /* HoD: tighten gap, shrink photo */
    .hod-grid { gap: 3rem !important; }
    .hod-photo { flex: 0 0 260px !important; }

    /* Stats: 5 → 3 */
    .stats-grid {
        grid-template-columns: repeat(3, 1fr) !important;
    }

    /* News/Events: narrow sidebar */
    .news-events-split {
        grid-template-columns: 1fr 320px !important;
        gap: 2.5rem !important;
    }

    /* Gallery: 4 → 3 */
    .gallery-grid {
        grid-template-columns: repeat(3, 1fr) !important;
    }
}

/* ── Small Tablet ≤ 768px ── */
@media (max-width: 768px) {
    /* Hero */
    .hero-carousel { height: 450px !important; }
    .hero-carousel h1 { font-size: 2rem !important; line-height: 1.2 !important; }
    .hero-carousel p { font-size: 0.95rem !important; margin-bottom: 1.5rem !important; }
    .hero-carousel .btn { padding: 0.7rem 1.5rem !important; font-size: 0.95rem !important; }
    .carousel-arrow { width: 40px !important; height: 40px !important; font-size: 1rem !important; }

    /* Section headings */
    section h2[style*="font-size: 2.8rem"] { font-size: 1.9rem !important; }
    section h2[style*="font-size: 2.4rem"] { font-size: 1.7rem !important; }
    section p[style*="font-size: 1.1rem"] { font-size: 0.95rem !important; }
    section div[style*="margin-bottom: 4rem"] { margin-bottom: 2.5rem !important; }

    /* Section padding */
    section[style*="padding: 6rem"] { padding-top: 3rem !important; padding-bottom: 3rem !important; }
    section[style*="padding: 5rem"] { padding-top: 2.5rem !important; }

    /* HoD: stack vertically */
    /* HOD Section: Stack text before photo and force text-align to justify */
    .hod-grid {
        display: flex !important;
        flex-direction: column-reverse !important;
        gap: 2rem !important;
        align-items: center !important;
    }
    .hod-photo { flex: none !important; width: 250px !important; }
    .hod-photo div[style*="right: -20px"] { display: none !important; }
    .hod-text { min-width: 0 !important; width: 100% !important; text-align: justify !important; }
    .hod-text h2, .hod-text > span { text-align: left !important; display: block; }
    .hod-text blockquote { text-align: justify !important; }
    .hod-text div[style*="display: inline-flex"] { display: flex !important; justify-content: flex-start !important; }
    .hod-grid { margin-top: 2.5rem !important; padding-bottom: 2.5rem !important; }

    /* Stats: 5 → 2 */
    .stats-grid {
        grid-template-columns: repeat(2, 1fr) !important;
    }

    /* Programmes: single column */
    .hover-card-grid { grid-template-columns: 1fr; }

    /* News/Events: stack */
    .news-events-split {
        grid-template-columns: 1fr !important;
        gap: 2rem !important;
    }

    /* News card images */
    .news-card div[style*="width: 140px"] { width: 110px !important; height: 95px !important; }

    /* Gallery: 4 → 2 */
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr) !important;
    }

    /* Staff: adjust photo height */
    .staff-card-img { height: 320px !important; }
}

/* ── Large Phone ≤ 575px ── */
@media (max-width: 575px) {
    /* Hero */
    .hero-carousel { height: 400px !important; }
    .hero-carousel h1 { font-size: 1.6rem !important; }
    .hero-carousel p { font-size: 0.88rem !important; max-width: 100% !important; }
    .hero-carousel .btn { padding: 0.6rem 1.3rem !important; font-size: 0.88rem !important; gap: 0.4rem !important; }
    .carousel-arrow { width: 36px !important; height: 36px !important; font-size: 0.9rem !important; }
    .carousel-arrow[style*="left:"] { left: 10px !important; }
    .carousel-arrow[style*="right:"] { right: 10px !important; }
    .carousel-dot { width: 10px !important; height: 10px !important; }

    /* Section headings */
    section h2[style*="font-size: 2.8rem"] { font-size: 1.6rem !important; }
    section h2[style*="font-size: 2.4rem"] { font-size: 1.4rem !important; }
    section h2[style*="font-size: 1.8rem"] { font-size: 1.4rem !important; }
    section p[style*="font-size: 1.1rem"] { font-size: 0.9rem !important; }

    /* Section padding */
    section[style*="padding: 6rem"] { padding-top: 2.5rem !important; padding-bottom: 2.5rem !important; }
    section[style*="padding: 5rem"] { padding-top: 2rem !important; }
    section div[style*="margin-bottom: 4rem"] { margin-bottom: 1.8rem !important; }

    /* HoD */
    .hod-photo { width: 200px !important; }
    .hod-text h2 { font-size: 1.6rem !important; }
    .hod-text blockquote { font-size: 1rem !important; padding-left: 1rem !important; }

    /* Stats */
    .stat-number { font-size: 2rem !important; }
    .stat-card { padding: 1.2rem 0.8rem 1rem !important; min-height: 100px !important; }

    /* Gallery: 2 → 1 */
    .gallery-grid {
        grid-template-columns: 1fr !important;
    }
    .gallery-home-item[style*="grid-row: span 2"] { grid-row: span 1 !important; }
    .gallery-home-item { aspect-ratio: 16/9 !important; }

    /* News cards: stack image + text vertically */
    .news-card { flex-direction: column !important; gap: 0.8rem !important; }
    .news-card div[style*="width: 140px"] { width: 100% !important; height: 160px !important; }

    /* Staff grid: 2 cols, smaller gap */
    .staff-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 1rem !important;
    }
    .staff-card-img { height: 260px !important; }
    .staff-home-card div[style*="padding: 1.2rem 1.5rem"] { padding: 0.8rem 1rem !important; }

    /* Systems grid: 2 cols */
    .systems-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 1rem !important;
    }
    .system-card { padding: 1.2rem 1rem !important; }

    /* Partners */
    .partners-grid {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 1rem !important;
    }
    .partner-card {
        min-width: unset !important;
        width: 100% !important;
        height: 80px !important;
        padding: 0.5rem !important;
        margin: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .partner-logo { max-width: 100% !important; max-height: 60px !important; object-fit: contain !important; }

    /* CTA: center & stack */
    .cta-flex {
        flex-direction: column !important;
        text-align: center !important;
    }

    /* Programmes gap */
    .hover-card-grid { gap: 1.2rem !important; }
}

/* ── Small Phone ≤ 480px ── */
@media (max-width: 480px) {
    /* Hero */
    .hero-carousel { height: 360px !important; }
    .hero-carousel h1 { font-size: 1.35rem !important; }
    .hero-carousel p { font-size: 0.82rem !important; }
    .hero-carousel .btn { padding: 0.55rem 1rem !important; font-size: 0.82rem !important; }
    .hero-carousel .container > span[style*="letter-spacing"] { font-size: 0.65rem !important; padding: 0.25rem 0.7rem !important; }
    .carousel-dot { width: 8px !important; height: 8px !important; }

    /* Section headings */
    section h2[style*="font-size: 2.8rem"] { font-size: 1.4rem !important; }
    section h2[style*="font-size: 2.4rem"] { font-size: 1.25rem !important; }

    /* Section padding + spacing */
    section[style*="padding: 6rem"] { padding-top: 2rem !important; padding-bottom: 2rem !important; }
    section[style*="padding: 5rem"] { padding-top: 1.5rem !important; }
    section div[style*="margin-bottom: 4rem"] { margin-bottom: 1.5rem !important; }
    section div[style*="margin-bottom: 2.5rem"] { margin-bottom: 1.2rem !important; }

    /* HoD */
    .hod-photo { width: 180px !important; }
    .hod-section .container[style*="margin-top"] { margin-top: 1.5rem !important; padding-bottom: 1.5rem !important; }

    /* Stats */
    .stat-number { font-size: 1.6rem !important; }
    .stat-card { padding: 1rem 0.5rem 0.8rem !important; min-height: 85px !important; }
    .stat-bg-icon { font-size: 2rem !important; }
    .stat-card p { font-size: 0.6rem !important; letter-spacing: 0.5px !important; }

    /* Staff: single column */
    .staff-grid {
        grid-template-columns: 1fr !important;
    }

    /* Systems: single column */
    .systems-grid {
        grid-template-columns: 1fr !important;
    }

    /* Programme cards: compact padding */
    .hover-card div[style*="padding: 2rem"] { padding: 1.2rem !important; }
    .hover-card div[style*="padding: 1rem 2rem"] { padding: 0.75rem 1rem !important; }

    /* CTA buttons: full width */
    .cta-flex div[style*="gap: 0.7rem"] {
        flex-direction: column !important;
        width: 100% !important;
    }
    .cta-flex div[style*="gap: 0.7rem"] a {
        width: 100% !important;
        justify-content: center !important;
        text-align: center !important;
    }

    /* News card images */
    .news-card div[style*="width: 140px"] { height: 140px !important; }
}
</style>

<script>
(function() {
    let currentSlide = 0;
    const track = document.getElementById('carouselTrack');
    const dots = document.querySelectorAll('.carousel-dot');
    const totalSlides = {{ $carouselSlides->count() ?: 1 }};
    let autoplayTimer;

    function updateCarousel() {
        track.style.transform = `translateX(-${currentSlide * 100}%)`;
        dots.forEach((dot, i) => {
            dot.style.background = i === currentSlide ? 'white' : 'transparent';
        });
    }

    window.moveCarousel = function(dir) {
        currentSlide = (currentSlide + dir + totalSlides) % totalSlides;
        updateCarousel();
        resetAutoplay();
    };

    window.goToSlide = function(index) {
        currentSlide = index;
        updateCarousel();
        resetAutoplay();
    };

    function resetAutoplay() {
        clearInterval(autoplayTimer);
        if (totalSlides > 1) {
            autoplayTimer = setInterval(() => {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateCarousel();
            }, 5000);
        }
    }

    // Start autoplay
    resetAutoplay();
})();
</script>
