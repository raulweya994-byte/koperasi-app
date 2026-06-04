<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PeriodePendaftaran extends Model
{
    use HasFactory;

    protected $table = 'periode_pendaftaran';

    protected $fillable = [
        'nama_periode',
        'tahun_ajaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'status',
        'kuota',
        'jumlah_pendaftar',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    // Relasi
    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }

    // Scope
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Static Methods
    public static function getPeriodeAktif()
    {
        // Ambil periode dengan status aktif (tanpa cek tanggal)
        return self::where('status', 'aktif')->first();
    }

    public static function isPendaftaranTerbuka()
    {
        $periode = self::getPeriodeAktif();
        return $periode && $periode->is_buka;
    }

    // Instance Methods
    public function isKuotaPenuh()
    {
        if ($this->kuota === null) {
            return false;
        }
        return $this->jumlah_pendaftar >= $this->kuota;
    }

    // Accessor
    public function getIsBukaAttribute()
    {
        // Jika status aktif, langsung buka tanpa cek tanggal
        if ($this->status === 'aktif') {
            // Cek kuota jika ada
            if ($this->kuota !== null && $this->jumlah_pendaftar >= $this->kuota) {
                return false; // Kuota penuh
            }
            return true; // Buka
        }
        
        return false; // Status tidak aktif = tutup
    }

    public function getSisaKuotaAttribute()
    {
        if ($this->kuota === null) {
            return 'Unlimited';
        }
        return max(0, $this->kuota - $this->jumlah_pendaftar);
    }

    public function getStatusPendaftaranAttribute()
    {
        if (!$this->is_buka) {
            if ($this->kuota && $this->jumlah_pendaftar >= $this->kuota) {
                return 'Kuota Penuh';
            }
            if (Carbon::now()->lt($this->tanggal_mulai)) {
                return 'Belum Dibuka';
            }
            if (Carbon::now()->gt($this->tanggal_selesai)) {
                return 'Sudah Ditutup';
            }
            return 'Nonaktif';
        }
        return 'Dibuka';
    }
}
