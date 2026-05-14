@extends('layouts.app')

@section('title', 'Edit Jadwal Konsultasi')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>Edit Jadwal Konsultasi</h2>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pasien_id" class="form-label">Pasien <span class="text-danger">*</span></label>
                        <select class="form-select @error('pasien_id') is-invalid @enderror" id="pasien_id" name="pasien_id" required>
                            <option value="">-- Pilih Pasien --</option>
                            @foreach($pasiens as $pasien)
                                <option value="{{ $pasien->id }}" {{ old('pasien_id', $jadwal->pasien_id) == $pasien->id ? 'selected' : '' }}>
                                    {{ $pasien->nama }} ({{ $pasien->telp ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                        @error('pasien_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="dokter_id" class="form-label">Dokter <span class="text-danger">*</span></label>
                        <select class="form-select @error('dokter_id') is-invalid @enderror" id="dokter_id" name="dokter_id" required>
                            <option value="">-- Pilih Dokter --</option>
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}" {{ old('dokter_id', $jadwal->dokter_id) == $dokter->id ? 'selected' : '' }}>
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

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Konsultasi <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $jadwal->tanggal) }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jam" class="form-label">Jam Konsultasi <span class="text-danger">*</span></label>
                        <input type="time" class="form-control @error('jam') is-invalid @enderror" id="jam" name="jam" value="{{ old('jam', \Carbon\Carbon::parse($jadwal->jam)->format('H:i')) }}" required>
                        @error('jam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="menunggu" {{ old('status', $jadwal->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="proses" {{ old('status', $jadwal->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ old('status', $jadwal->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="batal" {{ old('status', $jadwal->status) == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="keluhan" class="form-label">Keluhan</label>
                <textarea class="form-control @error('keluhan') is-invalid @enderror" id="keluhan" name="keluhan" rows="3">{{ old('keluhan', $jadwal->keluhan) }}</textarea>
                @error('keluhan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save"></i> Perbarui Jadwal
            </button>
        </form>
    </div>
</div>
@endsection
