<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah sudah ada admin
        $adminExists = User::where('role', 'admin')->exists();

        if (!$adminExists) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@disperindagkop.go.id',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => true,
                'phone' => '081234567890',
            ]);

            $this->command->info('✅ User Admin berhasil dibuat!');
            $this->command->info('Email: admin@disperindagkop.go.id');
            $this->command->info('Password: admin123');
        } else {
            $this->command->warn('⚠️  User Admin sudah ada di database.');
            
            // Tampilkan admin yang ada
            $admins = User::where('role', 'admin')->get(['name', 'email', 'is_active']);
            $this->command->table(['Nama', 'Email', 'Status'], $admins->map(function($admin) {
                return [
                    $admin->name,
                    $admin->email,
                    $admin->is_active ? 'Aktif' : 'Tidak Aktif'
                ];
            }));
        }

        // Pastikan semua admin aktif
        User::where('role', 'admin')->update(['is_active' => true]);
        $this->command->info('✅ Semua user admin telah diaktifkan.');
    }
}
