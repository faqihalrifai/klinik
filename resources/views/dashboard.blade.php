@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="alert alert-info shadow-sm border-0 mb-4 rounded-3 d-flex align-items-center" style="background-color: #e3f2fd; color: #055160;">
    <i class="fas fa-info-circle fa-2x me-3"></i>
    <div>
        <strong>Halo! Selamat datang Administrator.</strong><br>
        Anda memiliki <b>{{ $jadwalHariIni }}</b> jadwal konsultasi hari ini.
    </div>
</div>

<div class="row">
    <!-- Total Pasien -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card card-pink">
            <div class="card-body">
                <div class="inner">
                    <h3>{{ $totalPasien }}</h3>
                    <p>Total Pasien</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Dokter -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card card-green">
            <div class="card-body">
                <div class="inner">
                    <h3>{{ $totalDokter }}</h3>
                    <p>Total Dokter</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-md"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Hari Ini -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card card-blue">
            <div class="card-body">
                <div class="inner">
                    <h3>{{ $jadwalHariIni }}</h3>
                    <p>Jadwal Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Laporan -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card card-yellow">
            <div class="card-body">
                <div class="inner">
                    <h3>{{ $totalLaporan }}</h3>
                    <p>Laporan Medis</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-medical-alt"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Pasien Terbaru -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0 h-100 rounded-3">
            <div class="card-header bg-primary text-white border-0" style="border-radius: 10px 10px 0 0;">
                <h5 class="mb-0 py-1"><i class="fas fa-user-plus me-2"></i> Pasien Terbaru</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Telp</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pasienTerbaru as $p)
                                <tr>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->telp ?? '-' }}</td>
                                    <td>{{ Str::limit($p->alamat, 30) ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center py-3">Belum ada pasien terdaftar</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white text-center border-0">
                <a href="{{ route('pasien.index') }}" class="text-decoration-none text-primary">Lihat Semua Pasien <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>

    <!-- Jadwal Terbaru -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0 h-100 rounded-3">
            <div class="card-header text-white border-0" style="background-color: #1abc9c; border-radius: 10px 10px 0 0;">
                <h5 class="mb-0 py-1"><i class="fas fa-calendar-alt me-2"></i> Jadwal Konsultasi Terkini</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwalTerbaru as $j)
                                <tr>
                                    <td>
                                        <strong>{{ \Carbon\Carbon::parse($j->tanggal)->format('d M') }}</strong><br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</small>
                                    </td>
                                    <td>{{ $j->pasien->nama }}</td>
                                    <td>{{ $j->dokter->nama }}</td>
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
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center py-3">Belum ada jadwal konsultasi</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white text-center border-0">
                <a href="{{ route('jadwal.index') }}" class="text-decoration-none" style="color: #1abc9c;">Lihat Semua Jadwal <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
