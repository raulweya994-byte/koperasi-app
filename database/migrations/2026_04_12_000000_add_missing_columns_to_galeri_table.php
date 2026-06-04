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
        Schema::table('galeri', function (Blueprint $table) {
            // Add missing columns
            $table->string('kategori')->default('kegiatan')->after('deskripsi');
            $table->integer('urutan')->default(0)->after('kategori');
            $table->boolean('is_active')->default(true)->after('urutan');
        });
    }

    /**
     * Run the migrations.
     */
    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'urutan', 'is_active']);
        });
    }
};
