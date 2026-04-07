import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';

document.addEventListener('DOMContentLoaded', () => {
    // Dynamically inject AOS into component elements and cards before init
    const animCards = document.querySelectorAll('.hover-card, .news-card, .staff-home-card, .staff-card, .gallery-item, .card, .stat-card, article, .info-box, [class*="-card"], [class*="-box"], [class*="-item"], [class*="-block"], [class$="-member"], .partner-logo, .system-card');
    
    animCards.forEach((el, idx) => {
        if (!el.hasAttribute('data-aos') && !el.closest('.nav-dropdown-menu') && el.tagName !== 'HEADER' && el.tagName !== 'NAV' && el.tagName !== 'FOOTER') {
            el.setAttribute('data-aos', 'fade-up');
            // Create a staggered delay effect grouping by row roughly
            const delay = (idx % 6) * 100;
            if (delay > 0) {
                el.setAttribute('data-aos-delay', delay.toString());
            }
        }
    });

    // Initialize AOS Animation Library
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 100
    });

    // TOC Intersection Observer
    const tocLinks = document.querySelectorAll('.toc-list a');
    const sections = Array.from(tocLinks).map(link => {
        const id = link.getAttribute('href').replace('#', '');
        return document.getElementById(id);
    }).filter(section => section !== null);

    if (sections.length > 0) {
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -60% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    tocLinks.forEach(link => link.classList.remove('active'));
                    const id = entry.target.getAttribute('id');
                    const activeLink = document.querySelector(`.toc-list a[href="#${id}"]`);
                    if (activeLink) activeLink.classList.add('active');
                }
            });
        }, observerOptions);

        sections.forEach(section => observer.observe(section));
    }

    // Scroll reveal animations
    const revealElements = document.querySelectorAll('.reveal');
    if (revealElements.length > 0) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    entry.target.classList.add('active');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        revealElements.forEach(el => revealObserver.observe(el));
    }

    // Mobile TOC Toggle
    const floatingTocBtn = document.getElementById('floating-toc-btn');
    const sidebarToc = document.getElementById('sidebar-toc');
    if (floatingTocBtn && sidebarToc) {
        floatingTocBtn.addEventListener('click', () => {
            sidebarToc.classList.toggle('mobile-active');
        });
    }
});

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
