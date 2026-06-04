<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("notifikasi", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->string("judul");
            $table->text("pesan");
            $table->string("icon")->default("fa-bell");
            $table->string("warna")->default("primary");
            $table->string("url")->nullable();
            $table->boolean("dibaca")->default(false);
            $table->string("tipe")->default("info");
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("notifikasi"); }
};