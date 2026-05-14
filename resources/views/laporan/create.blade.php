@extends('layouts.app')

@section('title', 'Tambah Laporan Medis')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>Tambah Laporan Medis</h2>
        <a href="{{ route('laporan.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('laporan.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="pasien_id" class="form-label">Pasien <span class="text-danger">*</span></label>
                        <select class="form-select @error('pasien_id') is-invalid @enderror" id="pasien_id" name="pasien_id" required>
                            <option value="">-- Pilih Pasien --</option>
                            @foreach($pasiens as $pasien)
                                <option value="{{ $pasien->id }}" {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>
                                    {{ $pasien->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('pasien_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="dokter_id" class="form-label">Dokter <span class="text-danger">*</span></label>
                        <select class="form-select @error('dokter_id') is-invalid @enderror" id="dokter_id" name="dokter_id" required>
                            <option value="">-- Pilih Dokter --</option>
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}" {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>
                                    {{ $dokter->nama }} - {{ $dokter->spesialis }}
                                </option>
                            @endforeach
                        </select>
                        @error('dokter_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="diagnosa" class="form-label">Diagnosa <span class="text-danger">*</span></label>
                <textarea class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" name="diagnosa" rows="3" required>{{ old('diagnosa') }}</textarea>
                @error('diagnosa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tindakan" class="form-label">Tindakan</label>
                <textarea class="form-control @error('tindakan') is-invalid @enderror" id="tindakan" name="tindakan" rows="3">{{ old('tindakan') }}</textarea>
                @error('tindakan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="resep" class="form-label">Resep Obat</label>
                <textarea class="form-control @error('resep') is-invalid @enderror" id="resep" name="resep" rows="3">{{ old('resep') }}</textarea>
                @error('resep')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Simpan Laporan
            </button>
        </form>
    </div>
</div>
@endsection
