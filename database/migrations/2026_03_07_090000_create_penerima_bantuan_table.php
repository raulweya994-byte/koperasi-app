<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penerima_bantuan', function (Blueprint $table) {
            $table->id();
$table->unsignedBigInteger('bantuan_id')->unsigned()->index()->references('id')->on('bantuan')->onDelete('cascade');
$table->unsignedBigInteger('koperasi_id')->nullable();
            $table->date('tanggal_penerimaan')->nullable();
            $table->decimal('jumlah_bantuan', 15, 2);
            $table->enum('status', ['diterima','divalidasi','ditolak','disalurkan','pending'])->default('pending');
            $table->text('catatan')->nullable();
            $table->foreignId('validated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('validated_at')->nullable();
            $table->timestamps();

            $table->index(['bantuan_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerima_bantuan');
    }
};

