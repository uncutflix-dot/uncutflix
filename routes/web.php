<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AdminController;
use App\Models\Movie;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute Khusus Login Administrator
Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'store']);

// Halaman Utama / Beranda (Bebas Diakses Tanpa Login agar Iklan Lancar)
Route::get('/', function () {
    $movies = Movie::latest()->get();
    return view('welcome', compact('movies'));
})->name('welcome');

// Dashboard Pengguna Biasa
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute Khusus Admin (Dilindungi Auth & AdminMiddleware)
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    
    // Dashboard Admin (Lengkap dengan data $movies)
    Route::get('/admin', function () {
        $movies = Movie::latest()->get();
        return view('admin.dashboard', compact('movies'));
    })->name('admin.dashboard');

    // Rute Tambah Film
    Route::get('/tambah-film', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/tambah-film', [MovieController::class, 'store'])->name('movies.store');
    
    // Rute Edit & Update Film
    Route::get('/film/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/film/{id}', [MovieController::class, 'update'])->name('movies.update');

    // Rute Hapus Film
    Route::delete('/film/{id}', [MovieController::class, 'destroy'])->name('movies.destroy');

    // Rute Tambah Banner & Iklan Admin
    Route::post('/admin/banner', [AdminController::class, 'storeBanner'])->name('admin.banner.store');
    Route::post('/admin/ad', [AdminController::class, 'storeAd'])->name('admin.ad.store');
});

// Rute Autentikasi Sosial Media (Google, Facebook, LINE)
Route::get('/auth/{provider}', [SocialController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialController::class, 'callback'])->name('social.callback');

// Memuat rute bawaan Laravel Breeze (login, register, dll)
require __DIR__.'/auth.php';