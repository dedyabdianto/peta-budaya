<?php

use Illuminate\Support\Facades\Route;

// Landing Page Routes
Route::view('/', 'pages.landing.beranda')->name('home');
Route::view('/tentang-budaya', 'pages.landing.tentang-budaya')->name('landing.tentang-budaya');
Route::view('/daftar-warisan', 'pages.landing.daftar-warisan')->name('landing.daftar-warisan');
Route::view('/galeri-warisan', 'pages.landing.galeri-warisan')->name('landing.galeri-warisan');
Route::view('/lapor-situs', 'pages.landing.lapor-situs')->name('landing.lapor-situs');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'pages.admin.dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
