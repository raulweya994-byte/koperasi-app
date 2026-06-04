<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bantuan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bantuan')->unique();
            $table->string('nama_bantuan');
            $table->string('jenis_bantuan');
            $table->year('tahun');
            $table->string('periode');
            $table->text('deskripsi');
            $table->decimal('anggaran', 15, 2);
            $table->integer('kuota');
            $table->enum('status', ['aktif', 'selesai', 'dibatalkan'])->default('aktif');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->index(['tahun', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bantuan');
    }
};

