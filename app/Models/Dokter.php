<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';

    protected $fillable = [
        'nama',
        'spesialis',
        'telp',
        'jadwal_praktik',
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
