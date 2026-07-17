<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

Route::view('/berita', 'pages.berita')->name('berita');
Route::view('/galeri', 'pages.galeri')->name('galeri');
Route::view('/ppdb', 'pages.ppdb')->name('ppdb');
Route::view('/kontak', 'pages.kontak')->name('kontak');

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
});
