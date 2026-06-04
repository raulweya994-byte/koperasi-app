<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_pelatihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatihan_id')->constrained('pelatihan')->onDelete('cascade');
            $table->foreignId('koperasi_id')->nullable()->constrained('koperasi')->onDelete('cascade');
            $table->string('nama_peserta');
            $table->string('no_hp', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('nama_usaha')->nullable();
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_pelatihan');
    }
};
