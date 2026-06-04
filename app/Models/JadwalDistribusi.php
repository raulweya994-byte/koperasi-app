<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDistribusi extends Model
{
    protected $table = 'jadwal_distribusi';
    protected $fillable = [
        'bantuan_id','tanggal_distribusi','waktu_mulai','waktu_selesai',
        'lokasi','distrik','petugas_id','jumlah_penerima','status','catatan',
    ];
    protected $casts = [
        'tanggal_distribusi' => 'date',
    ];

    public function bantuan() { return $this->belongsTo(Bantuan::class); }
    public function petugas() { return $this->belongsTo(User::class, 'petugas_id'); }
}