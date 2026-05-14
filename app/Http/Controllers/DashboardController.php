<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\JadwalKonsultasi;
use App\Models\LaporanMedis;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Pasien::count();
        $totalDokter = Dokter::count();
        $jadwalHariIni = JadwalKonsultasi::whereDate('tanggal', date('Y-m-d'))->count();
        $totalLaporan = LaporanMedis::count();

        $pasienTerbaru = Pasien::latest()->take(5)->get();
        $jadwalTerbaru = JadwalKonsultasi::with(['pasien', 'dokter'])->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalPasien', 
            'totalDokter', 
            'jadwalHariIni', 
            'totalLaporan', 
            'pasienTerbaru', 
            'jadwalTerbaru'
        ));
    }
}
