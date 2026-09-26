// ─────────────────────────────────────────────────────────────
//  Aakar Dermatology – Main JS
//  Premium animation layer: scroll-reveal, stagger, tilt,
//  counter, scroll-progress, sparkles, WhatsApp pulse.
//  Zero external dependencies — pure browser APIs only.
// ─────────────────────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', () => {

  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // ── 1. SCROLL-PROGRESS BAR ──────────────────────────────────
  const progressBar = document.createElement('div');
  progressBar.id = 'scroll-progress';
  document.body.prepend(progressBar);

  window.addEventListener('scroll', () => {
    const scrolled  = window.scrollY;
    const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
    progressBar.style.width = maxScroll > 0 ? (scrolled / maxScroll * 100) + '%' : '0%';
  }, { passive: true });


  // ── 2. STICKY NAVBAR SHADOW ─────────────────────────────────
  const navbar = document.getElementById('navbar');
  if (navbar) {
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 20);
    }, { passive: true });
  }


  // ── 3. MOBILE MENU TOGGLE ───────────────────────────────────
  const menuBtn    = document.getElementById('menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const iconOpen   = document.getElementById('menu-icon-open');
  const iconClose  = document.getElementById('menu-icon-close');

  if (menuBtn && mobileMenu) {
    menuBtn.addEventListener('click', () => {
      const isOpen = mobileMenu.classList.toggle('open');
      menuBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      if (iconOpen)  iconOpen.classList.toggle('hidden',  isOpen);
      if (iconClose) iconClose.classList.toggle('hidden', !isOpen);
    });

    mobileMenu.querySelectorAll('a.mobile-nav-link, li:last-child a').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.remove('open');
        menuBtn.setAttribute('aria-expanded', 'false');
        if (iconOpen)  iconOpen.classList.remove('hidden');
        if (iconClose) iconClose.classList.add('hidden');
      });
    });

    document.addEventListener('click', (e) => {
      if (!menuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
        mobileMenu.classList.remove('open');
        menuBtn.setAttribute('aria-expanded', 'false');
        if (iconOpen)  iconOpen.classList.remove('hidden');
        if (iconClose) iconClose.classList.add('hidden');
      }
    });

    window.addEventListener('resize', () => {
      if (window.innerWidth >= 1024) {
        mobileMenu.classList.remove('open');
        menuBtn.setAttribute('aria-expanded', 'false');
        if (iconOpen)  iconOpen.classList.remove('hidden');
        if (iconClose) iconClose.classList.add('hidden');
      }
    });
  }


  // ── 4. PREMIUM SCROLL-REVEAL ENGINE ─────────────────────────
  // Handles: .sr, .sr-left, .sr-right, .sr-pop, .sr-stagger,
  //          .reveal (legacy), .section-divider.pre-animate,
  //          .section-label (label line), .stat-number
  const srOptions = { threshold: 0.12, rootMargin: '0px 0px -40px 0px' };

  const srObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el = entry.target;

      el.classList.add('is-visible', 'visible'); // both new + legacy

      // Stagger children if sr-stagger parent
      if (el.classList.contains('sr-stagger')) {
        Array.from(el.children).forEach((child, i) => {
          child.style.setProperty('--sr-delay', `${i * 90}ms`);
        });
      }

      // Animate section-label line
      const label = el.querySelector?.('.section-label');
      if (label) label.classList.add('animate-label');

      // Animate section-divider inside
      el.querySelectorAll?.('.section-divider.pre-animate').forEach(div => {
        div.classList.add('is-visible');
      });

      srObserver.unobserve(el);
    });
  }, srOptions);

  // Observe all reveal targets (new + legacy)
  document.querySelectorAll(
    '.sr, .sr-left, .sr-right, .sr-pop, .sr-stagger, .reveal'
  ).forEach(el => srObserver.observe(el));

  // Standalone dividers
  document.querySelectorAll('.section-divider').forEach(el => {
    el.classList.add('pre-animate');
    srObserver.observe(el);
  });

  // Standalone stat-numbers
  document.querySelectorAll('.stat-number').forEach(el => {
    const statObs = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (!e.isIntersecting) return;
        e.target.classList.add('is-visible');
        statObs.unobserve(e.target);
      });
    }, { threshold: 0.5 });
    statObs.observe(el);
  });


  // ── 5. ANIMATED COUNTER ─────────────────────────────────────
  // Handles [data-count] elements — smooth easing, suffix preserved
  const easeOut = (t) => 1 - Math.pow(1 - t, 3);   // cubic ease-out

  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el     = entry.target;
      const raw    = el.dataset.count;                // e.g. "86+"
      const target = parseInt(raw, 10);
      const suffix = raw.replace(/[0-9]/g, '');
      const duration = prefersReduced ? 0 : 1400;    // ms

      if (prefersReduced) {
        el.textContent = raw;
        counterObserver.unobserve(el);
        return;
      }

      let start = null;
      const step = (timestamp) => {
        if (!start) start = timestamp;
        const elapsed  = timestamp - start;
        const progress = Math.min(elapsed / duration, 1);
        const value    = Math.round(easeOut(progress) * target);
        el.textContent = value + suffix;
        if (progress < 1) requestAnimationFrame(step);
      };
      requestAnimationFrame(step);
      counterObserver.unobserve(el);
    });
  }, { threshold: 0.5 });

  document.querySelectorAll('[data-count]').forEach(el => counterObserver.observe(el));


  // ── 6. CARD 3-D TILT ────────────────────────────────────────
  if (!prefersReduced) {
    document.querySelectorAll('.tilt-card').forEach(card => {
      const MAX = 6; // max degrees

      card.addEventListener('mousemove', (e) => {
        const rect   = card.getBoundingClientRect();
        const cx     = rect.left + rect.width  / 2;
        const cy     = rect.top  + rect.height / 2;
        const dx     = (e.clientX - cx) / (rect.width  / 2);
        const dy     = (e.clientY - cy) / (rect.height / 2);
        const rotX   = (-dy * MAX).toFixed(2);
        const rotY   = ( dx * MAX).toFixed(2);
        card.style.transform = `perspective(800px) rotateX(${rotX}deg) rotateY(${rotY}deg) scale(1.02)`;
      });

      card.addEventListener('mouseleave', () => {
        card.style.transform = '';
      });
    });
  }


  // ── 7. HERO SPARKLES ────────────────────────────────────────
  if (!prefersReduced) {
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
      const sparkleData = [
        { size:10, top:'12%', left:'8%',  bg:'var(--primary)',       opacity:.25 },
        { size: 7, top:'72%', left:'5%',  bg:'var(--accent)',        opacity:.20 },
        { size:14, top:'25%', left:'90%', bg:'var(--primary-mid)',   opacity:.18 },
        { size: 6, top:'80%', left:'85%', bg:'var(--accent-mid)',    opacity:.22 },
        { size: 9, top:'50%', left:'50%', bg:'var(--primary)',       opacity:.12 },
      ];
      sparkleData.forEach((s) => {
        const dot = document.createElement('div');
        dot.className = 'hero-sparkle';
        Object.assign(dot.style, {
          width:   s.size + 'px',
          height:  s.size + 'px',
          top:     s.top,
          left:    s.left,
          background: s.bg,
          opacity: s.opacity,
        });
        heroSection.appendChild(dot);
      });
    }
  }


  // ── 8. WHATSAPP FAB PULSE RING ──────────────────────────────
  if (!prefersReduced) {
    const fab = document.querySelector('a[aria-label="WhatsApp Chat"]');
    if (fab) {
      [0, 800].forEach((delay) => {
        const ring = document.createElement('span');
        ring.className = 'wa-pulse-ring';
        ring.style.animationDelay = delay + 'ms';
        fab.prepend(ring);
      });
    }
  }


  // ── 9. TESTIMONIAL MARQUEE (CSS-driven — no JS needed) ─────


  // ── 10. FLASH MESSAGE AUTO-DISMISS ──────────────────────────
  const flash = document.getElementById('flash-message');
  if (flash) {
    setTimeout(() => {
      flash.style.transition = 'opacity .5s, transform .5s';
      flash.style.opacity    = '0';
      flash.style.transform  = 'translateY(-8px)';
      setTimeout(() => flash.remove(), 520);
    }, 5000);
  }


  // ── 11. ACTIVE NAV LINK ──────────────────────────────────────
  const currentPath = window.location.pathname;
  document.querySelectorAll('.nav-link').forEach(link => {
    const href = link.getAttribute('href');
    if (href && (href === currentPath || (href !== '/' && currentPath.startsWith(href)))) {
      link.classList.add('active');
    }
  });


  // ── 12. SERVICE CATEGORY FILTER ─────────────────────────────
  const filterBtns  = document.querySelectorAll('[data-filter]');
  const serviceCards = document.querySelectorAll('[data-category]');
  if (filterBtns.length && serviceCards.length) {
    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('active-filter'));
        btn.classList.add('active-filter');
        const filter = btn.dataset.filter;
        serviceCards.forEach(card => {
          const show = filter === 'all' || card.dataset.category === filter;
          card.style.transition = 'opacity .3s, transform .3s';
          card.style.opacity   = show ? '1' : '0';
          card.style.transform = show ? 'scale(1)' : 'scale(.95)';
          card.style.pointerEvents = show ? '' : 'none';
          setTimeout(() => { card.style.display = show ? '' : 'none'; }, show ? 0 : 300);
        });
      });
    });
  }


  // ── 13. SMOOTH ANCHOR SCROLL ────────────────────────────────
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', (e) => {
      const target = document.querySelector(anchor.getAttribute('href'));
      if (target) {
        e.preventDefault();
        const offset = navbar ? navbar.offsetHeight + 16 : 80;
        const top    = target.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });


  // ── 14. IMAGE HOVER SWEEP (non-touch only) ──────────────────
  // img-sweep is CSS-driven via :hover, nothing to do in JS.
  // But we disable it on touch devices to avoid stuck states.
  if ('ontouchstart' in window) {
    document.querySelectorAll('.img-sweep').forEach(el => {
      el.classList.remove('img-sweep');
    });
  }

});
