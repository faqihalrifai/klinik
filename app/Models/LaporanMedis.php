<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMedis extends Model
{
    use HasFactory;

    protected $table = 'laporan_medis';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'diagnosa',
        'tindakan',
        'resep',
        'tanggal',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
