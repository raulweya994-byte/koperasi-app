<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Distrik
        Schema::create('distrik', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('nama');
            $table->string('ibu_kota')->nullable();
            $table->timestamps();
        });

        // Tabel Kelurahan
        Schema::create('kelurahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distrik_id')->constrained('distrik')->onDelete('cascade');
            $table->string('nama');
            $table->timestamps();
        });

        // Tabel Kampung
        Schema::create('kampung', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distrik_id')->constrained('distrik')->onDelete('cascade');
            $table->string('nama');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kampung');
        Schema::dropIfExists('kelurahan');
        Schema::dropIfExists('distrik');
    }
};
