<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaProfileController extends Controller
{
    public function index()
    {
        // Data sementara untuk menampilkan desain profil.
        // Nantinya dapat diganti dengan data dari database.

        $profile = [
            'nama' => 'Nayla Zumrotusa’adah',
            'nisn' => '-',
            'kelas' => 'XI RPL C',
            'sekolah' => 'SMK Negeri 2 Trenggalek',
            'jurusan' => 'Rekayasa Perangkat Lunak (RPL)',
            'email' => auth()->user()?->email ?? '-',
            'telepon' => '-',
            'tempat_lahir' => '-',
            'tanggal_lahir' => '-',
            'jenis_kelamin' => '-',
            'alamat' => '-',
            'tempat_pkl' => 'PT Hummatech, Malang',
            'periode_pkl' => '1 Juli 2026 - 31 Desember 2026',
            'pembimbing' => 'Belum ditentukan',
            'foto' => null,
        ];

        $siswa = [
            'nama' => $profile['nama'],
            'kelas' => $profile['kelas'],
        ];

        return view('siswa.profile', compact('profile', 'siswa'));
    }
}