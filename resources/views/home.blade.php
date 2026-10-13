
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0b1738">
    <meta name="description" content="PKL Online - Portal pengajuan dan laporan Praktik Kerja Lapangan siswa.">

    <title>PKL Online | Portal Pengajuan dan Laporan PKL</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>

<canvas id="particleCanvas" aria-hidden="true"></canvas>

<div class="background-glow glow-one"></div>
<div class="background-glow glow-two"></div>

<header class="navbar" id="navbar">
    <div class="navbar-container">
        <a href="{{ url('/') }}" class="brand">
            <span class="brand-logo"><i class="ti ti-school"></i></span>
            <span class="brand-name">PKL<span>Online</span></span>
        </a>

        <button class="mobile-menu-toggle" id="mobileMenuToggle"
                type="button" aria-label="Buka navigasi" aria-expanded="false">
            <i class="ti ti-menu-2"></i>
        </button>

        <nav class="nav-menu" id="navMenu">
            <a href="#beranda" class="nav-link active">Beranda</a>
            <a href="#tentang" class="nav-link">Tentang</a>
            <a href="#alur" class="nav-link">Alur PKL</a>
            <a href="#fitur" class="nav-link">Fitur</a>
            <a href="#faq" class="nav-link">FAQ</a>

            <a href="{{ url('/login') }}" class="nav-login">
                <i class="ti ti-login-2"></i> Login
            </a>
        </nav>
    </div>
</header>

