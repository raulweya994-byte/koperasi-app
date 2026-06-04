<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\StrukturOrganisasi;

class StrukturOrganisasiSeeder extends Seeder
{
    public function run(): void
    {
        StrukturOrganisasi::truncate();
        $data = [
            ['nama'=>'Ir. Thomas Wenda, M.Si','jabatan'=>'Kepala Dinas','bidang'=>'kepala_dinas','sub_jabatan'=>'Kepala Dinas DISPERINDAGKOP','foto'=>'struktur/fHCMCE3YAYJGV8zF8h8Y5Y9GK2lxfEFuC5MmZXXR.jpg','nip'=>'197203151998031005','urutan'=>1,'is_active'=>1],
            ['nama'=>'Drs. Jelly Gombo, M.Si','jabatan'=>'Wakil Kepala Dinas','bidang'=>'kepala_dinas','sub_jabatan'=>'Wakil Kepala Dinas DISPERINDAGKOP','foto'=>'struktur/tclwkwqHGmxms5dc85UxkPfXIIfHc8E8bqGrcTti.jpg','nip'=>'197508202003121004','urutan'=>2,'is_active'=>1],
            ['nama'=>'Meiles Karoba, S.E','jabatan'=>'Sekretaris Dinas','bidang'=>'kepala_dinas','sub_jabatan'=>'Sekretariat DISPERINDAGKOP','foto'=>'struktur/hhkoOzTLB5nNe4RnLa4c9TqEhGiqFXHc6ZoD7hzl.webp','nip'=>'197805202005011012','urutan'=>3,'is_active'=>1],
            ['nama'=>'Frengky Weya, S.E','jabatan'=>'Staff Keuangan','bidang'=>'sekretariat','sub_jabatan'=>'Sekretariat','foto'=>'struktur/4lEYDk8MTytC0tVmKxjroGvRDTnX4u0koUnoIBgA.jpg','nip'=>'199203142016032010','urutan'=>3,'is_active'=>1],
            ['nama'=>'yuli yikwa.S.SOS','jabatan'=>'Staff Umum','bidang'=>'sekretariat','sub_jabatan'=>'Sekretariat','foto'=>'struktur/9F6kK1Q9mlsVqqWDFwpgFNJh8BhRwZIEwJK0w03F.png','nip'=>'198907202014031008','urutan'=>4,'is_active'=>1],
            ['nama'=>'Melin Wanena, S.SOS','jabatan'=>'Staff Administrasi','bidang'=>'sekretariat','sub_jabatan'=>'Sekretariat','foto'=>'struktur/RwisyQ79oAmf16m9cRmIlBQpOZtCsnji1sqzDeGP.jpg','nip'=>'199506102018032005','urutan'=>5,'is_active'=>1],
            ['nama'=>'Ella morib.S.P','jabatan'=>'Kepala bidang Dinas peridakop','bidang'=>'perindustrian','sub_jabatan'=>'Kepala Dinas DISPERINDAGKOP','foto'=>'struktur/i5cM9us7TaQqG9iAldkCxoQvh3PQGzWbayWCg9Ci.png','nip'=>'197203151998031022','urutan'=>1,'is_active'=>1],
            ['nama'=>'Yulin Kogoya.S.PD','jabatan'=>'Kepala Seksi Industri Kecil','bidang'=>'perindustrian','sub_jabatan'=>'Seksi Industri Kecil dan Menengah','foto'=>'struktur/2jwxoVSj1PRepUp81YgWljQELJelrcUUTbMRmJeq.png','nip'=>'198506102010011012','urutan'=>2,'is_active'=>1],
            ['nama'=>'Monas wenda, S.A.P','jabatan'=>'Kepala Seksi Industri Agro','bidang'=>'perindustrian','sub_jabatan'=>'Seksi Industri Agro dan Kimia','foto'=>'struktur/IK9y5KpJNwuybrGSLIprVfJl0DIeio8YPxXM5s3R.png','nip'=>'199001152015032008','urutan'=>3,'is_active'=>1],
            ['nama'=>'Merry Tabo, S.E., M.Ak.','jabatan'=>'Kepala Bidang Perdagangan','bidang'=>'perdagangan','sub_jabatan'=>'Bidang Perdagangan','foto'=>'struktur/H88kYrX1MdXAdP3A0LOaPzHD09nkkEOR4SDTAAMa.jpg','nip'=>'197906152006042018','urutan'=>1,'is_active'=>1],
            ['nama'=>'Petrus Wenda, S.E','jabatan'=>'Staff Bidang Perdagangan','bidang'=>'perdagangan','sub_jabatan'=>'Bidang Perdagangan','foto'=>'struktur/UQuzzAm6JxusZLOr3CSfo7cuAow4Fm4xo8t9XUYS.jpg','nip'=>'199101202015032009','urutan'=>4,'is_active'=>1],
            ['nama'=>'Rmonas Enumbi, S.E','jabatan'=>'Kepala Seksi Perdagangan Luar Negeri','bidang'=>'perdagangan','sub_jabatan'=>'Bidang Perdagangan','foto'=>'struktur/0VAajGUFbg84skNX1tB3Blx1mKq8FSPXANMENQXY.jpg','nip'=>'198603102010031004','urutan'=>5,'is_active'=>1],
            ['nama'=>'aria Pagawak, S.E','jabatan'=>'Kepala Bidang Koperasi','bidang'=>'koperasi','sub_jabatan'=>'Bidang Koperasi','foto'=>'struktur/P9CBn07Ym0FAnSjmC8RJZgGuVDaCqNbxm9m70uGg.jpg','nip'=>'198003102009041003','urutan'=>1,'is_active'=>1],
            ['nama'=>'Drs. Ronal Tabuni, M.M','jabatan'=>'Kepala Seksi Pemberdayaan Koperasi','bidang'=>'koperasi','sub_jabatan'=>'Bidang Koperasi','foto'=>'struktur/8qfQlcAUjUN2FyCg8beDqpmBjEE1UuWJXmdfQCmf.webp','nip'=>'199008152014032007','urutan'=>3,'is_active'=>1],
            ['nama'=>'Agustinus Wanimbo, S.H., M.Si.','jabatan'=>'Staff Bidang Koperasi','bidang'=>'koperasi','sub_jabatan'=>'Bidang Koperasi','foto'=>'struktur/D4bOg9fJqePHNN7wKEc5RXhA5KEU3Cfg9AvPgPYb.jpg','nip'=>'198705202011031005','urutan'=>4,'is_active'=>1],
        ];
        foreach ($data as $item) {
            StrukturOrganisasi::create($item);
        }
        echo "Selesai! " . count($data) . " struktur organisasi berhasil dibuat!\n";
    }
}
