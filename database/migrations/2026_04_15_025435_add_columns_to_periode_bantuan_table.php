<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('periode_bantuan', function (Blueprint $table) {
            if (!Schema::hasColumn('periode_bantuan', 'nama_periode')) {
                $table->string('nama_periode')->after('id');
            }
            if (!Schema::hasColumn('periode_bantuan', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('nama_periode');
            }
            if (!Schema::hasColumn('periode_bantuan', 'tanggal_mulai')) {
                $table->date('tanggal_mulai')->after('deskripsi');
            }
            if (!Schema::hasColumn('periode_bantuan', 'tanggal_selesai')) {
                $table->date('tanggal_selesai')->after('tanggal_mulai');
            }
            if (!Schema::hasColumn('periode_bantuan', 'status')) {
                $table->enum('status', ['aktif', 'nonaktif'])->default('nonaktif')->after('tanggal_selesai');
            }
            if (!Schema::hasColumn('periode_bantuan', 'kuota_penerima')) {
                $table->integer('kuota_penerima')->nullable()->after('status');
            }
            if (!Schema::hasColumn('periode_bantuan', 'anggaran_total')) {
                $table->decimal('anggaran_total', 15, 2)->nullable()->after('kuota_penerima');
            }
            if (!Schema::hasColumn('periode_bantuan', 'created_by')) {
                $table->foreignId('created_by')->nullable()->after('anggaran_total')->constrained('users')->onDelete('set null');
            }
        });
    }
    public function down(): void
    {
        Schema::table('periode_bantuan', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn([
                'nama_periode', 'deskripsi', 'tanggal_mulai',
                'tanggal_selesai', 'status', 'kuota_penerima',
                'anggaran_total', 'created_by',
            ]);
        });
    }
};
