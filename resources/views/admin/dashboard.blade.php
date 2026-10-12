@extends('layouts.admin')

@section('title', 'Dashboard Admin | PKL Online')
@section('page-heading', 'Dashboard Admin')

@section('content')

{{-- =====================================================
     1. BANNER SELAMAT DATANG
     ===================================================== --}}
<div class="welcome-section">
    <div>
        <span class="welcome-label">ADMINISTRATION OVERVIEW</span>
        <h1>Selamat datang, Admin! 👋</h1>
        <p>Pantau pengajuan dan laporan PKL siswa dalam satu tempat.</p>
    </div>
    <div class="welcome-icon">
        <i class="bi bi-mortarboard-fill"></i>
    </div>
</div>

{{-- =====================================================
     2. KARTU STATISTIK (4 kartu angka)
     ===================================================== --}}
<div class="stats-grid">

    {{-- 2a. Total Pengajuan --}}
    <div class="stat-card">
        <div class="stat-top">
            <div class="stat-icon blue"><i class="bi bi-files"></i></div>
            <span class="stat-tag">Total data</span>
        </div>
        <div class="stat-number">{{ $totalPengajuan }}</div>
        <div class="stat-title">Total Pengajuan</div>
        <div class="stat-note">Seluruh pengajuan PKL siswa</div>
    </div>

    {{-- 2b. Menunggu Verifikasi --}}
    <div class="stat-card">
        <div class="stat-top">
            <div class="stat-icon orange"><i class="bi bi-clock-history"></i></div>
            <span class="stat-tag">Perlu diperiksa</span>
        </div>
        <div class="stat-number">{{ $menunggu }}</div>
        <div class="stat-title">Menunggu Verifikasi</div>
        <div class="stat-note">Pengajuan belum diproses</div>
    </div>

    {{-- 2c. Disetujui --}}
    <div class="stat-card">
        <div class="stat-top">
            <div class="stat-icon green"><i class="bi bi-check-circle-fill"></i></div>
            <span class="stat-tag">Selesai</span>
        </div>
        <div class="stat-number">{{ $disetujui }}</div>
        <div class="stat-title">Disetujui</div>
        <div class="stat-note">Pengajuan telah disetujui</div>
    </div>

    {{-- 2d. Ditolak --}}
    <div class="stat-card">
        <div class="stat-top">
            <div class="stat-icon red"><i class="bi bi-x-circle-fill"></i></div>
            <span class="stat-tag">Ditolak</span>
        </div>
        <div class="stat-number">{{ $ditolak }}</div>
        <div class="stat-title">Pengajuan Ditolak</div>
        <div class="stat-note">Pengajuan yang ditolak</div>
    </div>
</div>

{{-- =====================================================
     3. GRID DASHBOARD (kolom kiri + kolom kanan)
     ===================================================== --}}
