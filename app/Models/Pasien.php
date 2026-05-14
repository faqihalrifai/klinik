<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $fillable = [
        'nama',
        'telp',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'riwayat_penyakit',
    ];

    public function jadwalKonsultasi()
    {
        return $this->hasMany(JadwalKonsultasi::class);
    }

    public function laporanMedis()
    {
        return $this->hasMany(LaporanMedis::class);
    }
}
