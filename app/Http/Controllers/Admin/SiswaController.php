<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $data = User::query();

        // Hanya menampilkan akun siswa
        if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'role')) {
            $data->where('role', 'user');
        }

        // Pencarian nama, email, atau NIS jika kolom tersedia
        if ($request->filled('search')) {
            $search = $request->search;

            $data->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $siswa = $data->latest()->paginate(10)->withQueryString();

        $totalSiswa = (clone $data)->count();

        return view('admin.siswa', compact(
            'siswa',
            'totalSiswa'
        ));
    }
}