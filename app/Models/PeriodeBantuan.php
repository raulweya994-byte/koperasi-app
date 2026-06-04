<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeBantuan extends Model
{
    use HasFactory;

    protected $table = 'periode_bantuan';

    protected $fillable = [
        'nama_periode',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'kuota_penerima',
        'anggaran_total',
        'created_by',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'anggaran_total' => 'decimal:2',
    ];

    public function pengajuanBantuan()
    {
        return $this->hasMany(PengajuanBantuan::class, 'periode_bantuan_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeAktif($query)
    {
        // Hanya cek status aktif, tidak cek tanggal
        // Karena admin yang mengontrol kapan periode dibuka/ditutup
        return $query->where('status', 'aktif');
    }

    public function scopeAktifDenganTanggal($query)
    {
        // Scope alternatif yang mengecek tanggal juga
        return $query->where('status', 'aktif')
                    ->where('tanggal_mulai', '<=', now())
                    ->where('tanggal_selesai', '>=', now());
    }

    public function isAktif()
    {
        // Cukup cek status saja, admin yang mengontrol
        return $this->status === 'aktif';
    }
    
    public function isAktifDenganTanggal()
    {
        // Method alternatif yang mengecek tanggal juga
        return $this->status === 'aktif' 
            && $this->tanggal_mulai <= now() 
            && $this->tanggal_selesai >= now();
    }

    public function jumlahPengajuan()
    {
        return $this->pengajuanBantuan()->count();
    }

    public function sisaKuota()
    {
        if (!$this->kuota_penerima) {
            return null;
        }
        return $this->kuota_penerima - $this->jumlahPengajuan();
    }
}
