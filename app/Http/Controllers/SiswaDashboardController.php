<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SiswaDashboardController extends Controller
{
    public function index(): View
    {
        $siswa = [
            'nama' => 'Nayla Zumrotusa’adah',
            'nis' => '2026009',
            'kelas' => 'XI RPL C',
            'sekolah' => 'SMK Negeri 2 Trenggalek',
        ];

        $pkl = [
            'perusahaan' => 'PT Hummatech',
            'alamat' => 'Malang, Jawa Timur',
            'pembimbing' => 'Belum ditentukan',
            'status' => 'Dalam Persiapan',
            'tanggal_mulai' => '1 Juli 2026',
            'tanggal_selesai' => '31 Desember 2026',
            'progress' => 55,
        ];

        $statistik = [
            [
                'label' => 'Status Pengajuan',
                'nilai' => 'Diproses',
                'ikon' => 'ti-file-check',
                'warna' => 'blue',
                'keterangan' => 'Pengajuan PKL',
            ],
            [
                'label' => 'Laporan Terkirim',
                'nilai' => '8',
                'ikon' => 'ti-files',
                'warna' => 'purple',
                'keterangan' => 'Laporan kegiatan',
            ],
            [
                'label' => 'Kehadiran',
                'nilai' => '95%',
                'ikon' => 'ti-calendar-check',
                'warna' => 'green',
                'keterangan' => 'Persentase kehadiran',
            ],
            [
                'label' => 'Sisa PKL',
                'nilai' => '—',
                'ikon' => 'ti-clock',
                'warna' => 'orange',
                'keterangan' => 'Sesuaikan dengan tanggal PKL',
            ],
        ];

        $aktivitas = [
            [
                'judul' => 'Mempelajari alur aplikasi',
                'tanggal' => 'Hari ini',
                'status' => 'Selesai',
                'ikon' => 'ti-book',
            ],
            [
                'judul' => 'Mengerjakan laporan kegiatan',
                'tanggal' => 'Kemarin',
                'status' => 'Selesai',
                'ikon' => 'ti-file-text',
            ],
            [
                'judul' => 'Pengecekan tugas PKL',
                'tanggal' => 'Sebelumnya',
                'status' => 'Diproses',
                'ikon' => 'ti-clipboard-check',
            ],
        ];

        $pengumuman = [
            [
                'judul' => 'Pengumpulan Laporan PKL',
                'isi' => 'Pastikan laporan kegiatan diperbarui secara berkala.',
                'tanggal' => 'Informasi umum',
                'warna' => 'blue',
            ],
            [
                'judul' => 'Periksa Status Pengajuan',
                'isi' => 'Periksa halaman status untuk mengetahui perkembangan pengajuan.',
                'tanggal' => 'Informasi umum',
                'warna' => 'orange',
            ],
        ];

        
$grafikLaporan = [
    'labels' => [
        'Minggu 1',
        'Minggu 2',
        'Minggu 3',
        'Minggu 4',
        'Minggu 5',
        'Minggu 6',
        'Minggu 7',
        'Minggu 8',
    ],
    'data' => [1, 2, 3, 4, 5, 6, 7, 8],
];

$grafikStatusLaporan = [
    'labels' => ['Terkirim', 'Diproses', 'Perlu Revisi'],
    'data' => [0, 0, 0],
];


        return view('siswa.dashboard', compact(
          
          'siswa',
          'pkl',
          'statistik',
          'aktivitas',
          'pengumuman',
          'grafikLaporan',
          'grafikStatusLaporan'

        ));
    }
}