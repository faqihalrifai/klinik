<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $dokters = Dokter::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('spesialis', 'like', "%{$search}%")
                         ->orWhere('telp', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();

        return view('dokter.index', compact('dokters', 'search'));
    }

    public function create()
    {
        return view('dokter.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'telp' => 'nullable|string|max:20',
            'jadwal_praktik' => 'nullable|string',
        ]);

        Dokter::create($validated);

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit(Dokter $dokter)
    {
        return view('dokter.edit', compact('dokter'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'telp' => 'nullable|string|max:20',
            'jadwal_praktik' => 'nullable|string',
        ]);

        $dokter->update($validated);

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }
}
