
document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar');
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    // Menu navigasi untuk HP
    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => {
            const isOpen = navLinks.classList.toggle('open');

            menuToggle.setAttribute('aria-expanded', String(isOpen));
            menuToggle.innerHTML = isOpen
                ? '<i class="ti ti-x"></i>'
                : '<i class="ti ti-menu-2"></i>';
        });

        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('open');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.innerHTML = '<i class="ti ti-menu-2"></i>';
            });
        });

        document.addEventListener('click', event => {
            if (
                !navLinks.contains(event.target) &&
                !menuToggle.contains(event.target)
            ) {
                navLinks.classList.remove('open');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.innerHTML = '<i class="ti ti-menu-2"></i>';
            }
        });
    }

    // Efek navbar ketika halaman di-scroll
    function updateNavbar() {
        if (navbar) {
            navbar.classList.toggle('scrolled', window.scrollY > 20);
        }
    }

    updateNavbar();
    window.addEventListener('scroll', updateNavbar, { passive: true });

    // Animasi muncul ketika elemen memasuki layar
    const revealElements = document.querySelectorAll(
        '.reveal, .reveal-left, .reveal-right'
    );

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12
        });

        revealElements.forEach(element => observer.observe(element));
    } else {
        revealElements.forEach(element => {
            element.classList.add('visible');
        });
    }

    // Efek cahaya dan jejak partikel biru pada kursor laptop
    const canUsePointer = window.matchMedia(
        '(hover: hover) and (pointer: fine)'
    ).matches;

    const reduceMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    let lastParticleTime = 0;
    let particleCount = 0;

    if (canUsePointer && !reduceMotion) {
        let glow = document.querySelector('.cursor-glow');

        if (!glow) {
            glow = document.createElement('div');
            glow.className = 'cursor-glow';
            document.body.prepend(glow);
        }

        document.addEventListener('pointermove', event => {
            glow.style.setProperty('--mouse-x', `${event.clientX}px`);
            glow.style.setProperty('--mouse-y', `${event.clientY}px`);

            const now = performance.now();

            // Batasi jumlah partikel agar laptop tetap ringan
            if (
                now - lastParticleTime < 45 ||
                particleCount >= 22
            ) {
                return;
            }

            lastParticleTime = now;

            const particle = document.createElement('span');
            particle.className = 'cursor-particle';

            const size = Math.random() * 5 + 3;

            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${event.clientX}px`;
            particle.style.top = `${event.clientY}px`;

            document.body.appendChild(particle);
            particleCount++;

            particle.addEventListener('animationend', () => {
                particle.remove();
                particleCount--;
            }, { once: true });
        }, { passive: true });
    }

    // Efek tilt 3D pada kartu ketika kursor bergerak
    if (canUsePointer && !reduceMotion) {
        const cards = document.querySelectorAll(
            '.feature-card, .dashboard-preview'
        );

        cards.forEach(card => {
            card.addEventListener('pointermove', event => {
                const rect = card.getBoundingClientRect();

                const x = (event.clientX - rect.left) / rect.width;
                const y = (event.clientY - rect.top) / rect.height;

                const rotateY = (x - 0.5) * 7;
                const rotateX = (0.5 - y) * 7;

                card.style.transform =
                    `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-4px)`;
            });

            card.addEventListener('pointerleave', () => {
                card.style.transform = '';
            });
        });
    }

    // FAQ: hanya satu pertanyaan terbuka dalam satu waktu
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        item.addEventListener('toggle', () => {
            if (!item.open) return;

            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.open = false;
                }
            });
        });
    });

    // Penanda menu berdasarkan bagian halaman yang terlihat
    const sections = document.querySelectorAll(
        'main section[id]'
    );

    if ('IntersectionObserver' in window && sections.length) {
        const sectionObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;

                const sectionId = entry.target.id;

                document.querySelectorAll('.nav-links a[href^="#"]')
                    .forEach(link => {
                        const active = link.getAttribute('href') === `#${sectionId}`;

                        link.classList.toggle('active', active);

                        if (active) {
                            link.setAttribute('aria-current', 'location');
                        } else {
                            link.removeAttribute('aria-current');
                        }
                    });
            });
        }, {
            rootMargin: '-25% 0px -60% 0px'
        });

        sections.forEach(section => sectionObserver.observe(section));
    }
});

const canvas = document.getElementById('particleCanvas');

if (canvas) {
    const ctx = canvas.getContext('2d');
    let particles = [];

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    window.addEventListener('mousemove', (e) => {
        for (let i = 0; i < 3; i++) {
            particles.push({
                x: e.clientX,
                y: e.clientY,
                size: Math.random() * 4 + 1,
                speedX: (Math.random() - 0.5) * 2,
                speedY: (Math.random() - 0.5) * 2,
                life: 1
            });
        }
    });

    window.addEventListener('click', (e) => {
        for (let i = 0; i < 12; i++) {
            particles.push({
                x: e.clientX,
                y: e.clientY,
                size: Math.random() * 5 + 2,
                speedX: (Math.random() - 0.5) * 5,
                speedY: (Math.random() - 0.5) * 5,
                life: 1
            });
        }
    });

    function animateParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        particles.forEach((p, index) => {
            p.x += p.speedX;
            p.y += p.speedY;
            p.life -= 0.025;
            p.size *= 0.98;

            ctx.beginPath();
            ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(59, 130, 246, ${p.life})`;
            ctx.shadowBlur = 10;
            ctx.shadowColor = '#3B82F6';
            ctx.fill();

            if (p.life <= 0) {
                particles.splice(index, 1);
            }
        });

        ctx.shadowBlur = 0;
        requestAnimationFrame(animateParticles);
    }

    animateParticles();
}
