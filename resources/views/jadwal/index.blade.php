@extends('layouts.app')

@section('title', 'Jadwal Konsultasi')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="mb-0">Jadwal Konsultasi</h2>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('jadwal.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('jadwal.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari pasien, dokter, atau keluhan..." value="{{ $search }}">
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
                        <th>Tanggal & Jam</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $index => $j)
                        <tr>
                            <td>{{ $jadwals->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ \Carbon\Carbon::parse($j->tanggal)->format('d M Y') }}</strong><br>
                                <small class="text-muted"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</small>
                            </td>
                            <td>{{ $j->pasien->nama }}</td>
                            <td>{{ $j->dokter->nama }} <br><span class="badge bg-info text-dark" style="font-size: 0.7em;">{{ $j->dokter->spesialis }}</span></td>
                            <td>{{ Str::limit($j->keluhan, 30) ?? '-' }}</td>
                            <td>
                                @if($j->status == 'menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($j->status == 'proses')
                                    <span class="badge bg-primary">Proses</span>
                                @elseif($j->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-danger">Batal</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('jadwal.edit', $j->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal konsultasi ini?');" style="display:inline;">
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
                            <td colspan="7" class="text-center">Tidak ada data jadwal konsultasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $jadwals->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
