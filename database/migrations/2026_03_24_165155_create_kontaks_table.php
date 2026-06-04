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
  // in the migration file
Schema::create('kontaks', function (Blueprint $table) {
    $table->id();
    $table->string('nama');       // or whatever columns you need
    $table->string('nilai');
    $table->integer('urutan')->default(0);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontaks');
    }
};
