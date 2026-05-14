<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalKonsultasiController;
use App\Http\Controllers\LaporanMedisController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('pasien', PasienController::class);
Route::resource('dokter', DokterController::class);
Route::resource('jadwal', JadwalKonsultasiController::class);

Route::resource('laporan', LaporanMedisController::class);
Route::get('laporan/{laporan}/pdf', [LaporanMedisController::class, 'exportPdf'])->name('laporan.pdf');