<div class="dashboard-grid">

    {{-- ================= KOLOM KIRI ================= --}}
    <div class="dashboard-left">

        {{-- 3a. GRAFIK GARIS: Statistik Pengajuan PKL --}}
        <div class="panel chart-panel">
            <div class="panel-header">
                <div>
                    <h5>Statistik Pengajuan PKL</h5>
                    <p>Perbandingan pengajuan dan persetujuan per bulan</p>
                </div>
                <span class="chart-period">7 Bulan Terakhir</span>
            </div>

            {{-- Keterangan warna garis --}}
            <div class="chart-legend">
                <span><i class="legend-dot purple-dot"></i> Pengajuan</span>
                <span><i class="legend-dot lavender-dot"></i> Disetujui</span>
            </div>

            {{-- Canvas grafik (digambar oleh script di bawah) --}}
            <div class="chart-container">
                <canvas id="pengajuanChart"></canvas>
            </div>
        </div>

        {{-- 3b. TABEL: Pengajuan Terbaru --}}
        <div class="panel activity-panel">
            <div class="panel-header">
                <div>
                    <h5>Pengajuan Terbaru</h5>
                    <p>Data pengajuan PKL terbaru</p>
                </div>
                <a href="{{ url('/admin/pengajuan') }}" class="panel-link">
                    Lihat semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="table-responsive">
                <table class="table admin-table align-middle">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Instansi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuanTerbaru as $pengajuan)
                            <tr>
                                {{-- Kolom nama siswa + avatar inisial --}}
                                <td>
                                    <div class="student-cell">
                                        <div class="student-avatar">
                                            {{ strtoupper(substr($pengajuan['nama'], 0, 1)) }}
                                        </div>
                                        <span>{{ $pengajuan['nama'] }}</span>
                                    </div>
                                </td>

                                {{-- Kolom instansi & tanggal --}}
                                <td>{{ $pengajuan['instansi'] }}</td>
                                <td>{{ $pengajuan['tanggal'] }}</td>

                                {{-- Kolom badge status --}}
                                <td>
                                    @if ($pengajuan['status'] === 'Disetujui')
                                        <span class="status-badge status-approved">Disetujui</span>
                                    @elseif ($pengajuan['status'] === 'Ditolak')
                                        <span class="status-badge status-rejected">Ditolak</span>
                                    @else
                                        <span class="status-badge status-pending">Menunggu</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            {{-- Tampilan jika data kosong --}}
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    Belum ada pengajuan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- ================= KOLOM KANAN ================= --}}
    <div class="dashboard-right">

        {{-- 3c. DIAGRAM DONAT: Status Pengajuan --}}
        <div class="panel donut-panel">
            <div class="panel-header">
                <div>
                    <h5>Status Pengajuan</h5>
                    <p>Ringkasan status seluruh pengajuan</p>
                </div>
                <i class="bi bi-pie-chart panel-heading-icon"></i>
            </div>

            <div class="donut-content">
                {{-- Donat + angka total di tengah --}}
                <div class="donut-chart-wrap">
                    <canvas id="statusChart"></canvas>
                    <div class="donut-center">
                        <strong>{{ $totalPengajuan }}</strong>
                        <span>Total</span>
                    </div>
                </div>

                {{-- Legend donat --}}
                <div class="donut-legend">
                    <div class="donut-legend-item">
                        <span class="legend-dot purple-dot"></span>
                        <div class="legend-info">
                            <span>Menunggu</span>
                            <strong>{{ $menunggu }}</strong>
                        </div>
                    </div>
                    <div class="donut-legend-item">
                        <span class="legend-dot lavender-dot"></span>
                        <div class="legend-info">
                            <span>Disetujui</span>
                            <strong>{{ $disetujui }}</strong>
                        </div>
                    </div>
                    <div class="donut-legend-item">
                        <span class="legend-dot orange-dot"></span>
                        <div class="legend-info">
                            <span>Ditolak</span>
                            <strong>{{ $ditolak }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3d. AKTIVITAS TERBARU (4 data teratas) --}}
        <div class="panel recent-panel">
            <div class="panel-header">
                <div>
                    <h5>Aktivitas Terbaru</h5>
                    <p>Ringkasan pengajuan terakhir</p>
                </div>
                <i class="bi bi-activity panel-heading-icon"></i>
            </div>

            @forelse (array_slice($pengajuanTerbaru, 0, 4) as $aktivitas)
                <div class="recent-item">
                    {{-- Avatar inisial --}}
                    <div class="recent-avatar">
                        {{ strtoupper(substr($aktivitas['nama'], 0, 1)) }}
                    </div>

                    {{-- Nama, instansi, tanggal --}}
                    <div class="recent-info">
                        <strong>{{ $aktivitas['nama'] }}</strong>
                        <span>{{ $aktivitas['instansi'] }}</span>
                        <small>{{ $aktivitas['tanggal'] }}</small>
                    </div>

                    {{-- Badge status --}}
                    <div>
                        @if ($aktivitas['status'] === 'Disetujui')
                            <span class="status-badge status-approved">Disetujui</span>
                        @elseif ($aktivitas['status'] === 'Ditolak')
                            <span class="status-badge status-rejected">Ditolak</span>
                        @else
                            <span class="status-badge status-pending">Menunggu</span>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-secondary mb-0">Belum ada aktivitas.</p>
            @endforelse
        </div>

    </div>
