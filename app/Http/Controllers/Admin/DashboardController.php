<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengajuan = Pengajuan::count();

        $menunggu = Pengajuan::where('status', 'menunggu')->count();

        $disetujui = Pengajuan::where('status', 'disetujui')->count();
        
        $ditolak = Pengajuan::where('status', 'ditolak')->count();

        $pengajuanTerbaru = Pengajuan::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'pengajuanTerbaru',
            'totalPengajuan',
            'menunggu',
            'disetujui',
            'ditolak'
        ));
    }
}