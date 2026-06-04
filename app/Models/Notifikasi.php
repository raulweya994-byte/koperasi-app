<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';

    protected $fillable = [
        'user_id',
        'judul',
        'pesan',
        'icon',
        'warna',
        'tipe',
        'jenis',
        'is_read',      // ← nama kolom asli di DB
        'url',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    // ─── Relasi ───────────────────────────────────
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ─── Scope ────────────────────────────────────
    public function scopeBelumDibaca($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // ─── Accessor: alias 'dibaca' → is_read ───────
    // supaya kode lama yang akses ->dibaca tetap jalan
    public function getDibacaAttribute()
    {
        return $this->is_read;
    }

    // ─── Method kirim (static helper) ─────────────
    /**
     * Kirim notifikasi ke user tertentu.
     *
     * @param int    $userId
     * @param string $judul
     * @param string $pesan
     * @param string $tipe    info|success|warning|danger
     * @param string $url
     * @return static
     */
    public static function kirim(int $userId, string $judul, string $pesan, string $tipe = 'info', string $url = '')
    {
        // Mapping tipe → icon FontAwesome
        $iconMap = [
            'info'    => 'fa-info-circle',
            'success' => 'fa-check-circle',
            'warning' => 'fa-exclamation-triangle',
            'danger'  => 'fa-times-circle',
        ];

        // Mapping tipe → warna bootstrap
        $warnaMap = [
            'info'    => 'info',
            'success' => 'success',
            'warning' => 'warning',
            'danger'  => 'danger',
        ];

        return static::create([
            'user_id' => $userId,
            'judul'   => $judul,
            'pesan'   => $pesan,
            'icon'    => $iconMap[$tipe]  ?? 'fa-bell',
            'warna'   => $warnaMap[$tipe] ?? 'info',
            'tipe'    => $tipe,
            'jenis'   => $tipe,           // kolom jenis (enum) juga diisi
            'is_read' => false,           // ← pakai is_read bukan dibaca
            'url'     => $url,
        ]);
    }

    // ─── Method tandai sudah dibaca ───────────────
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => Carbon::now(),
        ]);
    }

    // ─── Helper jumlah belum dibaca ───────────────
    public static function jumlahBelumDibaca(int $userId): int
    {
        return static::where('user_id', $userId)
                     ->where('is_read', false)
                     ->count();
    }
}