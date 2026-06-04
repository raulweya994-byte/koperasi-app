<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RolePermission;

class PimpinanPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default permissions for Pimpinan role
        $permissions = [
            [
                'role' => 'pimpinan',
                'module' => 'koperasi',
                'can_view' => true,
                'can_create' => false,
                'can_edit' => false,
                'can_delete' => false,
                'can_export' => false,
                'can_approve' => false,
                'description' => 'Pimpinan dapat melihat data koperasi'
            ],
            [
                'role' => 'pimpinan',
                'module' => 'anggota',
                'can_view' => true,
                'can_create' => false,
                'can_edit' => false,
                'can_delete' => false,
                'can_export' => false,
                'can_approve' => false,
                'description' => 'Pimpinan dapat melihat data anggota'
            ],
            [
                'role' => 'pimpinan',
                'module' => 'laporan',
                'can_view' => true,
                'can_create' => false,
                'can_edit' => false,
                'can_delete' => false,
                'can_export' => true,
                'can_approve' => false,
                'description' => 'Pimpinan dapat melihat dan mengekspor laporan'
            ],
            [
                'role' => 'pimpinan',
                'module' => 'jadwal',
                'can_view' => true,
                'can_create' => false,
                'can_edit' => false,
                'can_delete' => false,
                'can_export' => false,
                'can_approve' => false,
                'description' => 'Pimpinan dapat melihat jadwal'
            ],
            [
                'role' => 'pimpinan',
                'module' => 'chat',
                'can_view' => true,
                'can_create' => true,
                'can_edit' => true,
                'can_delete' => true,
                'can_export' => false,
                'can_approve' => false,
                'description' => 'Pimpinan dapat menggunakan fitur chat'
            ],
        ];

        foreach ($permissions as $permission) {
            RolePermission::updateOrCreate(
                [
                    'role' => $permission['role'],
                    'module' => $permission['module']
                ],
                $permission
            );
        }

        $this->command->info('Default permissions for Pimpinan role created successfully!');
    }
}
