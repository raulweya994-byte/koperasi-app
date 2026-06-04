<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PendaftaranPelatihan extends Model {
    protected $table = 'pendaftaran_pelatihan';
    protected $fillable = ['pelatihan_id','koperasi_id','nama_peserta','no_hp','email','nama_usaha','status','catatan'];

    public function pelatihan() { return $this->belongsTo(Pelatihan::class); }
    public function koperasi() { return $this->belongsTo(Koperasi::class); }
}