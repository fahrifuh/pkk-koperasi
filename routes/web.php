<?php

use App\Http\Controllers\AnggotaKoperasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('data-anggota', [AnggotaKoperasiController::class, 'index']);
    Route::get('data-anggota/create', [AnggotaKoperasiController::class, 'create']);
    Route::post('data-anggota', [AnggotaKoperasiController::class, 'store']);
    Route::get('data-anggota/{id}/edit', [AnggotaKoperasiController::class, 'edit']);
    Route::put('data-anggota/{id}', [AnggotaKoperasiController::class, 'update']);
    Route::delete('data-anggota/{id}', [AnggotaKoperasiController::class, 'destroy']);
    Route::get('data-anggota/akun', [AnggotaKoperasiController::class, 'getAkun']);
    Route::delete('data-anggota/akun/{id}', [AnggotaKoperasiController::class, 'deleteAkun']);
    Route::resource('data-warga', WargaController::class);
    Route::get('/logout', [LoginController::class, 'logout']);
});
