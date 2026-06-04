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
        Schema::create('periode_pendaftaran_koperasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_periode');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->boolean('is_active')->default(false);
            $table->integer('kuota')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            $table->index('is_active');
            $table->index(['tanggal_mulai', 'tanggal_selesai']);
        });
        
        // Tambahkan kolom periode_pendaftaran_koperasi_id ke tabel koperasi
        Schema::table('koperasi', function (Blueprint $table) {
            $table->foreignId('periode_pendaftaran_koperasi_id')
                  ->nullable()
                  ->after('user_id')
                  ->constrained('periode_pendaftaran_koperasi')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('koperasi', function (Blueprint $table) {
            $table->dropForeign(['periode_pendaftaran_koperasi_id']);
            $table->dropColumn('periode_pendaftaran_koperasi_id');
        });
        
        Schema::dropIfExists('periode_pendaftaran_koperasi');
    }
};
