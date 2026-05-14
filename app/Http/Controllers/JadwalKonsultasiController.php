<?php

namespace App\Http\Controllers;

use App\Models\JadwalKonsultasi;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;

class JadwalKonsultasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jadwals = JadwalKonsultasi::with(['pasien', 'dokter'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('pasien', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('dokter', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhere('keluhan', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('jadwal.index', compact('jadwals', 'search'));
    }

    public function create()
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        return view('jadwal.create', compact('pasiens', 'dokters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'keluhan' => 'nullable|string',
            'status' => 'required|in:menunggu,proses,selesai,batal',
        ]);

        JadwalKonsultasi::create($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal konsultasi berhasil ditambahkan.');
    }

    public function edit(JadwalKonsultasi $jadwal)
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        return view('jadwal.edit', compact('jadwal', 'pasiens', 'dokters'));
    }

    public function update(Request $request, JadwalKonsultasi $jadwal)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'keluhan' => 'nullable|string',
            'status' => 'required|in:menunggu,proses,selesai,batal',
        ]);

        $jadwal->update($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal konsultasi berhasil diperbarui.');
    }

    public function destroy(JadwalKonsultasi $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal konsultasi berhasil dihapus.');
    }
}
