<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\Api\WilayahController;
use Illuminate\Support\Facades\Route;

// --- JALUR PUBLIC (Bisa diakses tanpa login) ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// --- JALUR PROTECTED (Wajib Login / Menyertakan Bearer Token) ---
Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);

    // Mengambil data wilayah untuk pilihan di Form Pengaduan
    Route::get('/desa', [WilayahController::class, 'getDesa']);
    Route::get('/desa/{desa_id}/rtrw', [WilayahController::class, 'getRtrwByDesa']);

    // Aksi masyarakat mengirim pengaduan
    Route::post('/pengaduan', [PengaduanController::class, 'store']);

    // Aksi CRUD Admin Panel
    Route::get('/admin/pengaduan', [PengaduanController::class, 'index']);          // Lihat Semua
    Route::get('/admin/pengaduan/{id}', [PengaduanController::class, 'show']);     // Lihat Detail Satu Data
    Route::put('/admin/pengaduan/{id}', [PengaduanController::class, 'update']);   // Edit Status Laporan
    Route::delete('/admin/pengaduan/{id}', [PengaduanController::class, 'destroy']); // Hapus Laporan
});