<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_bantuan', function (Blueprint $table) {
            $table->id();
$table->unsignedBigInteger('koperasi_id')->nullable();
            $table->string('nama_pemohon');
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->string('nama_usaha');
            $table->string('jenis_bantuan');
            $table->decimal('jumlah_diajukan', 15, 2);
            $table->text('tujuan_penggunaan');
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
            
            $table->index('status');
            $table->index('koperasi_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_bantuan');
    }
};

