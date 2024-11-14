<?php

use App\Http\Controllers\Api\AnggotaKoperasiController;
use App\Http\Controllers\Api\LoginController;
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

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
// Route::apiResource('data-anggota', AnggotaKoperasiController::class);

