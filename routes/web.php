<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\FAQController;
use App\Http\Controllers\Landing\AlurController;
use App\Http\Controllers\Landing\LaporController;
use App\Http\Controllers\Landing\BerandaController;
use App\Http\Controllers\Landing\KategoriController;

Route::get('/', [BerandaController::class, 'beranda'])->name('beranda');
Route::get('/kategori', [KategoriController::class, 'kategori'])->name('kategori');
Route::get('/alur', [AlurController::class, 'alur'])->name('alur');
Route::get('/faq', [FAQController::class, 'faq'])->name('faq');
Route::get('/lapor', [LaporController::class, 'index'])->name('lapor');
