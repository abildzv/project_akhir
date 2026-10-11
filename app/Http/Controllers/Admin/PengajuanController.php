<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
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

        $pengajuan = $data->latest()->paginate(10)
            ->withQueryString();

        $totalPengajuan = Pengajuan::count();
        $menungguVerifikasi = Pengajuan::where(
            'status', 'menunggu'
        )->count();
        $disetujui = Pengajuan::where(
            'status', 'disetujui'
        )->count();
        $ditolak = Pengajuan::where(
            'status', 'ditolak'
        )->count();

        return view('admin.pengajuan', compact(
            'pengajuan',
            'totalPengajuan',
            'menungguVerifikasi',
            'disetujui',
            'ditolak'
        ));
   
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        return view('admin.detail-pengajuan', compact('pengajuan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan_admin' => 'nullable|string|max:1000',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);

        $pengajuan->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()
            ->route('admin.pengajuan.index')
            ->with('success', 'Status pengajuan berhasil diperbarui.');
    }
}
