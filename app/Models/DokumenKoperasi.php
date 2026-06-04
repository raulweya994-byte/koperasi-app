<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DokumenKoperasi extends Model
{
    protected $table = 'dokumen_koperasi';
    protected $fillable = ['koperasi_id','jenis_dokumen','nama_file','path_file','ukuran_file'];

    public function koperasi() { return $this->belongsTo(Koperasi::class); }

    public function getUrlAttribute(): string
    {
        return Storage::url($this->path_file);
    }

    public function getJenisLabelAttribute(): string
    {
        return match ($this->jenis_dokumen) {
            'ktp'         => 'KTP',
            'kk'          => 'Kartu Keluarga',
            'foto_usaha'  => 'Foto Usaha',
            'surat_izin'  => 'Surat Izin Usaha',
            'lainnya'     => 'Dokumen Lainnya',
            default       => ucfirst($this->jenis_dokumen),
        };
    }
}