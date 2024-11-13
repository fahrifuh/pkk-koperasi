<?php

use App\Http\Controllers\AnggotaKoperasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class])->name('dashboard');
    Route::resource('data-anggota', AnggotaKoperasiController::class);
});
