<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
        'is_active', 'phone', 'profile_photo',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_active'         => 'boolean',
    ];

    // ── Relasi ──────────────────────────────────────────────
    public function koperasi()
    {
        return $this->hasOne(Koperasi::class);
    }

    public function anggota()
    {
        return $this->hasOne(Anggota::class);
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class)->latest();
    }

    public function unreadNotifikasi()
    {
        return $this->hasMany(Notifikasi::class)->where('is_read', false);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    // ── Helper ──────────────────────────────────────────────
    public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function isPetugas(): bool  { return $this->role === 'petugas'; }
    public function isPimpinan(): bool { return $this->role === 'pimpinan'; }
    public function isKoperasi(): bool     { return $this->role === 'koperasi'; }
    public function isAnggota(): bool  { return $this->role === 'anggota'; }

    public function getDashboardRoute(): string
    {
        return match ($this->role) {
            'admin'    => '/admin/dashboard',
            'petugas'  => '/petugas/dashboard',
            'pimpinan' => '/pimpinan/dashboard',
            'koperasi'     => '/koperasi-portal/dashboard',
            'anggota'  => '/anggota-portal/dashboard',
            default    => '/',
        };
    }

    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'admin'    => 'Administrator',
            'petugas'  => 'Petugas',
            'pimpinan' => 'Pimpinan',
            'koperasi'     => 'Pelaku Koperasi',
            default    => ucfirst($this->role),
        };
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo) {
            return asset('storage/' . $this->profile_photo);
        }
        return asset('adminlte/dist/img/user2-160x160.jpg');
    }
}