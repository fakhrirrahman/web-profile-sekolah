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

const setupProfileTabs = () => {
    const tabGroups = document.querySelectorAll('[data-profile-tabs]');

    if (!tabGroups.length) {
        return;
    }

    const activeClasses = ['border-primary', 'bg-primary', 'text-white', 'shadow-[5px_5px_0_rgba(217,180,92,.35)]'];
    const inactiveClasses = ['border-primary/15', 'bg-surface', 'text-primary', 'shadow-[4px_4px_0_rgba(31,92,69,.08)]', 'hover:border-primary/30', 'hover:bg-secondary-muted'];

    tabGroups.forEach((group) => {
        const tabs = Array.from(group.querySelectorAll('[data-profile-tab]'));
        const panels = Array.from(group.querySelectorAll('[data-profile-panel]'));
        const allowedTargets = tabs.map((tab) => tab.dataset.profileTab);

        const setActiveTab = (target, shouldUpdateHash = true) => {
            if (!allowedTargets.includes(target)) {
                return;
            }

            tabs.forEach((tab) => {
                const isActive = tab.dataset.profileTab === target;

                tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                tab.classList.remove(...activeClasses, ...inactiveClasses);
                tab.classList.add(...(isActive ? activeClasses : inactiveClasses));
            });

            panels.forEach((panel) => {
                const isActive = panel.dataset.profilePanel === target;

                panel.classList.toggle('hidden', !isActive);

                if (isActive && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    gsap.fromTo(panel, {
                        autoAlpha: 0,
                        y: 14,
                    }, {
                        autoAlpha: 1,
                        y: 0,
                        duration: 0.45,
                        ease: 'power2.out',
                        clearProps: 'transform,opacity,visibility',
                    });
                }
            });

            if (shouldUpdateHash) {
                history.replaceState(null, '', `${window.location.pathname}#${target}`);
            }
        };

        tabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                setActiveTab(tab.dataset.profileTab);
            });
        });

        const hashTarget = window.location.hash.replace('#', '');
        setActiveTab(allowedTargets.includes(hashTarget) ? hashTarget : allowedTargets[0], false);

        window.addEventListener('hashchange', () => {
            const nextTarget = window.location.hash.replace('#', '');

            if (allowedTargets.includes(nextTarget)) {
                setActiveTab(nextTarget, false);
            }
        });
    });
};

const setupGsapMotion = () => {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const heroItems = gsap.utils.toArray('.js-hero-item');
    const heroPanel = document.querySelector('.js-hero-panel');
    const heroImage = document.querySelector('.js-hero-image');
    const heroSection = document.querySelector('#beranda');

    if (prefersReducedMotion) {
        const reducedTargets = [
            ...heroItems,
            ...gsap.utils.toArray('.js-reveal'),
            ...gsap.utils.toArray('.js-card'),
        ];

        if (heroPanel) {
            reducedTargets.push(heroPanel);
        }

        if (reducedTargets.length) {
            gsap.set(reducedTargets, {
                autoAlpha: 1,
                clearProps: 'all',
            });
        }

        return;
    }

    gsap.defaults({
        duration: 0.85,
        ease: 'power3.out',
    });

    const heroIntroTargets = [...heroItems];

    if (heroPanel) {
        heroIntroTargets.push(heroPanel);
    }

    if (heroIntroTargets.length) {
        gsap.set(heroIntroTargets, {
            autoAlpha: 0,
            y: 26,
        });
    }

    if (heroImage || heroItems.length || heroPanel) {
        const heroTimeline = gsap.timeline({ delay: 0.12 });

        if (heroImage) {
            heroTimeline.fromTo(heroImage, {
                scale: 1.08,
                filter: 'saturate(0.85) contrast(0.95)',
            }, {
                scale: 1,
                filter: 'saturate(1) contrast(1)',
                duration: 1.8,
                ease: 'power2.out',
            }, 0);
        }

        if (heroItems.length) {
            heroTimeline.to(heroItems, {
                autoAlpha: 1,
                y: 0,
                stagger: 0.11,
            }, 0.18);
        }

        if (heroPanel) {
            heroTimeline.to(heroPanel, {
                autoAlpha: 1,
                y: 0,
                duration: 0.95,
                ease: 'back.out(1.2)',
            }, 0.62);
        }
    }

    if (heroImage && heroSection) {
        gsap.to(heroImage, {
            yPercent: 10,
            scale: 1.08,
            ease: 'none',
            scrollTrigger: {
                trigger: heroSection,
                start: 'top top',
                end: 'bottom top',
                scrub: true,
            },
        });
    }

    if (heroPanel) {
        gsap.to(heroPanel, {
            y: -12,
            duration: 2.4,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut',
        });
    }

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
    setupProfileTabs();
    setupGsapMotion();
});
