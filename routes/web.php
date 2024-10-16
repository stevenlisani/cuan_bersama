<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestasiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\CryptoController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AnggotaMiddleware;

Route::get('/', function () {
    return view('login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/homeLogin', [App\Http\Controllers\HomeController::class, 'indexLogin'])->name('homeLogin');

Route::get('/admin-dashboard', [HomeController::class, 'admin'])->name('admin.home')->middleware(AdminMiddleware::class);
Route::get('/anggota-dashboard', [HomeController::class, 'anggota'])->name('anggota.home')->middleware(AnggotaMiddleware::class);

Route::get('/admin-profile', [HomeController::class, 'profile'])->name('profile')->middleware(AdminMiddleware::class);
Route::put('/admin-profile-update/{user}', [HomeController::class, 'profileUpdate'])->name('profile.update')->middleware(AdminMiddleware::class);
Route::put('/admin-change-password/{user}', [HomeController::class, 'changePassword'])->name('change.password')->middleware(AdminMiddleware::class);

Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index')->middleware(AdminMiddleware::class);
Route::post('/anggota-store', [AnggotaController::class, 'store'])->name('anggota.store')->middleware(AdminMiddleware::class);
Route::put('/anggota-update/{anggota}', [AnggotaController::class, 'update'])->name('anggota.update')->middleware(AdminMiddleware::class);
Route::delete('/anggota-delete/{anggota}', [AnggotaController::class, 'delete'])->name('anggota.destroy')->middleware(AdminMiddleware::class);
Route::get('/anggota-search', [AnggotaController::class, 'search'])->name('anggota.search')->middleware(AdminMiddleware::class);

Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index')->middleware(AdminMiddleware::class);
Route::post('/keuangan-store', [KeuanganController::class, 'store'])->name('keuangan.store')->middleware(AdminMiddleware::class);
Route::put('/keuangan-update/{keuangan}', [KeuanganController::class, 'update'])->name('keuangan.update')->middleware(AdminMiddleware::class);
Route::delete('/keuangan-delete/{keuangan}', [KeuanganController::class, 'delete'])->name('keuangan.destroy')->middleware(AdminMiddleware::class);
Route::get('/keuangan-search', [KeuanganController::class, 'search'])->name('keuangan.search')->middleware(AdminMiddleware::class);

Route::get('/admin-keuangan-export', [KeuanganController::class, 'export'])->name('keuangan.export')->middleware(AdminMiddleware::class);
Route::post('/admin-keuangan-export-filter', [KeuanganController::class, 'exportFilter'])->name('keuangan.export-filter')->middleware(AdminMiddleware::class);

Route::get('/admin-investasi', [InvestasiController::class, 'index'])->name('investasi.index')->middleware(AdminMiddleware::class);
Route::post('/investasi-store', [InvestasiController::class, 'store'])->name('investasi.store')->middleware(AdminMiddleware::class);
Route::put('/investasi-update/{investasi}', [InvestasiController::class, 'update'])->name('investasi.update')->middleware(AdminMiddleware::class);
Route::delete('/investasi-delete/{investasi}', [InvestasiController::class, 'delete'])->name('investasi.destroy')->middleware(AdminMiddleware::class);
Route::get('/investasi-search', [InvestasiController::class, 'search'])->name('investasi.search')->middleware(AdminMiddleware::class);
Route::put('/investasi-selesai/{investasi}', [InvestasiController::class, 'selesai'])->name('investasi.selesai')->middleware(AdminMiddleware::class);

Route::get('/admin-harga-coin', [CryptoController::class, 'getData'])->name('harga.coin');
Route::get('/harga-coin', [CryptoController::class, 'indexAnggota'])->name('anggota-harga.coin');

Auth::routes();

Route::post('/lengkapi-store', [AnggotaController::class, 'lengkapiProfile'])->name('lengkapi.create')->middleware(AnggotaMiddleware::class);
Route::get('/lengkapi-profile', [AnggotaController::class, 'profileCreate'])->name('lengkapi.profile')->middleware(AnggotaMiddleware::class);

Route::get('/anggota-keuangan', [KeuanganController::class, 'indexAnggota'])->name('anggota.keuangan')->middleware(AnggotaMiddleware::class);
Route::post('/anggota-keuangan-store', [KeuanganController::class, 'tambahTabungan'])->name('tambah.tabungan')->middleware(AnggotaMiddleware::class);
Route::delete('/pengajuan-batal/{keuangan}', [KeuanganController::class, 'batal'])->name('keuangan.batal')->middleware(AnggotaMiddleware::class);

Route::put('/check-terima/{keuangan}', [KeuanganController::class, 'checkTerima'])->name('check.terima');
Route::put('/check-tolak/{keuangan}', [KeuanganController::class, 'checkTolak'])->name('check.tolak');

Route::get('/investasi', [InvestasiController::class, 'indexAnggota'])->name('anggota-investasi.index')->middleware(AnggotaMiddleware::class);

Route::get('/keuangan-export', [KeuanganController::class, 'exportAnggota'])->name('anggota-keuangan.export')->middleware(AnggotaMiddleware::class);
Route::post('/keuangan-export-filter', [KeuanganController::class, 'exportFilterAnggota'])->name('anggota-keuangan.export-filter')->middleware(AnggotaMiddleware::class);

Route::get('/profile', [HomeController::class, 'profileAnggota'])->name('anggota.profile')->middleware(AnggotaMiddleware::class);
Route::put('/profile-update/{user}', [HomeController::class, 'profileUpdateAnggota'])->name('anggota-profile.update')->middleware(AnggotaMiddleware::class);
Route::put('/change-password/{user}', [HomeController::class, 'changePasswordAnggota'])->name('anggota-change.password')->middleware(AnggotaMiddleware::class);
