<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriFromStorageSeeder extends Seeder
{
    public function run(): void
    {
        $files = glob(public_path('storage/galeri/*'));
        $urutan = 1;
        foreach ($files as $file) {
            $filename = basename($file);
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $videoExts = ['mp4', 'avi', 'mov', 'mkv', 'webm'];
            $tipe = in_array($ext, $videoExts) ? 'video' : 'foto';
            Galeri::create([
                'tipe'      => $tipe,
                'judul'     => 'Galeri ' . $urutan,
                'deskripsi' => null,
                'foto'      => $tipe === 'foto' ? 'galeri/' . $filename : null,
                'video_url' => $tipe === 'video' ? 'galeri/' . $filename : null,
                'kategori'  => 'umum',
                'urutan'    => $urutan,
                'is_active' => true,
                'created_by'=> 1,
            ]);
            $urutan++;
        }
        echo "Selesai! " . ($urutan - 1) . " galeri berhasil dibuat!\n";
    }
}
