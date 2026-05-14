@extends('layouts.app')

@section('title', 'Tambah Data Dokter')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>Tambah Data Dokter</h2>
        <a href="{{ route('dokter.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('dokter.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Dokter <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="spesialis" class="form-label">Spesialis <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('spesialis') is-invalid @enderror" id="spesialis" name="spesialis" value="{{ old('spesialis') }}" required>
                        @error('spesialis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="telp" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" value="{{ old('telp') }}">
                        @error('telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="jadwal_praktik" class="form-label">Jadwal Praktik</label>
                <textarea class="form-control @error('jadwal_praktik') is-invalid @enderror" id="jadwal_praktik" name="jadwal_praktik" rows="3" placeholder="Contoh: Senin - Rabu (08:00 - 14:00)">{{ old('jadwal_praktik') }}</textarea>
                @error('jadwal_praktik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Simpan Data
            </button>
        </form>
    </div>
</div>
@endsection
