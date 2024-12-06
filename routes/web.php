<?php

use App\Http\Controllers\AnggotaKoperasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\WargaController;
use App\Http\Middleware\RoleCheck;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

Route::middleware(['auth', RoleCheck::class . ':admin,warga'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('data-anggota/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
});

Route::middleware(['auth', RoleCheck::class . ':admin'])->group(function () {
    Route::get('data-anggota', [AnggotaKoperasiController::class, 'index'])->name('data-anggota.index');
    Route::get('data-anggota/create', [AnggotaKoperasiController::class, 'create'])->name('data-anggota.create');
    Route::post('data-anggota', [AnggotaKoperasiController::class, 'store'])->name('data-anggota.store');
    Route::get('data-anggota/{id}/edit', [AnggotaKoperasiController::class, 'edit'])->name('data-anggota.edit');
    Route::put('data-anggota/{id}', [AnggotaKoperasiController::class, 'update'])->name('data-anggota.update');
    Route::delete('data-anggota/{id}', [AnggotaKoperasiController::class, 'destroy'])->name('data-anggota.destroy');
    Route::get('data-anggota/akun', [AnggotaKoperasiController::class, 'getAkun']);
    Route::delete('data-anggota/akun/{id}', [AnggotaKoperasiController::class, 'deleteAkun']);
    Route::resource('data-warga', WargaController::class);
    Route::get('data-anggota/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('data-anggota/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('data-anggota/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('data-anggota/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('data-anggota/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('data-anggota/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});
