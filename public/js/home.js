javascript
document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar');
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    const reduceMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    const canUsePointer = window.matchMedia(
        '(hover: hover) and (pointer: fine)'
    ).matches;

    // =====================================================
    // 1. MENU NAVIGASI UNTUK HP
    // =====================================================
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

    // =====================================================
    // 2. EFEK NAVBAR KETIKA HALAMAN DI-SCROLL
    // =====================================================
    function updateNavbar() {
        if (navbar) {
            navbar.classList.toggle(
                'scrolled',
                window.scrollY > 20
            );
        }
    }

    updateNavbar();

    window.addEventListener('scroll', updateNavbar, {
        passive: true
    });

    // =====================================================
    // 3. ANIMASI MUNCUL KETIKA ELEMEN MASUK LAYAR
    // =====================================================
    const revealElements = document.querySelectorAll(
        '.reveal, .reveal-left, .reveal-right'
    );

    // Elemen tambahan untuk mockup laptop dan HP.
    const deviceRevealElements = document.querySelectorAll(
        '.device-reveal, .device-reveal-left, ' +
        '.device-reveal-right, .device-showcase'
    );

    if ('IntersectionObserver' in window && !reduceMotion) {
        const revealObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        entry.target.classList.add('is-visible');

                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.12
            }
        );

        revealElements.forEach(element => {
            revealObserver.observe(element);
        });

        deviceRevealElements.forEach(element => {
            revealObserver.observe(element);
        });
    } else {
        revealElements.forEach(element => {
            element.classList.add('visible');
        });

        deviceRevealElements.forEach(element => {
            element.classList.add('visible', 'is-visible');
        });
    }

    // =====================================================
    // 4. ANIMASI PROGRESS BAR DAN GRAFIK MOCKUP
    // =====================================================
    const deviceShowcases = document.querySelectorAll(
        '.device-showcase'
    );

    function activateDeviceShowcase(element) {
        element.classList.add('is-visible', 'visible');
    }

    if ('IntersectionObserver' in window && !reduceMotion) {
        const deviceProgressObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        activateDeviceShowcase(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.2
            }
        );

        deviceShowcases.forEach(element => {
            deviceProgressObserver.observe(element);
        });
    } else {
        deviceShowcases.forEach(activateDeviceShowcase);
    }

    // =====================================================
    // 5. CAHAYA BIRU DAN PARTIKEL PADA KURSOR
    // =====================================================
    let lastParticleTime = 0;
    let particleCount = 0;
    const maxCursorParticles = 22;

    if (canUsePointer && !reduceMotion) {
        let glow = document.querySelector('.cursor-glow');

        if (!glow) {
            glow = document.createElement('div');
            glow.className = 'cursor-glow';
            document.body.prepend(glow);
        }

        document.addEventListener('pointermove', event => {
            glow.style.setProperty(
                '--mouse-x',
                `${event.clientX}px`
            );

            glow.style.setProperty(
                '--mouse-y',
                `${event.clientY}px`
            );

            const now = performance.now();

            if (
                now - lastParticleTime < 45 ||
                particleCount >= maxCursorParticles
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

            particle.addEventListener(
                'animationend',
                () => {
                    particle.remove();
                    particleCount = Math.max(0, particleCount - 1);
                },
                { once: true }
            );

            // Pengaman jika animasi partikel tidak selesai.
            window.setTimeout(() => {
                if (particle.isConnected) {
                    particle.remove();
                    particleCount = Math.max(
                        0,
                        particleCount - 1
                    );
                }
            }, 1500);
        }, {
            passive: true
        });
    }

    // =====================================================
    // 6. EFEK TILT 3D PADA KARTU DAN DASHBOARD
    // =====================================================
    if (canUsePointer && !reduceMotion) {
        const cards = document.querySelectorAll(
            '.feature-card, .dashboard-preview'
        );

        cards.forEach(card => {
            card.addEventListener('pointermove', event => {
                const rect = card.getBoundingClientRect();

                if (!rect.width || !rect.height) return;

                const x = (event.clientX - rect.left) / rect.width;
                const y = (event.clientY - rect.top) / rect.height;

                const rotateY = (x - 0.5) * 7;
                const rotateX = (0.5 - y) * 7;

                card.style.transform =
                    `perspective(900px) ` +
                    `rotateX(${rotateX}deg) ` +
                    `rotateY(${rotateY}deg) ` +
                    `translateY(-4px)`;
            });

            card.addEventListener('pointerleave', () => {
                card.style.transform = '';
            });
        });
    }

    // =====================================================
    // 7. EFEK TILT 3D PADA MOCKUP LAPTOP DAN HP
    // =====================================================
    if (canUsePointer && !reduceMotion) {
        const deviceElements = document.querySelectorAll(
            '.device-tilt'
        );

        deviceElements.forEach(device => {
            device.addEventListener('pointermove', event => {
                const rect = device.getBoundingClientRect();

                if (!rect.width || !rect.height) return;

                const x = (event.clientX - rect.left) / rect.width;
                const y = (event.clientY - rect.top) / rect.height;

                const rotateY = (x - 0.5) * 10;
                const rotateX = (0.5 - y) * 8;

                device.style.setProperty(
                    '--device-rotate-x',
                    `${rotateX}deg`
                );

                device.style.setProperty(
                    '--device-rotate-y',
                    `${rotateY}deg`
                );
            });

            device.addEventListener('pointerleave', () => {
                device.style.setProperty(
                    '--device-rotate-x',
                    '0deg'
                );

                device.style.setProperty(
                    '--device-rotate-y',
                    '0deg'
                );
            });
        });
    }

    // =====================================================
    // 8. EFEK HOVER PADA ITEM MENU HP
    // =====================================================
    const phoneMenuItems = document.querySelectorAll(
        '.device-phone-menu-item'
    );

    phoneMenuItems.forEach((item, index) => {
        item.style.setProperty(
            '--phone-item-index',
            String(index)
        );

        if (canUsePointer && !reduceMotion) {
            item.addEventListener('pointerenter', () => {
                item.classList.add('phone-item-active');
            });

            item.addEventListener('pointerleave', () => {
                item.classList.remove('phone-item-active');
            });
        }
    });

    // =====================================================
    // 9. ANIMASI NOTIFIKASI MOCKUP
    // =====================================================
    const deviceNotifications = document.querySelectorAll(
        '.device-floating-card'
    );

    if ('IntersectionObserver' in window && !reduceMotion) {
        const notificationObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.15
            }
        );

        deviceNotifications.forEach(notification => {
            notificationObserver.observe(notification);
        });
    } else {
        deviceNotifications.forEach(notification => {
            notification.classList.add('is-visible');
        });
    }

    // =====================================================
    // 10. FAQ: HANYA SATU PERTANYAAN TERBUKA
    // =====================================================
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

    // =====================================================
    // 11. PENANDA MENU BERDASARKAN SECTION YANG TERLIHAT
    // =====================================================
    const sections = document.querySelectorAll(
        'main section[id]'
    );

    if ('IntersectionObserver' in window && sections.length) {
        const sectionObserver = new IntersectionObserver(
            entries => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;

                    const sectionId = entry.target.id;

                    document.querySelectorAll(
                        '.nav-links a[href^="#"]'
                    ).forEach(link => {
                        const active =
                            link.getAttribute('href') ===
                            `#${sectionId}`;

                        link.classList.toggle('active', active);

                        if (active) {
                            link.setAttribute(
                                'aria-current',
                                'location'
                            );
                        } else {
                            link.removeAttribute('aria-current');
                        }
                    });
                });
            },
            {
                rootMargin: '-25% 0px -60% 0px'
            }
        );

        sections.forEach(section => {
            sectionObserver.observe(section);
        });
    }
});

