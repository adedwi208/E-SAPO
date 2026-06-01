<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\Api\WilayahController;
use Illuminate\Support\Facades\Route;

// --- JALUR PUBLIC ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Halaman index bisa diakses siapa saja tanpa login
Route::get('/pengaduan',        [PengaduanController::class, 'index']);
Route::get('/pengaduan/stats',  [PengaduanController::class, 'stats']);

// --- JALUR PROTECTED ---
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/desa',              [WilayahController::class, 'getDesa']);
    Route::get('/desa/{desa_id}/rtrw', [WilayahController::class, 'getRtrwByDesa']);

    Route::post('/pengaduan',           [PengaduanController::class, 'store']);

    // Admin
    Route::get('/admin/pengaduan/{id}',    [PengaduanController::class, 'show']);
    Route::put('/admin/pengaduan/{id}',    [PengaduanController::class, 'update']);
    Route::delete('/admin/pengaduan/{id}', [PengaduanController::class, 'destroy']);
});