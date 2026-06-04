<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PeriodePendaftaran;
use Carbon\Carbon;

class PeriodePendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        PeriodePendaftaran::create([
            'nama_periode' => 'Pendaftaran Anggota 2026',
            'tahun_ajaran' => '2026',
            'tanggal_mulai' => Carbon::now(),
            'tanggal_selesai' => Carbon::now()->addMonths(3),
            'deskripsi' => 'Periode pendaftaran anggota koperasi tahun 2026',
            'status' => 'aktif',
            'kuota' => null, // unlimited
            'jumlah_pendaftar' => 0,
        ]);
    }
}
