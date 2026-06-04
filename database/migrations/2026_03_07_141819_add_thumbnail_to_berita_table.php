<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
if (Schema::hasTable('berita')) {
    Schema::table('berita', function (Blueprint $table) {
        if (!Schema::hasColumn('berita', 'thumbnail')) {
            $table->string('thumbnail')->nullable()->after('slug');
        }
        if (!Schema::hasColumn('berita', 'kategori')) {
            $table->string('kategori')->default('umum')->after('konten');
        }
        if (!Schema::hasColumn('berita', 'status')) {
            $table->enum('status', ['draft', 'publish'])->default('draft')->after('kategori');
        }
        if (!Schema::hasColumn('berita', 'created_by')) {
            $table->foreignId('created_by')->nullable()->constrained('users')->after('status');
        }
        if (!Schema::hasColumn('berita', 'published_at')) {
            $table->timestamp('published_at')->nullable()->after('created_by');
        }
    });
}
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn(['thumbnail', 'kategori', 'status', 'created_by', 'published_at']);
        });
    }
};