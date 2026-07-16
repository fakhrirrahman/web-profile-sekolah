import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);
document.documentElement.classList.add('js');

const onReady = (callback) => {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback, { once: true });
        return;
    }

    callback();
};

const setupHeader = () => {
    const header = document.querySelector('[data-site-header]');

    if (!header) {
        return;
    }

    const updateHeader = () => {
        header.toggleAttribute('data-scrolled', window.scrollY > 12);
    };

    updateHeader();
    window.addEventListener('scroll', updateHeader, { passive: true });

    document.querySelectorAll('[data-mobile-menu] a[href^="#"]').forEach((link) => {
        link.addEventListener('click', () => {
            link.closest('details')?.removeAttribute('open');
        });
    });
};

const setupGsapMotion = () => {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        gsap.set('.js-hero-item, .js-hero-panel, .js-reveal, .js-card', {
            autoAlpha: 1,
            clearProps: 'all',
        });
        return;
    }

    gsap.defaults({
        duration: 0.85,
        ease: 'power3.out',
    });

    gsap.set('.js-hero-item, .js-hero-panel', {
        autoAlpha: 0,
        y: 26,
    });

    const heroTimeline = gsap.timeline({ delay: 0.12 });

    heroTimeline
        .fromTo('.js-hero-image', {
            scale: 1.08,
            filter: 'saturate(0.85) contrast(0.95)',
        }, {
            scale: 1,
            filter: 'saturate(1) contrast(1)',
            duration: 1.8,
            ease: 'power2.out',
        }, 0)
        .to('.js-hero-item', {
            autoAlpha: 1,
            y: 0,
            stagger: 0.11,
        }, 0.18)
        .to('.js-hero-panel', {
            autoAlpha: 1,
            y: 0,
            duration: 0.95,
            ease: 'back.out(1.2)',
        }, 0.62);

    gsap.to('.js-hero-image', {
        yPercent: 10,
        scale: 1.08,
        ease: 'none',
        scrollTrigger: {
            trigger: '#beranda',
            start: 'top top',
            end: 'bottom top',
            scrub: true,
        },
    });

    gsap.to('.js-hero-panel', {
        y: -12,
        duration: 2.4,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut',
    });

    const revealOnce = (element, animation) => {
        ScrollTrigger.create({
            trigger: element,
            start: 'top 88%',
            once: true,
            onEnter: () => animation(),
        });
    };

    gsap.utils.toArray('.js-reveal').forEach((section) => {
        revealOnce(section, () => {
            gsap.fromTo(section, {
                autoAlpha: 0,
                y: 36,
            }, {
                autoAlpha: 1,
                y: 0,
                duration: 0.9,
                clearProps: 'transform,opacity,visibility',
            });
        });
    });

    gsap.utils.toArray('.js-stagger').forEach((container) => {
        const cards = container.querySelectorAll('.js-card');

        if (!cards.length) {
            return;
        }

        revealOnce(container, () => {
            gsap.fromTo(cards, {
                autoAlpha: 0,
                y: 28,
                scale: 0.985,
            }, {
                autoAlpha: 1,
                y: 0,
                scale: 1,
                stagger: 0.08,
                duration: 0.72,
                clearProps: 'transform,opacity,visibility',
            });
        });
    });

    gsap.utils.toArray('.motion-card').forEach((card) => {
        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                x: -2,
                y: -6,
                scale: 1.01,
                boxShadow: '8px 8px 0 rgba(31, 92, 69, 0.14)',
                duration: 0.28,
                overwrite: 'auto',
            });
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                x: 0,
                y: 0,
                scale: 1,
                boxShadow: '5px 5px 0 rgba(31, 92, 69, 0.10)',
                duration: 0.32,
                overwrite: 'auto',
            });
        });
    });

    ScrollTrigger.refresh();
};

onReady(() => {
    setupHeader();
    setupGsapMotion();
});
