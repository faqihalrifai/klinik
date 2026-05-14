@extends('layouts.app')

@section('title', 'Data Dokter')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="mb-0">Data Dokter</h2>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('dokter.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Dokter
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('dokter.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, spesialis, atau telp dokter..." value="{{ $search }}">
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
                        <th>Nama</th>
                        <th>Spesialis</th>
                        <th>Telp</th>
                        <th>Jadwal Praktik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokters as $index => $d)
                        <tr>
                            <td>{{ $dokters->firstItem() + $index }}</td>
                            <td>{{ $d->nama }}</td>
                            <td><span class="badge bg-info text-dark">{{ $d->spesialis }}</span></td>
                            <td>{{ $d->telp ?? '-' }}</td>
                            <td>{{ Str::limit($d->jadwal_praktik, 50) ?? '-' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('dokter.edit', $d->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dokter.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data dokter ini?');" style="display:inline;">
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
                            <td colspan="6" class="text-center">Tidak ada data dokter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $dokters->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
