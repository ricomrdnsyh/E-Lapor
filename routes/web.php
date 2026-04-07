<?php

use App\Http\Controllers\Admin\AdminUnitController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminLaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\FAQController;
use App\Http\Controllers\Landing\AlurController;
use App\Http\Controllers\Landing\LacakController;
use App\Http\Controllers\Landing\LaporController;
use App\Http\Controllers\Landing\BerandaController;
use App\Http\Controllers\Landing\KategoriController;

Route::get('/', [BerandaController::class, 'beranda'])->name('beranda');
Route::get('/kategori', [KategoriController::class, 'kategori'])->name('kategori');
Route::get('/alur', [AlurController::class, 'alur'])->name('alur');
Route::get('/faq', [FAQController::class, 'faq'])->name('faq');
Route::get('/lapor', [LaporController::class, 'index'])->name('lapor');
Route::post('/lapor', [LaporController::class, 'store'])->name('lapor.store');
Route::get('/lapor/data/categories', [LaporController::class, 'getCategories'])->name('lapor.categories');
Route::get('/lacak', [LacakController::class, 'index'])->name('lacak');

Route::prefix('admin')->name('admin.')->group(function () {

    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/unit/data', [AdminUnitController::class, 'getUnit'])->name('unit.data');
    Route::resource('unit', AdminUnitController::class);

    Route::get('/kategori/data', [AdminKategoriController::class, 'getKategori'])->name('kategori.data');
    Route::resource('kategori', AdminKategoriController::class);

    Route::get('/laporan/data', [AdminLaporanController::class, 'getLaporan'])->name('laporan.data');
    Route::resource('laporan', AdminLaporanController::class, ['only' => ['index', 'show', 'edit', 'update', 'destroy']]);
});
