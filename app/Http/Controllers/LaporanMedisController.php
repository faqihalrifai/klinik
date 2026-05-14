<?php

namespace App\Http\Controllers;

use App\Models\LaporanMedis;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanMedisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $laporans = LaporanMedis::with(['pasien', 'dokter'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('pasien', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('dokter', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhere('diagnosa', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('laporan.index', compact('laporans', 'search'));
    }

    public function create()
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        return view('laporan.create', compact('pasiens', 'dokters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'tanggal' => 'required|date',
            'diagnosa' => 'required|string',
            'tindakan' => 'nullable|string',
            'resep' => 'nullable|string',
        ]);

        LaporanMedis::create($validated);

        return redirect()->route('laporan.index')->with('success', 'Laporan medis berhasil ditambahkan.');
    }

    public function edit(LaporanMedis $laporan)
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        return view('laporan.edit', compact('laporan', 'pasiens', 'dokters'));
    }

    public function update(Request $request, LaporanMedis $laporan)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'tanggal' => 'required|date',
            'diagnosa' => 'required|string',
            'tindakan' => 'nullable|string',
            'resep' => 'nullable|string',
        ]);

        $laporan->update($validated);

        return redirect()->route('laporan.index')->with('success', 'Laporan medis berhasil diperbarui.');
    }

    public function destroy(LaporanMedis $laporan)
    {
        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan medis berhasil dihapus.');
    }

    public function exportPdf(LaporanMedis $laporan)
    {
        $laporan->load(['pasien', 'dokter']);
        
        $pdf = Pdf::loadView('laporan.pdf', compact('laporan'));
        
        return $pdf->download('laporan_medis_' . $laporan->pasien->nama . '_' . $laporan->tanggal . '.pdf');
    }
}
