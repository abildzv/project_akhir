<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanPklController extends Controller
{
    
    // Menampilkan halaman form pengajuan PKL
    public function index(): View
    {
        $siswa = [
            'nama' => auth()->user()->name ?? '',
            'nis' => '',
            'kelas' => 'XI RPL C',
            'jurusan' => 'Rekayasa Perangkat Lunak',
        ];

        return view('siswa.pengajuan-pkl', compact('siswa'));
    }

    // Memproses pengajuan PKL
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:50',
            'kelas' => 'nullable|string|max:50',
            'jurusan' => 'required|string|max:100',
            'instansi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'surat_pengajuan' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Simpan file PDF ke storage Laravel
        $path = $request->file('surat_pengajuan')
            ->store('surat-pengajuan-pkl', 'local');

        // Simpan data pengajuan ke database
        DB::table('pengajuan_pkls')->insert([
            'user_id' => auth()->id(),
            'nama' => $validated['nama'],
            'nis' => $validated['nis'],
            'kelas' => $validated['kelas'] ?? null,
            'jurusan' => $validated['jurusan'],
            'instansi' => $validated['instansi'],
            'alamat' => $validated['alamat'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'surat_pengajuan' => $path,
            'status' => 'Menunggu Verifikasi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/pengajuan-pkl')
            ->with('success', 'Pengajuan PKL berhasil dikirim!');
    }
}

