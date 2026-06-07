<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengumumanBeritaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengumuman')->truncate();
        DB::table('berita')->truncate();

        DB::table('pengumuman')->insert([
            ['id'=>1,'judul'=>'Pendaftaran Penerima Bantuan Modal Usaha Semester I 2026 Dibuka','isi'=>'Dinas Perdagangan dan Koperasi Kabupaten Tolikara mengumumkan bahwa pendaftaran program Bantuan Modal Usaha Koperasi Semester I 2026 resmi dibuka.','tanggal'=>'2026-04-27','hari'=>'Senin','jam'=>'08:00:00','tahun'=>2026,'pengirim'=>'Admin Disperindagkop','jenis'=>'info','target'=>'semua','is_active'=>1,'dibuat_oleh'=>2,'created_at'=>'2026-04-27 09:14:04','updated_at'=>'2026-04-27 09:14:04'],
            ['id'=>2,'judul'=>'Jadwal Distribusi Bantuan Modal Usaha Semester I 2026','isi'=>'Dinas Perdagangan dan Koperasi Kabupaten Tolikara memberitahukan jadwal distribusi Bantuan Modal Usaha Semester I 2026. Tanggal: 09 May 2026.','tanggal'=>'2026-04-29','hari'=>'Rabu','jam'=>'09:00:00','tahun'=>2026,'pengirim'=>'Admin Disperindagkop','jenis'=>'penting','target'=>'semua','is_active'=>1,'dibuat_oleh'=>2,'created_at'=>'2026-04-29 09:14:04','updated_at'=>'2026-04-29 09:14:04'],
            ['id'=>3,'judul'=>'Hasil Verifikasi Penerima Bantuan Modal Usaha Semester II 2025','isi'=>'Dinas Perdagangan dan Koperasi Kabupaten Tolikara mengumumkan bahwa proses verifikasi penerima Bantuan Modal Usaha Semester II 2025 telah selesai.','tanggal'=>'2026-01-02','hari'=>'Jumat','jam'=>'10:00:00','tahun'=>2025,'pengirim'=>'Admin Disperindagkop','jenis'=>'success','target'=>'semua','is_active'=>1,'dibuat_oleh'=>2,'created_at'=>'2026-01-02 09:14:04','updated_at'=>'2026-01-02 09:14:04'],
            ['id'=>4,'judul'=>'Pelatihan Digital Marketing Koperasi 2026','isi'=>'Akan segera membukanya','tanggal'=>'2026-06-02','hari'=>'Selasa','jam'=>'06:00:00','tahun'=>2026,'pengirim'=>'Super Admin','jenis'=>'info','target'=>'semua','is_active'=>1,'dibuat_oleh'=>2,'created_at'=>'2026-06-01 23:44:46','updated_at'=>'2026-06-01 23:44:46'],
        ]);

        DB::table('berita')->insert([
            ['id'=>1,'judul'=>'Disperindagkop Tolikara Salurkan Bantuan Modal kepada 9 Koperasi','slug'=>'disperindagkop-tolikara-salurkan-bantuan-modal-9-koperasi','thumbnail'=>'galeri/0IdydTbme6d58YoffOWaMMiL4j17RFcDHfpgmmYM.jpg','konten'=>'<p>Disperindagkop Kabupaten Tolikara resmi menyalurkan Bantuan Modal Usaha Semester II 2025 kepada 9 koperasi aktif.</p>','kategori'=>'Bantuan','status'=>'publish','user_id'=>2,'published_at'=>'2026-02-02 09:14:04','views'=>171,'created_at'=>'2026-02-02 09:14:04','updated_at'=>'2026-06-01 21:58:02'],
            ['id'=>2,'judul'=>'Program Bantuan Modal Usaha Semester I 2026 Resmi Dibuka','slug'=>'program-bantuan-modal-usaha-semester-i-2026-resmi-dibuka','thumbnail'=>'galeri/1776064512_del2.jpg','konten'=>'<p>Disperindagkop Kabupaten Tolikara resmi membuka program Bantuan Modal Usaha Semester I 2026.</p>','kategori'=>'Bantuan','status'=>'publish','user_id'=>2,'published_at'=>'2026-04-27 09:14:04','views'=>141,'created_at'=>'2026-04-27 09:14:04','updated_at'=>'2026-05-04 02:01:55'],
            ['id'=>3,'judul'=>'Pelatihan Manajemen Keuangan Koperasi Akan Segera Dilaksanakan','slug'=>'pelatihan-manajemen-keuangan-koperasi-segera-dilaksanakan','thumbnail'=>'galeri/1776387639_perbukitan.jpg','konten'=>'<p>Disperindagkop Kabupaten Tolikara akan menyelenggarakan Pelatihan Manajemen Keuangan Koperasi pada 16 May 2026.</p>','kategori'=>'Pelatihan','status'=>'publish','user_id'=>2,'published_at'=>'2026-04-30 09:14:04','views'=>132,'created_at'=>'2026-04-30 09:14:04','updated_at'=>'2026-06-01 21:57:39'],
        ]);

        echo "Selesai! Pengumuman dan Berita berhasil dibuat!\n";
    }
}