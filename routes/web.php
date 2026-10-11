<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\SiswaController;

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
});