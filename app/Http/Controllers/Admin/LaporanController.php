<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $data = Pengajuan::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $data->where(function ($query) use ($search) {
                $query->where('nama_siswa', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('nama_perusahaan', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $data->where('status', $request->status);
        }

        $laporan = $data->latest()->paginate(10)
            ->withQueryString();

        $totalPengajuan = Pengajuan::count();

        $menunggu = Pengajuan::where(
            'status', 'menunggu'
        )->count();

        $disetujui = Pengajuan::where(
            'status', 'disetujui'
        )->count();

        $ditolak = Pengajuan::where(
            'status', 'ditolak'
        )->count();

        return view('admin.laporan', compact(
            'laporan',
            'totalPengajuan',
            'menunggu',
            'disetujui',
            'ditolak'
        ));
    }
}
