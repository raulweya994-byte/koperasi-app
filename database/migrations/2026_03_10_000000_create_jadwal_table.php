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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->enum('jenis', ['verifikasi', 'pelatihan', 'penilaian_bantuan', 'rapat'])->default('verifikasi');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai')->nullable();
            $table->string('lokasi')->nullable();
            $table->enum('status', ['dijadwalkan', 'berlangsung', 'selesai', 'dibatalkan'])->default('dijadwalkan');
            $table->boolean('is_publik')->default(false);
            $table->text('catatan')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('petugas_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });

        // Tabel pivot untuk relasi many-to-many jadwal dengan koperasi
        Schema::create('jadwal_koperasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->constrained('jadwal')->onDelete('cascade');
            $table->foreignId('koperasi_id')->constrained('koperasi')->onDelete('cascade');
            $table->enum('status_hadir', ['hadir', 'tidak_hadir', 'belum_konfirmasi'])->default('belum_konfirmasi');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_koperasi');
        Schema::dropIfExists('jadwal');
    }
};
