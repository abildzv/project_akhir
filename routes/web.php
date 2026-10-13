<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/pengajuan', [
        PengajuanController::class,
        'index'
    ])->name('pengajuan.index');

    Route::get('/pengajuan/{id}', [
        PengajuanController::class,
        'show'
    ])->name('pengajuan.show');

    Route::patch('/pengajuan/{id}/status', [
        PengajuanController::class,
        'updateStatus'
    ])->name('pengajuan.updateStatus');

    Route::get('/laporan', [
    LaporanController::class,
        'index'
    ])->name('laporan.index');

    Route::get('/siswa', [SiswaController::class, 'index'])
    ->name('siswa.index');

    Route::get('/pengaturan', [PengaturanController::class, 'index'])
    ->name('pengaturan.index');

    Route::put('/pengaturan/profil', [PengaturanController::class, 'updateProfil'])
    ->name('pengaturan.profil.update');

    Route::put('/pengaturan/password', [PengaturanController::class, 'updatePassword'])
    ->name('pengaturan.password.update');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.process');

    Route::get('/register', [RegisterController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.process');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');