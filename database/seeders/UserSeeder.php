<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@tolikara.go.id',
                'role' => 'admin',
                'is_active' => 1,
                'phone' => '085123456789',
                'password' => Hash::make('admin123'),
            ],
            [
                'name' => 'Petugas Dinas',
                'email' => 'petugas@tolikara.go.id',
                'role' => 'petugas',
                'is_active' => 1,
                'phone' => '085987654321',
                'password' => Hash::make('petugas123'),
            ],
            [
                'name' => 'Pimpinan Dinas',
                'email' => 'pimpinan@tolikara.go.id',
                'role' => 'pimpinan',
                'is_active' => 1,
                'phone' => '085111222333',
                'password' => Hash::make('pimpinan123'),
            ],
            [
                'name' => 'Koperasi User',
                'email' => 'koperasi@tolikara.go.id',
                'role' => 'koperasi',
                'is_active' => 1,
                'phone' => '085444555666',
                'password' => Hash::make('koperasi123'),
            ],
        ];

        foreach ($users as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}

