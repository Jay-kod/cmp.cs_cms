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

.hover-card:hover .card-arrow {
    transform: translateX(8px);
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
.gallery-home-item:hover img {
    transform: scale(1.1);
}
.gallery-home-item:hover .gallery-overlay {
    opacity: 1 !important;
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
    100% { transform: translateX(-50%); }
}

/* Responsive */
@media (max-width: 991px) {
    .hero-carousel { height: 480px !important; }
    .hero-carousel h1 { font-size: 2.6rem !important; }
    .hero-carousel p { font-size: 1.05rem !important; }
    .carousel-arrow { width: 44px !important; height: 44px !important; font-size: 1.1rem !important; }
}

@media (max-width: 768px) {
    .hero-carousel { height: 450px !important; }
    .hero-carousel h1 { font-size: 2rem !important; line-height: 1.2 !important;}
    .hero-carousel p { font-size: 0.95rem !important; margin-bottom: 1.5rem !important; }
    .hero-carousel .btn { padding: 0.7rem 1.5rem !important; font-size: 0.95rem !important; }
    .hover-card-grid { grid-template-columns: 1fr; }
    
    /* Stack news/events on mobile */
    section .container > div[style*="grid-template-columns: 1fr 380px"],
    section .container > div[style*="grid-template-columns: 1fr 400px"] {
        grid-template-columns: 1fr !important;
    }

    /* Gallery 2-col on mobile */
    section div[style*="grid-template-columns: repeat(4"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }

    /* Stats responsive */
    div[style*="grid-template-columns: repeat(5"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
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
@endsection
