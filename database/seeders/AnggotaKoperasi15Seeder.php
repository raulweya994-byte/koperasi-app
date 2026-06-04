<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Anggota;

class AnggotaKoperasi15Seeder extends Seeder
{
    public function run(): void
    {
        $anggota = [
            ['nik'=>'9404010101990001','nama'=>'Yulianus Wetipo','jk'=>'L','ttl'=>'Karubaga, 1990-03-15','distrik'=>'Karubaga','kampung'=>'Ampera'],
            ['nik'=>'9404010101920002','nama'=>'Marta Kogoya','jk'=>'P','ttl'=>'Bokondini, 1992-07-20','distrik'=>'Bokondini','kampung'=>'Galala'],
            ['nik'=>'9404010101880003','nama'=>'Barnabas Wenda','jk'=>'L','ttl'=>'Kanggime, 1988-01-10','distrik'=>'Kanggime','kampung'=>'Aulani'],
            ['nik'=>'9404010101950004','nama'=>'Dorkas Enembe','jk'=>'P','ttl'=>'Kembu, 1995-05-25','distrik'=>'Kembu','kampung'=>'Kobon'],
            ['nik'=>'9404010101870005','nama'=>'Yonas Tabuni','jk'=>'L','ttl'=>'Kondaga, 1987-11-08','distrik'=>'Kondaga','kampung'=>'Konda'],
            ['nik'=>'9404010101930006','nama'=>'Ribka Pigai','jk'=>'P','ttl'=>'Kuari, 1993-09-14','distrik'=>'Kuari','kampung'=>'Kuari'],
            ['nik'=>'9404010101910007','nama'=>'Elias Logo','jk'=>'L','ttl'=>'Numba, 1991-04-22','distrik'=>'Numba','kampung'=>'Numba'],
            ['nik'=>'9404010101960008','nama'=>'Naomi Waker','jk'=>'P','ttl'=>'Gilubandu, 1996-12-03','distrik'=>'Gilubandu','kampung'=>'Tinggom'],
            ['nik'=>'9404010101850009','nama'=>'Mateus Murib','jk'=>'L','ttl'=>'Nelawi, 1985-06-18','distrik'=>'Nelawi','kampung'=>'Nelawi'],
            ['nik'=>'9404010101940010','nama'=>'Susana Tekege','jk'=>'P','ttl'=>'Geya, 1994-02-28','distrik'=>'Geya','kampung'=>'Geya'],
            ['nik'=>'9404010101890011','nama'=>'Petrus Numberi','jk'=>'L','ttl'=>'Panaga, 1989-08-07','distrik'=>'Panaga','kampung'=>'Panaga'],
            ['nik'=>'9404010101970012','nama'=>'Agustina Wandik','jk'=>'P','ttl'=>'Dundu, 1997-10-16','distrik'=>'Dundu','kampung'=>'Dundu'],
            ['nik'=>'9404010101860013','nama'=>'Kornelius Koyoga','jk'=>'L','ttl'=>'Bokoneri, 1986-03-30','distrik'=>'Bokoneri','kampung'=>'Bokoneri'],
            ['nik'=>'9404010101980014','nama'=>'Priskila Enumbi','jk'=>'P','ttl'=>'Egiam, 1998-07-11','distrik'=>'Egiam','kampung'=>'Egiam'],
            ['nik'=>'9404010101920015','nama'=>'Stefanus Doga','jk'=>'L','ttl'=>'Wina, 1992-01-05','distrik'=>'Wina','kampung'=>'Wina'],
        ];

        foreach ($anggota as $i => $a) {
            $ttlParts = explode(', ', $a['ttl']);
            Anggota::create([
                'koperasi_id'    => 15,
                'no_anggota'     => 'ANG-15-' . str_pad($i+1, 3, '0', STR_PAD_LEFT),
                'nik'            => $a['nik'],
                'nama'           => $a['nama'],
                'jenis_kelamin'  => $a['jk'],
                'tempat_lahir'   => $ttlParts[0],
                'tanggal_lahir'  => $ttlParts[1],
                'agama'          => 'Kristen',
                'no_hp'          => '08' . rand(100000000, 999999999),
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

        echo "Selesai! 15 anggota dengan distrik beragam berhasil dibuat!\n";
    }
}
