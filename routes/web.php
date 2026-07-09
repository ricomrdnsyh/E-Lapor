<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SsoController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUnitController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminHistoryLaporanController;
use App\Http\Controllers\Admin\AdminGedungController;
use App\Http\Controllers\Admin\AdminLantaiController;
use App\Http\Controllers\Admin\AdminFungsiRuanganController;
use App\Http\Controllers\Admin\AdminRuanganController;
use App\Http\Controllers\Admin\AdminSubKategoriController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminPanduanController;
use App\Http\Controllers\Unit\UnitDashboardController;
use App\Http\Controllers\Unit\UnitHistoryLaporanController;
use App\Http\Controllers\Unit\UnitPanduanController;
use App\Http\Controllers\Pimpinan\PimpinanDashboardController;
use App\Http\Controllers\Pimpinan\PimpinanHistoryLaporanController;
use App\Http\Controllers\Pimpinan\PimpinanPanduanController;
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
Route::get('/statistik/data', [StatistikController::class, 'getData'])->name('statistik.data');
Route::get('/lapor', [LaporController::class, 'index'])->name('lapor');
Route::post('/lapor', [LaporController::class, 'store'])->name('lapor.store');
Route::get('/lapor/data/units', [LaporController::class, 'getUnits'])->name('lapor.units');
Route::get('/lapor/data/categories', [LaporController::class, 'getCategories'])->name('lapor.categories');
Route::get('/lapor/data/gedungs', [LaporController::class, 'getGedungs'])->name('lapor.gedungs');
Route::get('/lapor/data/lantai', [LaporController::class, 'getLantaiByGedung'])->name('lapor.lantai');
Route::get('/lapor/data/subkategori', [LaporController::class, 'getSubKategoris'])->name('lapor.subkategoris');
Route::get('/lapor/data/ruangan', [LaporController::class, 'getRuanganByLantai'])->name('lapor.ruangan');
Route::get('/lapor/captcha', [LaporController::class, 'generateCaptcha'])->name('lapor.captcha');
Route::get('/lacak', [LacakController::class, 'index'])->name('lacak');

Route::get('/login-admin', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/sso', [SsoController::class, 'sso']);
Route::get('/sso/lapor', [SsoController::class, 'lapor']);
Route::get('/sso/admin', [SsoController::class, 'admin']);
Route::get('/sso/pilih', [SsoController::class, 'pilih'])->name('sso.pilih');
Route::get('/sso/pilih/dashboard', [SsoController::class, 'pilihDashboard'])->name('sso.pilih.dashboard');
Route::get('/sso/pilih/lapor', [SsoController::class, 'pilihLapor'])->name('sso.pilih.lapor');
Route::get('/sso/logout/{sessionId}', [SsoController::class, 'logout']);

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/unit-data', [AdminDashboardController::class, 'getUnitChartData'])->name('dashboard.unit-data');

    Route::get('/unit/data', [AdminUnitController::class, 'getUnit'])->name('unit.data');
    Route::post('/unit/sinkronisasi', [AdminUnitController::class, 'syncFromApi'])->name('unit.sync');
    Route::resource('unit', AdminUnitController::class, ['only' => ['index', 'show', 'edit', 'update', 'destroy']]);

    Route::get('/kategori/data', [AdminKategoriController::class, 'getKategori'])->name('kategori.data');
    Route::resource('kategori', AdminKategoriController::class);

    Route::get('/gedung/data', [AdminGedungController::class, 'getGedung'])->name('gedung.data');
    Route::resource('gedung', AdminGedungController::class);

    Route::get('/lantai/data', [AdminLantaiController::class, 'getLantai'])->name('lantai.data');
    Route::resource('lantai', AdminLantaiController::class);

    Route::get('/fungsi-ruangan/data', [AdminFungsiRuanganController::class, 'getFungsiRuangan'])->name('fungsi-ruangan.data');
    Route::resource('fungsi-ruangan', AdminFungsiRuanganController::class);

    Route::get('/ruangan/data', [AdminRuanganController::class, 'getRuangan'])->name('ruangan.data');
    Route::resource('ruangan', AdminRuanganController::class);

    Route::get('/sub-kategori/data', [AdminSubKategoriController::class, 'getSubKategori'])->name('sub-kategori.data');
    Route::resource('sub-kategori', AdminSubKategoriController::class);

    Route::get('/laporan/data', [AdminLaporanController::class, 'getLaporan'])->name('laporan.data');
    Route::resource('laporan', AdminLaporanController::class, ['only' => ['index', 'show', 'edit', 'update']]);

    Route::get('/history-laporan/data', [AdminHistoryLaporanController::class, 'getHistoryLaporan'])->name('history-laporan.data');
    Route::resource('history-laporan', AdminHistoryLaporanController::class, ['only' => ['index', 'show', 'edit', 'update']]);

    Route::get('/panduan/data', [AdminPanduanController::class, 'getPanduan'])->name('panduan.data');
    Route::resource('panduan', AdminPanduanController::class);

    Route::get('/users/karyawan-api', [AdminUserController::class, 'getKaryawanApi'])->name('users.karyawan-api');
    Route::get('/users/data', [AdminUserController::class, 'getUsers'])->name('users.data');
    Route::resource('users', AdminUserController::class);
});

Route::prefix('unit')->name('unit.')->middleware(['auth', 'role:unit'])->group(function () {
    Route::get('/dashboard', [UnitDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/sub-kategori-data', [UnitDashboardController::class, 'getSubKategoriData'])->name('dashboard.sub-kategori-data');
    Route::get('/history-laporan/data', [UnitHistoryLaporanController::class, 'getHistoryLaporan'])->name('history-laporan.data');
    Route::resource('history-laporan', UnitHistoryLaporanController::class, ['only' => ['index', 'show', 'edit', 'update']]);

    Route::get('/panduan', [UnitPanduanController::class, 'index'])->name('panduan.index');
});

Route::prefix('pimpinan')->name('pimpinan.')->middleware(['auth', 'role:pimpinan'])->group(function () {
    Route::get('/dashboard', [PimpinanDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/sub-kategori-data', [PimpinanDashboardController::class, 'getSubKategoriData'])->name('dashboard.sub-kategori-data');
    Route::get('/history-laporan/data', [PimpinanHistoryLaporanController::class, 'getHistoryLaporan'])->name('history-laporan.data');
    Route::resource('history-laporan', PimpinanHistoryLaporanController::class, ['only' => ['index', 'show']]);

    Route::get('/panduan', [PimpinanPanduanController::class, 'index'])->name('panduan.index');
});
