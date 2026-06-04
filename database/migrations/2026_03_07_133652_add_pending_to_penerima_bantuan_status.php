<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Masukkan semua nilai yang sudah ada + pending
        DB::statement("ALTER TABLE penerima_bantuan MODIFY COLUMN status ENUM('pending','diterima','divalidasi','ditolak','disalurkan') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE penerima_bantuan MODIFY COLUMN status ENUM('diterima','divalidasi','ditolak','disalurkan') NOT NULL DEFAULT 'diterima'");
    }
};