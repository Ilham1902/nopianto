<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\DataAdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Karyawan\AbsensiKaryawanController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
})->middleware(['guest']);

Route::get('/absensi', function () {
    if (auth()->user()->HasRole('admin')) {
        return redirect()->route('admin.absensi');
    } else {
        return redirect()->route('karyawan.absensi');
    }
})->middleware(['auth', 'verified'])->name('absensi');

Route::group([['auth', 'verified', 'role:admin']], function () {
    // Absensi
    Route::get('/admin_absensi', [AbsensiController::class, 'index'])->name('admin.absensi');
    Route::get('/data_absensi', [AbsensiController::class, 'GetAll'])->name('data_absensi');
    Route::post('/search', [AbsensiController::class, 'Search'])->name('search');

    // Data Karyawan
    Route::get('/data_karyawan', [KaryawanController::class, 'index'])->name('data_karyawan');
    Route::get('/ubah_karyawan/{id}', [KaryawanController::class, 'edit']);
    Route::post('/ubah_status', [KaryawanController::class, 'ubah_status'])->name('ubah_status');
    Route::post('/edit_barcode', [KaryawanController::class, 'edit_barcode'])->name('edit_barcode');
    Route::post('/UpdateKaryawan', [KaryawanController::class, 'UpdateKaryawan'])->name('UpdateKaryawan');
    Route::get('/tambahKaryawan', [KaryawanController::class, 'create'])->name('tambahKaryawan');
    Route::post('/tambahKaryawan', [KaryawanController::class, 'store'])->name('tambahKaryawan');

    // Data Admin
    Route::get('/data_admin', [DataAdminController::class, 'index'])->name('data_admin');
    Route::get('/tambahAdmin', [DataAdminController::class, 'create'])->name('tambahAdmin');
    Route::post('/tambahAdmin', [DataAdminController::class, 'store'])->name('tambahAdmin');
    Route::get('/ubah_admin/{id}', [DataAdminController::class, 'edit']);
    Route::post('/UpdateAdmin', [DataAdminController::class, 'UpdateAdmin'])->name('UpdateAdmin');

    // Info Akun
    Route::get('/info_akunAdmin', [UserController::class, 'akunAdmin'])->name('akunAdmin');
    Route::get('/editAkunAdmin', [UserController::class, 'editAkunAdmin'])->name('editAkunAdmin');
    Route::post('/UpdateAkun', [UserController::class, 'UpdateAkun'])->name('UpdateAkun');
});

Route::group(["prefix" => "karyawan", "middleware" => ['auth', 'verified', 'role:karyawan']], function () {
    Route::get('/karyawan_absensi', [AbsensiKaryawanController::class, 'index'])->name('karyawan.absensi');
    Route::get('/info_akunKaryawan', [UserController::class, 'akunKaryawan'])->name('akunKaryawan');
    Route::get('/editAkunKaryawan', [UserController::class, 'editAkunKaryawan'])->name('editAkunKaryawan');
    Route::post('/UpdateAkun', [UserController::class, 'UpdateAkunKaryawan'])->name('UpdateAkunKaryawan');
});

require __DIR__ . '/auth.php';
