<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = "jadwal";
    protected $fillable = ["judul","deskripsi","jenis","tanggal","jam_mulai","jam_selesai","lokasi","status","is_publik","catatan","created_by","petugas_id"];
    protected $casts = ["tanggal"=>"date","is_publik"=>"boolean"];

    public function pembuat()  { return $this->belongsTo(User::class, "created_by"); }
    public function petugas()  { return $this->belongsTo(User::class, "petugas_id"); }
    public function koperasiList() { return $this->belongsToMany(Koperasi::class, "jadwal_koperasi", "jadwal_id", "koperasi_id")->withPivot("status_hadir","keterangan")->withTimestamps(); }

    public function getJenisLabelAttribute() {
        return ["verifikasi"=>"Verifikasi Lapangan","pelatihan"=>"Pelatihan/Pembinaan","penilaian_bantuan"=>"Penilaian Bantuan","rapat"=>"Rapat/Pertemuan"][$this->jenis] ?? $this->jenis;
    }
    public function getStatusLabelAttribute() {
        return ["dijadwalkan"=>"Dijadwalkan","berlangsung"=>"Berlangsung","selesai"=>"Selesai","dibatalkan"=>"Dibatalkan"][$this->status] ?? $this->status;
    }
    public function getStatusColorAttribute() {
        return ["dijadwalkan"=>"primary","berlangsung"=>"warning","selesai"=>"success","dibatalkan"=>"danger"][$this->status] ?? "secondary";
    }
    public function getJenisColorAttribute() {
        return ["verifikasi"=>"info","pelatihan"=>"success","penilaian_bantuan"=>"warning","rapat"=>"primary"][$this->jenis] ?? "secondary";
    }
    public function scopeAktif($q)  { return $q->whereIn("status",["dijadwalkan","berlangsung"]); }
    public function scopePublik($q) { return $q->where("is_publik", true); }
}