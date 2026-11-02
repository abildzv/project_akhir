/* ========================================
   DASHBOARD SISWA PKL
   File: public/js/dashboard-siswa.js
   ======================================== */

document.addEventListener('DOMContentLoaded', function () {

    // ========================================
    // 1. SIDEBAR RESPONSIVE
    // ========================================

    const sidebar = document.getElementById('sidebar');
    const menuToggle = document.getElementById('menuToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function bukaSidebar() {
        if (!sidebar || !sidebarOverlay) return;

        sidebar.classList.add('is-open');
        sidebarOverlay.classList.add('is-visible');
    }

    function tutupSidebar() {
        if (!sidebar || !sidebarOverlay) return;

        sidebar.classList.remove('is-open');
        sidebarOverlay.classList.remove('is-visible');
    }

    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            if (sidebar && sidebar.classList.contains('is-open')) {
                tutupSidebar();
            } else {
                bukaSidebar();
            }
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', tutupSidebar);
    }

    // Tutup sidebar setelah menu dipilih di HP
    if (sidebar) {
        const menuLinks = sidebar.querySelectorAll('.nav a');

        menuLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 760) {
                    tutupSidebar();
                }
            });
        });
    }


    // ========================================
    // 2. DATA GRAFIK DARI LARAVEL
    // ========================================

    const dashboardData = window.dashboardPKL || {};

    // Data grafik progres
    const grafikLaporan = dashboardData.grafikLaporan || {};

    const labelsLaporan = Array.isArray(grafikLaporan.labels)
        && grafikLaporan.labels.length > 0
        ? grafikLaporan.labels
        : [
            'Minggu 1',
            'Minggu 2',
            'Minggu 3',
            'Minggu 4',
            'Minggu 5',
            'Minggu 6',
            'Minggu 7',
            'Minggu 8'
        ];

    const dataLaporan = Array.isArray(grafikLaporan.data)
        && grafikLaporan.data.length > 0
        ? grafikLaporan.data.map(value => Number(value) || 0)
        : [1, 2, 3, 4, 5, 6, 7, 8];


    // Data grafik status
    const grafikStatus = dashboardData.grafikStatusLaporan || {};

    const labelsStatus = Array.isArray(grafikStatus.labels)
        && grafikStatus.labels.length > 0
        ? grafikStatus.labels
        : [
            'Terkirim',
            'Diproses',
            'Perlu Revisi'
        ];

    const dataStatus = Array.isArray(grafikStatus.data)
        && grafikStatus.data.length > 0
        ? grafikStatus.data.map(value => Number(value) || 0)
        : [5, 3, 2];


    // ========================================
    // 3. CEK LIBRARY CHART.JS
    // ========================================

    if (typeof Chart === 'undefined') {
        console.error(
            'Chart.js belum dimuat. Pastikan library Chart.js dipanggil sebelum dashboard-siswa.js.'
        );

        return;
    }

    Chart.defaults.font.family = 'Inter, sans-serif';
    Chart.defaults.color = '#64748b';


    // ========================================
    // 4. GRAFIK PROGRES LAPORAN
    // BAR CHART
    // ========================================

    const laporanCanvas = document.getElementById('grafikLaporan');

    if (laporanCanvas) {

        // Menghapus grafik sebelumnya jika sudah ada
        const chartLama = Chart.getChart(laporanCanvas);

        if (chartLama) {
            chartLama.destroy();
        }

        new Chart(laporanCanvas, {

            type: 'bar',

            data: {
                labels: labelsLaporan,

                datasets: [{
                    label: 'Jumlah Laporan',

                    data: dataLaporan,

                    backgroundColor: [
                        'rgba(37, 99, 235, 0.85)',
                        'rgba(59, 130, 246, 0.85)',
                        'rgba(96, 165, 250, 0.85)',
                        'rgba(37, 99, 235, 0.85)',
                        'rgba(59, 130, 246, 0.85)',
                        'rgba(96, 165, 250, 0.85)',
                        'rgba(37, 99, 235, 0.85)',
                        'rgba(59, 130, 246, 0.85)'
                    ],

                    hoverBackgroundColor: '#1d4ed8',

                    borderRadius: 8,

                    borderSkipped: false,

                    barPercentage: 0.65,

                    categoryPercentage: 0.75,

                    maxBarThickness: 42
                }]
            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                animation: {
                    duration: 1200,
                    easing: 'easeOutQuart'
                },

                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {
                        enabled: true,

                        backgroundColor: '#172554',

                        titleColor: '#ffffff',

                        bodyColor: '#ffffff',

                        padding: 12,

                        cornerRadius: 10,

                        displayColors: true,

                        callbacks: {
                            label: function (context) {
                                return ' ' + context.parsed.y + ' laporan';
                            }
                        }
                    }
                },

                scales: {

                    x: {
                        grid: {
                            display: false
                        },

                        border: {
                            display: false
                        },

                        ticks: {
                            color: '#64748b',

                            font: {
                                size: 11,
                                weight: '500'
                            },

                            maxRotation: 0,

                            minRotation: 0
                        }
                    },

                    y: {
                        beginAtZero: true,

                        border: {
                            display: false
                        },

                        grid: {
                            color: 'rgba(148, 163, 184, 0.15)',

                            drawTicks: false
                        },

                        ticks: {
                            precision: 0,

                            stepSize: 1,

                            padding: 10
                        }
                    }
                }
            }
        });
    }


    // ========================================
    // 5. GRAFIK STATUS LAPORAN
    // DOUGHNUT CHART
    // ========================================

    const statusCanvas = document.getElementById('grafikStatusLaporan');

    if (statusCanvas) {

        // Menghapus grafik sebelumnya jika sudah ada
        const chartLama = Chart.getChart(statusCanvas);

        if (chartLama) {
            chartLama.destroy();
        }

        new Chart(statusCanvas, {

            type: 'doughnut',

            data: {
                labels: labelsStatus,

                datasets: [{
                    label: 'Status Laporan',

                    data: dataStatus,

                    backgroundColor: [
                        '#2563eb',
                        '#16a34a',
                        '#f59e0b'
                    ],

                    hoverBackgroundColor: [
                        '#1d4ed8',
                        '#15803d',
                        '#d97706'
                    ],

                    borderColor: '#ffffff',

                    borderWidth: 4,

                    hoverOffset: 12,

                    spacing: 3
                }]
            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                cutout: '68%',

                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 1300
                },

                plugins: {

                    legend: {
                        display: true,

                        position: 'bottom',

                        labels: {
                            usePointStyle: true,

                            pointStyle: 'circle',

                            padding: 22,

                            color: '#64748b',

                            font: {
                                family: 'Inter',
                                size: 12,
                                weight: '500'
                            }
                        }
                    },

                    tooltip: {
                        enabled: true,

                        backgroundColor: '#172554',

                        titleColor: '#ffffff',

                        bodyColor: '#ffffff',

                        padding: 12,

                        cornerRadius: 10,

                        callbacks: {
                            label: function (context) {

                                const total = context.dataset.data.reduce(
                                    function (jumlah, nilai) {
                                        return jumlah + Number(nilai || 0);
                                    },
                                    0
                                );

                                const nilai = Number(context.raw || 0);

                                const persentase = total > 0
                                    ? ((nilai / total) * 100).toFixed(1)
                                    : 0;

                                return ' ' + context.label + ': ' +
                                    nilai + ' laporan (' +
                                    persentase + '%)';
                            }
                        }
                    }
                }
            }
        });
    }


    // ========================================
    // 6. TAHUN OTOMATIS DI FOOTER
    // ========================================

    const tahunElement = document.getElementById('tahunSekarang');

    if (tahunElement) {
        tahunElement.textContent = new Date().getFullYear();
    }

});