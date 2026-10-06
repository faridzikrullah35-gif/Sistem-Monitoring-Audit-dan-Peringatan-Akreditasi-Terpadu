{{-- resources/views/pages/landing/landingpage-simantap.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>SIMANTAP - Sistem Monitoring Audit & Peringatan Akreditasi Terpadu</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    {{-- Global Styles (Centralized biar gampang diubah) --}}
    <style>
        /* ============================================================
           RESET & BASE (Sama seperti sebelumnya, tapi dirapikan)
           ============================================================ */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #0F4C81;
            --secondary: #2563EB;
            --accent: #38BDF8;
            --bg: #F8FAFC;
            --text: #1E293B;
            --text-light: #64748B;
            --white: #ffffff;
            --shadow: 0 10px 40px rgba(15, 76, 129, 0.08);
            --radius: 16px;
            --transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            line-height: 1.7;
            overflow-x: hidden;
        }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        img { max-width: 100%; display: block; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
        .section-padding { padding: 80px 0; }
        .section-label {
            display: inline-block;
            font-size: 13px;
            font-weight: 600;
            color: var(--secondary);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }
        .section-title {
            font-family: 'Poppins', sans-serif;
            font-size: 38px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 12px;
        }
        .section-title span { color: var(--primary); }
        .section-desc {
            color: var(--text-light);
            font-size: 18px;
            max-width: 600px;
        }
        .text-center { text-align: center; }
        .mx-auto { margin-left: auto; margin-right: auto; }

        /* ============================================================
           BUTTONS
           ============================================================ */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 15px;
            padding: 14px 32px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        .btn-primary { background: var(--primary); color: var(--white); box-shadow: 0 4px 20px rgba(15, 76, 129, 0.35); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 35px rgba(15, 76, 129, 0.45); }
        .btn-secondary { background: var(--secondary); color: var(--white); box-shadow: 0 4px 20px rgba(37, 99, 235, 0.35); }
        .btn-secondary:hover { transform: translateY(-2px); box-shadow: 0 8px 35px rgba(37, 99, 235, 0.45); }
        .btn-outline { background: transparent; color: var(--primary); border: 2px solid var(--primary); }
        .btn-outline:hover { background: var(--primary); color: var(--white); transform: translateY(-2px); }
        .btn-white { background: var(--white); color: var(--primary); }
        .btn-white:hover { background: var(--bg); transform: translateY(-2px); }
        .btn-danger { background: #dc2626; color: #fff; box-shadow: 0 4px 20px rgba(220, 38, 38, 0.4); }
        .btn-danger:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(220, 38, 38, 0.5); }
        .btn::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at var(--mx, 50%) var(--my, 50%), rgba(255,255,255,0.25) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.4s;
            pointer-events: none;
        }
        .btn:hover::after { opacity: 1; }

        /* ============================================================
           REVEAL ON SCROLL
           ============================================================ */
        .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-40px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .reveal-left.visible { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(40px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }

        /* ============================================================
           RESPONSIVE GLOBAL TWEAKS
           ============================================================ */
        @media (max-width: 768px) {
            .section-title { font-size: 28px; }
            .section-padding { padding: 50px 0; }
        }
        @media (max-width: 480px) {
            .section-title { font-size: 24px; }
        }
    </style>

    {{-- Component-specific styles (optional, bisa taruh di masing-masing komponen juga) --}}
    @stack('styles')
</head>
<body>

    {{-- ============================================================
        KOMPONEN LANDING PAGE
        ============================================================ --}}
    @include('components.landing.navbar')
    @include('components.landing.hero')
    @include('components.landing.stats')
    @include('components.landing.about')
    @include('components.landing.ews')
    @include('components.landing.structure')
    @include('components.landing.cta')
    @include('components.landing.footer')

    {{-- ============================================================
        SCRIPTS GLOBAL
        ============================================================ --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ---- NAVBAR SCROLL ----
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 30) navbar.classList.add('scrolled');
                else navbar.classList.remove('scrolled');
            });

            // ---- HAMBURGER ----
            const hamburger = document.getElementById('hamburger');
            const navLinks = document.getElementById('navLinks');
            if(hamburger) {
                hamburger.addEventListener('click', function() {
                    this.classList.toggle('active');
                    navLinks.classList.toggle('open');
                });
                document.querySelectorAll('.nav-links a').forEach(link => {
                    link.addEventListener('click', function() {
                        hamburger.classList.remove('active');
                        navLinks.classList.remove('open');
                    });
                });
            }

            // ---- SMOOTH SCROLL ----
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    const target = document.querySelector(targetId);
                    if (target) {
                        e.preventDefault();
                        const offsetTop = target.getBoundingClientRect().top + window.pageYOffset - 80;
                        window.scrollTo({ top: offsetTop, behavior: 'smooth' });
                    }
                });
            });

            // ---- REVEAL ON SCROLL ----
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
            }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
            document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => revealObserver.observe(el));

            // ---- COUNTUP ANIMATION (Supports multiple rows) ----
            const counters = document.querySelectorAll('.counter');
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        const target = parseInt(el.getAttribute('data-target'));
                        const duration = 2000;
                        const startTime = performance.now();
                        function updateCounter(currentTime) {
                            const elapsed = currentTime - startTime;
                            const progress = Math.min(elapsed / duration, 1);
                            const eased = 1 - Math.pow(1 - progress, 3);
                            el.textContent = Math.round(eased * target);
                            if (progress < 1) requestAnimationFrame(updateCounter);
                            else el.textContent = target;
                        }
                        requestAnimationFrame(updateCounter);
                        counterObserver.unobserve(el);
                    }
                });
            }, { threshold: 0.5 });
            counters.forEach(c => counterObserver.observe(c));

            // ---- BUTTON RIPPLE ----
            document.querySelectorAll('.btn').forEach(btn => {
                btn.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    this.style.setProperty('--mx', ((e.clientX - rect.left) / rect.width * 100) + '%');
                    this.style.setProperty('--my', ((e.clientY - rect.top) / rect.height * 100) + '%');
                });
            });

            // ---- ACTIVE NAV LINK ----
            const sections = document.querySelectorAll('section[id], .hero');
            const navAnchors = document.querySelectorAll('.nav-links a:not(.btn-login)');
            window.addEventListener('scroll', function() {
                let current = '';
                const scrollPos = window.pageYOffset + 120;
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                        current = section.getAttribute('id');
                    }
                });
                navAnchors.forEach(a => {
                    a.classList.remove('active');
                    if (a.getAttribute('href') === '#' + current) a.classList.add('active');
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>