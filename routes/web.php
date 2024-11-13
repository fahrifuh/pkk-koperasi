<?php

use App\Http\Controllers\AnggotaKoperasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('data-anggota', AnggotaKoperasiController::class);
