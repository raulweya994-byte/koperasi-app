<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SystemSettingController extends Controller
{
    public function index()
    {
        // Define settings structure
        $settingsStructure = [
            'general' => [
                ['key' => 'app_name', 'label' => 'Nama Aplikasi', 'type' => 'text', 'description' => 'Nama aplikasi yang ditampilkan di seluruh sistem'],
                ['key' => 'app_short_name', 'label' => 'Nama Singkat', 'type' => 'text', 'description' => 'Nama singkat aplikasi'],
                ['key' => 'app_description', 'label' => 'Deskripsi Aplikasi', 'type' => 'textarea', 'description' => 'Deskripsi singkat tentang aplikasi'],
                ['key' => 'app_footer', 'label' => 'Footer Text', 'type' => 'text', 'description' => 'Text yang ditampilkan di footer'],
            ],
            'appearance' => [
                ['key' => 'logo', 'label' => 'Logo Aplikasi', 'type' => 'image', 'description' => 'Logo utama aplikasi (sidebar & header)'],
                ['key' => 'logo_login', 'label' => 'Logo Login', 'type' => 'image', 'description' => 'Logo yang ditampilkan di halaman login'],
                ['key' => 'favicon', 'label' => 'Favicon', 'type' => 'image', 'description' => 'Icon yang ditampilkan di tab browser'],
                ['key' => 'color_primary', 'label' => 'Warna Primary', 'type' => 'color', 'description' => 'Warna utama aplikasi (navbar, sidebar)'],
                ['key' => 'color_secondary', 'label' => 'Warna Secondary', 'type' => 'color', 'description' => 'Warna sekunder aplikasi (gradient)'],
                ['key' => 'color_topbar', 'label' => 'Warna Topbar', 'type' => 'color', 'description' => 'Warna topbar (bagian jam & info di atas navbar)'],
                ['key' => 'color_topbar_secondary', 'label' => 'Warna Topbar Secondary', 'type' => 'color', 'description' => 'Warna gradient topbar'],
                ['key' => 'color_sidebar', 'label' => 'Warna Sidebar', 'type' => 'color', 'description' => 'Warna background sidebar'],
                ['key' => 'color_success', 'label' => 'Warna Success', 'type' => 'color', 'description' => 'Warna untuk status sukses'],
                ['key' => 'color_warning', 'label' => 'Warna Warning', 'type' => 'color', 'description' => 'Warna untuk status warning'],
                ['key' => 'color_danger', 'label' => 'Warna Danger', 'type' => 'color', 'description' => 'Warna untuk status danger'],
            ],
            'contact' => [
                ['key' => 'contact_email', 'label' => 'Email', 'type' => 'email', 'description' => 'Email kontak resmi'],
                ['key' => 'contact_phone', 'label' => 'Telepon', 'type' => 'text', 'description' => 'Nomor telepon kantor'],
                ['key' => 'contact_whatsapp', 'label' => 'WhatsApp', 'type' => 'text', 'description' => 'Nomor WhatsApp'],
                ['key' => 'contact_address', 'label' => 'Alamat', 'type' => 'textarea', 'description' => 'Alamat lengkap kantor'],
            ],
        ];

        // Get current values from database
        $settings = collect();
        foreach ($settingsStructure as $group => $items) {
            $groupSettings = collect();
            foreach ($items as $item) {
                $value = Setting::get($item['key'], $this->getDefaultValue($item['key']));
                $groupSettings->push((object) array_merge($item, ['value' => $value, 'group' => $group]));
            }
            $settings->put($group, $groupSettings);
        }
        
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
        ]);

        foreach ($request->settings as $key => $value) {
            // Handle file upload for image type
            if ($request->hasFile("settings.{$key}")) {
                // Delete old image if exists and not default
                $oldValue = Setting::get($key);
                if ($oldValue && $oldValue !== 'logo.png' && Storage::disk('public')->exists($oldValue)) {
                    Storage::disk('public')->delete($oldValue);
                }
                
                // Upload new image
                $file = $request->file("settings.{$key}");
                $filename = time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('settings', $filename, 'public');
                $value = $path;
            }

            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil disimpan');
    }

    public function reset()
    {
        // Reset to default values
        $defaults = [
            'app_name' => 'DISPERINDAGKOP',
            'app_short_name' => 'Kab. Tolikara',
            'app_description' => 'Sistem Informasi Manajemen Koperasi',
            'app_footer' => '© 2026 DISPERINDAGKOP Kabupaten Tolikara. All rights reserved.',
            'logo' => 'logo.png',
            'logo_login' => 'logo.png',
            'favicon' => 'logo.png',
            'color_primary' => '#1a3a6e',
            'color_secondary' => '#3b82f6',
            'color_topbar' => '#c8102e',
            'color_topbar_secondary' => '#a00d24',
            'color_sidebar' => '#1a3a6e',
            'color_success' => '#10b981',
            'color_warning' => '#f59e0b',
            'color_danger' => '#ef4444',
            'contact_email' => 'disperindagkop@tolikara.go.id',
            'contact_phone' => '(0969) 12345',
            'contact_whatsapp' => '081234567890',
            'contact_address' => 'Kabupaten Tolikara, Papua Pegunungan',
        ];

        foreach ($defaults as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil direset ke default');
    }

    private function getDefaultValue($key)
    {
        $defaults = [
            'app_name' => 'DISPERINDAGKOP',
            'app_short_name' => 'Kab. Tolikara',
            'app_description' => 'Sistem Informasi Manajemen Koperasi',
            'app_footer' => '© 2026 DISPERINDAGKOP Kabupaten Tolikara. All rights reserved.',
            'logo' => 'logo.png',
            'logo_login' => 'logo.png',
            'favicon' => 'logo.png',
            'color_primary' => '#1a3a6e',
            'color_secondary' => '#3b82f6',
            'color_topbar' => '#c8102e',
            'color_topbar_secondary' => '#a00d24',
            'color_sidebar' => '#1a3a6e',
            'color_success' => '#10b981',
            'color_warning' => '#f59e0b',
            'color_danger' => '#ef4444',
            'contact_email' => 'disperindagkop@tolikara.go.id',
            'contact_phone' => '(0969) 12345',
            'contact_whatsapp' => '081234567890',
            'contact_address' => 'Kabupaten Tolikara, Papua Pegunungan',
        ];

        return $defaults[$key] ?? '';
    }
}
