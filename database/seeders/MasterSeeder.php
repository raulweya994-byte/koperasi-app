<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Koperasi;
use App\Models\Bantuan;
use App\Models\PenerimaBantuan;
use App\Models\Notifikasi;
use Carbon\Carbon;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        // ===== KOPERASI =====
        $koperasiData = [
            ['nama_pemilik'=>'Yohanes Wenda','nama_usaha'=>'KSP Mandiri Karubaga','jenis_usaha'=>'Koperasi Simpan Pinjam','distrik'=>'Karubaga','modal'=>85000000,'omset'=>12000000,'kategori'=>'kecil','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Marthina Kogoya','nama_usaha'=>'KUD Sejahtera Tiom','jenis_usaha'=>'Koperasi Konsumen','distrik'=>'Tiom','modal'=>45000000,'omset'=>7500000,'kategori'=>'mikro','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Piter Enumbi','nama_usaha'=>'Koperasi Tani Kembu','jenis_usaha'=>'Koperasi Pertanian','distrik'=>'Kembu','modal'=>120000000,'omset'=>18000000,'kategori'=>'kecil','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Naomi Pagawak','nama_usaha'=>'KSP Bokondini Maju','jenis_usaha'=>'Koperasi Simpan Pinjam','distrik'=>'Bokondini','modal'=>65000000,'omset'=>9000000,'kategori'=>'kecil','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Lukas Wanimbo','nama_usaha'=>'Koperasi Ternak Kanggime','jenis_usaha'=>'Koperasi Peternakan','distrik'=>'Kanggime','modal'=>95000000,'omset'=>14000000,'kategori'=>'kecil','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Debora Itlay','nama_usaha'=>'KUD Kondaga Bersama','jenis_usaha'=>'Koperasi Konsumen','distrik'=>'Kondaga','modal'=>38000000,'omset'=>5500000,'kategori'=>'mikro','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Ones Kogoya','nama_usaha'=>'Koperasi Kerajinan Numba','jenis_usaha'=>'Koperasi Kerajinan','distrik'=>'Numba','modal'=>28000000,'omset'=>4200000,'kategori'=>'mikro','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Aplena Wetipo','nama_usaha'=>'KSP Kuari Sejahtera','jenis_usaha'=>'Koperasi Simpan Pinjam','distrik'=>'Kuari','modal'=>155000000,'omset'=>22000000,'kategori'=>'kecil','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Benediktus Murib','nama_usaha'=>'Koperasi Multi Gilubandu','jenis_usaha'=>'Koperasi Multi Usaha','distrik'=>'Gilubandu','modal'=>210000000,'omset'=>35000000,'kategori'=>'menengah','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Theresia Enumbi','nama_usaha'=>'KSP Apalapsili Mandiri','jenis_usaha'=>'Koperasi Simpan Pinjam','distrik'=>'Apalapsili','modal'=>72000000,'omset'=>10500000,'kategori'=>'kecil','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Melkias Wandik','nama_usaha'=>'Koperasi Dagang Karubaga','jenis_usaha'=>'Koperasi Perdagangan','distrik'=>'Karubaga','modal'=>185000000,'omset'=>28000000,'kategori'=>'menengah','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Kornelia Kogoya','nama_usaha'=>'KUD Tiom Makmur','jenis_usaha'=>'Koperasi Konsumen','distrik'=>'Tiom','modal'=>42000000,'omset'=>6800000,'kategori'=>'mikro','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Agus Wenda','nama_usaha'=>'Koperasi Jasa Kembu','jenis_usaha'=>'Koperasi Jasa','distrik'=>'Kembu','modal'=>58000000,'omset'=>8500000,'kategori'=>'kecil','status_v'=>'pending'],
            ['nama_pemilik'=>'Yunus Pagawak','nama_usaha'=>'KSP Bokondini Berkah','jenis_usaha'=>'Koperasi Simpan Pinjam','distrik'=>'Bokondini','modal'=>92000000,'omset'=>13500000,'kategori'=>'kecil','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Priska Wanimbo','nama_usaha'=>'Koperasi Ikan Kanggime','jenis_usaha'=>'Koperasi Perikanan','distrik'=>'Kanggime','modal'=>35000000,'omset'=>5200000,'kategori'=>'mikro','status_v'=>'pending'],
            ['nama_pemilik'=>'Markus Itlay','nama_usaha'=>'KUD Kondaga Jaya','jenis_usaha'=>'Koperasi Konsumen','distrik'=>'Kondaga','modal'=>275000000,'omset'=>42000000,'kategori'=>'menengah','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Yuliana Kogoya','nama_usaha'=>'Koperasi Tani Numba','jenis_usaha'=>'Koperasi Pertanian','distrik'=>'Numba','modal'=>48000000,'omset'=>7200000,'kategori'=>'mikro','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Darius Wetipo','nama_usaha'=>'KSP Kuari Maju','jenis_usaha'=>'Koperasi Simpan Pinjam','distrik'=>'Kuari','modal'=>135000000,'omset'=>19500000,'kategori'=>'kecil','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Fransiska Murib','nama_usaha'=>'Koperasi Produsen Gilubandu','jenis_usaha'=>'Koperasi Produsen','distrik'=>'Gilubandu','modal'=>68000000,'omset'=>9800000,'kategori'=>'kecil','status_v'=>'diverifikasi'],
            ['nama_pemilik'=>'Yosef Wandik','nama_usaha'=>'KSP Apalapsili Berkah','jenis_usaha'=>'Koperasi Simpan Pinjam','distrik'=>'Apalapsili','modal'=>52000000,'omset'=>7800000,'kategori'=>'mikro','status_v'=>'diverifikasi'],
        ];

        $koperasiIds = [];
        foreach ($koperasiData as $i => $k) {
            $no = $i + 1;
            $user = User::firstOrCreate(
                ['email' => "koperasi{$no}@tolikara.go.id"],
                [
                    'name'      => $k['nama_pemilik'],
                    'password'  => Hash::make('koperasi123'),
                    'role'      => 'koperasi',
                    'is_active' => 1,
                    'phone'     => '0812' . str_pad($no, 8, '0', STR_PAD_LEFT),
                ]
            );

            $koperasi = Koperasi::firstOrCreate(
                ['email' => "usaha{$no}@koperasi.id"],
                [
                    'user_id'            => $user->id,
                    'no_registrasi'      => 'KOP-TLK-' . date('Y') . '-' . str_pad($no, 4, '0', STR_PAD_LEFT),
                    'no_ktp'             => '9401' . str_pad($no * 123456, 12, '0', STR_PAD_LEFT),
                    'nama_pemilik'       => $k['nama_pemilik'],
                    'nama_usaha'         => $k['nama_usaha'],
                    'jenis_usaha'        => $k['jenis_usaha'],
                    'kategori'           => $k['kategori'],
                    'alamat'             => 'Jl. ' . $k['distrik'] . ' No. ' . $no . ', Kab. Tolikara',
                    'distrik'            => $k['distrik'],
                    'kelurahan'          => 'Kelurahan ' . $k['distrik'],
                    'no_telp'            => '0812' . str_pad($no * 111, 8, '0', STR_PAD_LEFT),
                    'modal_usaha'        => $k['modal'],
                    'omset_per_bulan'    => $k['omset'],
                    'jumlah_karyawan'    => rand(3, 25),
                    'status_verifikasi'  => $k['status_v'],
                    'status_usaha'       => 'aktif',
                    'catatan_verifikasi' => $k['status_v'] === 'diverifikasi' ? 'Dokumen lengkap dan valid, koperasi aktif beroperasi.' : null,
                    'verified_by'        => $k['status_v'] === 'diverifikasi' ? 2 : null,
                    'verified_at'        => $k['status_v'] === 'diverifikasi' ? now()->subMonths(rand(1,6)) : null,
                    'created_at'         => now()->subMonths(rand(2,10)),
                ]
            );
            $koperasiIds[] = $koperasi->id;
        }
        $this->command->info('✅ 20 Koperasi berhasil dibuat');

        // ===== BANTUAN =====
        $bantuanList = [
            [
                'kode_bantuan'  => 'BNT-TLK-2026-001',
                'nama_bantuan'  => 'Bantuan Modal Usaha Koperasi Semester I 2026',
                'jenis_bantuan' => 'tunai',
                'tahun'         => 2026,
                'periode'       => 'Semester I 2026',
                'deskripsi'     => 'Program bantuan modal usaha bagi koperasi aktif di Kabupaten Tolikara untuk mendorong pertumbuhan ekonomi daerah pada semester pertama tahun 2026.',
                'anggaran'      => 500000000,
                'kuota'         => 10,
                'status'        => 'aktif',
            ],
            [
                'kode_bantuan'  => 'BNT-TLK-2026-002',
                'nama_bantuan'  => 'Bantuan Peralatan Produksi Koperasi 2026',
                'jenis_bantuan' => 'barang',
                'tahun'         => 2026,
                'periode'       => 'Triwulan I 2026',
                'deskripsi'     => 'Bantuan berupa peralatan produksi untuk meningkatkan kapasitas produksi koperasi di Kabupaten Tolikara, khususnya di sektor pertanian dan peternakan.',
                'anggaran'      => 300000000,
                'kuota'         => 8,
                'status'        => 'aktif',
            ],
            [
                'kode_bantuan'  => 'BNT-TLK-2025-003',
                'nama_bantuan'  => 'Bantuan Modal Usaha Koperasi Semester II 2025',
                'jenis_bantuan' => 'tunai',
                'tahun'         => 2025,
                'periode'       => 'Semester II 2025',
                'deskripsi'     => 'Program bantuan modal usaha bagi koperasi aktif di Kabupaten Tolikara untuk semester kedua tahun anggaran 2025.',
                'anggaran'      => 450000000,
                'kuota'         => 9,
                'status'        => 'selesai',
            ],
        ];

        $bantuanIds = [];
        foreach ($bantuanList as $b) {
            $bantuan = Bantuan::firstOrCreate(
                ['kode_bantuan' => $b['kode_bantuan']],
                array_merge($b, ['created_by' => 2, 'created_at' => now()->subMonths(rand(1,3))])
            );
            $bantuanIds[] = $bantuan->id;
        }
        $this->command->info('✅ 3 Program Bantuan berhasil dibuat');

        // ===== PENERIMA BANTUAN =====
        $statusList = ['diterima','diterima','diterima','divalidasi','ditolak'];
        $penyaluranList = ['tersalurkan','tersalurkan','tersalurkan','tidak_hadir','belum'];
        
        // Bantuan 1 - 10 penerima
        $penerima1 = array_slice($koperasiIds, 0, 10);
        foreach ($penerima1 as $idx => $kopId) {
            $status = $statusList[$idx % count($statusList)];
            $penyaluran = $status === 'diterima' ? $penyaluranList[$idx % count($penyaluranList)] : 'belum';
            PenerimaBantuan::firstOrCreate(
                ['bantuan_id' => $bantuanIds[0], 'koperasi_id' => $kopId],
                [
                    'tanggal_penerimaan' => $status === 'diterima' ? now()->subDays(rand(5,30)) : null,
                    'jumlah_bantuan'     => 50000000,
                    'status'             => $status,
                    'catatan'            => $status === 'ditolak' ? 'Dokumen persyaratan tidak lengkap.' : 'Proses verifikasi selesai.',
                    'validated_by'       => 3,
                    'validated_at'       => now()->subDays(rand(3,15)),
                    'status_penyaluran'  => $penyaluran,
                    'waktu_konfirmasi'   => $penyaluran !== 'belum' ? now()->subDays(rand(1,5)) : null,
                    'dikonfirmasi_oleh'  => $penyaluran !== 'belum' ? 3 : null,
                ]
            );
        }

        // Bantuan 2 - 8 penerima
        $penerima2 = array_slice($koperasiIds, 5, 8);
        foreach ($penerima2 as $idx => $kopId) {
            $status = $idx < 5 ? 'divalidasi' : 'pending';
            PenerimaBantuan::firstOrCreate(
                ['bantuan_id' => $bantuanIds[1], 'koperasi_id' => $kopId],
                [
                    'tanggal_penerimaan' => null,
                    'jumlah_bantuan'     => 37500000,
                    'status'             => $status,
                    'catatan'            => 'Menunggu jadwal distribusi peralatan.',
                    'validated_by'       => 3,
                    'validated_at'       => $status === 'divalidasi' ? now()->subDays(rand(3,10)) : null,
                    'status_penyaluran'  => 'belum',
                ]
            );
        }

        // Bantuan 3 (selesai) - 9 penerima tersalurkan semua
        $penerima3 = array_slice($koperasiIds, 10, 9);
        foreach ($penerima3 as $idx => $kopId) {
            PenerimaBantuan::firstOrCreate(
                ['bantuan_id' => $bantuanIds[2], 'koperasi_id' => $kopId],
                [
                    'tanggal_penerimaan' => now()->subMonths(rand(2,4)),
                    'jumlah_bantuan'     => 50000000,
                    'status'             => 'diterima',
                    'catatan'            => 'Bantuan telah diterima dan digunakan untuk pengembangan usaha.',
                    'validated_by'       => 3,
                    'validated_at'       => now()->subMonths(rand(3,5)),
                    'status_penyaluran'  => 'tersalurkan',
                    'waktu_konfirmasi'   => now()->subMonths(rand(2,4)),
                    'dikonfirmasi_oleh'  => 3,
                ]
            );
        }
        $this->command->info('✅ Data Penerima Bantuan berhasil dibuat');

        // ===== JADWAL DISTRIBUSI =====
        DB::table('jadwal')->insertOrIgnore([
            [
                'judul'         => 'Distribusi Bantuan Modal Usaha Semester I 2026',
                'deskripsi'     => 'Jadwal distribusi bantuan modal usaha bagi 10 koperasi penerima program semester I tahun 2026.',
                'tanggal'       => now()->addDays(7)->format('Y-m-d'),
                'jam_mulai'   => '08:00:00',
                'jam_selesai' => '16:00:00',
                'lokasi'        => 'Aula Dinas Perdagangan Koperasi Kabupaten Tolikara',
                'status'        => 'dijadwalkan',
                'created_by'    => 3,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'judul'         => 'Distribusi Bantuan Peralatan Produksi 2026',
                'deskripsi'     => 'Distribusi peralatan produksi untuk 8 koperasi di bidang pertanian dan peternakan.',
                'tanggal'       => now()->addDays(21)->format('Y-m-d'),
                'jam_mulai'   => '09:00:00',
                'jam_selesai' => '15:00:00',
                'lokasi'        => 'Kantor Kecamatan Karubaga',
                'status'        => 'dijadwalkan',
                'created_by'    => 3,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'judul'         => 'Distribusi Bantuan Modal Semester II 2025',
                'deskripsi'     => 'Distribusi bantuan modal usaha semester II 2025 — telah selesai dilaksanakan.',
                'tanggal'       => now()->subMonths(3)->format('Y-m-d'),
                'jam_mulai'   => '08:00:00',
                'jam_selesai' => '14:00:00',
                'lokasi'        => 'Aula Dinas Perdagangan Koperasi Kabupaten Tolikara',
                'status'        => 'selesai',
                'created_by'    => 3,
                'created_at'    => now()->subMonths(4),
                'updated_at'    => now()->subMonths(3),
            ],
        ]);
        $this->command->info('✅ Jadwal Distribusi berhasil dibuat');

        // ===== PENGUMUMAN =====
        DB::table('pengumuman')->insertOrIgnore([
            [
                'judul'       => 'Pendaftaran Penerima Bantuan Modal Usaha Semester I 2026 Dibuka',
                'konten'      => '<p>Dinas Perdagangan dan Koperasi Kabupaten Tolikara dengan bangga mengumumkan bahwa pendaftaran untuk program Bantuan Modal Usaha Koperasi Semester I Tahun 2026 resmi dibuka.</p><p>Koperasi yang memenuhi syarat dapat mendaftarkan diri melalui portal koperasi atau langsung ke kantor dinas. Pendaftaran dibuka mulai tanggal 1 Mei hingga 31 Mei 2026.</p><p><strong>Syarat Pendaftaran:</strong></p><ul><li>Koperasi terdaftar dan aktif di Kabupaten Tolikara</li><li>Memiliki minimal 10 anggota aktif</li><li>Laporan keuangan 1 tahun terakhir</li><li>Surat keterangan usaha aktif dari kelurahan</li></ul>',
                'jenis'       => 'pengumuman',
                'status'      => 'aktif',
                'created_by'  => 2,
                'created_at'  => now()->subDays(5),
                'updated_at'  => now()->subDays(5),
            ],
            [
                'judul'       => 'Jadwal Distribusi Bantuan Modal Usaha Semester I 2026',
                'konten'      => '<p>Dinas Perdagangan dan Koperasi Kabupaten Tolikara memberitahukan jadwal distribusi Bantuan Modal Usaha Semester I 2026 sebagai berikut:</p><p><strong>Tanggal:</strong> ' . now()->addDays(7)->format('d F Y') . '<br><strong>Waktu:</strong> 08.00 – 16.00 WIT<br><strong>Tempat:</strong> Aula Dinas Perdagangan Koperasi Kabupaten Tolikara</p><p>Seluruh penerima bantuan yang telah tervalidasi wajib hadir dengan membawa dokumen identitas asli.</p>',
                'jenis'       => 'pengumuman',
                'status'      => 'aktif',
                'created_by'  => 2,
                'created_at'  => now()->subDays(3),
                'updated_at'  => now()->subDays(3),
            ],
            [
                'judul'       => 'Hasil Verifikasi Penerima Bantuan Modal Usaha Semester II 2025',
                'konten'      => '<p>Dinas Perdagangan dan Koperasi Kabupaten Tolikara mengumumkan bahwa proses verifikasi penerima Bantuan Modal Usaha Semester II 2025 telah selesai dilaksanakan. Sebanyak 9 koperasi dinyatakan lolos verifikasi dan berhak menerima bantuan.</p><p>Koperasi yang lolos verifikasi akan dihubungi secara langsung untuk konfirmasi jadwal distribusi.</p>',
                'jenis'       => 'pengumuman',
                'status'      => 'aktif',
                'created_by'  => 2,
                'created_at'  => now()->subMonths(4),
                'updated_at'  => now()->subMonths(4),
            ],
        ]);
        $this->command->info('✅ Pengumuman berhasil dibuat');

        // ===== BERITA =====
        DB::table('berita')->insertOrIgnore([
            [
                'judul'        => 'Disperindagkop Tolikara Salurkan Bantuan Modal kepada 9 Koperasi',
                'slug'         => 'disperindagkop-tolikara-salurkan-bantuan-modal-9-koperasi',
                'konten'       => '<p>Dinas Perdagangan dan Koperasi (Disperindagkop) Kabupaten Tolikara resmi menyalurkan Bantuan Modal Usaha Semester II 2025 kepada 9 koperasi aktif di wilayah Kabupaten Tolikara. Penyaluran dilaksanakan di Aula Dinas Perdagangan pada ' . now()->subMonths(3)->format('d F Y') . '.</p><p>Kepala Dinas menyampaikan bahwa program ini merupakan wujud nyata komitmen pemerintah daerah dalam mendorong pertumbuhan ekonomi berbasis koperasi di Kabupaten Tolikara.</p>',
                'status'       => 'published',
                'created_by'   => 2,
                'published_at' => now()->subMonths(3),
                'created_at'   => now()->subMonths(3),
                'updated_at'   => now()->subMonths(3),
            ],
            [
                'judul'        => 'Program Bantuan Modal Usaha Semester I 2026 Resmi Dibuka',
                'slug'         => 'program-bantuan-modal-usaha-semester-i-2026-resmi-dibuka',
                'konten'       => '<p>Disperindagkop Kabupaten Tolikara resmi membuka program Bantuan Modal Usaha Semester I 2026. Program ini menyediakan anggaran sebesar Rp 500.000.000 untuk 10 koperasi terpilih di seluruh distrik Kabupaten Tolikara.</p><p>Kepala Bidang Koperasi menyampaikan bahwa seleksi penerima dilakukan secara ketat berdasarkan kelengkapan dokumen, status keaktifan koperasi, dan rekam jejak pengelolaan usaha.</p>',
                'status'       => 'published',
                'created_by'   => 2,
                'published_at' => now()->subDays(5),
                'created_at'   => now()->subDays(5),
                'updated_at'   => now()->subDays(5),
            ],
        ]);
        $this->command->info('✅ Berita berhasil dibuat');

        // ===== PELATIHAN =====
        DB::table('pelatihan')->insertOrIgnore([
            [
                'judul'            => 'Pelatihan Manajemen Keuangan Koperasi 2026',
                'deskripsi'        => 'Pelatihan intensif manajemen keuangan bagi pengurus koperasi untuk meningkatkan kompetensi dalam pengelolaan keuangan dan penyusunan laporan keuangan standar.',
                'tanggal_mulai'    => now()->addDays(14)->format('Y-m-d'),
                'tanggal_selesai'  => now()->addDays(16)->format('Y-m-d'),
                'lokasi'           => 'Aula Dinas Perdagangan Koperasi Kabupaten Tolikara',
                'kuota'            => 30,
                'status'           => 'aktif',
                'created_by'       => 3,
                'created_at'       => now()->subDays(10),
                'updated_at'       => now()->subDays(10),
            ],
            [
                'judul'            => 'Pelatihan Digital Marketing untuk Koperasi',
                'deskripsi'        => 'Pelatihan pemasaran digital bagi anggota koperasi untuk memperluas jangkauan pasar produk lokal melalui platform digital dan media sosial.',
                'tanggal_mulai'    => now()->addDays(30)->format('Y-m-d'),
                'tanggal_selesai'  => now()->addDays(31)->format('Y-m-d'),
                'lokasi'           => 'Aula Kantor Bupati Tolikara',
                'kuota'            => 25,
                'status'           => 'aktif',
                'created_by'       => 3,
                'created_at'       => now()->subDays(5),
                'updated_at'       => now()->subDays(5),
            ],
            [
                'judul'            => 'Pelatihan Penguatan Kelembagaan Koperasi 2025',
                'deskripsi'        => 'Pelatihan penguatan kelembagaan bagi pengurus dan pengawas koperasi yang telah dilaksanakan pada tahun 2025.',
                'tanggal_mulai'    => now()->subMonths(5)->format('Y-m-d'),
                'tanggal_selesai'  => now()->subMonths(5)->addDays(2)->format('Y-m-d'),
                'lokasi'           => 'Hotel Tolikara Indah',
                'kuota'            => 40,
                'status'           => 'selesai',
                'created_by'       => 3,
                'created_at'       => now()->subMonths(6),
                'updated_at'       => now()->subMonths(5),
            ],
        ]);
        $this->command->info('✅ Pelatihan berhasil dibuat');

        // ===== STRUKTUR ORGANISASI =====
        DB::table('struktur_organisasi')->insertOrIgnore([
            ['nama'=>'Ir. Thomas Wenda, M.Si','jabatan'=>'Kepala Dinas','foto'=>null,'urutan'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Aplena Kogoya, S.E','jabatan'=>'Sekretaris Dinas','foto'=>null,'urutan'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Yohanes Murib, S.Sos','jabatan'=>'Kepala Bidang Koperasi','foto'=>null,'urutan'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Naomi Pagawak, S.E','jabatan'=>'Kepala Bidang Perdagangan','foto'=>null,'urutan'=>4,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Lukas Enumbi, S.T','jabatan'=>'Kepala Bidang Perindustrian','foto'=>null,'urutan'=>5,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Marthina Wetipo, A.Md','jabatan'=>'Staff Bidang Koperasi','foto'=>null,'urutan'=>6,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Benediktus Wanimbo, S.E','jabatan'=>'Staff Bidang Perdagangan','foto'=>null,'urutan'=>7,'created_at'=>now(),'updated_at'=>now()],
        ]);
        $this->command->info('✅ Struktur Organisasi berhasil dibuat');

        // ===== PERIODE BANTUAN =====
        DB::table('periode_bantuan')->insertOrIgnore([
            [
                'nama_periode'   => 'Semester I Tahun 2026',
                'deskripsi'      => 'Periode penerimaan bantuan modal usaha koperasi semester pertama tahun anggaran 2026.',
                'tanggal_mulai'  => '2026-01-01',
                'tanggal_selesai'=> '2026-06-30',
                'status'         => 'aktif',
                'kuota_penerima' => 10,
                'anggaran_total' => 500000000,
                'created_by'     => 2,
                'created_at'     => now()->subMonths(2),
                'updated_at'     => now()->subMonths(2),
            ],
            [
                'nama_periode'   => 'Semester II Tahun 2025',
                'deskripsi'      => 'Periode penerimaan bantuan modal usaha koperasi semester kedua tahun anggaran 2025.',
                'tanggal_mulai'  => '2025-07-01',
                'tanggal_selesai'=> '2025-12-31',
                'status'         => 'nonaktif',
                'kuota_penerima' => 9,
                'anggaran_total' => 450000000,
                'created_by'     => 2,
                'created_at'     => now()->subMonths(8),
                'updated_at'     => now()->subMonths(2),
            ],
        ]);
        $this->command->info('✅ Periode Bantuan berhasil dibuat');

        $this->command->info('');
        $this->command->info('🎉 Semua data berhasil diisi!');
        $this->command->info('📊 Summary:');
        $this->command->info('   - 20 Koperasi (18 terverifikasi, 2 pending)');
        $this->command->info('   - 3 Program Bantuan');
        $this->command->info('   - 27 Data Penerima Bantuan');
        $this->command->info('   - 3 Jadwal Distribusi');
        $this->command->info('   - 3 Pengumuman');
        $this->command->info('   - 2 Berita');
        $this->command->info('   - 3 Pelatihan');
        $this->command->info('   - 7 Struktur Organisasi');
        $this->command->info('   - 2 Periode Bantuan');
    }
}
