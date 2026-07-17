<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $news = \App\Models\News::query()->where('is_active', true)->latest()->take(2)->get();
    $galleryItems = \App\Models\GalleryItem::query()->where('is_active', true)->latest()->take(4)->get();
    return view('pages.home', compact('news', 'galleryItems'));
});

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

Route::get('/berita', [NewsController::class, 'index'])->name('berita');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri');
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
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    Route::resource('gallery-items', \App\Http\Controllers\Admin\GalleryItemController::class);
});
