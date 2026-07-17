<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PpdbRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/berita/{news:slug}', [HomeController::class, 'beritaShow'])->name('berita.show');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/ppdb', [HomeController::class, 'ppdb'])->name('ppdb');
Route::post('/ppdb', [PpdbRegistrationController::class, 'store'])->name('ppdb.store');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::redirect('/dashboard', '/admin')
    ->middleware('auth')
    ->name('dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    Route::resource('gallery-items', \App\Http\Controllers\Admin\GalleryItemController::class);
    Route::resource('ppdb-registrations', \App\Http\Controllers\Admin\PpdbRegistrationController::class)
        ->only(['index', 'update', 'destroy']);
});
