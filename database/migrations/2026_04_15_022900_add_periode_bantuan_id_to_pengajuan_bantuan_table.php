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
        Schema::table('pengajuan_bantuan', function (Blueprint $table) {
            $table->foreignId('periode_bantuan_id')->nullable()->after('id')->constrained('periode_bantuan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_bantuan', function (Blueprint $table) {
            $table->dropForeign(['periode_bantuan_id']);
            $table->dropColumn('periode_bantuan_id');
        });
    }
};
