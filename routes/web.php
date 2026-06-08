<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pengaduan;

/*
|--------------------------------------------------------------------------
| Web Routes - E-SAPO
|--------------------------------------------------------------------------
| Route ini hanya untuk halaman Blade.
| Proses data utama tetap lewat routes/api.php.
*/

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
})->name('home');

Route::redirect('/index', '/');


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
| Masyarakat Pages
|--------------------------------------------------------------------------
*/

Route::get('/create', function () {
    return view('create');
})->name('laporan.create');

Route::get('/show/{id}', function ($id) {
    $pengaduan = Pengaduan::with([
        'user:id,name',
        'desa:id,nama_desa',
    ])->findOrFail($id);

    $pengaduan->foto_url = $pengaduan->foto
        ? asset('storage/' . $pengaduan->foto)
        : null;

    return view('show', [
        'id' => $id,
        'pengaduan' => $pengaduan,
    ]);
})->name('laporan.show');


/*
|--------------------------------------------------------------------------
| Admin Pages
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/pengaduan', function () {
        return view('admin.index');
    })->name('pengaduan.index');

    Route::redirect('/', '/admin/dashboard');
});


/*
|--------------------------------------------------------------------------
| Fallback
|--------------------------------------------------------------------------
| Kalau user buka URL web yang tidak ada, balikin ke home.
*/

Route::fallback(function () {
    return redirect()->route('home');
});