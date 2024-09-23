<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeperluanController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\PertanyaanController;

// Auth::routes();
// Disable Register
Auth::routes(['register' => false]);

Route::get('/', [TamuController::class, 'index'])->name('home');
Route::post('/tamu/simpan', [TamuController::class, 'store'])->name('store_tamu');

Route::get('/survey', [TamuController::class, 'survey'])->name('survey');
Route::get('/survey/{id}', [TamuController::class, 'showsurvey'])->name('isi_survey');
Route::post('/survey/{id}', [TamuController::class, 'storesurvey'])->name('store_survey');

Route::middleware(['auth'])->group(function () {
    Route::get('admin', [DashboardController::class, 'index'])->name('admin-dashboard');

    Route::get('/daftar-tamu', [TamuController::class, 'show'])->name('daftar_tamu');
    Route::get('/daftar-tamu/{id}/edit', [TamuController::class, 'edit'])->name('edit_tamu');
    Route::put('/daftar-tamu/{id}', [TamuController::class, 'update'])->name('update_tamu');
    Route::delete('/daftar-tamu/{id}', [TamuController::class, 'destroy'])->name('hapus_tamu');
    Route::put('/daftar-tamu/checkout/{id}', [TamuController::class, 'checkout'])->name('checkout_tamu');

    Route::get('/keperluan', [KeperluanController::class, 'index'])->name('perlu');
    Route::get('/keperluan/tambah', [KeperluanController::class, 'create'])->name('create_perlu');
    Route::post('/keperluan/simpan', [KeperluanController::class, 'store'])->name('store_perlu');
    Route::get('/keperluan/{id}/edit', [KeperluanController::class, 'edit'])->name('edit_perlu');
    Route::put('/keperluan/{id}', [KeperluanController::class, 'update'])->name('update_perlu');
    Route::delete('/keperluan/{id}', [KeperluanController::class, 'destroy'])->name('destroy_perlu');

    Route::get('/pertanyaan', [PertanyaanController::class, 'index'])->name('tanya');
    Route::get('/pertanyaan/tambah', [PertanyaanController::class, 'create'])->name('create_tanya');
    Route::post('/pertanyaan/simpan', [PertanyaanController::class, 'store'])->name('store_tanya');
    Route::get('/pertanyaan/{id}/edit', [PertanyaanController::class, 'edit'])->name('edit_tanya');
    Route::put('/pertanyaan/{id}', [PertanyaanController::class, 'update'])->name('update_tanya');
    Route::delete('/pertanyaan/{id}', [PertanyaanController::class, 'destroy'])->name('destroy_tanya');

    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai');
    Route::get('/pegawai/tambah', [PegawaiController::class, 'create'])->name('create_pegawai');
    Route::post('/pegawai/simpan', [PegawaiController::class, 'store'])->name('store_pegawai');
    Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('edit_pegawai');
    Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->name('update_pegawai');
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('destroy_pegawai');

    Route::get('/unit-kerja', [UnitKerjaController::class, 'index'])->name('nitKerja');
    Route::get('/unit-kerja/tambah', [UnitKerjaController::class, 'create'])->name('create_unit');
    Route::post('/unit-kerja/simpan', [UnitKerjaController::class, 'store'])->name('store_unit');
    Route::get('/unit-kerja/{id}/edit', [UnitKerjaController::class, 'edit'])->name('edit_unit');
    Route::put('/unit-kerja/{id}', [UnitKerjaController::class, 'update'])->name('update_unit');
    Route::delete('/unit-kerja/{id}', [UnitKerjaController::class, 'destroy'])->name('destroy_unit');

    Route::get('/jawaban', [PertanyaanController::class, 'jawabanIndex'])->name('jawab');
});
