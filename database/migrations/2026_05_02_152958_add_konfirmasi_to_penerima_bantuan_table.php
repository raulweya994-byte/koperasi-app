<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penerima_bantuan', function (Blueprint $table) {
            $table->enum('status_penyaluran', ['belum','tersalurkan','tidak_hadir'])->default('belum')->after('status');
            $table->timestamp('waktu_konfirmasi')->nullable()->after('status_penyaluran');
            $table->foreignId('dikonfirmasi_oleh')->nullable()->after('waktu_konfirmasi');
            $table->text('catatan_konfirmasi')->nullable()->after('dikonfirmasi_oleh');
        });
    }

    public function down(): void
    {
        Schema::table('penerima_bantuan', function (Blueprint $table) {
            $table->dropColumn(['status_penyaluran','waktu_konfirmasi','dikonfirmasi_oleh','catatan_konfirmasi']);
        });
    }
};
