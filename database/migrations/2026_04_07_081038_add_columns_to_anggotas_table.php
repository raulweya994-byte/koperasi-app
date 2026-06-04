<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up() {
        if (Schema::hasTable('anggotas')) {
            Schema::table('anggotas', function (Blueprint $table) {
                if (!Schema::hasColumn('anggotas', 'user_id')) {
                    $table->foreignId('user_id')->nullable()->after('id')->constrained()->onDelete('set null');
                }
                if (!Schema::hasColumn('anggotas', 'catatan_admin')) {
                    $table->text('catatan_admin')->nullable()->after('status');
                }
                if (!Schema::hasColumn('anggotas', 'tanggal_verifikasi')) {
                    $table->timestamp('tanggal_verifikasi')->nullable()->after('catatan_admin');
                }
            });
        }
    }
    public function down() {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id','catatan_admin','tanggal_verifikasi']);
        });
    }
};
