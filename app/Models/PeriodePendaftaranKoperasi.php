<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PeriodePendaftaranKoperasi extends Model
{
    use HasFactory;

    protected $table = 'periode_pendaftaran_koperasi';

    protected $fillable = [
        'nama_periode',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active',
        'kuota',
        'created_by',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean',
    ];

    // ── Relasi ──────────────────────────────────────────────
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function koperasi()
    {
        return $this->hasMany(Koperasi::class, 'periode_pendaftaran_koperasi_id');
    }

    // ── Scope ──────────────────────────────────────────────
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBerlangsung($query)
    {
        $today = Carbon::today();
        return $query->where('is_active', true)
                     ->where('tanggal_mulai', '<=', $today)
                     ->where('tanggal_selesai', '>=', $today);
    }

    // ── Helper ──────────────────────────────────────────────
    public function getStatusAttribute()
    {
        if (!$this->is_active) {
            return 'Tidak Aktif';
        }

        $today = Carbon::today();
        
        if ($today->lt($this->tanggal_mulai)) {
            return 'Belum Dimulai';
        }
        
        if ($today->gt($this->tanggal_selesai)) {
            return 'Selesai';
        }
        
        return 'Berlangsung';
    }

    public function getStatusBadgeAttribute()
    {
        $status = $this->status;
        
        return match($status) {
            'Berlangsung' => '<span class="badge badge-success">Berlangsung</span>',
            'Belum Dimulai' => '<span class="badge badge-info">Belum Dimulai</span>',
            'Selesai' => '<span class="badge badge-secondary">Selesai</span>',
            'Tidak Aktif' => '<span class="badge badge-danger">Tidak Aktif</span>',
            default => '<span class="badge badge-secondary">' . $status . '</span>',
        };
    }

    public function isBerlangsung()
    {
        if (!$this->is_active) {
            return false;
        }

        $today = Carbon::today();
        return $today->between($this->tanggal_mulai, $this->tanggal_selesai);
    }

    public function getJumlahPendaftarAttribute()
    {
        return $this->koperasi()->count();
    }

    public function getSisaKuotaAttribute()
    {
        if (!$this->kuota) {
            return null;
        }
        
        return max(0, $this->kuota - $this->jumlah_pendaftar);
    }

    public function isKuotaPenuh()
    {
        if (!$this->kuota) {
            return false;
        }
        
        return $this->jumlah_pendaftar >= $this->kuota;
    }

    // ── Static Methods ──────────────────────────────────────
    public static function getPeriodeAktif()
    {
        return static::berlangsung()->first();
    }

    public static function isPendaftaranTerbuka()
    {
        $periode = static::getPeriodeAktif();
        
        if (!$periode) {
            return false;
        }
        
        if ($periode->kuota && $periode->isKuotaPenuh()) {
            return false;
        }
        
        return true;
    }
}
