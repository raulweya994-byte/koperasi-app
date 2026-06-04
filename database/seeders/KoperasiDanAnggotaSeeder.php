<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Koperasi;
use App\Models\Anggota;
use Carbon\Carbon;

class KoperasiDanAnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $koperasiData = [
            ['nama_pemilik'=>'Yulianus Wetipo','no_ktp'=>'9404010101990001','no_telp'=>'081234560001','alamat'=>'Jl. Karubaga No.1','distrik'=>'Karubaga','kelurahan'=>'Karubaga','nama_usaha'=>'KSP Karubaga Mandiri','jenis_usaha'=>'Koperasi Simpan Pinjam','kategori'=>'mikro'],
            ['nama_pemilik'=>'Marta Kogoya','no_ktp'=>'9404010101920002','no_telp'=>'081234560002','alamat'=>'Jl. Bokondini No.2','distrik'=>'Bokondini','kelurahan'=>'Bokondini','nama_usaha'=>'KUD Bokondini Maju','jenis_usaha'=>'Koperasi Konsumen','kategori'=>'mikro'],
            ['nama_pemilik'=>'Barnabas Wenda','no_ktp'=>'9404010101880003','no_telp'=>'081234560003','alamat'=>'Jl. Kanggime No.3','distrik'=>'Kanggime','kelurahan'=>'Aulani','nama_usaha'=>'Koperasi Tani Kanggime','jenis_usaha'=>'Koperasi Pertanian','kategori'=>'mikro'],
            ['nama_pemilik'=>'Dorkas Enembe','no_ktp'=>'9404010101950004','no_telp'=>'081234560004','alamat'=>'Jl. Kembu No.4','distrik'=>'Kembu','kelurahan'=>'Kobon','nama_usaha'=>'Koperasi Ternak Kembu','jenis_usaha'=>'Koperasi Peternakan','kategori'=>'mikro'],
            ['nama_pemilik'=>'Yonas Tabuni','no_ktp'=>'9404010101870005','no_telp'=>'081234560005','alamat'=>'Jl. Kondaga No.5','distrik'=>'Kondaga','kelurahan'=>'Konda','nama_usaha'=>'KUD Kondaga Bersama','jenis_usaha'=>'Koperasi Produsen','kategori'=>'kecil'],
            ['nama_pemilik'=>'Ribka Pigai','no_ktp'=>'9404010101930006','no_telp'=>'081234560006','alamat'=>'Jl. Kuari No.6','distrik'=>'Kuari','kelurahan'=>'Kuari','nama_usaha'=>'KSP Kuari Sejahtera','jenis_usaha'=>'Koperasi Simpan Pinjam','kategori'=>'kecil'],
            ['nama_pemilik'=>'Elias Logo','no_ktp'=>'9404010101910007','no_telp'=>'081234560007','alamat'=>'Jl. Numba No.7','distrik'=>'Numba','kelurahan'=>'Numba','nama_usaha'=>'Koperasi Kerajinan Numba','jenis_usaha'=>'Koperasi Kerajinan','kategori'=>'mikro'],
            ['nama_pemilik'=>'Naomi Waker','no_ktp'=>'9404010101960008','no_telp'=>'081234560008','alamat'=>'Jl. Gilubandu No.8','distrik'=>'Gilubandu','kelurahan'=>'Tinggom','nama_usaha'=>'Koperasi Produsen Gilubandu','jenis_usaha'=>'Koperasi Produsen','kategori'=>'kecil'],
            ['nama_pemilik'=>'Mateus Murib','no_ktp'=>'9404010101850009','no_telp'=>'081234560009','alamat'=>'Jl. Nelawi No.9','distrik'=>'Nelawi','kelurahan'=>'Nelawi','nama_usaha'=>'Koperasi Jasa Nelawi','jenis_usaha'=>'Koperasi Jasa','kategori'=>'mikro'],
            ['nama_pemilik'=>'Susana Tekege','no_ktp'=>'9404010101940010','no_telp'=>'081234560010','alamat'=>'Jl. Geya No.10','distrik'=>'Geya','kelurahan'=>'Geya','nama_usaha'=>'Koperasi Tani Geya','jenis_usaha'=>'Koperasi Pertanian','kategori'=>'mikro'],
            ['nama_pemilik'=>'Petrus Numberi','no_ktp'=>'9404010101890011','no_telp'=>'081234560011','alamat'=>'Jl. Panaga No.11','distrik'=>'Panaga','kelurahan'=>'Panaga','nama_usaha'=>'KSP Panaga Berkah','jenis_usaha'=>'Koperasi Simpan Pinjam','kategori'=>'mikro'],
            ['nama_pemilik'=>'Agustina Wandik','no_ktp'=>'9404010101970012','no_telp'=>'081234560012','alamat'=>'Jl. Dundu No.12','distrik'=>'Dundu','kelurahan'=>'Dundu','nama_usaha'=>'Koperasi Perikanan Dundu','jenis_usaha'=>'Koperasi Perikanan','kategori'=>'mikro'],
            ['nama_pemilik'=>'Kornelius Koyoga','no_ktp'=>'9404010101860013','no_telp'=>'081234560013','alamat'=>'Jl. Bokoneri No.13','distrik'=>'Bokoneri','kelurahan'=>'Bokoneri','nama_usaha'=>'KUD Bokoneri Jaya','jenis_usaha'=>'Koperasi Konsumen','kategori'=>'kecil'],
            ['nama_pemilik'=>'Priskila Enumbi','no_ktp'=>'9404010101980014','no_telp'=>'081234560014','alamat'=>'Jl. Egiam No.14','distrik'=>'Egiam','kelurahan'=>'Egiam','nama_usaha'=>'Koperasi Wanita Egiam','jenis_usaha'=>'Koperasi Pemasaran','kategori'=>'mikro'],
            ['nama_pemilik'=>'Stefanus Doga','no_ktp'=>'9404010101920015','no_telp'=>'081234560015','alamat'=>'Jl. Wina No.15','distrik'=>'Wina','kelurahan'=>'Wina','nama_usaha'=>'Koperasi Multi Usaha Wina','jenis_usaha'=>'Koperasi Jasa','kategori'=>'kecil'],
        ];

        $koperasiIds = [];
        foreach ($koperasiData as $i => $k) {
            $no = str_pad($i+1, 4, '0', STR_PAD_LEFT);
            $kop = Koperasi::create([
                'no_registrasi'   => 'KOP-TLK-2026-' . $no,
                'nama_pemilik'    => $k['nama_pemilik'],
                'no_ktp'          => $k['no_ktp'],
                'no_telp'         => $k['no_telp'],
                'alamat'          => $k['alamat'],
                'distrik'         => $k['distrik'],
                'kelurahan'       => $k['kelurahan'],
                'nama_usaha'      => $k['nama_usaha'],
                'jenis_usaha'     => $k['jenis_usaha'],
                'kategori'        => $k['kategori'],
                'modal_usaha'     => rand(5,50) * 1000000,
                'omset_per_bulan' => rand(1,20) * 1000000,
                'jumlah_karyawan' => rand(2,15),
                'status_verifikasi' => 'diverifikasi',
                'status_usaha'    => 'aktif',
            ]);
            $koperasiIds[] = ['id' => $kop->id, 'distrik' => $k['distrik']];
        }

        echo "15 Koperasi berhasil dibuat!\n";

        $anggotaData = [
            ['nama'=>'Andreas Kogoya','nik'=>'9404020101910001','jk'=>'L','distrik'=>'Karubaga','kampung'=>'Ampera'],
            ['nama'=>'Yosefina Wenda','nik'=>'9404020101930002','jk'=>'P','distrik'=>'Bokondini','kampung'=>'Galala'],
            ['nama'=>'Markus Tabuni','nik'=>'9404020101880004','jk'=>'L','distrik'=>'Kanggime','kampung'=>'Logon'],
            ['nama'=>'Magdalena Murib','nik'=>'9404020101960005','jk'=>'P','distrik'=>'Kembu','kampung'=>'Agimdek'],
            ['nama'=>'Lukas Enembe','nik'=>'9404020101870006','jk'=>'L','distrik'=>'Kondaga','kampung'=>'Arumagi'],
            ['nama'=>'Kristina Pigai','nik'=>'9404020101940007','jk'=>'P','distrik'=>'Kuari','kampung'=>'Gubagi'],
            ['nama'=>'Habel Logo','nik'=>'9404020101920008','jk'=>'L','distrik'=>'Numba','kampung'=>'Kuma'],
            ['nama'=>'Esther Wetipo','nik'=>'9404020101970009','jk'=>'P','distrik'=>'Gilubandu','kampung'=>'Baguni'],
            ['nama'=>'Daniel Numberi','nik'=>'9404020101850010','jk'=>'L','distrik'=>'Nelawi','kampung'=>'Mondagul'],
            ['nama'=>'Carolina Tekege','nik'=>'9404020101950011','jk'=>'P','distrik'=>'Geya','kampung'=>'Nawu'],
            ['nama'=>'Benediktus Doga','nik'=>'9404020101890012','jk'=>'L','distrik'=>'Panaga','kampung'=>'Siak'],
            ['nama'=>'Anastasia Wandik','nik'=>'9404020101980013','jk'=>'P','distrik'=>'Dundu','kampung'=>'Bimo'],
            ['nama'=>'Filipus Koyoga','nik'=>'9404020101860014','jk'=>'L','distrik'=>'Bokoneri','kampung'=>'Omuk'],
            ['nama'=>'Veronika Enumbi','nik'=>'9404020101990015','jk'=>'P','distrik'=>'Egiam','kampung'=>'Yoka'],
            ['nama'=>'Timotius Waker','nik'=>'9404020101910016','jk'=>'L','distrik'=>'Wina','kampung'=>'Wina'],
        ];

        foreach ($anggotaData as $i => $a) {
            Anggota::create([
                'koperasi_id'    => $koperasiIds[$i]['id'],
                'no_anggota'     => 'ANG-' . str_pad($i+1, 3, '0', STR_PAD_LEFT) . '-2026',
                'nik'            => $a['nik'],
                'nama'           => $a['nama'],
                'jenis_kelamin'  => $a['jk'],
                'tempat_lahir'   => $a['distrik'],
                'tanggal_lahir'  => '199' . rand(0,9) . '-0' . rand(1,9) . '-' . str_pad(rand(1,28), 2, '0', STR_PAD_LEFT),
                'agama'          => 'Kristen',
                'no_hp'          => '0812345' . str_pad($i+1, 5, '0', STR_PAD_LEFT),
                'alamat'         => 'Kampung ' . $a['kampung'],
                'desa'           => $a['kampung'],
                'distrik'        => $a['distrik'],
                'kabupaten'      => 'Tolikara',
                'simpanan_pokok' => 500000,
                'simpanan_wajib' => 100000,
                'total_simpanan' => 600000,
                'status'         => 'Aktif',
            ]);
        }

        echo "15 Anggota berhasil dibuat!\n";
        echo "Total: 15 Koperasi + 15 Anggota = 30 data!\n";
    }
}
