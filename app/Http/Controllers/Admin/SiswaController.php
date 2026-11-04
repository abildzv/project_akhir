<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        //Mengambil akun dengan role siswa
        $data = User::where('role', 'siswa');

        //Fitur pencarian nama dan email
        if ($request->filled('search')) {
            $search = $request->search;

            $data->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            });
        }

        //Menghitung total seluruh siswa
        $totalSiswa = User::where('role', 'siswa')->count();

        //Mengambil data siswa terbaru
        $siswa = $data->latest()
                      ->paginate(10)
                      ->withQueryString();
        
        return view('admin.siswa', compact(
            'siswa', 
            'totalSiswa'
        ));
    }
}