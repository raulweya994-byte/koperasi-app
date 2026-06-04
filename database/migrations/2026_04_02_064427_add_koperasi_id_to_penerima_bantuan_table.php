<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
if (!Schema::hasColumn('penerima_bantuan', 'koperasi_id')) {
    Schema::table('penerima_bantuan', function (Blueprint $table) {
        $table->foreignId('koperasi_id')
              ->nullable()
              ->constrained('koperasi')
              ->onDelete('cascade');
    });
}
    }

    public function down(): void
    {
        Schema::table('penerima_bantuan', function (Blueprint $table) {
            $table->dropForeign(['koperasi_id']);
            $table->dropColumn('koperasi_id');
        });
    }
};