<main>

    {{-- ================= HERO ================= --}}
    <section class="hero section-container" id="beranda">

        <div class="hero-content reveal">
            <div class="hero-badge">
                <span class="badge-pulse"></span>
                PORTAL DIGITAL PRAKTIK KERJA LAPANGAN
            </div>

            <h1>
                Perjalanan PKL Lebih
                <span class="gradient-text">Mudah dan Terarah.</span>
            </h1>

            <p class="hero-description">
                Mulai pengajuan Praktik Kerja Lapangan, kumpulkan laporan,
                dan pantau statusnya dalam satu platform yang praktis,
                terstruktur, dan mudah digunakan.
            </p>

            <div class="hero-actions">
                <a href="{{ url('/login') }}" class="button-primary">
                    Mulai Sekarang <i class="ti ti-arrow-up-right"></i>
                </a>

                <a href="#alur" class="button-secondary">
                    <span class="play-icon"><i class="ti ti-player-play"></i></span>
                    Pelajari Alurnya
                </a>
            </div>

            <div class="hero-trust">
                <div class="trust-icon"><i class="ti ti-shield-check"></i></div>
                <div>
                    <strong>Pengelolaan Lebih Terstruktur</strong>
                    <span>Pengajuan dan laporan dalam satu sistem.</span>
                </div>
            </div>
        </div>

        {{-- Laptop dan HP hero --}}
        <div class="hero-visual reveal" id="heroVisual">

            <div class="hero-decoration" aria-hidden="true">
                <span class="floating-square square-one"></span>
                <span class="floating-square square-two"></span>
                <span class="floating-square square-three"></span>
                <span class="floating-square square-four"></span>
                <span class="floating-orbit orbit-one"></span>
                <span class="floating-orbit orbit-two"></span>
            </div>

            <div class="visual-orbit orbit-one"></div>
            <div class="visual-orbit orbit-two"></div>

            <div class="floating-icon floating-icon-one">
                <i class="ti ti-file-check"></i>
            </div>
            <div class="floating-icon floating-icon-two">
                <i class="ti ti-cloud-upload"></i>
            </div>
            <div class="floating-icon floating-icon-three">
                <i class="ti ti-chart-line"></i>
            </div>

            {{-- Laptop --}}
            <div class="hero-laptop">
                <div class="dashboard-preview">

                    <div class="preview-topbar">
                        <div class="preview-brand">
                            <span class="preview-logo"><i class="ti ti-school"></i></span>
                            <div>
                                <strong>PKL Online</strong>
                                <small>Student Portal</small>
                            </div>
                        </div>
                        <span class="preview-menu"><i class="ti ti-dots"></i></span>
                    </div>

                    <div class="preview-body">
                        <div class="preview-welcome">
                            <div>
                                <span>SELAMAT DATANG</span>
                                <h3>Perjalanan PKL Kamu</h3>
                                <p>Semua aktivitas dalam satu tempat.</p>
                            </div>
                            <div class="preview-avatar"><i class="ti ti-user"></i></div>
                        </div>

                        <div class="preview-stats">
                            <div class="preview-stat">
                                <span class="preview-stat-icon blue"><i class="ti ti-file-text"></i></span>
                                <div><small>Pengajuan</small><strong>Terstruktur</strong></div>
                            </div>

                            <div class="preview-stat">
                                <span class="preview-stat-icon cyan"><i class="ti ti-cloud-upload"></i></span>
                                <div><small>Laporan</small><strong>Terpantau</strong></div>
                            </div>
                        </div>

                        <div class="preview-progress-card">
                            <div class="preview-card-heading">
                                <div>
                                    <strong>Alur Praktik Kerja Lapangan</strong>
                                    <small>Tahapan kegiatan PKL</small>
                                </div>
                                <i class="ti ti-route"></i>
                            </div>

                            <div class="mini-timeline">
                                <div class="timeline-item completed">
                                    <span class="timeline-dot"><i class="ti ti-check"></i></span>
                                    <div><strong>Pengajuan PKL</strong><small>Isi data pengajuan</small></div>
                                </div>

                                <div class="timeline-item current">
                                    <span class="timeline-dot"><i class="ti ti-file-text"></i></span>
                                    <div><strong>Pengumpulan Laporan</strong><small>Unggah laporan kegiatan</small></div>
                                </div>

                                <div class="timeline-item">
                                    <span class="timeline-dot"><i class="ti ti-clipboard-check"></i></span>
                                    <div><strong>Verifikasi</strong><small>Pemeriksaan laporan</small></div>
                                </div>
                            </div>
                        </div>

                        {{-- Grafik tambahan --}}
                        <div class="preview-mini-chart">
                            <div class="preview-chart-heading">
                                <strong>Progres Kegiatan</strong>
                                <span>PKL</span>
                            </div>
                            <div class="preview-chart-bars" aria-label="Ilustrasi grafik progres">
                                <i style="--bar-height:35%"></i>
                                <i style="--bar-height:55%"></i>
                                <i style="--bar-height:45%"></i>
                                <i style="--bar-height:75%"></i>
                                <i style="--bar-height:60%"></i>
                                <i style="--bar-height:95%"></i>
                                <i style="--bar-height:80%"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="laptop-base"></div>
            </div>

            {{-- HP hero --}}
            <div class="hero-phone">
                <div class="phone-frame">
                    <div class="phone-notch"></div>

                    <div class="phone-screen">
                        <div class="phone-status">
                            <span>09:41</span>
                            <span><i class="ti ti-wifi"></i> <i class="ti ti-battery-4"></i></span>
                        </div>

                        <div class="phone-app-heading">
                            <span class="phone-app-logo"><i class="ti ti-school"></i></span>
                            <div>
                                <strong>PKL Online</strong>
                                <small>Dashboard siswa</small>
                            </div>
                        </div>

                        <div class="phone-greeting">
                            <small>HALO, SISWA!</small>
                            <h3>Semangat PKL!</h3>
                            <p>Pantau kegiatanmu hari ini.</p>
                        </div>

                        <div class="phone-progress">
                            <div class="phone-progress-top">
                                <span>Progres kegiatan</span>
                                <strong>75%</strong>
                            </div>
                            <div class="phone-progress-track"><span></span></div>
                        </div>

                        <div class="phone-task-heading">
                            <strong>Aktivitas</strong>
                            <small>Lihat semua</small>
                        </div>

                        <div class="phone-task">
                            <span class="phone-task-icon"><i class="ti ti-file-text"></i></span>
                            <div><strong>Laporan PKL</strong><small>Periksa status laporan</small></div>
                            <i class="ti ti-chevron-right"></i>
                        </div>

                        <div class="phone-task">
                            <span class="phone-task-icon"><i class="ti ti-calendar"></i></span>
                            <div><strong>Jadwal kegiatan</strong><small>Agenda PKL</small></div>
                            <i class="ti ti-chevron-right"></i>
                        </div>

                        <div class="phone-task">
                            <span class="phone-task-icon"><i class="ti ti-bell"></i></span>
                            <div><strong>Informasi</strong><small>Pengumuman terbaru</small></div>
                            <i class="ti ti-chevron-right"></i>
                        </div>

                        <div class="phone-bottom-nav">
                            <span><i class="ti ti-home-2"></i><small>Beranda</small></span>
                            <span><i class="ti ti-file-text"></i><small>Laporan</small></span>
                            <span><i class="ti ti-user"></i><small>Profil</small></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Notifikasi mengambang --}}
            <div class="floating-notification">
                <span class="notification-icon"><i class="ti ti-check"></i></span>
                <div>
                    <strong>Laporan lebih terarah</strong>
                    <small>Pantau proses PKL dengan mudah</small>
                </div>
            </div>

            <div class="floating-status-card">
                <span class="floating-status-icon"><i class="ti ti-file-check"></i></span>
                <div><strong>Status laporan</strong><small>Informasi dalam satu tempat</small></div>
            </div>
        </div>

        <a href="#tentang" class="scroll-indicator" aria-label="Gulir ke bawah">
            <span>Jelajahi lebih lanjut</span>
            <i class="ti ti-arrow-down"></i>
        </a>
    </section>

    {{-- ================= HIGHLIGHT ================= --}}
    <section class="highlight-section">
        <div class="section-container">
            <div class="highlight-grid">
                <div class="highlight-item reveal">
                    <span class="highlight-icon"><i class="ti ti-file-plus"></i></span>
                    <div><strong>Pengajuan PKL</strong><p>Ajukan data PKL secara terstruktur.</p></div>
                </div>
                <div class="highlight-item reveal">
                    <span class="highlight-icon"><i class="ti ti-cloud-upload"></i></span>
                    <div><strong>Upload Laporan</strong><p>Kumpulkan laporan kegiatan PKL.</p></div>
                </div>
                <div class="highlight-item reveal">
                    <span class="highlight-icon"><i class="ti ti-clipboard-check"></i></span>
                    <div><strong>Verifikasi Laporan</strong><p>Pantau status pemeriksaan laporan.</p></div>
                </div>
                <div class="highlight-item reveal">
                    <span class="highlight-icon"><i class="ti ti-chart-dots-3"></i></span>
                    <div><strong>Pantau Progres</strong><p>Ikuti perkembangan proses PKL.</p></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= TENTANG ================= --}}
    <section class="about-section section-container" id="tentang">
        <div class="about-visual reveal">
            <div class="about-decoration decoration-one"></div>
            <div class="about-decoration decoration-two"></div>

            <div class="about-main-card">
                <div class="about-main-icon"><i class="ti ti-school"></i></div>
                <span>PKL ONLINE</span>
                <h3>Belajar, Berkembang, dan Berkarya.</h3>
                <p>Mendukung proses administrasi PKL agar lebih tertata dan mudah dipantau.</p>
                <div class="about-card-line"></div>
                <div class="about-card-footer"><i class="ti ti-shield-check"></i><span>Portal pengajuan dan laporan PKL</span></div>
            </div>

            <div class="about-small-card">
                <i class="ti ti-device-laptop"></i>
                <div><strong>Akses Praktis</strong><span>Dalam satu platform</span></div>
            </div>
        </div>

        <div class="about-content reveal">
            <span class="section-eyebrow"><span></span>TENTANG PLATFORM</span>
            <h2>Satu Platform untuk <span class="gradient-text">Perjalanan PKL Kamu.</span></h2>
            <p>PKL Online merupakan portal yang dirancang untuk membantu siswa dalam proses pengajuan Praktik Kerja Lapangan dan pengelolaan laporan kegiatan PKL.</p>
            <p>Melalui sistem ini, siswa dapat mengakses fitur pengajuan, mengunggah laporan, dan memantau statusnya tanpa harus berpindah-pindah halaman.</p>

            <div class="about-points">
                <div class="about-point"><i class="ti ti-circle-check"></i><span>Informasi pengajuan lebih terorganisasi.</span></div>
                <div class="about-point"><i class="ti ti-circle-check"></i><span>Pengumpulan laporan lebih praktis.</span></div>
                <div class="about-point"><i class="ti ti-circle-check"></i><span>Status proses dapat dipantau melalui portal.</span></div>
            </div>

            <a href="#fitur" class="text-button">Kenali Fitur Kami <i class="ti ti-arrow-narrow-right"></i></a>
        </div>
    </section>

    {{-- ================= FITUR ================= --}}
    <section class="features-section section-container" id="fitur">
        <div class="section-heading reveal">
            <span class="section-eyebrow"><span></span>FITUR UTAMA</span>
            <h2>Semua Kebutuhan PKL, <span class="gradient-text">Lebih Terorganisasi.</span></h2>
            <p>Fitur yang membantu siswa mengelola proses pengajuan dan laporan Praktik Kerja Lapangan.</p>
        </div>

        <div class="features-grid">
            <article class="feature-card reveal">
                <div class="feature-icon icon-blue"><i class="ti ti-file-plus"></i></div>
                <span class="feature-number">01</span>
                <h3>Pengajuan PKL</h3>
                <p>Isi informasi yang diperlukan dan kirim pengajuan PKL melalui sistem sesuai ketentuan sekolah.</p>
                <a href="{{ url('/login') }}" class="feature-link">Mulai pengajuan <i class="ti ti-arrow-up-right"></i></a>
                <div class="feature-decoration"></div>
            </article>

            <article class="feature-card reveal">
                <div class="feature-icon icon-cyan"><i class="ti ti-cloud-upload"></i></div>
                <span class="feature-number">02</span>
                <h3>Upload Laporan</h3>
                <p>Unggah dokumen laporan kegiatan PKL agar dapat diperiksa sesuai prosedur yang berlaku.</p>
                <a href="{{ url('/login') }}" class="feature-link">Unggah laporan <i class="ti ti-arrow-up-right"></i></a>
                <div class="feature-decoration"></div>
            </article>

            <article class="feature-card reveal">
                <div class="feature-icon icon-indigo"><i class="ti ti-clipboard-check"></i></div>
                <span class="feature-number">03</span>
                <h3>Cek Status</h3>
                <p>Periksa perkembangan pengajuan maupun status laporan yang telah dikumpulkan.</p>
                <a href="{{ url('/login') }}" class="feature-link">Periksa status <i class="ti ti-arrow-up-right"></i></a>
                <div class="feature-decoration"></div>
            </article>

            <article class="feature-card reveal">
                <div class="feature-icon icon-sky"><i class="ti ti-chart-line"></i></div>
                <span class="feature-number">04</span>
                <h3>Progres Laporan</h3>
                <p>Pantau perkembangan pengumpulan laporan dan informasi aktivitas PKL melalui dashboard.</p>
                <a href="{{ url('/login') }}" class="feature-link">Lihat progres <i class="ti ti-arrow-up-right"></i></a>
                <div class="feature-decoration"></div>
            </article>

            <article class="feature-card reveal">
                <div class="feature-icon icon-blue"><i class="ti ti-bell-ringing"></i></div>
                <span class="feature-number">05</span>
                <h3>Informasi dan Pengumuman</h3>
                <p>Ketahui informasi dan pengumuman yang berkaitan dengan kegiatan Praktik Kerja Lapangan.</p>
                <a href="{{ url('/login') }}" class="feature-link">Lihat informasi <i class="ti ti-arrow-up-right"></i></a>
                <div class="feature-decoration"></div>
            </article>

            <article class="feature-card reveal">
                <div class="feature-icon icon-cyan"><i class="ti ti-user-circle"></i></div>
                <span class="feature-number">06</span>
                <h3>Profil Siswa</h3>
                <p>Periksa informasi identitas siswa yang digunakan dalam proses pengajuan dan laporan PKL.</p>
                <a href="{{ url('/login') }}" class="feature-link">Buka profil <i class="ti ti-arrow-up-right"></i></a>
                <div class="feature-decoration"></div>
            </article>
        </div>
    </section>

    {{-- ================= FITUR MOBILE: HP DI KIRI ================= --}}
    <section class="student-mobile-section section-container" id="fitur-mobile">
        <div class="student-mobile-visual reveal">
            <div class="mobile-decoration" aria-hidden="true">
                <span class="floating-square square-one"></span>
                <span class="floating-square square-two"></span>
                <span class="floating-square square-three"></span>
                <span class="floating-orbit orbit-one"></span>
            </div>

            <div class="student-phone">
                <div class="phone-frame">
                    <div class="phone-notch"></div>
                    <div class="phone-screen">
                        <div class="phone-status">
                            <span>09:41</span>
                            <span><i class="ti ti-wifi"></i> <i class="ti ti-battery-4"></i></span>
                        </div>

                        <div class="phone-app-heading">
                            <span class="phone-app-logo"><i class="ti ti-school"></i></span>
                            <div><strong>PKL Online</strong><small>Menu siswa</small></div>
                        </div>

                        <div class="phone-greeting">
                            <small>FITUR SISWA</small>
                            <h3>Semua lebih mudah.</h3>
                            <p>Akses kebutuhan PKL dalam satu tempat.</p>
                        </div>

                        <div class="student-feature-row">
                            <span><i class="ti ti-file-plus"></i></span>
                            <div><strong>Pengajuan PKL</strong><small>Kelola pengajuanmu</small></div>
                            <i class="ti ti-chevron-right"></i>
                        </div>

                        <div class="student-feature-row">
                            <span><i class="ti ti-cloud-upload"></i></span>
                            <div><strong>Upload laporan</strong><small>Kumpulkan dokumen</small></div>
                            <i class="ti ti-chevron-right"></i>
                        </div>

                        <div class="student-feature-row">
                            <span><i class="ti ti-clipboard-check"></i></span>
                            <div><strong>Status laporan</strong><small>Pantau pemeriksaan</small></div>
                            <i class="ti ti-chevron-right"></i>
                        </div>

                        <div class="student-feature-row">
                            <span><i class="ti ti-bell"></i></span>
                            <div><strong>Pengumuman</strong><small>Informasi terbaru</small></div>
                            <i class="ti ti-chevron-right"></i>
                        </div>

                        <div class="phone-bottom-nav">
                            <span><i class="ti ti-home-2"></i><small>Beranda</small></span>
                            <span><i class="ti ti-file-text"></i><small>Laporan</small></span>
                            <span><i class="ti ti-user"></i><small>Profil</small></span>
                        </div>
                    </div>
                </div>

                <div class="mobile-floating-notice">
                    <span><i class="ti ti-check"></i></span>
                    <div><strong>Lebih praktis</strong><small>Akses fitur siswa</small></div>
                </div>
            </div>
        </div>

        <div class="student-mobile-content reveal">
            <span class="section-eyebrow"><span></span>AKSES DARI PERANGKATMU</span>
            <h2>Fitur Siswa dalam <span class="gradient-text">Genggaman.</span></h2>
            <p>Desain tampilan mobile membantu siswa menemukan informasi penting dengan mudah, baik saat mengakses pengajuan maupun mengelola laporan PKL.</p>

            <div class="mobile-feature-list">
                <div><span><i class="ti ti-file-plus"></i></span><div><strong>Pengajuan PKL</strong><p>Lengkapi informasi pengajuan melalui portal.</p></div></div>
                <div><span><i class="ti ti-cloud-upload"></i></span><div><strong>Upload laporan</strong><p>Kumpulkan dokumen laporan sesuai ketentuan.</p></div></div>
                <div><span><i class="ti ti-progress-check"></i></span><div><strong>Status dan progres</strong><p>Periksa informasi proses yang tersedia.</p></div></div>
                <div><span><i class="ti ti-bell-ringing"></i></span><div><strong>Informasi siswa</strong><p>Temukan pengumuman dan informasi PKL.</p></div></div>
            </div>

            <a href="{{ url('/login') }}" class="button-primary">Masuk ke Portal <i class="ti ti-arrow-up-right"></i></a>
        </div>
    </section>

    {{-- ================= ALUR PKL ================= --}}
    <section class="workflow-section" id="alur">
        <div class="section-container">
            <div class="section-heading reveal">
                <span class="section-eyebrow"><span></span>ALUR PENGGUNAAN</span>
                <h2>Mulai PKL dengan <span class="gradient-text">Langkah yang Jelas.</span></h2>
                <p>Ikuti tahapan pengajuan dan pelaporan PKL melalui portal sesuai prosedur sekolah.</p>
            </div>

            <div class="workflow-grid">
                <article class="workflow-card reveal">
                    <div class="workflow-top"><span class="workflow-number">01</span><span class="workflow-icon"><i class="ti ti-login-2"></i></span></div>
                    <div class="workflow-line"></div>
                    <h3>Masuk ke Portal</h3>
                    <p>Login menggunakan akun siswa untuk mengakses fitur pengajuan dan laporan.</p>
                </article>

                <article class="workflow-card reveal">
                    <div class="workflow-top"><span class="workflow-number">02</span><span class="workflow-icon"><i class="ti ti-file-description"></i></span></div>
                    <div class="workflow-line"></div>
                    <h3>Ajukan PKL</h3>
                    <p>Lengkapi informasi yang dibutuhkan dan kirim pengajuan sesuai ketentuan.</p>
                </article>

                <article class="workflow-card reveal">
                    <div class="workflow-top"><span class="workflow-number">03</span><span class="workflow-icon"><i class="ti ti-cloud-upload"></i></span></div>
                    <div class="workflow-line"></div>
                    <h3>Kumpulkan Laporan</h3>
                    <p>Unggah dokumen laporan kegiatan PKL melalui fitur yang tersedia.</p>
                </article>

                <article class="workflow-card reveal">
                    <div class="workflow-top"><span class="workflow-number">04</span><span class="workflow-icon"><i class="ti ti-clipboard-check"></i></span></div>
                    <div class="workflow-line"></div>
                    <h3>Pantau Hasil Verifikasi</h3>
                    <p>Periksa status laporan dan lakukan perbaikan apabila terdapat permintaan revisi.</p>
                </article>
            </div>

            <div class="workflow-note reveal">
                <div class="workflow-note-icon"><i class="ti ti-info-circle"></i></div>
                <div>
                    <strong>Perhatikan setiap tahapan.</strong>
                    <p>Ikuti petunjuk sekolah dan guru pembimbing. Tahapan serta persyaratan dapat menyesuaikan kebijakan PKL yang berlaku.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= LAPORAN ================= --}}
    <section class="report-section section-container">
        <div class="report-content reveal">
            <span class="section-eyebrow"><span></span>PENGELOLAAN LAPORAN</span>
            <h2>Laporan PKL Lebih <span class="gradient-text">Mudah Dipantau.</span></h2>
            <p>Setelah mengumpulkan laporan, siswa dapat memantau status pemeriksaan melalui sistem dan mengetahui langkah selanjutnya yang perlu dilakukan.</p>

            <div class="report-steps">
                <div class="report-step"><span class="report-step-icon"><i class="ti ti-upload"></i></span><div><strong>1. Kirim laporan</strong><p>Unggah dokumen sesuai persyaratan.</p></div></div>
                <div class="report-step"><span class="report-step-icon"><i class="ti ti-search"></i></span><div><strong>2. Proses pemeriksaan</strong><p>Laporan diperiksa oleh pihak yang berwenang.</p></div></div>
                <div class="report-step"><span class="report-step-icon"><i class="ti ti-refresh"></i></span><div><strong>3. Tindak lanjuti status</strong><p>Perbaiki laporan apabila diminta melakukan revisi.</p></div></div>
            </div>

            <a href="{{ url('/login') }}" class="button-primary">Akses Portal <i class="ti ti-arrow-right"></i></a>
        </div>

        <div class="report-visual reveal">
            <div class="report-glow"></div>
            <div class="report-preview">
                <div class="report-preview-heading">
                    <div><small>PORTAL SISWA</small><h3>Status Laporan</h3></div>
                    <span><i class="ti ti-chart-donut-3"></i></span>
                </div>

                <div class="report-preview-document">
                    <div class="document-icon"><i class="ti ti-file-type-pdf"></i></div>
                    <div class="document-info"><strong>Laporan Kegiatan PKL</strong><small>Dokumen laporan siswa</small></div>
                    <i class="ti ti-dots-vertical document-menu"></i>
                </div>

                <div class="report-status status-submitted"><span><i class="ti ti-circle-check"></i></span><div><strong>Terkirim</strong><small>Dokumen berhasil dikumpulkan</small></div></div>
                <div class="report-status status-review"><span><i class="ti ti-clock"></i></span><div><strong>Diproses</strong><small>Menunggu hasil pemeriksaan</small></div></div>
                <div class="report-status status-revision"><span><i class="ti ti-edit"></i></span><div><strong>Perlu Revisi</strong><small>Perbaikan jika diperlukan</small></div></div>

                <div class="report-preview-footer"><i class="ti ti-shield-check"></i><span>Contoh tampilan status laporan</span></div>
            </div>
        </div>
    </section>

    {{-- ================= KEUNGGULAN ================= --}}
    <section class="benefits-section">
        <div class="section-container">
            <div class="section-heading reveal">
                <span class="section-eyebrow"><span></span>KENAPA PKL ONLINE?</span>
                <h2>Proses Lebih Rapi, <span class="gradient-text">Informasi Lebih Jelas.</span></h2>
                <p>Membantu siswa mengelola kebutuhan administrasi PKL melalui halaman yang saling terhubung.</p>
            </div>

            <div class="benefits-grid">
                <article class="benefit-card reveal"><div class="benefit-icon"><i class="ti ti-layout-dashboard"></i></div><h3>Satu Pusat Informasi</h3><p>Informasi pengajuan, laporan, dan status dapat diakses melalui portal yang sama.</p></article>
                <article class="benefit-card reveal"><div class="benefit-icon"><i class="ti ti-eye"></i></div><h3>Status Lebih Transparan</h3><p>Siswa dapat memeriksa perkembangan sesuai informasi yang tersedia pada sistem.</p></article>
                <article class="benefit-card reveal"><div class="benefit-icon"><i class="ti ti-devices"></i></div><h3>Tampilan Responsif</h3><p>Desain disiapkan agar nyaman digunakan pada laptop maupun perangkat seluler.</p></article>
            </div>
        </div>
    </section>

    {{-- ================= FAQ ================= --}}
    <section class="faq-section section-container" id="faq">
        <div class="faq-intro reveal">
            <span class="section-eyebrow"><span></span>PERTANYAAN UMUM</span>
            <h2>Ada yang Ingin <span class="gradient-text">Kamu Ketahui?</span></h2>
            <p>Berikut beberapa informasi dasar untuk membantu kamu menggunakan portal PKL Online.</p>
            <div class="faq-contact"><i class="ti ti-message-circle"></i><div><strong>Masih mengalami kendala?</strong><span>Hubungi guru pembimbing PKL.</span></div></div>
        </div>

        <div class="faq-list reveal">
            <details class="faq-item"><summary>Apa itu PKL Online?<span class="faq-toggle"><i class="ti ti-plus"></i></span></summary><p>PKL Online adalah portal untuk membantu siswa mengelola pengajuan Praktik Kerja Lapangan, mengumpulkan laporan, dan memantau statusnya.</p></details>
            <details class="faq-item"><summary>Bagaimana cara mengajukan PKL?<span class="faq-toggle"><i class="ti ti-plus"></i></span></summary><p>Masuk ke akun siswa, buka menu Pengajuan PKL, lalu lengkapi data sesuai petunjuk dan ketentuan yang ditetapkan sekolah.</p></details>
            <details class="faq-item"><summary>Bagaimana cara mengumpulkan laporan PKL?<span class="faq-toggle"><i class="ti ti-plus"></i></span></summary><p>Login ke portal, buka menu Upload Laporan, kemudian unggah dokumen sesuai format dan persyaratan yang berlaku.</p></details>
            <details class="faq-item"><summary>Apa yang harus dilakukan jika laporan perlu revisi?<span class="faq-toggle"><i class="ti ti-plus"></i></span></summary><p>Periksa catatan atau arahan dari pemeriksa, perbaiki bagian yang diminta, lalu kumpulkan kembali laporan sesuai prosedur sistem.</p></details>
            <details class="faq-item"><summary>Apakah status laporan bisa dipantau?<span class="faq-toggle"><i class="ti ti-plus"></i></span></summary><p>Siswa dapat melihat status laporan melalui menu Cek Status setelah login, sesuai data yang tersedia di sistem.</p></details>
        </div>
    </section>

    {{-- ================= CTA ================= --}}
    <section class="cta-section section-container">
        <div class="cta-card reveal">
            <div class="cta-decoration cta-decoration-one"></div>
            <div class="cta-decoration cta-decoration-two"></div>

            <div class="cta-content">
                <span class="cta-eyebrow"><i class="ti ti-rocket"></i>MULAI PERJALANANMU</span>
                <h2>Siap Mengelola <span>PKL dengan Lebih Mudah?</span></h2>
                <p>Masuk ke portal dan mulai kelola pengajuan serta laporan Praktik Kerja Lapangan kamu.</p>
                <a href="{{ url('/login') }}" class="cta-button">Masuk ke PKL Online <i class="ti ti-arrow-right"></i></a>
            </div>

            <div class="cta-art">
                <div class="cta-art-circle"><i class="ti ti-school"></i></div>
                <span class="cta-star star-one"><i class="ti ti-sparkles"></i></span>
                <span class="cta-star star-two"><i class="ti ti-asterisk"></i></span>
            </div>
        </div>
    </section>

