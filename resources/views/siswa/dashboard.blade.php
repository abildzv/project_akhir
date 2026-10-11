
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Siswa | PKL Online</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/dashboard-siswa.css') }}">
</head>
<body>

<div class="app">

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="side" id="sidebar">
        <a href="{{ route('siswa.dashboard') }}" class="brand">
            <span class="brand-icon"><i class="ti ti-school"></i></span>
            <span>PKL<span class="brand-light">Online</span></span>
        </a>

        <div class="sidebar-label">MENU UTAMA</div>

        <nav class="nav" id="nav">
            <a href="{{ route('siswa.dashboard') }}" class="active">
                <i class="ti ti-layout-dashboard"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ url('/pengajuan-pkl') }}">
                <i class="ti ti-file-plus"></i>
                <span>Pengajuan PKL</span>
            </a>

            <a href="{{ url('/upload-laporan') }}">
                <i class="ti ti-cloud-upload"></i>
                <span>Upload Laporan</span>
            </a>

            <a href="{{ url('/cek-status') }}">
                <i class="ti ti-clipboard-check"></i>
                <span>Cek Status</span>
            </a>

            <a href="{{ url('/profile') }}">
                <i class="ti ti-user-circle"></i>
                <span>Profile</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="help-card">
                <div class="help-icon"><i class="ti ti-headset"></i></div>
                <strong>Butuh bantuan?</strong>
                <p>Hubungi guru pembimbing jika mengalami kendala.</p>
            </div>

            <form action="{{ url('/logout') }}" method="POST"
                  onsubmit="return confirm('Yakin ingin keluar dari akun?')">
                @csrf

                <button type="submit" class="logout-button">
                    <i class="ti ti-logout"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main">

        <header class="top">
            <div class="top-left">
                <button class="menu-toggle" id="menuToggle"
                        type="button" aria-label="Buka menu">
                    <i class="ti ti-menu-2"></i>
                </button>

                <div>
                    <div class="breadcrumb">Halaman / Dashboard</div>
                    <h1>Dashboard Siswa</h1>
                </div>
            </div>

            <div class="top-right">
                <div class="user">
                    <div class="avatar">
                        {{ strtoupper(substr($siswa['nama'], 0, 1)) }}
                    </div>

                    <div class="user-info">
                        <strong>{{ $siswa['nama'] }}</strong>
                        <span>{{ $siswa['kelas'] }}</span>
                    </div>

                    <i class="ti ti-chevron-down user-chevron"></i>
                </div>
            </div>
        </header>

        <div class="content">

            {{-- Sambutan --}}
            <section class="hero">
                <div class="hero-content">
                    <span class="hero-label">
                        <i class="ti ti-school"></i>
                        STUDENT PORTAL
                    </span>

                    <h2>Halo, {{ explode(' ', $siswa['nama'])[0] }}! 👋</h2>

                    <p>
                        Selamat datang di dashboard PKL Online.
                        Pantau pengajuan dan perkembangan laporan PKL
                        kamu dari satu tempat.
                    </p>

                    <a href="{{ url('/cek-status') }}" class="hero-button">
                        Lihat Status PKL
                        <i class="ti ti-arrow-right"></i>
                    </a>
                </div>

                <div class="hero-art">
                    <div class="art-circle circle-one"></div>
                    <div class="art-circle circle-two"></div>

                    <div class="art-card">
                        <i class="ti ti-school"></i>
                        <span>PKL</span>
                        <small>Terus berkembang!</small>
                    </div>
                </div>
            </section>

            {{-- Ringkasan Statistik --}}
            <section class="section">
                <div class="section-heading">
                    <div>
                        <h2>Ringkasan Aktivitas</h2>
                        <p>Informasi pengajuan dan laporan PKL kamu.</p>
                    </div>

                    <span class="updated-label">
                        <i class="ti ti-info-circle"></i>
                        Ringkasan PKL
                    </span>
                </div>

                <div class="stats">
                    @foreach ($statistik as $item)
                        <article class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon {{ $item['warna'] }}">
                                    <i class="ti {{ $item['ikon'] }}"></i>
                                </div>

                                <i class="ti ti-chart-bar stat-dots"></i>
                            </div>

                            <p class="stat-label">{{ $item['label'] }}</p>
                            <h3>
                                {{ $item['nilai'] }}
                                @if ($item['label'] === 'Sisa Hari PKL')
                                    <small>hari</small>
                                @endif
                            </h3>
                            <p class="stat-description">{{ $item['keterangan'] }}</p>
                        </article>
                    @endforeach
                </div>
            </section>

            {{-- Informasi PKL dan Aktivitas --}}
            <section class="main-grid">

                <article class="panel progress-panel">
                    <div class="panel-heading">
                        <div>
                            <h2>Informasi PKL</h2>
                            <p>Ringkasan tempat dan periode PKL.</p>
                        </div>

                        <span class="status-pill">{{ $pkl['status'] }}</span>
                    </div>

                    <div class="company">
                        <div class="company-icon">
                            <i class="ti ti-building"></i>
                        </div>

                        <div>
                            <h3>{{ $pkl['perusahaan'] }}</h3>
                            <p>
                                <i class="ti ti-map-pin"></i>
                                {{ $pkl['alamat'] }}
                            </p>
                        </div>
                    </div>

                    <div class="progress-info">
                        <div>
                            <span>Progres Laporan</span>
                            <strong>{{ $pkl['progress'] }}%</strong>
                        </div>

                        <div class="progress-track">
                            <div class="progress-fill"
                                 style="width: {{ $pkl['progress'] }}%">
                            </div>
                        </div>

                        <p>Progres akan disesuaikan dengan data laporan.</p>
                    </div>

                    <div class="detail-list">
                        <div class="detail-row">
                            <span><i class="ti ti-calendar-event"></i> Mulai PKL</span>
                            <strong>{{ $pkl['tanggal_mulai'] }}</strong>
                        </div>

                        <div class="detail-row">
                            <span><i class="ti ti-calendar-check"></i> Selesai PKL</span>
                            <strong>{{ $pkl['tanggal_selesai'] }}</strong>
                        </div>

                        <div class="detail-row">
                            <span><i class="ti ti-user-check"></i> Pembimbing</span>
                            <strong>{{ $pkl['pembimbing'] }}</strong>
                        </div>
                    </div>
                </article>

                <article class="panel activity-panel">
                    <div class="panel-heading">
                        <div>
                            <h2>Aktivitas Terbaru</h2>
                            <p>Riwayat singkat pengajuan dan laporan.</p>
                        </div>

                        <span class="heading-icon">
                            <i class="ti ti-activity"></i>
                        </span>
                    </div>

                    <div class="activity-list">
                        @forelse ($aktivitas as $item)
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="ti {{ $item['ikon'] }}"></i>
                                </div>

                                <div class="activity-body">
                                    <h3>{{ $item['judul'] }}</h3>
                                    <p>{{ $item['tanggal'] }}</p>
                                </div>

                                <span class="activity-status">
                                    {{ $item['status'] }}
                                </span>
                            </div>
                        @empty
                            <p>Belum ada aktivitas pengajuan atau laporan.</p>
                        @endforelse
                    </div>

                    <a href="{{ url('/cek-status') }}" class="text-link">
                        Periksa status
                        <i class="ti ti-arrow-right"></i>
                    </a>
                </article>

            </section>

            {{-- Pengumuman dan Identitas Siswa --}}
            <section class="bottom-grid">

                <article class="panel announcement-panel">
                    <div class="panel-heading">
                        <div>
                            <h2>Pengumuman</h2>
                            <p>Pengingat terkait kegiatan PKL.</p>
                        </div>

                        <span class="heading-icon">
                            <i class="ti ti-speakerphone"></i>
                        </span>
                    </div>

                    <div class="announcement-list">
                        @forelse ($pengumuman as $item)
                            <div class="announcement-item">
                                <div class="announcement-icon {{ $item['warna'] }}">
                                    <i class="ti ti-bell-ringing"></i>
                                </div>

                                <div>
                                    <h3>{{ $item['judul'] }}</h3>
                                    <p>{{ $item['isi'] }}</p>
                                    <span>{{ $item['tanggal'] }}</span>
                                </div>
                            </div>
                        @empty
                            <p>Belum ada pengumuman.</p>
                        @endforelse
                    </div>
                </article>

                <article class="panel profile-panel">
                    <div class="panel-heading">
                        <div>
                            <h2>Informasi Siswa</h2>
                            <p>Identitas siswa.</p>
                        </div>

                        <span class="heading-icon">
                            <i class="ti ti-id"></i>
                        </span>
                    </div>

                    <div class="profile-summary">
                        <div class="profile-avatar">
                            {{ strtoupper(substr($siswa['nama'], 0, 1)) }}
                        </div>

                        <h3>{{ $siswa['nama'] }}</h3>
                        <p>{{ $siswa['sekolah'] }}</p>
                    </div>

                    <div class="detail-list profile-details">
                        <div class="detail-row">
                            <span>NIS</span>
                            <strong>{{ $siswa['nis'] }}</strong>
                        </div>

                        <div class="detail-row">
                            <span>Kelas</span>
                            <strong>{{ $siswa['kelas'] }}</strong>
                        </div>
                    </div>

                    <a href="{{ url('/profile') }}" class="profile-button">
                        Lihat Profil
                        <i class="ti ti-arrow-right"></i>
                    </a>
                </article>

            </section>

            {{-- Grafik Laporan --}}
            <section class="dashboard-charts">

                <article class="chart-card">
                    <div class="chart-heading">
                        <div>
                            <h3>Progres Laporan</h3>
                            <p>Jumlah laporan yang dikumpulkan per minggu.</p>
                        </div>

                        <span class="chart-icon">
                            <i class="ti ti-chart-line"></i>
                        </span>
                    </div>

                    <div class="chart-container">
                        <canvas id="grafikLaporan"></canvas>
                    </div>
                </article>

                <article class="chart-card">
                    <div class="chart-heading">
                        <div>
                            <h3>Status Laporan</h3>
                            <p>Ringkasan status laporan PKL.</p>
                        </div>

                        <span class="chart-icon">
                            <i class="ti ti-chart-donut-3"></i>
                        </span>
                    </div>

                    <div class="chart-container chart-doughnut">
                        <canvas id="grafikStatusLaporan"></canvas>
                    </div>
                </article>

            </section>

            <footer class="footer">
                <span>© {{ date('Y') }} PKL Online</span>
                <span>Portal Pengajuan dan Laporan Praktik Kerja Lapangan</span>
            </footer>

        </div>
    </main>
</div>

{{-- Data grafik dikirim dari controller ke file JavaScript --}}
<script>
    window.dashboardPKL = {
        grafikLaporan: @json($grafikLaporan),
        grafikStatusLaporan: @json($grafikStatusLaporan)
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/dashboard-siswa.js') }}"></script>

</body>
</html>
