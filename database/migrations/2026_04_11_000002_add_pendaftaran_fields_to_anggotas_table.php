<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('anggotas', function (Blueprint $table) {
            // Identitas tambahan
            if (!Schema::hasColumn('anggotas', 'status_perkawinan')) {
                $table->string('status_perkawinan')->nullable()->after('jenis_kelamin');
            }
            if (!Schema::hasColumn('anggotas', 'pendidikan_terakhir')) {
                $table->string('pendidikan_terakhir')->nullable()->after('status_perkawinan');
            }
            
            // Alamat tambahan
            if (!Schema::hasColumn('anggotas', 'kode_pos')) {
                $table->string('kode_pos', 10)->nullable()->after('alamat_lengkap');
            }
            if (!Schema::hasColumn('anggotas', 'koordinat_gps')) {
                $table->string('koordinat_gps')->nullable()->after('kode_pos');
            }
            if (!Schema::hasColumn('anggotas', 'status_kepemilikan_rumah')) {
                $table->string('status_kepemilikan_rumah')->nullable()->after('koordinat_gps');
            }
            
            // Usaha tambahan
            if (!Schema::hasColumn('anggotas', 'bidang_usaha')) {
                $table->string('bidang_usaha')->nullable()->after('nama_usaha');
            }
            if (!Schema::hasColumn('anggotas', 'lama_berdiri_usaha')) {
                $table->integer('lama_berdiri_usaha')->nullable()->after('bidang_usaha');
            }
            if (!Schema::hasColumn('anggotas', 'jumlah_karyawan')) {
                $table->integer('jumlah_karyawan')->nullable()->after('lama_berdiri_usaha');
            }
            if (!Schema::hasColumn('anggotas', 'alamat_tempat_usaha')) {
                $table->text('alamat_tempat_usaha')->nullable()->after('jumlah_karyawan');
            }
            if (!Schema::hasColumn('anggotas', 'legalitas_usaha')) {
                $table->string('legalitas_usaha')->nullable()->after('alamat_tempat_usaha');
            }
            
            // Keuangan
            if (!Schema::hasColumn('anggotas', 'nama_bank')) {
                $table->string('nama_bank')->nullable()->after('legalitas_usaha');
            }
            if (!Schema::hasColumn('anggotas', 'nomor_rekening')) {
                $table->string('nomor_rekening')->nullable()->after('nama_bank');
            }
            if (!Schema::hasColumn('anggotas', 'nama_pemilik_rekening')) {
                $table->string('nama_pemilik_rekening')->nullable()->after('nomor_rekening');
            }
            if (!Schema::hasColumn('anggotas', 'npwp')) {
                $table->string('npwp', 15)->nullable()->after('nama_pemilik_rekening');
            }
            
            // Ahli Waris
            if (!Schema::hasColumn('anggotas', 'nama_ahli_waris')) {
                $table->string('nama_ahli_waris')->nullable()->after('npwp');
            }
            if (!Schema::hasColumn('anggotas', 'hubungan_ahli_waris')) {
                $table->string('hubungan_ahli_waris')->nullable()->after('nama_ahli_waris');
            }
            if (!Schema::hasColumn('anggotas', 'no_hp_ahli_waris')) {
                $table->string('no_hp_ahli_waris')->nullable()->after('hubungan_ahli_waris');
            }
            if (!Schema::hasColumn('anggotas', 'nik_ahli_waris')) {
                $table->string('nik_ahli_waris', 16)->nullable()->after('no_hp_ahli_waris');
            }
            
            // Simpanan
            if (!Schema::hasColumn('anggotas', 'simpanan_pokok')) {
                $table->decimal('simpanan_pokok', 15, 2)->default(0)->after('nik_ahli_waris');
            }
            if (!Schema::hasColumn('anggotas', 'simpanan_wajib')) {
                $table->decimal('simpanan_wajib', 15, 2)->default(0)->after('simpanan_pokok');
            }
            if (!Schema::hasColumn('anggotas', 'tanggal_bergabung')) {
                $table->date('tanggal_bergabung')->nullable()->after('simpanan_wajib');
            }
            
            // Dokumen
            if (!Schema::hasColumn('anggotas', 'foto_tanda_tangan')) {
                $table->string('foto_tanda_tangan')->nullable()->after('foto');
            }
            if (!Schema::hasColumn('anggotas', 'foto_kk')) {
                $table->string('foto_kk')->nullable()->after('foto_tanda_tangan');
            }
            if (!Schema::hasColumn('anggotas', 'foto_lokasi_usaha')) {
                $table->string('foto_lokasi_usaha')->nullable()->after('foto_kk');
            }
            if (!Schema::hasColumn('anggotas', 'foto_selfie_ktp')) {
                $table->string('foto_selfie_ktp')->nullable()->after('foto_lokasi_usaha');
            }
            
            // Periode Pendaftaran
            if (!Schema::hasColumn('anggotas', 'periode_pendaftaran_id')) {
                $table->foreignId('periode_pendaftaran_id')->nullable()->after('user_id')->constrained('periode_pendaftaran')->onDelete('set null');
            }
            
            // Created By
            if (!Schema::hasColumn('anggotas', 'created_by')) {
                $table->foreignId('created_by')->nullable()->after('periode_pendaftaran_id')->constrained('users')->onDelete('set null');
            }
            
            // Koperasi
            if (!Schema::hasColumn('anggotas', 'koperasi_id')) {
                $table->foreignId('koperasi_id')->nullable()->after('created_by')->constrained('koperasi')->onDelete('set null');
            }
        });
    }

    public function down() {
        Schema::table('anggotas', function (Blueprint $table) {
            $columns = [
                'status_perkawinan', 'pendidikan_terakhir', 'kode_pos', 'koordinat_gps', 
                'status_kepemilikan_rumah', 'bidang_usaha', 'lama_berdiri_usaha', 
                'jumlah_karyawan', 'alamat_tempat_usaha', 'legalitas_usaha',
                'nama_bank', 'nomor_rekening', 'nama_pemilik_rekening', 'npwp',
                'nama_ahli_waris', 'hubungan_ahli_waris', 'no_hp_ahli_waris', 'nik_ahli_waris',
                'simpanan_pokok', 'simpanan_wajib', 'tanggal_bergabung',
                'foto_tanda_tangan', 'foto_kk', 'foto_lokasi_usaha', 'foto_selfie_ktp',
                'periode_pendaftaran_id', 'created_by', 'koperasi_id'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('anggotas', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