// =========================================================
// 12. CANVAS PARTIKEL BIRU
// =========================================================
(() => {
    const canvas = document.getElementById('particleCanvas');

    if (!canvas) return;

    const ctx = canvas.getContext('2d');

    if (!ctx) return;

    const reduceMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    const canUsePointer = window.matchMedia(
        '(hover: hover) and (pointer: fine)'
    ).matches;

    if (reduceMotion || !canUsePointer) {
        canvas.style.display = 'none';
        return;
    }

    let particles = [];
    let animationFrame = null;

    const maxParticles = 120;

    function resizeCanvas() {
        const dpr = Math.min(window.devicePixelRatio || 1, 2);

        canvas.width = Math.floor(window.innerWidth * dpr);
        canvas.height = Math.floor(window.innerHeight * dpr);

        canvas.style.width = `${window.innerWidth}px`;
        canvas.style.height = `${window.innerHeight}px`;

        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    }

    resizeCanvas();

    window.addEventListener('resize', resizeCanvas, {
        passive: true
    });

    function addParticles(x, y, count, spread) {
        for (let i = 0; i < count; i++) {
            if (particles.length >= maxParticles) {
                particles.shift();
            }

            particles.push({
                x,
                y,
                size: Math.random() * 4 + 1,
                speedX: (Math.random() - 0.5) * spread,
                speedY: (Math.random() - 0.5) * spread,
                life: 1,
                decay: Math.random() * 0.018 + 0.018
            });
        }
    }

    window.addEventListener('pointermove', event => {
        addParticles(
            event.clientX,
            event.clientY,
            2,
            2
        );
    }, {
        passive: true
    });

    window.addEventListener('click', event => {
        addParticles(
            event.clientX,
            event.clientY,
            12,
            5
        );
    });

    function animateParticles() {
        ctx.clearRect(
            0,
            0,
            window.innerWidth,
            window.innerHeight
        );

        particles = particles.filter(particle => {
            particle.x += particle.speedX;
            particle.y += particle.speedY;

            particle.life -= particle.decay;
            particle.size *= 0.985;

            if (particle.life <= 0 || particle.size < 0.2) {
                return false;
            }

            ctx.beginPath();

            ctx.arc(
                particle.x,
                particle.y,
                particle.size,
                0,
                Math.PI * 2
            );

            ctx.fillStyle =
                `rgba(59, 130, 246, ${Math.max(0, particle.life)})`;

            ctx.shadowBlur = 8;
            ctx.shadowColor = '#3B82F6';
            ctx.fill();

            return true;
        });

        ctx.shadowBlur = 0;

        animationFrame = requestAnimationFrame(animateParticles);
    }

    animateParticles();

    // Bersihkan animasi ketika tab tidak terlihat.
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            if (animationFrame !== null) {
                cancelAnimationFrame(animationFrame);
                animationFrame = null;
            }

            ctx.clearRect(
                0,
                0,
                window.innerWidth,
                window.innerHeight
            );
        } else if (animationFrame === null) {
            animateParticles();
        }
    });
})();

