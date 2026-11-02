<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data contoh untuk menguji tampilan dashboard.
        // Nanti diganti dengan data dari database.

        $pengajuanTerbaru = [
            [
                'nama' => 'Ryomen Sukuna',
                'instansi' => 'PT Mundur Jaya',
                'tanggal' => '10 Okt 2026',
                'status' => 'Menunggu',
            ],
            [
                'nama' => 'Budianto Mangkuwanitolimo',
                'instansi' => 'CV Kreatif Media',
                'tanggal' => '9 Okt 2026',
                'status' => 'Disetujui',
            ],
            [
                'nama' => 'Dedi Susanto',
                'instansi' => 'PT Sinar Abadi',
                'tanggal' => '8 Okt 2026',
                'status' => 'Ditolak',
            ],
            [
                'nama' => 'Mikael Budiharjo',
                'instansi' => 'PT Teknologi Nusantara',
                'tanggal' => '7 Okt 2026',
                'status' => 'Menunggu',
            ],
        ];

        $totalPengajuan = count($pengajuanTerbaru);

        $menunggu = count(array_filter(
            $pengajuanTerbaru,
            fn ($item) => $item['status'] === 'Menunggu'
        ));

        $disetujui = count(array_filter(
            $pengajuanTerbaru,
            fn ($item) => $item['status'] === 'Disetujui'
        ));

        $ditolak = count(array_filter(
            $pengajuanTerbaru,
            fn ($item) => $item['status'] === 'Ditolak'
        ));

        return view('admin.dashboard', compact(
            'pengajuanTerbaru',
            'totalPengajuan',
            'menunggu',
            'disetujui',
            'ditolak'
        ));
    }
}
