<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Koperasi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KoperasiSeeder extends Seeder
{
    public function run()
    {
        $distrikList = [
            'Karubaga', 'Tiom', 'Kembu', 'Bokondini', 'Kanggime',
            'Kondaga', 'Numba', 'Kuari', 'Gilubandu', 'Apalapsili'
        ];

        $jenisUsaha = [
            'Koperasi Simpan Pinjam',
            'Koperasi Konsumen',
            'Koperasi Produsen',
            'Koperasi Jasa',
            'Koperasi Pertanian',
            'Koperasi Peternakan',
            'Koperasi Perikanan',
            'Koperasi Kerajinan',
            'Koperasi Perdagangan',
            'Koperasi Multi Usaha'
        ];

        $kategori = ['mikro', 'kecil', 'menengah'];
        $statusVerifikasi = ['pending', 'diverifikasi', 'diverifikasi', 'diverifikasi']; // Lebih banyak yang terverifikasi
        $statusUsaha = ['aktif', 'aktif', 'aktif', 'tidak aktif']; // Lebih banyak yang aktif

        // Generate 50 data koperasi contoh
        for ($i = 1; $i <= 50; $i++) {
            // Buat user untuk koperasi
            $user = User::create([
                'name' => "Koperasi User $i",
                'email' => "koperasi$i@example.com",
                'password' => Hash::make('password'),
                'role' => 'koperasi',
                'is_active' => true,
            ]);

            // Random data
            $distrik = $distrikList[array_rand($distrikList)];
            $jenis = $jenisUsaha[array_rand($jenisUsaha)];
            $kat = $kategori[array_rand($kategori)];
            $statusV = $statusVerifikasi[array_rand($statusVerifikasi)];
            $statusU = $statusUsaha[array_rand($statusUsaha)];

            // Modal dan omset berdasarkan kategori
            $modal = match($kat) {
                'mikro' => rand(5000000, 50000000),
                'kecil' => rand(50000000, 500000000),
                'menengah' => rand(500000000, 2000000000),
            };

            $omset = match($kat) {
                'mikro' => rand(1000000, 10000000),
                'kecil' => rand(10000000, 100000000),
                'menengah' => rand(100000000, 500000000),
            };

            // Buat data koperasi dengan tanggal acak dalam 12 bulan terakhir
            $createdAt = now()->subMonths(rand(0, 11))->subDays(rand(0, 28));

            Koperasi::create([
                'user_id' => $user->id,
                'no_registrasi' => 'KOPERASI-' . date('Y') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'no_ktp' => '9401' . str_pad(rand(1, 999999999999), 12, '0', STR_PAD_LEFT),
                'nama_pemilik' => "Pemilik Koperasi $i",
                'nama_usaha' => "Koperasi $jenis $distrik $i",
                'jenis_usaha' => $jenis,
                'kategori' => $kat,
                'alamat' => "Jalan Raya $distrik No. $i",
                'distrik' => $distrik,
                'kelurahan' => "Kelurahan $distrik",
                'no_telp' => '08' . rand(1000000000, 9999999999),
                'email' => "koperasi$i@koperasi.com",
                'modal_usaha' => $modal,
                'omset_per_bulan' => $omset,
                'jumlah_karyawan' => rand(3, 50),
                'status_verifikasi' => $statusV,
                'status_usaha' => $statusU,
                'catatan_verifikasi' => $statusV === 'diverifikasi' ? 'Dokumen lengkap dan valid' : null,
                'verified_by' => $statusV === 'diverifikasi' ? 1 : null,
                'verified_at' => $statusV === 'diverifikasi' ? $createdAt->addDays(rand(1, 7)) : null,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }

        $this->command->info('✅ Berhasil membuat 50 data koperasi contoh!');
    }
}