document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.getElementById('navbar');
    const menuToggle = document.getElementById('mobileMenuToggle');
    const navMenu = document.getElementById('navMenu');

    // Efek navbar ketika halaman digulir.
    const updateNavbar = () => {
        if (navbar) {
            navbar.classList.toggle('scrolled', window.scrollY > 15);
        }
    };

    updateNavbar();
    window.addEventListener('scroll', updateNavbar, { passive: true });

    // Buka dan tutup navigasi mobile.
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', () => {
            const isOpen = navMenu.classList.toggle('active');

            menuToggle.setAttribute('aria-expanded', String(isOpen));
            menuToggle.setAttribute(
                'aria-label',
                isOpen ? 'Tutup navigasi' : 'Buka navigasi'
            );

            const icon = menuToggle.querySelector('i');

            if (icon) {
                icon.className = isOpen ? 'ti ti-x' : 'ti ti-menu-2';
            }
        });

        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Buka navigasi');

                const icon = menuToggle.querySelector('i');

                if (icon) {
                    icon.className = 'ti ti-menu-2';
                }
            });
        });
    }

    // Menyorot menu sesuai section yang sedang terlihat.
    const sections = document.querySelectorAll(
        'main section[id]'
    );

    const navLinks = document.querySelectorAll(
        '.nav-menu .nav-link'
    );

    if ('IntersectionObserver' in window) {
        const sectionObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;

                navLinks.forEach(link => {
                    const isActive =
                        link.getAttribute('href') === `#${entry.target.id}`;

                    link.classList.toggle('active', isActive);
                });
            });
        }, {
            rootMargin: '-25% 0px -60% 0px'
        });

        sections.forEach(section => sectionObserver.observe(section));
    }

    // FAQ: buka satu pertanyaan dalam satu waktu.
    document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('toggle', () => {
            if (!item.open) return;

            document.querySelectorAll('.faq-item').forEach(other => {
                if (other !== item) other.open = false;
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('particleCanvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    const particles = [];
    const maxParticles = 70;
    const colors = ['#3185ff', '#54c8ff', '#8bbcff', '#ffffff'];

    let width = 0;
    let height = 0;
    let animationFrame;

    function resizeCanvas() {
        const dpr = Math.min(window.devicePixelRatio || 1, 2);

        width = window.innerWidth;
        height = window.innerHeight;

        canvas.width = width * dpr;
        canvas.height = height * dpr;
        canvas.style.width = `${width}px`;
        canvas.style.height = `${height}px`;

        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    }

    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    // Partikel muncul saat kursor bergerak.
    window.addEventListener('pointermove', event => {
        if (event.pointerType === 'touch') return;

        for (let i = 0; i < 3; i++) {
            if (particles.length >= maxParticles) {
                particles.shift();
            }

            particles.push({
                x: event.clientX + (Math.random() - 0.5) * 12,
                y: event.clientY + (Math.random() - 0.5) * 12,
                size: Math.random() * 3 + 1,
                vx: (Math.random() - 0.5) * 1.8,
                vy: (Math.random() - 0.5) * 1.8 - 0.4,
                life: 1,
                decay: Math.random() * 0.018 + 0.012,
                color: colors[Math.floor(Math.random() * colors.length)]
            });
        }
    }, { passive: true });

    function animate() {
        ctx.clearRect(0, 0, width, height);

        for (let i = particles.length - 1; i >= 0; i--) {
            const p = particles[i];

            p.x += p.vx;
            p.y += p.vy;
            p.life -= p.decay;
            p.size *= 0.992;

            if (p.life <= 0 || p.size < 0.2) {
                particles.splice(i, 1);
                continue;
            }

            ctx.save();
            ctx.globalAlpha = Math.max(0, p.life);
            ctx.fillStyle = p.color;
            ctx.shadowColor = p.color;
            ctx.shadowBlur = 12;

            ctx.beginPath();
            ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
            ctx.fill();

            ctx.restore();
        }

        animationFrame = requestAnimationFrame(animate);
    }

    // Hentikan animasi ketika tab tidak aktif.
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            cancelAnimationFrame(animationFrame);
        } else {
            animate();
        }
    });

    animate();
});
