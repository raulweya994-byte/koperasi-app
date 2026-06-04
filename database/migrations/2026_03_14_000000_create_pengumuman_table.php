<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->enum('jenis', ['info', 'penting', 'urgent'])->default('info');
            $table->enum('tampil_di', ['semua', 'admin', 'koperasi', 'anggota'])->default('semua');
            $table->boolean('is_aktif')->default(true);
            $table->timestamp('mulai_tampil')->nullable();
            $table->timestamp('selesai_tampil')->nullable();
            $table->string('link')->nullable();
            $table->string('foto')->nullable();
            $table->string('video')->nullable();
            $table->enum('jenis_video', ['youtube', 'upload'])->nullable();
            $table->integer('urutan')->default(0);
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
