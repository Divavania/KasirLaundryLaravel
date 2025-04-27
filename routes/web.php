<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesananController; // Tambahkan ini!
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute dashboard untuk superadmin dan admin
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/superadmin/dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('layanan', LayananController::class);

    Route::resource('pelanggan', PelangganController::class);

    Route::resource('admin', AdminController::class);

    Route::resource('pesanan', PesananController::class);
    
    Route::put('pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.update.status');

    Route::get('pesanan/{id}/cetak', [PesananController::class, 'cetakNota'])->name('pesanan.cetak');


});

