<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'module',
        'can_view',
        'can_create',
        'can_edit',
        'can_delete',
        'can_export',
        'can_approve',
        'description'
    ];

    protected $casts = [
        'can_view' => 'boolean',
        'can_create' => 'boolean',
        'can_edit' => 'boolean',
        'can_delete' => 'boolean',
        'can_export' => 'boolean',
        'can_approve' => 'boolean',
    ];

    // Available roles
    public static $roles = [
        'admin' => 'Administrator',
        'petugas' => 'Petugas',
        'pimpinan' => 'Pimpinan',
        'koperasi' => 'Koperasi',
        'anggota' => 'Anggota'
    ];

    // Available modules
    public static $modules = [
        'koperasi' => 'Manajemen Koperasi',
        'anggota' => 'Manajemen Anggota',
        'bantuan' => 'Distribusi Bantuan',
        'berita' => 'Berita & Artikel',
        'pengumuman' => 'Pengumuman',
        'galeri' => 'Galeri Kegiatan',
        'jadwal' => 'Jadwal Kegiatan',
        'pelatihan' => 'Pelatihan',
        'laporan' => 'Laporan',
        'user' => 'Manajemen User',
        'setting' => 'Pengaturan Sistem',
        'chat' => 'Chat & Pesan',
        'kontak' => 'Kontak Masuk',
        'struktur' => 'Struktur Organisasi',
        'halaman_statis' => 'Halaman Statis',
    ];

    // Check if role has permission
    public static function hasPermission($role, $module, $action)
    {
        $permission = self::where('role', $role)
            ->where('module', $module)
            ->first();

        if (!$permission) {
            return false;
        }

        $field = 'can_' . $action;
        return $permission->$field ?? false;
    }

    // Get all permissions for a role
    public static function getPermissionsForRole($role)
    {
        return self::where('role', $role)->get()->keyBy('module');
    }
}
