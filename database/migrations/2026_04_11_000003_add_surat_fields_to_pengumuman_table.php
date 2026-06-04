<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->date('tanggal')->nullable()->after('isi');
            $table->string('hari', 20)->nullable()->after('tanggal');
            $table->time('jam')->nullable()->after('hari');
            $table->year('tahun')->nullable()->after('jam');
            $table->string('pembuat')->nullable()->after('tahun');
        });
    }

    public function down(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->dropColumn(['tanggal', 'hari', 'jam', 'tahun', 'pembuat']);
        });
    }
};
