<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Rename kolom dibaca menjadi is_read menggunakan raw SQL untuk MariaDB
        if (Schema::hasColumn('notifikasi', 'dibaca')) {
            DB::statement('ALTER TABLE notifikasi CHANGE dibaca is_read TINYINT(1) NOT NULL DEFAULT 0');
        }
        
        // Step 2: Tambah kolom baru setelah rename selesai
        Schema::table('notifikasi', function (Blueprint $table) {
            // Tambah kolom jenis jika belum ada
            if (!Schema::hasColumn('notifikasi', 'jenis')) {
                $table->enum('jenis', ['info', 'success', 'warning', 'danger'])->default('info')->after('tipe');
            }
            
            // Tambah kolom read_at jika belum ada
            if (!Schema::hasColumn('notifikasi', 'read_at')) {
                $table->timestamp('read_at')->nullable()->after('is_read');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('notifikasi', 'is_read')) {
            DB::statement('ALTER TABLE notifikasi CHANGE is_read dibaca TINYINT(1) NOT NULL DEFAULT 0');
        }
        
        Schema::table('notifikasi', function (Blueprint $table) {
            if (Schema::hasColumn('notifikasi', 'jenis')) {
                $table->dropColumn('jenis');
            }
            
            if (Schema::hasColumn('notifikasi', 'read_at')) {
                $table->dropColumn('read_at');
            }
        });
    }
};
