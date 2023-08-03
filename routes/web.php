<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\DataAdminController;

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
    return view('Auth.login');
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
});

Route::group(["prefix" => "karyawan", "middleware" => ['auth', 'verified', 'role:karyawab']], function () {
    Route::get('/karyawan_absensi', [AbsensiController::class, 'index'])->name('karyawan.absensi');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
