<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiswaDashboardController;

Route::get('/dashboard-siswa', [
    SiswaDashboardController::class,
    'index'
])->name('siswa.dashboard');

Route::get('/pengajuan-pkl', function () {
    return view('siswa.pengajuan-pkl');
})->name('siswa.pengajuan');

Route::get('/', function () {
    return view('welcome');
});
