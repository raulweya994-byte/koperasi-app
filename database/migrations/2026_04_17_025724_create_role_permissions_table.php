<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('role'); // admin, petugas, pimpinan, koperasi, anggota
            $table->string('module'); // koperasi, anggota, berita, galeri, dll
            $table->boolean('can_view')->default(false);
            $table->boolean('can_create')->default(false);
            $table->boolean('can_edit')->default(false);
            $table->boolean('can_delete')->default(false);
            $table->boolean('can_export')->default(false);
            $table->boolean('can_approve')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();
            
            // Unique constraint untuk role + module
            $table->unique(['role', 'module']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
};
