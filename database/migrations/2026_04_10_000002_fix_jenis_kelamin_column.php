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
        // Ubah kolom jenis_kelamin dari enum('Laki-laki','Perempuan') menjadi enum('L','P')
        DB::statement("ALTER TABLE anggotas MODIFY COLUMN jenis_kelamin ENUM('L', 'P') NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE anggotas MODIFY COLUMN jenis_kelamin ENUM('Laki-laki', 'Perempuan') NULL");
    }
};