</div>

{{-- =====================================================
     4. SCRIPT GRAFIK (Chart.js)
     ===================================================== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ---------- Warna yang dipakai grafik ----------
    const purple   = '#6551D9';   // Pengajuan / Menunggu
    const lavender = '#A99AFB';   // Disetujui
    const orange   = '#FFB547';   // Ditolak
    const gridColor = '#ECEBFA';  // garis bantu grafik

    // =====================================================
    // GRAFIK GARIS: Statistik Pengajuan PKL (#pengajuanChart)
    // =====================================================
    const chartElement = document.getElementById('pengajuanChart');

    if (chartElement) {
        const ctx = chartElement.getContext('2d');

        // Gradasi area di bawah garis Pengajuan
        // (angka 290 = tinggi .chart-container di admin.css)
        const gradPurple = ctx.createLinearGradient(0, 0, 0, 290);
        gradPurple.addColorStop(0, 'rgba(101, 81, 217, 0.32)');
        gradPurple.addColorStop(1, 'rgba(101, 81, 217, 0)');

        // Gradasi area di bawah garis Disetujui
        const gradLavender = ctx.createLinearGradient(0, 0, 0, 290);
        gradLavender.addColorStop(0, 'rgba(169, 154, 251, 0.30)');
        gradLavender.addColorStop(1, 'rgba(169, 154, 251, 0)');

        new Chart(chartElement, {
            type: 'line',

            // ----- Data grafik -----
            data: {
                labels: ['Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt'],
                datasets: [
                    {
                        // Garis 1: Pengajuan
                        label: 'Pengajuan',
                        data: [18, 25, 22, 34, 28, 31, 24],
                        borderColor: purple,
                        backgroundColor: gradPurple,
                        fill: true,
                        tension: 0.4,               // kelengkungan garis
                        borderWidth: 3,
                        pointRadius: 0,             // titik disembunyikan
                        pointHoverRadius: 6,        // titik muncul saat hover
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: purple,
                        pointHoverBorderWidth: 3
                    },
                    {
                        // Garis 2: Disetujui
                        label: 'Disetujui',
                        data: [12, 18, 16, 28, 21, 25, 19],
                        borderColor: lavender,
                        backgroundColor: gradLavender,
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: lavender,
                        pointHoverBorderWidth: 3
                    }
                ]
            },

            // ----- Pengaturan tampilan -----
            options: {
                responsive: true,
                maintainAspectRatio: false,

                // Tooltip menampilkan semua garis di satu bulan
                interaction: {
                    mode: 'index',
                    intersect: false
                },

                plugins: {
                    legend: { display: false },     // legend memakai HTML sendiri
                    tooltip: {
                        backgroundColor: '#201747',
                        padding: 12,
                        cornerRadius: 10,
                        usePointStyle: true,
                        boxPadding: 6
                    }
                },

                scales: {
                    // Sumbu X (bulan)
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { color: '#7B82A3' }
                    },
                    // Sumbu Y (jumlah)
                    y: {
                        beginAtZero: true,
                        grid: { color: gridColor, borderDash: [4, 4] },
                        border: { display: false },
                        ticks: {
                            stepSize: 10,
                            color: '#7B82A3'
                        }
                    }
                }
            }
        });
    }

    // =====================================================
    // DIAGRAM DONAT: Status Pengajuan (#statusChart)
    // =====================================================
    const statusElement = document.getElementById('statusChart');

    if (statusElement) {
        new Chart(statusElement, {
            type: 'doughnut',

            // ----- Data donat (dari controller) -----
            data: {
                labels: ['Menunggu', 'Disetujui', 'Ditolak'],
                datasets: [{
                    data: [
                        {{ $menunggu }},
                        {{ $disetujui }},
                        {{ $ditolak }}
                    ],
                    backgroundColor: [purple, lavender, orange],
                    borderWidth: 0,
                    hoverOffset: 5
                }]
            },

            // ----- Pengaturan tampilan -----
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '74%',                      // ketebalan cincin donat
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#201747',
                        padding: 12
                    }
                }
            }
        });
    }
});
</script>

@endsection