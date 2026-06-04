<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
public function up(): void
    {
        if (!Schema::hasColumn('koperasi', 'foto_usaha')) {
            Schema::table('koperasi', function (Blueprint $table) {
                $table->string('foto_usaha')->nullable()->after('email');
            });
        }
    }
    public function down(): void
    {
        Schema::table('koperasi', function (Blueprint $table) {
            $table->dropColumn('foto_usaha');
        });
    }
};
