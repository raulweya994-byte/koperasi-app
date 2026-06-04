<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // ── Identitas Sistem ──────────────────────
            ['key' => 'site_name',        'value' => 'DISPERINDAGKOP Kab. Tolikara'],

            // ── Footer Admin ──────────────────────────
            ['key' => 'footer_copyright', 'value' => '© ' . date('Y') . ' DISPERINDAGKOP Kabupaten Tolikara. All rights reserved.'],
            ['key' => 'footer_address',   'value' => 'Jl. Raya Karubaga, Kab. Tolikara, Papua Pegunungan'],
            ['key' => 'footer_phone',     'value' => '(0964) 123456'],
            ['key' => 'footer_email',     'value' => 'info@disperindagkop.tolikara.go.id'],
            ['key' => 'footer_website',   'value' => 'www.disperindagkop-tolikara.go.id'],

            // ── Header Publik (bar merah di atas) ─────
            ['key' => 'office_address',   'value' => 'Jl. Raya Karubaga, Kab. Tolikara, Papua Pegunungan'],
            ['key' => 'office_phone',     'value' => '(0964) 123456'],
            ['key' => 'office_email',     'value' => 'info@disperindagkop.tolikara.go.id'],
            ['key' => 'office_hours',     'value' => 'Senin-Jumat: 08.00 - 16.00 WIT'],

            // ── Sosial Media ──────────────────────────
            ['key' => 'social_facebook',  'value' => 'https://facebook.com/disperindagkop.tolikara'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/disperindagkop.tolikara'],
            ['key' => 'social_youtube',   'value' => 'https://youtube.com/@disperindagkop'],
            ['key' => 'social_twitter',   'value' => 'https://twitter.com/disperindagkop'],

            // ── Deskripsi Instansi ────────────────────
            ['key' => 'site_description', 'value' => 'Dinas Perindustrian, Perdagangan, Koperasi dan KOPERASI Kabupaten Tolikara hadir untuk mendorong pertumbuhan ekonomi lokal melalui pembinaan dan pengembangan KOPERASI.'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],   // cari berdasarkan key
                ['value' => $setting['value'], 'updated_at' => now(), 'created_at' => now()]
            );
        }

        $this->command->info('✅ Settings berhasil diisi!');
    }
}