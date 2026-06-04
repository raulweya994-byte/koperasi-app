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
        // Rename kolom foto_profil menjadi profile_photo menggunakan raw SQL untuk MariaDB
        if (Schema::hasColumn('users', 'foto_profil')) {
            DB::statement('ALTER TABLE users CHANGE foto_profil profile_photo VARCHAR(255) NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'profile_photo')) {
            DB::statement('ALTER TABLE users CHANGE profile_photo foto_profil VARCHAR(255) NULL');
        }
    }
};
