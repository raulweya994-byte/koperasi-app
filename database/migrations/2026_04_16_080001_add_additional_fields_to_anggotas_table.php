<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            // Cek apakah kolom belum ada sebelum menambahkan
            if (!Schema::hasColumn('anggotas', 'pekerjaan')) {
                $table->string('pekerjaan')->nullable()->after('email');
            }
            if (!Schema::hasColumn('anggotas', 'nama_ibu_kandung')) {
                $table->string('nama_ibu_kandung')->nullable()->after('npwp');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            if (Schema::hasColumn('anggotas', 'pekerjaan')) {
                $table->dropColumn('pekerjaan');
            }
            if (Schema::hasColumn('anggotas', 'nama_ibu_kandung')) {
                $table->dropColumn('nama_ibu_kandung');
            }
        });
    }
};
