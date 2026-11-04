<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengajuan::query();

        //Pencarian
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_siswa', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        //Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        //Statistik Pengajuan
        $totalPengajuan = Pengajuan::count();

        $menungguVerifikasi = Pengajuan::where(
            'status',
            'menunggu'
        )->count();

        $disetujui = Pengajuan::where(
            'status',
            'disetujui'
        )->count();

        $ditolak = Pengajuan::where(
            'status',
            'ditolak'
        )->count();

        //Ambil data pengajuan
        $pengajuan = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();
        
        return view('admin.pengajuan', compact(
            'totalPengajuan',
            'menungguVerifikasi',
            'disetujui',
            'ditolak',
            'pengajuan'
        ));
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        return view('admin.pengajuan-detail', compact('pengajuan'));
    }
}