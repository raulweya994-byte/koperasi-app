<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('no_anggota')->unique()->nullable();
            $table->string('nik', 16)->unique();
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('agama')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('desa')->nullable();
            $table->string('distrik')->nullable();
            $table->string('kabupaten')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('nama_komplek_dekat_desa')->nullable();
            $table->string('nama_usaha')->nullable();
            $table->decimal('modal_usaha', 15, 2)->default(0);
            $table->decimal('omzet_per_bulan', 15, 2)->default(0);
            $table->decimal('total_simpanan', 15, 2)->default(0);
            $table->text('keterangan_usaha')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['Pending', 'Aktif', 'Nonaktif', 'Ditolak'])->default('Pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('anggotas');
    }
};
