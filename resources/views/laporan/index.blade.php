@extends('layouts.app')

@section('title', 'Laporan Medis')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="mb-0">Laporan Medis</h2>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('laporan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Laporan
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('laporan.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari pasien, dokter, atau diagnosa..." value="{{ $search }}">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Diagnosa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporans as $index => $l)
                        <tr>
                            <td>{{ $laporans->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($l->tanggal)->format('d M Y') }}</td>
                            <td>{{ $l->pasien->nama }}</td>
                            <td>{{ $l->dokter->nama }}</td>
                            <td>{{ Str::limit($l->diagnosa, 30) }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('laporan.pdf', $l->id) }}" class="btn btn-sm btn-info text-white" title="Export PDF" target="_blank">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <a href="{{ route('laporan.edit', $l->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('laporan.destroy', $l->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan medis ini?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data laporan medis.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $laporans->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
