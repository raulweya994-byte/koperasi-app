<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model {
    protected $table = 'struktur_organisasi';
    protected $fillable = ['nama','jabatan','bidang','sub_jabatan','foto','nip','urutan','is_active'];

    public function getFotoUrlAttribute() {
        if ($this->foto) return asset('storage/'.$this->foto);
        return asset('adminlte/dist/img/user2-160x160.jpg');
    }

    public function getBidangLabelAttribute() {
        $labels = [
        
                'kepala_dinas'  => 'Kepala Dinas',
                'sekretariat'   => 'Sekretariat',
                'perindustrian' => 'Bidang Perindustrian',
                'perdagangan'   => 'Bidang Perdagangan',
                'koperasi'      => 'Bidang Koperasi',
                'uptd'          => 'UPTD',
            ];
        return $labels[$this->bidang] ?? $this->bidang;
    }
}