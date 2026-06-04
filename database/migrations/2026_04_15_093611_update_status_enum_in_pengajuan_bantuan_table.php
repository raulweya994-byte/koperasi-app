<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Expand enum to include both old and new values
        DB::statement("ALTER TABLE `pengajuan_bantuan` MODIFY COLUMN `status` ENUM('pending', 'diterima', 'ditolak', 'menunggu', 'diproses', 'disetujui') DEFAULT 'pending'");
        
        // Step 2: Update existing data
        DB::table('pengajuan_bantuan')->where('status', 'pending')->update(['status' => 'menunggu']);
        DB::table('pengajuan_bantuan')->where('status', 'diterima')->update(['status' => 'disetujui']);
        DB::table('pengajuan_bantuan')->where('status', 'ditolak')->update(['status' => 'ditolak']); // Keep same
        
        // Step 3: Alter column to only new enum values
        DB::statement("ALTER TABLE `pengajuan_bantuan` MODIFY COLUMN `status` ENUM('menunggu', 'diproses', 'disetujui', 'ditolak') DEFAULT 'menunggu'");
    }

    public function down(): void
    {
        // Step 1: Expand enum to include both old and new values
        DB::statement("ALTER TABLE `pengajuan_bantuan` MODIFY COLUMN `status` ENUM('pending', 'diterima', 'ditolak', 'menunggu', 'diproses', 'disetujui') DEFAULT 'menunggu'");
        
        // Step 2: Revert data
        DB::table('pengajuan_bantuan')->where('status', 'menunggu')->update(['status' => 'pending']);
        DB::table('pengajuan_bantuan')->where('status', 'disetujui')->update(['status' => 'diterima']);
        DB::table('pengajuan_bantuan')->where('status', 'diproses')->update(['status' => 'pending']);
        
        // Step 3: Revert to old enum values
        DB::statement("ALTER TABLE `pengajuan_bantuan` MODIFY COLUMN `status` ENUM('pending', 'diterima', 'ditolak') DEFAULT 'pending'");
    }
};
