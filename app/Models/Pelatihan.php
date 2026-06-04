<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model {
    protected $table = "pelatihan";
    protected $fillable = ['judul','deskripsi','penyelenggara','tanggal_mulai','tanggal_selesai','lokasi','kuota','status','foto','syarat'];
    protected $casts = ['tanggal_mulai'=>'date','tanggal_selesai'=>'date'];

    public function pendaftaran() {
        return $this->hasMany(PendaftaranPelatihan::class);
    }

    public function getSisaKuotaAttribute() {
        return $this->kuota - $this->pendaftaran()->where('status','diterima')->count();
    }

    public function getFotoUrlAttribute() {
        return $this->foto ? asset('storage/'.$this->foto) : null;
    }
}