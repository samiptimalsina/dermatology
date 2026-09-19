// ─────────────────────────────────────────
//  Aakar Dermatology – Main JS
// ─────────────────────────────────────────

document.addEventListener('DOMContentLoaded', () => {

    // ── Sticky navbar shadow ──────────────────
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 20);
        });
    }

    // ── Mobile menu toggle ────────────────────
    const menuBtn     = document.getElementById('menu-btn');
    const mobileMenu  = document.getElementById('mobile-menu');
    const iconOpen    = document.getElementById('menu-icon-open');
    const iconClose   = document.getElementById('menu-icon-close');
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.toggle('open');
            menuBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            // Swap hamburger ↔ X icon
            if (iconOpen)  iconOpen.classList.toggle('hidden', isOpen);
            if (iconClose) iconClose.classList.toggle('hidden', !isOpen);
        });

        // Close menu when any mobile nav link is clicked (excluding the More details toggle)
        mobileMenu.querySelectorAll('a.mobile-nav-link, li:last-child a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('open');
                menuBtn.setAttribute('aria-expanded', 'false');
                if (iconOpen)  iconOpen.classList.remove('hidden');
                if (iconClose) iconClose.classList.add('hidden');
            });
        });

        // Close menu on outside click
        document.addEventListener('click', (e) => {
            if (!menuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.remove('open');
                menuBtn.setAttribute('aria-expanded', 'false');
                if (iconOpen)  iconOpen.classList.remove('hidden');
                if (iconClose) iconClose.classList.add('hidden');
            }
        });

        // Close menu on resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                mobileMenu.classList.remove('open');
                menuBtn.setAttribute('aria-expanded', 'false');
                if (iconOpen)  iconOpen.classList.remove('hidden');
                if (iconClose) iconClose.classList.add('hidden');
            }
        });
    }

    // ── Scroll reveal ─────────────────────────
    const reveals = document.querySelectorAll('.reveal');
    if (reveals.length) {
        const observer = new IntersectionObserver(
            (entries) => entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            }),
            { threshold: 0.12 }
        );
        reveals.forEach(el => observer.observe(el));
    }

    // ── Testimonial slider (CSS-only fallback + JS auto-scroll) ──
    const track  = document.getElementById('testimonial-track');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    if (track) {
        let index = 0;
        const cards = track.querySelectorAll('.testimonial-card');
        const total = cards.length;
        const getVisible = () => window.innerWidth >= 1024 ? 3 : window.innerWidth >= 640 ? 2 : 1;

        const slideTo = (i) => {
            const visible = getVisible();
            const max = Math.max(0, total - visible);
            index = Math.min(Math.max(i, 0), max);
            const pct = (100 / visible) * index;
            track.style.transform = `translateX(-${pct}%)`;
        };

        prevBtn?.addEventListener('click', () => slideTo(index - 1));
        nextBtn?.addEventListener('click', () => slideTo(index + 1));

        // Auto-advance every 5s
        let auto = setInterval(() => {
            const visible = getVisible();
            index + 1 > total - visible ? slideTo(0) : slideTo(index + 1);
        }, 5000);

        // Pause on hover
        track.addEventListener('mouseenter', () => clearInterval(auto));
        track.addEventListener('mouseleave', () => {
            auto = setInterval(() => {
                const visible = getVisible();
                index + 1 > total - visible ? slideTo(0) : slideTo(index + 1);
            }, 5000);
        });
    }

    // ── Counter animation (stats section) ────
    const counters = document.querySelectorAll('[data-count]');
    if (counters.length) {
        const countObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                const el    = entry.target;
                const raw   = el.dataset.count;        // e.g. "86+"
                const num   = parseInt(raw);
                const suffix = raw.replace(/[0-9]/g, '');
                let current = 0;
                const step  = Math.ceil(num / 60);
                const timer = setInterval(() => {
                    current += step;
                    if (current >= num) { current = num; clearInterval(timer); }
                    el.textContent = current + suffix;
                }, 25);
                countObserver.unobserve(el);
            });
        }, { threshold: 0.5 });
        counters.forEach(el => countObserver.observe(el));
    }

    // ── Flash message auto-dismiss ────────────
    const flash = document.getElementById('flash-message');
    if (flash) {
        setTimeout(() => {
            flash.style.opacity = '0';
            flash.style.transition = 'opacity .5s';
            setTimeout(() => flash.remove(), 500);
        }, 5000);
    }

    // ── Before/After hover effect ─────────────
    document.querySelectorAll('.ba-card').forEach(card => {
        const after = card.querySelector('.ba-after');
        if (!after) return;
        card.addEventListener('mouseenter', () => after.style.opacity = '1');
        card.addEventListener('mouseleave', () => after.style.opacity = '0');
    });

    // ── Active nav link highlight ─────────────
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-link').forEach(link => {
        const href = link.getAttribute('href');
        if (href && (href === currentPath || (href !== '/' && currentPath.startsWith(href)))) {
            link.classList.add('active');
        }
    });

    // ── Service category filter (services page) ──
    const filterBtns = document.querySelectorAll('[data-filter]');
    const serviceCards = document.querySelectorAll('[data-category]');
    if (filterBtns.length && serviceCards.length) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active-filter'));
                btn.classList.add('active-filter');
                const filter = btn.dataset.filter;
                serviceCards.forEach(card => {
                    card.style.display =
                        filter === 'all' || card.dataset.category === filter
                            ? 'block' : 'none';
                });
            });
        });
    }

    // ── Smooth anchor scroll ──────────────────
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});
