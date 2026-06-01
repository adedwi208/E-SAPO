<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route halaman utama E-SAPO ditaruh di sini.
*/

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
})->name('home');

/*
|--------------------------------------------------------------------------
| Auth Pages
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

/*
|--------------------------------------------------------------------------
| Laporan Sampah
|--------------------------------------------------------------------------
*/

Route::get('/create', function () {
    return view('create');
})->name('laporan.create');

Route::get('/show/{id}', function ($id) {
    return view('show', [
        'id' => $id
    ]);
})->name('laporan.show');

/*
|--------------------------------------------------------------------------
| Redirect Tambahan
|--------------------------------------------------------------------------
| Kalau user buka /index, langsung diarahkan ke halaman utama.
*/

Route::redirect('/index', '/');