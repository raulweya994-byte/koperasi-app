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
        Schema::table('simpanans', function (Blueprint $table) {
            $table->foreignId('anggota_id')->nullable()->after('id')->constrained('anggotas')->onDelete('cascade');
            $table->string('jenis_simpanan', 50)->nullable()->after('anggota_id')->comment('Simpanan Pokok | Simpanan Wajib | Simpanan Sukarela');
            $table->decimal('jumlah', 15, 2)->default(0)->after('jenis_simpanan');
            $table->date('tanggal')->nullable()->after('jumlah');
            $table->text('keterangan')->nullable()->after('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simpanans', function (Blueprint $table) {
            $table->dropForeign(['anggota_id']);
            $table->dropColumn(['anggota_id', 'jenis_simpanan', 'jumlah', 'tanggal', 'keterangan']);
        });
    }
};
