<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SsoController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUnitController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminHistoryLaporanController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Unit\UnitDashboardController;
use App\Http\Controllers\Unit\UnitHistoryLaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\FAQController;
use App\Http\Controllers\Landing\AlurController;
use App\Http\Controllers\Landing\LacakController;
use App\Http\Controllers\Landing\LaporController;
use App\Http\Controllers\Landing\BerandaController;
use App\Http\Controllers\Landing\KategoriController;
use App\Http\Controllers\Landing\StatistikController;

Route::get('log-viewer', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/', [BerandaController::class, 'beranda'])->name('beranda');
Route::get('/kategori', [KategoriController::class, 'kategori'])->name('kategori');
Route::get('/alur', [AlurController::class, 'alur'])->name('alur');
Route::get('/faq', [FAQController::class, 'faq'])->name('faq');
Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');
Route::get('/lapor', [LaporController::class, 'index'])->name('lapor');
Route::post('/lapor', [LaporController::class, 'store'])->name('lapor.store');
Route::get('/lapor/data/categories', [LaporController::class, 'getCategories'])->name('lapor.categories');
Route::get('/lapor/captcha', [LaporController::class, 'generateCaptcha'])->name('lapor.captcha');
Route::get('/lacak', [LacakController::class, 'index'])->name('lacak');

Route::get('/login-admin', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/sso', [SsoController::class, 'sso']);
Route::get('/sso/lapor', [SsoController::class, 'lapor']);
Route::get('/sso/admin', [SsoController::class, 'admin']);
Route::get('/sso/logout/{sessionId}', [SsoController::class, 'logout']);

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/unit/data', [AdminUnitController::class, 'getUnit'])->name('unit.data');
    Route::post('/unit/sinkronisasi', [AdminUnitController::class, 'syncFromApi'])->name('unit.sync');
    Route::resource('unit', AdminUnitController::class, ['only' => ['index', 'show', 'destroy']]);

    Route::get('/kategori/data', [AdminKategoriController::class, 'getKategori'])->name('kategori.data');
    Route::resource('kategori', AdminKategoriController::class);

    Route::get('/laporan/data', [AdminLaporanController::class, 'getLaporan'])->name('laporan.data');
    Route::resource('laporan', AdminLaporanController::class, ['only' => ['index', 'show', 'edit', 'update']]);

    Route::get('/history-laporan/data', [AdminHistoryLaporanController::class, 'getHistoryLaporan'])->name('history-laporan.data');
    Route::resource('history-laporan', AdminHistoryLaporanController::class, ['only' => ['index', 'show', 'edit', 'update']]);

    Route::get('/users/karyawan-api', [AdminUserController::class, 'getKaryawanApi'])->name('users.karyawan-api');
    Route::get('/users/data', [AdminUserController::class, 'getUsers'])->name('users.data');
    Route::resource('users', AdminUserController::class);
});

Route::prefix('unit')->name('unit.')->middleware(['auth', 'role:unit'])->group(function () {
    Route::get('/dashboard', [UnitDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/history-laporan/data', [UnitHistoryLaporanController::class, 'getHistoryLaporan'])->name('history-laporan.data');
    Route::resource('history-laporan', UnitHistoryLaporanController::class, ['only' => ['index', 'show', 'edit', 'update']]);
});
