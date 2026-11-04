<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\SiswaCekStatusController;
use App\Http\Controllers\SiswaProfileController;
use App\Http\Controllers\SiswaPengajuanController;

Route::view('/', 'home')->name('home');
Route::get('/home', function () {
    return view('home');
})->name('home.page');

/*
|--------------------------------------------------------------------------
| Halaman Siswa
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard-siswa', [SiswaDashboardController::class, 'index'])
        ->name('siswa.dashboard');

    // Pengajuan PKL
    Route::get('/pengajuan-pkl', [SiswaPengajuanController::class, 'create'])
        ->name('siswa.pengajuan');

    Route::post('/pengajuan-pkl', [SiswaPengajuanController::class, 'store'])
        ->name('siswa.pengajuan.store');

    // Cek status
    Route::get('/cek-status', [SiswaCekStatusController::class, 'index'])
        ->name('siswa.cek-status');

    Route::get('/cek-status/{id}/dokumen', [SiswaCekStatusController::class, 'dokumen'])
        ->whereNumber('id')
        ->name('siswa.cek-status.dokumen');

    // Profile
    Route::get('/profile', [SiswaProfileController::class, 'index'])->name('siswa.profile');
Route::put('/profile', [SiswaProfileController::class, 'update'])->name('siswa.profile.update');
Route::put('/profile/password', [SiswaProfileController::class, 'updatePassword'])->name('siswa.profile.password');
Route::post('/profile/foto', [SiswaProfileController::class, 'updateFoto'])->name('siswa.profile.foto');
});
/*
|--------------------------------------------------------------------------
| Halaman Admin
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->group(function () {

    // Data pengajuan PKL
    Route::get('/pengajuan', [PengajuanController::class, 'index'])
        ->name('pengajuan.index');

    Route::get('/pengajuan/{id}', [PengajuanController::class, 'show'])
        ->name('pengajuan.show');

    Route::patch('/pengajuan/{id}/status', [PengajuanController::class, 'updateStatus'])
        ->name('pengajuan.updateStatus');

    // Data laporan PKL
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    // Data siswa
    Route::get('/siswa', [SiswaController::class, 'index'])
        ->name('siswa.index');

    // Pengaturan
    Route::get('/pengaturan', [PengaturanController::class, 'index'])
        ->name('pengaturan.index');

    Route::put('/pengaturan/profil', [PengaturanController::class, 'updateProfil'])
        ->name('pengaturan.profil.update');

    Route::put('/pengaturan/password', [PengaturanController::class, 'updatePassword'])
        ->name('pengaturan.password.update');
});

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');

    Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.process');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');