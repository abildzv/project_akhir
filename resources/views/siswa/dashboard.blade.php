@extends('layouts.app')

@section('title', 'Dashboard Siswa')
@section('page-heading', 'Dashboard')

@section('content')

    {{-- Sambutan --}}
    <section class="hero">
        <div class="hero-content">
            <span class="hero-label">
                <i class="ti ti-school"></i>
                STUDENT PORTAL
            </span>

            <h2>Halo, {{ explode(' ', $siswa['nama'] ?? 'Siswa')[0] }}! 👋</h2>

            <p>
                Selamat datang di dashboard PKL Online.
                Ajukan PKL dan pantau statusnya dari satu tempat.
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
                <p>Informasi pengajuan PKL kamu.</p>
            </div>

            <span class="updated-label">
                <i class="ti ti-info-circle"></i>
                Ringkasan PKL
            </span>
        </div>

        <div class="stats">
            @foreach ($statistik ?? [] as $item)
                <article class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon {{ $item['warna'] ?? '' }}">
                            <i class="ti {{ $item['ikon'] ?? 'ti-chart-bar' }}"></i>
                        </div>
                        <i class="ti ti-chart-bar stat-dots"></i>
                    </div>

                    <p class="stat-label">{{ $item['label'] ?? '-' }}</p>

                    <h3>
                        {{ $item['nilai'] ?? 0 }}
                        @if (($item['label'] ?? '') === 'Sisa Hari PKL')
                            <small>hari</small>
                        @endif
                    </h3>

                    <p class="stat-description">{{ $item['keterangan'] ?? '' }}</p>
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

                <span class="status-pill">{{ $pkl['status'] ?? '-' }}</span>
            </div>

            <div class="company">
                <div class="company-icon">
                    <i class="ti ti-building"></i>
                </div>

                <div>
                    <h3>{{ $pkl['perusahaan'] ?? '-' }}</h3>
                    <p>
                        <i class="ti ti-map-pin"></i>
                        {{ $pkl['alamat'] ?? '-' }}
                    </p>
                </div>
            </div>

            <div class="progress-info">
                <div>
                    <span>Progres Pengajuan</span>
                    <strong>{{ $pkl['progress'] ?? 0 }}%</strong>
                </div>

                <div class="progress-track">
                    <div class="progress-fill"
                         style="width: {{ $pkl['progress'] ?? 0 }}%"></div>
                </div>

                <p>Progres akan disesuaikan dengan status pengajuan.</p>
            </div>

            <div class="detail-list">
                <div class="detail-row">
                    <span><i class="ti ti-calendar-event"></i> Mulai PKL</span>
                    <strong>{{ $pkl['tanggal_mulai'] ?? '-' }}</strong>
                </div>

                <div class="detail-row">
                    <span><i class="ti ti-calendar-check"></i> Selesai PKL</span>
                    <strong>{{ $pkl['tanggal_selesai'] ?? '-' }}</strong>
                </div>

                <div class="detail-row">
                    <span><i class="ti ti-user-check"></i> Pembimbing</span>
                    <strong>{{ $pkl['pembimbing'] ?? '-' }}</strong>
                </div>
            </div>
        </article>

        <article class="panel activity-panel">
            <div class="panel-heading">
                <div>
                    <h2>Aktivitas Terbaru</h2>
                    <p>Riwayat singkat pengajuan PKL.</p>
                </div>

                <span class="heading-icon">
                    <i class="ti ti-activity"></i>
                </span>
            </div>

            <div class="activity-list">
                @forelse ($aktivitas ?? [] as $item)
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="ti {{ $item['ikon'] ?? 'ti-file' }}"></i>
                        </div>

                        <div class="activity-body">
                            <h3>{{ $item['judul'] ?? '-' }}</h3>
                            <p>{{ $item['tanggal'] ?? '-' }}</p>
                        </div>

                        <span class="activity-status">{{ $item['status'] ?? '-' }}</span>
                    </div>
                @empty
                    <p>Belum ada aktivitas pengajuan.</p>
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
                @forelse ($pengumuman ?? [] as $item)
                    <div class="announcement-item">
                        <div class="announcement-icon {{ $item['warna'] ?? '' }}">
                            <i class="ti ti-bell-ringing"></i>
                        </div>

                        <div>
                            <h3>{{ $item['judul'] ?? '-' }}</h3>
                            <p>{{ $item['isi'] ?? '' }}</p>
                            <span>{{ $item['tanggal'] ?? '-' }}</span>
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
                    {{ strtoupper(substr($siswa['nama'] ?? 'S', 0, 1)) }}
                </div>

                <h3>{{ $siswa['nama'] ?? 'Siswa' }}</h3>
                <p>{{ $siswa['sekolah'] ?? '-' }}</p>
            </div>

            <div class="detail-list profile-details">
                <div class="detail-row">
                    <span>NIS</span>
                    <strong>{{ $siswa['nis'] ?? '-' }}</strong>
                </div>

                <div class="detail-row">
                    <span>Kelas</span>
                    <strong>{{ $siswa['kelas'] ?? '-' }}</strong>
                </div>
            </div>

            <a href="{{ url('/profile') }}" class="profile-button">
                Lihat Profil
                <i class="ti ti-arrow-right"></i>
            </a>
        </article>

    </section>

    {{-- Grafik Status --}}
    <section class="dashboard-charts">
        <article class="chart-card">
            <div class="chart-heading">
                <div>
                    <h3>Status Pengajuan</h3>
                    <p>Ringkasan status pengajuan PKL.</p>
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

    {{-- Footer --}}
    <footer class="footer">
        <span>© {{ date('Y') }} PKL Online</span>
        <span>Portal Pengajuan Praktik Kerja Lapangan</span>
    </footer>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>

<script>
    window.dashboardPKL = {
        grafikStatusLaporan: @json($grafik)
    };
</script>

<script src="{{ asset('js/dashboard-siswa.js') }}"></script>
@endpush