<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\StrukturOrganisasi;

class StrukturFromStorageSeeder extends Seeder
{
    public function run(): void
    {
        $files = glob(public_path('storage/struktur/*'));
        $jabatanList = ['Kepala Dinas','Sekretaris','Kabid Perindustrian','Kabid Perdagangan','Kabid Koperasi','Staff'];
        $bidangList  = ['kepala_dinas','sekretariat','perindustrian','perdagangan','koperasi','uptd'];
        $urutan = 1;
        foreach ($files as $file) {
            $filename = basename($file);
            $idx = ($urutan - 1) % count($jabatanList);
            StrukturOrganisasi::create([
                'nama'       => 'Pegawai ' . $urutan,
                'jabatan'    => $jabatanList[$idx],
                'bidang'     => $bidangList[$idx],
                'sub_jabatan'=> null,
                'foto'       => 'struktur/' . $filename,
                'nip'        => '19' . str_pad($urutan, 14, '0', STR_PAD_LEFT),
                'urutan'     => $urutan,
                'is_active'  => true,
            ]);
            $urutan++;
        }
        echo "Selesai! " . ($urutan - 1) . " struktur berhasil dibuat!\n";
    }
}
