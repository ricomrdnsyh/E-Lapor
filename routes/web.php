<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\LandingController;

Route::get('/', [LandingController::class, 'beranda'])->name('beranda');
Route::get('/create-laporan', [LandingController::class, 'createLaporan'])->name('createLaporan');
