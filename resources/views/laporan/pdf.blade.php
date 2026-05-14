<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Medis - {{ $laporan->pasien->nama }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; line-height: 1.5; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; color: #0d6efd; }
        .header p { margin: 5px 0 0; color: #666; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table th { text-align: left; width: 20%; padding: 5px 0; }
        .info-table td { width: 30%; padding: 5px 0; }
        .content-section { margin-bottom: 20px; }
        .content-section h3 { margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 5px; color: #0d6efd; }
        .content-box { border: 1px solid #eee; padding: 10px; min-height: 50px; background-color: #fafafa; }
        .footer { margin-top: 50px; text-align: right; }
        .signature { margin-top: 60px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h1>SIMKLINIK SEHAT SELALU</h1>
        <p>Jl. Kesehatan No. 123, Kota Medis - Telp: (021) 1234567</p>
    </div>

    <h2 style="text-align: center; margin-bottom: 30px;">REKAM MEDIS PASIEN</h2>

    <table class="info-table">
        <tr>
            <th>No. Laporan</th>
            <td>: #LM-{{ str_pad($laporan->id, 4, '0', STR_PAD_LEFT) }}</td>
            <th>Tanggal Periksa</th>
            <td>: {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d F Y') }}</td>
        </tr>
        <tr>
            <th>Nama Pasien</th>
            <td>: <strong>{{ $laporan->pasien->nama }}</strong></td>
            <th>Dokter Pemeriksa</th>
            <td>: {{ $laporan->dokter->nama }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>: {{ $laporan->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            <th>Spesialis</th>
            <td>: {{ $laporan->dokter->spesialis }}</td>
        </tr>
    </table>

    <div class="content-section">
        <h3>Diagnosa</h3>
        <div class="content-box">
            {!! nl2br(e($laporan->diagnosa)) !!}
        </div>
    </div>

    <div class="content-section">
        <h3>Tindakan Medis</h3>
        <div class="content-box">
            {!! nl2br(e($laporan->tindakan ?? '-')) !!}
        </div>
    </div>

    <div class="content-section">
        <h3>Resep Obat</h3>
        <div class="content-box">
            {!! nl2br(e($laporan->resep ?? '-')) !!}
        </div>
    </div>

    <div class="footer">
        <p>Dokter Pemeriksa,</p>
        <div class="signature">
            dr. {{ $laporan->dokter->nama }}
        </div>
    </div>

</body>
</html>
