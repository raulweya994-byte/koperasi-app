<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update enum jenis di tabel pengumuman
        DB::statement("ALTER TABLE `pengumuman` MODIFY COLUMN `jenis` ENUM('info', 'warning', 'success', 'danger', 'penting', 'urgent') DEFAULT 'info'");
    }

    public function down(): void
    {
        // Kembalikan ke enum lama
        DB::statement("ALTER TABLE `pengumuman` MODIFY COLUMN `jenis` ENUM('info', 'penting', 'urgent') DEFAULT 'info'");
    }
};