</main>

{{-- ================= FOOTER ================= --}}
<footer class="footer">
    <div class="section-container">
        <div class="footer-main">
            <div class="footer-brand">
                <a href="{{ url('/') }}" class="brand">
                    <span class="brand-logo"><i class="ti ti-school"></i></span>
                    <span class="brand-name">PKL<span>Online</span></span>
                </a>
                <p>Portal digital untuk mendukung pengelolaan pengajuan dan laporan Praktik Kerja Lapangan.</p>
            </div>

            <div class="footer-column">
                <h3>Navigasi</h3>
                <a href="#beranda">Beranda</a>
                <a href="#tentang">Tentang</a>
                <a href="#fitur">Fitur</a>
                <a href="#alur">Alur PKL</a>
            </div>

            <div class="footer-column">
                <h3>Layanan</h3>
                <a href="{{ url('/login') }}">Pengajuan PKL</a>
                <a href="{{ url('/login') }}">Upload Laporan</a>
                <a href="{{ url('/login') }}">Cek Status</a>
                <a href="{{ url('/login') }}">Profil Siswa</a>
            </div>

            <div class="footer-column">
                <h3>Informasi</h3>
                <a href="#faq">Pertanyaan Umum</a>
                <a href="#alur">Panduan Penggunaan</a>
                <a href="#tentang">Tentang Sistem</a>
            </div>
        </div>

        <div class="footer-bottom">
            <span>© {{ date('Y') }} PKL Online. Semua hak dilindungi.</span>
            <a href="#beranda">Kembali ke atas <i class="ti ti-arrow-up"></i></a>
        </div>
    </div>
