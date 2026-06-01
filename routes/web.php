<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pengaduan;

// Ubah yang tadinya 'welcome' menjadi 'index'
Route::get('/', function () {
    return view('index'); 
});

// Jalur login, register, dll tetap di bawahnya...
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});

Route::get('/create', function () {
    return view('create');
});

Route::get('/show/{id}', function ($id) {
    return view('show', ['id' => $id]);
});

Route::get('/show/{id}', function ($id) {
    $pengaduan = Pengaduan::with(['user', 'desa', 'rtrw'])->findOrFail($id);
    return view('show', compact('pengaduan'));
});