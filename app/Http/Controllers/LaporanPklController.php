<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LaporanPklController extends Controller
{
    public function index(): View
    {
        $laporans = [];

        return view('siswa.upload-laporan', compact('laporans'));
    }
}


