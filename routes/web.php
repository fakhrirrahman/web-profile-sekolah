<?php

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
Route::view('/login', 'pages.auth.login')->name('login');
