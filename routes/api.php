<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\Api\WilayahController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - E-SAPO
|--------------------------------------------------------------------------
| Public  = bisa diakses tanpa login
| Private = wajib login pakai Bearer Token Sanctum
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
| Login, register, dan data desa untuk dropdown form.
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/desa', [WilayahController::class, 'getDesa']);


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
| Semua route di bawah ini wajib login pakai Bearer Token Sanctum.
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | AUTH
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout']);


    /*
    |--------------------------------------------------------------------------
    | MASYARAKAT ROUTES
    |--------------------------------------------------------------------------
    | Role masyarakat hanya boleh membuat pengaduan.
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:masyarakat')->group(function () {
        Route::post('/pengaduan', [PengaduanController::class, 'store']);
    });


    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    | Role admin bisa melihat, mengubah status, dan menghapus pengaduan.
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->middleware('role:admin')
        ->group(function () {
            Route::get('/pengaduan', [PengaduanController::class, 'index']);
            Route::get('/pengaduan/{id}', [PengaduanController::class, 'show']);
            Route::put('/pengaduan/{id}', [PengaduanController::class, 'update']);
            Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy']);
        });
});