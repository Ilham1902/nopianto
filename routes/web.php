<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('login');
})->middleware(['guest'])->name('login');

Route::get('/absensi', function () {
    if (auth()->user()->HasRole('admin')) {
        return redirect()->route('admin.absensi');
    } else {
        return redirect()->route('karyawan.absensi');
    }
})->middleware(['auth', 'verified'])->name('absensi');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'role:admin']], function () {
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('admin.absensi');
    Route::post('/simpanAbsensi', [AbsensiController::class, 'simpanAbsensi'])->name('simpanAbsensi');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