</footer>

<script src="{{ asset('js/home.js') }}"></script>

{{-- Animasi perangkat dan dekorasi --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const finePointer = window.matchMedia('(pointer: fine)').matches;

    // Reveal elemen ketika memasuki viewport.
    const revealElements = document.querySelectorAll('.reveal');

    if ('IntersectionObserver' in window && !reduceMotion) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        revealElements.forEach(element => revealObserver.observe(element));
    } else {
        revealElements.forEach(element => element.classList.add('is-visible'));
    }

    // Efek cursor pada perangkat di hero.
    const heroVisual = document.getElementById('heroVisual');
    if (heroVisual && finePointer && !reduceMotion) {
        const interactiveDevices = heroVisual.querySelectorAll('.hero-laptop, .hero-phone');

        heroVisual.addEventListener('pointermove', event => {
            const rect = heroVisual.getBoundingClientRect();
            const x = (event.clientX - rect.left) / rect.width - 0.5;
            const y = (event.clientY - rect.top) / rect.height - 0.5;

            interactiveDevices.forEach((device, index) => {
                const strength = index === 0 ? 7 : 12;
                device.style.setProperty('--cursor-x', `${x * strength}px`);
                device.style.setProperty('--cursor-y', `${y * strength}px`);
            });
        });

        heroVisual.addEventListener('pointerleave', () => {
            interactiveDevices.forEach(device => {
                device.style.setProperty('--cursor-x', '0px');
                device.style.setProperty('--cursor-y', '0px');
            });
        });
    }

    // Grafik tumbuh setelah section hero tampil.
    const chart = document.querySelector('.preview-chart-bars');
    if (chart && !reduceMotion) {
        const bars = chart.querySelectorAll('i');
        bars.forEach((bar, index) => {
            bar.style.animationDelay = `${index * 100}ms`;
        });
    }
});
</script>

</body>
</html>
