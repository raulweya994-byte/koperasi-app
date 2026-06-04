<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CheckAdminAccess extends Command
{
    protected $signature = 'admin:check {email?}';
    protected $description = 'Periksa dan perbaiki akses admin';

    public function handle()
    {
        $email = $this->argument('email');

        if ($email) {
            $user = User::where('email', $email)->first();
            
            if (!$user) {
                $this->error("❌ User dengan email {$email} tidak ditemukan!");
                return 1;
            }

            $this->info("📋 Informasi User:");
            $this->table(
                ['Field', 'Value'],
                [
                    ['ID', $user->id],
                    ['Nama', $user->name],
                    ['Email', $user->email],
                    ['Role', $user->role],
                    ['Status', $user->is_active ? 'Aktif' : 'Tidak Aktif'],
                ]
            );

            if ($user->role !== 'admin') {
                if ($this->confirm("User ini bukan admin. Ubah menjadi admin?")) {
                    $user->update(['role' => 'admin', 'is_active' => true]);
                    $this->info("✅ User berhasil diubah menjadi admin!");
                }
            } elseif (!$user->is_active) {
                if ($this->confirm("User tidak aktif. Aktifkan sekarang?")) {
                    $user->update(['is_active' => true]);
                    $this->info("✅ User berhasil diaktifkan!");
                }
            } else {
                $this->info("✅ User sudah admin dan aktif!");
            }

            if ($this->confirm("Reset password?")) {
                $password = $this->secret('Password baru (kosongkan untuk admin123)') ?: 'admin123';
                $user->update(['password' => Hash::make($password)]);
                $this->info("✅ Password berhasil direset!");
                $this->warn("Password baru: {$password}");
            }

        } else {
            // Tampilkan semua admin
            $admins = User::where('role', 'admin')->get();
            
            if ($admins->isEmpty()) {
                $this->warn("⚠️  Tidak ada user admin!");
                
                if ($this->confirm("Buat user admin baru?")) {
                    $name = $this->ask('Nama', 'Administrator');
                    $email = $this->ask('Email', 'admin@disperindagkop.go.id');
                    $password = $this->secret('Password (kosongkan untuk admin123)') ?: 'admin123';

                    User::create([
                        'name' => $name,
                        'email' => $email,
                        'password' => Hash::make($password),
                        'role' => 'admin',
                        'is_active' => true,
                    ]);

                    $this->info("✅ User admin berhasil dibuat!");
                    $this->info("Email: {$email}");
                    $this->warn("Password: {$password}");
                }
            } else {
                $this->info("📋 Daftar Admin:");
                $this->table(
                    ['ID', 'Nama', 'Email', 'Status'],
                    $admins->map(fn($u) => [
                        $u->id,
                        $u->name,
                        $u->email,
                        $u->is_active ? '✅ Aktif' : '❌ Tidak Aktif'
                    ])
                );

                // Aktifkan semua admin
                $inactive = $admins->where('is_active', false);
                if ($inactive->isNotEmpty()) {
                    if ($this->confirm("Ada {$inactive->count()} admin tidak aktif. Aktifkan semua?")) {
                        User::where('role', 'admin')->update(['is_active' => true]);
                        $this->info("✅ Semua admin berhasil diaktifkan!");
                    }
                }
            }
        }

        return 0;
    }
}
