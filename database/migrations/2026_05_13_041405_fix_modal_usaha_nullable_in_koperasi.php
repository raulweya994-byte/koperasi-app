<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('koperasi', function (Blueprint $table) {
            $table->decimal('modal_usaha', 15, 2)->nullable()->change();
            $table->decimal('omset_per_bulan', 15, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('koperasi', function (Blueprint $table) {
            $table->decimal('modal_usaha', 15, 2)->nullable(false)->change();
            $table->decimal('omset_per_bulan', 15, 2)->nullable(false)->change();
        });
    }
};
