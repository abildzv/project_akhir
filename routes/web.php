
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\LaporanPklController;
use App\Http\Controllers\SiswaDashboardController;


Route::view('/', 'home')->name('home');
Route::get('/home', function () {
    return view('home');
})->name('home.page');

/*
|--------------------------------------------------------------------------
| Halaman Siswa
|--------------------------------------------------------------------------
*/

Route::get('/dashboard-siswa', [
    SiswaDashboardController::class,
    'index'
])->name('siswa.dashboard');

Route::get('/pengajuan-pkl', function () {
    return view('siswa.pengajuan-pkl');
})->name('siswa.pengajuan');

Route::get('/upload-laporan', [
    LaporanPklController::class,
    'index'
])->name('siswa.laporan.index');

Route::post('/upload-laporan', [
    LaporanPklController::class,
    'store'
])->name('laporan.store');

/*
|--------------------------------------------------------------------------
| Halaman Admin
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [
    DashboardController::class,
    'index'
])->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->group(function () {

    // Data pengajuan PKL
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

    // Data laporan PKL
    Route::get('/laporan', [
        LaporanController::class,
        'index'
    ])->name('laporan.index');

    // Data siswa
    Route::get('/siswa', [
        SiswaController::class,
        'index'
    ])->name('siswa.index');

});