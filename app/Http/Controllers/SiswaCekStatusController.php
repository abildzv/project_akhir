<?php

namespace App\Http\Controllers;

class SiswaCekStatusController extends Controller
{
    public function index()
    {
        // Data siswa contoh
        $siswa = [
            'nama' => 'Nayla Zumrotusa’adah',
            'kelas' => 'XI RPL C',
        ];

        // Data pengajuan contoh
        $pengajuan = [
            [
                'instansi' => 'PT. Maju Jaya',
                'periode' => 'Juli - Desember 2026',
                'tanggal' => '15 Juni 2026',
                'status' => 'Disetujui',
                'pembimbing' => 'Belum ditentukan',
                'catatan' => 'Pengajuan telah disetujui. Silakan menunggu informasi berikutnya.',
            ],
        ];

        // Hitung statistik berdasarkan data pengajuan
        $statistik = [
            'total' => count($pengajuan),
            'menunggu' => collect($pengajuan)
                ->where('status', 'Menunggu')
                ->count(),
            'disetujui' => collect($pengajuan)
                ->where('status', 'Disetujui')
                ->count(),
            'ditolak' => collect($pengajuan)
                ->where('status', 'Ditolak')
                ->count(),
        ];

        return view('siswa.cek-status', compact(
            'siswa',
            'pengajuan',
            'statistik'
        ));
    }
}