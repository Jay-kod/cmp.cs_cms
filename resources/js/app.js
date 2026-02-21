import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
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
