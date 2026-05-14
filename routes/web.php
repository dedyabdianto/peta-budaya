<?php

use App\Http\Controllers\BeritaImageController;
use App\Http\Controllers\PetaDigitalController;
use Illuminate\Support\Facades\Route;

// Landing Page Routes
Route::view('/', 'pages.landing.beranda')->name('home');
Route::view('/tentang-budaya', 'pages.landing.tentang-budaya')->name('landing.tentang-budaya');
Route::livewire('/daftar-cagar-budaya', 'pages::landing.daftar-warisan')->name('landing.daftar-warisan');
Route::livewire('/cagar-budaya/{id}', 'pages::landing.detail-cagar-budaya')->name('landing.cagar-budaya.detail');
Route::livewire('/galeri-warisan', 'pages::landing.galeri-warisan')->name('landing.galeri-warisan');
Route::livewire('/galeri/{id}', 'pages::landing.detail-galeri')->name('landing.galeri.detail');
Route::view('/lapor-situs', 'pages.landing.lapor-situs')->name('landing.lapor-situs');
Route::get('/peta-digital', PetaDigitalController::class)->name('landing.peta-digital');

Route::middleware(['auth'])->group(function () {
    Route::livewire('dashboard', 'pages::admin.index')->name('dashboard');
    Route::livewire('/kategori-budaya', 'pages::kategori.index')->name('kategori-budaya.index');
    Route::livewire('/cagar-budaya', 'pages::cagar.index')->name('cagar-budaya.index');
    // Route::livewire('/kategori-budaya/create', 'pages::kategori.create')->name('kategori-budaya.create');
    Route::livewire('/kelola-peta', 'pages::peta.index')->name('peta.index');
    Route::livewire('/kelola-warisan', 'pages::warisan.index')->name('warisan.index');
    Route::livewire('/kelola-galeri', 'pages::galeri.index')->name('galeri.index');
    Route::livewire('/kelola-berita', 'pages::berita.index')->name('berita.index');
    Route::livewire('/kelola-berita/tulis', 'pages::berita.create')->name('berita.create');
    Route::livewire('/kelola-berita/{berita}/edit', 'pages::berita.edit')->name('berita.edit');
    Route::post('/admin/berita/upload-image', [BeritaImageController::class, 'store'])->name('berita.upload-image');
    Route::livewire('/verifikasi-laporan', 'pages::verifikasi.index')->name('verifikasi.index');
    Route::livewire('/pengaturan', 'pages::pengaturan.index')->name('pengaturan.index');
});

require __DIR__.'/settings.php';
