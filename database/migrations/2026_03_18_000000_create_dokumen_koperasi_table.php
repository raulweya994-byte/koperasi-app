<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen_koperasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('koperasi_id')->constrained('koperasi')->onDelete('cascade');
            $table->enum('jenis_dokumen', ['ktp', 'kk', 'foto_usaha', 'surat_izin', 'lainnya'])->default('lainnya');
            $table->string('nama_file');
            $table->string('path_file');
            $table->integer('ukuran_file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_koperasi');
    }
};
