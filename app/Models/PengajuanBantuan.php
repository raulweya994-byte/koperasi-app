<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PengajuanBantuan extends Model {
    protected $table = 'pengajuan_bantuan';
    protected $fillable = ['periode_bantuan_id','koperasi_id','anggota_id','nama_pemohon','no_hp','email','nama_usaha','jenis_bantuan','jumlah_diajukan','tujuan_penggunaan','status','catatan_admin'];

    public function koperasi() { return $this->belongsTo(Koperasi::class); }
    
    public function anggota() { return $this->belongsTo(Anggota::class); }
    
    public function periodeBantuan() { return $this->belongsTo(PeriodeBantuan::class, 'periode_bantuan_id'); }
}
