<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Default values
        DB::table('settings')->insert([
            ['key' => 'site_name',        'value' => 'DISPERINDAGKOP Kab. Tolikara'],
            ['key' => 'footer_copyright', 'value' => '© 2025 DISPERINDAGKOP Kabupaten Tolikara. All rights reserved.'],
            ['key' => 'footer_address',   'value' => 'Jl. Contoh No. 1, Karubaga, Tolikara, Papua Pegunungan'],
            ['key' => 'footer_phone',     'value' => '(0964) 123456'],
            ['key' => 'footer_email',     'value' => 'info@disperindagkop-tolikara.go.id'],
            ['key' => 'footer_website',   'value' => 'www.disperindagkop-tolikara.go.id'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};