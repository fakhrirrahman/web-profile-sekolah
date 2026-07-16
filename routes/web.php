<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');
