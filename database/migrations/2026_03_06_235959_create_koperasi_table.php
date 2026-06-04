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
        Schema::create('koperasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('no_registrasi')->unique();
            $table->string('no_ktp');
            $table->string('nama_pemilik');
            $table->string('nama_usaha');
            $table->string('jenis_usaha');
            $table->enum('kategori', ['mikro', 'kecil', 'menengah']);
            $table->text('alamat');
            $table->string('distrik');
            $table->string('kelurahan')->nullable();
            $table->string('no_telp');
            $table->string('email')->nullable();
            $table->decimal('modal_usaha', 15, 2)->default(0);
            $table->decimal('omset_per_bulan', 15, 2)->default(0);
            $table->integer('jumlah_karyawan')->default(0);
            $table->enum('status_verifikasi', ['pending', 'diverifikasi', 'ditolak'])->default('pending');
            $table->enum('status_usaha', ['aktif', 'tidak aktif'])->default('aktif');
            $table->text('catatan_verifikasi')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at')->nullable();
            $table->string('foto_usaha')->nullable();
            $table->timestamps();

            $table->index(['status_verifikasi', 'status_usaha']);
            $table->index('distrik');
            $table->index('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koperasi');
    }
};

