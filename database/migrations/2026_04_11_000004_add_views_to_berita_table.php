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
        if (Schema::hasTable('berita')) {
            Schema::table('berita', function (Blueprint $table) {
                if (!Schema::hasColumn('berita', 'views')) {
                    $table->unsignedBigInteger('views')->default(0)->after('published_at');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('berita')) {
            Schema::table('berita', function (Blueprint $table) {
                if (Schema::hasColumn('berita', 'views')) {
                    $table->dropColumn('views');
                }
            });
        }
    }
};
