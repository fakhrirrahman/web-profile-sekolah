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
                y: -6,
                scale: 1.01,
                boxShadow: '0 24px 60px rgba(7, 49, 92, 0.16)',
                duration: 0.28,
                overwrite: 'auto',
            });
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                y: 0,
                scale: 1,
                boxShadow: '0 1px 3px rgba(15, 23, 42, 0.10)',
                duration: 0.32,
                overwrite: 'auto',
            });
        });
    });

    gsap.utils.toArray('.motion-button').forEach((button) => {
        button.addEventListener('mouseenter', () => {
            gsap.to(button, {
                y: -2,
                scale: 1.03,
                duration: 0.22,
                overwrite: 'auto',
            });
        });

        button.addEventListener('mouseleave', () => {
            gsap.to(button, {
                y: 0,
                scale: 1,
                duration: 0.24,
                overwrite: 'auto',
            });
        });

        button.addEventListener('pointerdown', () => {
            gsap.to(button, {
                scale: 0.98,
                duration: 0.1,
                yoyo: true,
                repeat: 1,
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
