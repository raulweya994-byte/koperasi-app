<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RolePermission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Hapus semua permission yang ada
        RolePermission::truncate();

        // Default permissions untuk setiap role
        $permissions = [
            // ADMIN - Full Access
            'admin' => [
                'koperasi' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => true],
                'anggota' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => true],
                'bantuan' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => true],
                'berita' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => true],
                'pengumuman' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => true],
                'galeri' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => true],
                'jadwal' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => true],
                'pelatihan' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => true],
                'laporan' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => true],
                'user' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => true],
                'setting' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => true],
                'chat' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => false, 'approve' => false],
                'kontak' => ['view' => true, 'create' => false, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => false],
                'struktur' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => false, 'approve' => false],
                'halaman_statis' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => false, 'approve' => false],
            ],

            // PETUGAS - View, Create, Edit, Export (No Delete, No Approve)
            'petugas' => [
                'koperasi' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => false],
                'anggota' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => true, 'approve' => false],
                'bantuan' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => false, 'export' => true, 'approve' => false],
                'berita' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => false, 'approve' => false],
                'pengumuman' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => true, 'export' => false, 'approve' => false],
                'galeri' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => false, 'export' => false, 'approve' => false],
                'jadwal' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => false, 'export' => true, 'approve' => false],
                'pelatihan' => ['view' => true, 'create' => false, 'edit' => false, 'delete' => false, 'export' => true, 'approve' => false],
                'laporan' => ['view' => true, 'create' => false, 'edit' => false, 'delete' => false, 'export' => true, 'approve' => false],
                'chat' => ['view' => true, 'create' => true, 'edit' => true, 'delete' => false, 'export' => false, 'approve' => false],
            ],

            // PIMPINAN - View, Export, Approve (No Create, Edit, Delete)
            'pimpinan' => [
                'koperasi' => ['view' => true, 'create' => false, 'edit' => false, 'delete' => false, 'export' => true, 'approve' => true],
                'anggota' => ['view' => true, 'create' => false, 'edit' => false, 'delete' => false, 'export' => true, 'approve' => true],
                'bantuan' => ['view' => true, 'create' => false, 'edit' => false, 'delete' => false, 'export' => true, 'approve' => true],
                'berita' => ['view' => true, 'create' => false, 'edit' => false, 'delete' => false, 'export' => true, 'approve' => false],
                'pengumuman' => ['view' => true, 'create' => false, 'edit' => false, 'delete' => false, 'export' => true, 'approve' => false],
                'laporan' => ['view' => true, 'create' => false, 'edit' => false, 'delete' => false, 'export' => true, 'approve' => false],
                'chat' => ['view' => true, 'create' => true, 'edit' => false, 'delete' => false, 'export' => false, 'approve' => false],
            ],

            // KOPERASI - Limited Access
            'koperasi' => [
                'bantuan' => ['view' => true, 'create' => true, 'edit' => false, 'delete' => false, 'export' => false, 'approve' => false],
                'chat' => ['view' => true, 'create' => true, 'edit' => false, 'delete' => false, 'export' => false, 'approve' => false],
            ],

            // ANGGOTA - Very Limited Access
            'anggota' => [
                'chat' => ['view' => true, 'create' => true, 'edit' => false, 'delete' => false, 'export' => false, 'approve' => false],
            ],
        ];

        // Insert permissions ke database
        foreach ($permissions as $role => $modules) {
            foreach ($modules as $module => $perms) {
                RolePermission::create([
                    'role' => $role,
                    'module' => $module,
                    'can_view' => $perms['view'],
                    'can_create' => $perms['create'],
                    'can_edit' => $perms['edit'],
                    'can_delete' => $perms['delete'],
                    'can_export' => $perms['export'],
                    'can_approve' => $perms['approve'],
                    'description' => RolePermission::$modules[$module] ?? $module,
                ]);
            }
        }

        $this->command->info('✅ Default permissions berhasil dibuat!');
        $this->command->info('');
        $this->command->info('📊 Summary:');
        $this->command->info('   - Admin: Full access ke semua modul');
        $this->command->info('   - Petugas: View, Create, Edit, Export (Pengumuman: termasuk Delete)');
        $this->command->info('   - Pimpinan: View, Export, Approve');
        $this->command->info('   - Koperasi: Akses terbatas (Bantuan, Chat)');
        $this->command->info('   - Anggota: Akses minimal (Chat saja)');
    }
}
