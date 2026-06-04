<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemSetting;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'app_name',
                'value' => 'DISPERINDAGKOP',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Nama Aplikasi',
                'description' => 'Nama aplikasi yang ditampilkan di seluruh sistem',
            ],
            [
                'key' => 'app_short_name',
                'value' => 'Kab. Tolikara',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Nama Singkat',
                'description' => 'Nama singkat aplikasi',
            ],
            [
                'key' => 'app_description',
                'value' => 'Sistem Informasi Manajemen Koperasi',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Deskripsi Aplikasi',
                'description' => 'Deskripsi singkat tentang aplikasi',
            ],
            [
                'key' => 'app_footer',
                'value' => '© 2026 DISPERINDAGKOP Kabupaten Tolikara. All rights reserved.',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Footer Text',
                'description' => 'Text yang ditampilkan di footer',
            ],

            // Logo & Images
            [
                'key' => 'logo',
                'value' => 'logo.png',
                'type' => 'image',
                'group' => 'appearance',
                'label' => 'Logo Aplikasi',
                'description' => 'Logo utama aplikasi (sidebar & header)',
            ],
            [
                'key' => 'logo_login',
                'value' => 'logo.png',
                'type' => 'image',
                'group' => 'appearance',
                'label' => 'Logo Login',
                'description' => 'Logo yang ditampilkan di halaman login',
            ],
            [
                'key' => 'favicon',
                'value' => 'logo.png',
                'type' => 'image',
                'group' => 'appearance',
                'label' => 'Favicon',
                'description' => 'Icon yang ditampilkan di tab browser',
            ],

            // Color Theme
            [
                'key' => 'color_primary',
                'value' => '#1a3a6e',
                'type' => 'color',
                'group' => 'appearance',
                'label' => 'Warna Primary',
                'description' => 'Warna utama aplikasi',
            ],
            [
                'key' => 'color_secondary',
                'value' => '#3b82f6',
                'type' => 'color',
                'group' => 'appearance',
                'label' => 'Warna Secondary',
                'description' => 'Warna sekunder aplikasi',
            ],
            [
                'key' => 'color_sidebar',
                'value' => '#1a3a6e',
                'type' => 'color',
                'group' => 'appearance',
                'label' => 'Warna Sidebar',
                'description' => 'Warna background sidebar',
            ],
            [
                'key' => 'color_success',
                'value' => '#10b981',
                'type' => 'color',
                'group' => 'appearance',
                'label' => 'Warna Success',
                'description' => 'Warna untuk status sukses',
            ],
            [
                'key' => 'color_warning',
                'value' => '#f59e0b',
                'type' => 'color',
                'group' => 'appearance',
                'label' => 'Warna Warning',
                'description' => 'Warna untuk status warning',
            ],
            [
                'key' => 'color_danger',
                'value' => '#ef4444',
                'type' => 'color',
                'group' => 'appearance',
                'label' => 'Warna Danger',
                'description' => 'Warna untuk status danger',
            ],

            // Contact Information
            [
                'key' => 'contact_email',
                'value' => 'disperindagkop@tolikara.go.id',
                'type' => 'email',
                'group' => 'contact',
                'label' => 'Email',
                'description' => 'Email kontak resmi',
            ],
            [
                'key' => 'contact_phone',
                'value' => '(0969) 12345',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Telepon',
                'description' => 'Nomor telepon kantor',
            ],
            [
                'key' => 'contact_whatsapp',
                'value' => '081234567890',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'WhatsApp',
                'description' => 'Nomor WhatsApp',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Kabupaten Tolikara, Papua Pegunungan',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Alamat',
                'description' => 'Alamat lengkap kantor',
            ],
        ];

        foreach ($settings as $setting) {
            SystemSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
