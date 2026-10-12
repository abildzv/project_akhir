
/* ========================================
   DASHBOARD SISWA PKL
   File: public/js/dashboard-siswa.js
   ======================================== */

document.addEventListener('DOMContentLoaded', function () {
    // ========================================
    // 1. SIDEBAR RESPONSIVE
    // ========================================

    const sidebar = document.querySelector('.sidebar');
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebarOverlay = document.querySelector('.sidebar-overlay');

    function bukaSidebar() {
        if (!sidebar) return;

        sidebar.classList.add('active');

        if (sidebarOverlay) {
            sidebarOverlay.classList.add('active');
        }
    }

    function tutupSidebar() {
        if (!sidebar) return;

        sidebar.classList.remove('active');

        if (sidebarOverlay) {
            sidebarOverlay.classList.remove('active');
        }
    }

    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            if (sidebar && sidebar.classList.contains('active')) {
                tutupSidebar();
            } else {
                bukaSidebar();
            }
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', tutupSidebar);
    }

    // Tutup sidebar setelah menu dipilih di HP.
    if (sidebar) {
        const menuLinks = sidebar.querySelectorAll('a');

        menuLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 768) {
                    tutupSidebar();
                }
            });
        });
    }

    // ========================================
    // 2. DATA GRAFIK DARI CONTROLLER LARAVEL
    // ========================================

    const dashboardData = window.dashboardPKL || {};

    // ========================================
    // 3. GRAFIK JUMLAH LAPORAN
    // ========================================

    const laporanCanvas = document.getElementById('grafikLaporan');

    if (laporanCanvas && typeof Chart !== 'undefined') {
        const grafikLaporan = dashboardData.grafikLaporan || {
            labels: [],
            data: []
        };

        new Chart(laporanCanvas, {
            type: 'line',

            data: {
                labels: grafikLaporan.labels || [],

                datasets: [{
                    label: 'Jumlah Laporan',
                    data: grafikLaporan.data || [],
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.12)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.35,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#2563eb',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'start'
                    },

                    tooltip: {
                        enabled: true
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        },
                        grid: {
                            color: '#f1f5f9'
                        }
                    },

                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // ========================================
    // 4. GRAFIK STATUS LAPORAN
    // ========================================

    const statusCanvas = document.getElementById('grafikStatusLaporan');

    if (statusCanvas && typeof Chart !== 'undefined') {
        const grafikStatus = dashboardData.grafikStatusLaporan || {
            labels: ['Terkirim', 'Diproses', 'Perlu Revisi'],
            data: [0, 0, 0]
        };

        new Chart(statusCanvas, {
            type: 'doughnut',

            data: {
                labels: grafikStatus.labels || [],

                datasets: [{
                    label: 'Status Laporan',
                    data: grafikStatus.data || [],
                    backgroundColor: [
                        '#2563eb',
                        '#16a34a',
                        '#f59e0b'
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 3,
                    hoverOffset: 8
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    },

                    tooltip: {
                        enabled: true
                    }
                },

                cutout: '65%'
            }
        });
    }

    // ========================================
    // 5. TAHUN OTOMATIS DI FOOTER
    // ========================================

    const tahunElement = document.getElementById('tahunSekarang');

    if (tahunElement) {
        tahunElement.textContent = new Date().getFullYear();
    }
});
