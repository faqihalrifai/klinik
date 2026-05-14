<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\JadwalKonsultasi;
use App\Models\LaporanMedis;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Seed 5 Pasien
        $pasienIds = [];
        for ($i = 0; $i < 5; $i++) {
            $pasien = Pasien::create([
                'nama' => $faker->name,
                'telp' => $faker->phoneNumber,
                'alamat' => $faker->address,
                'tanggal_lahir' => $faker->date('Y-m-d', '2005-01-01'),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'riwayat_penyakit' => $faker->randomElement([null, 'Asma', 'Hipertensi', 'Diabetes', 'Alergi Obat']),
            ]);
            $pasienIds[] = $pasien->id;
        }

        // Seed 5 Dokter
        $dokterIds = [];
        $spesialisList = ['Umum', 'Gigi', 'Kandungan', 'Anak', 'Penyakit Dalam'];
        for ($i = 0; $i < 5; $i++) {
            $dokter = Dokter::create([
                'nama' => 'dr. ' . $faker->lastName,
                'spesialis' => $spesialisList[$i],
                'telp' => $faker->phoneNumber,
                'jadwal_praktik' => 'Senin - Jumat (08:00 - 16:00)',
            ]);
            $dokterIds[] = $dokter->id;
        }

        // Seed 10 Jadwal Konsultasi
        for ($i = 0; $i < 10; $i++) {
            JadwalKonsultasi::create([
                'pasien_id' => $faker->randomElement($pasienIds),
                'dokter_id' => $faker->randomElement($dokterIds),
                'tanggal' => Carbon::now()->addDays(rand(-5, 5))->format('Y-m-d'),
                'jam' => $faker->time('H:00'),
                'keluhan' => $faker->sentence(6),
                'status' => $faker->randomElement(['menunggu', 'proses', 'selesai', 'batal']),
            ]);
        }

        // Seed 10 Laporan Medis
        for ($i = 0; $i < 10; $i++) {
            LaporanMedis::create([
                'pasien_id' => $faker->randomElement($pasienIds),
                'dokter_id' => $faker->randomElement($dokterIds),
                'diagnosa' => $faker->sentence(4),
                'tindakan' => $faker->randomElement(['Pemeriksaan Fisik', 'Pemberian Obat', 'Rujuk Spesialis', 'Observasi']),
                'resep' => 'Obat ' . $faker->word . ' 3x1, Vitamin 1x1',
                'tanggal' => Carbon::now()->subDays(rand(1, 30))->format('Y-m-d'),
            ]);
        }
    }
}
