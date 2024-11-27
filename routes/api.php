<?php

use App\Http\Controllers\Api\AnggotaKoperasiController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\WargaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('data-anggota', [AnggotaKoperasiController::class, 'index']);
Route::get('data-anggota/{id}', [AnggotaKoperasiController::class, 'show']);
Route::post('data-anggota', [AnggotaKoperasiController::class, 'store']);
Route::put('data-anggota/{id}', [AnggotaKoperasiController::class, 'update']);
Route::delete('data-anggota/{id}', [AnggotaKoperasiController::class, 'destroy']);
Route::get('akun', [AnggotaKoperasiController::class, 'getAkun']);
Route::apiResource('data-warga', WargaController::class);
Route::apiResource('transaksi', TransaksiController::class);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
