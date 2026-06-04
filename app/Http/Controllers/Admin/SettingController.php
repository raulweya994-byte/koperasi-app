<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'footer_copyright' => 'nullable|string|max:500',
            'footer_address' => 'nullable|string|max:500',
            'footer_phone' => 'nullable|string|max:50',
            'footer_email' => 'nullable|email|max:255',
            'footer_website' => 'nullable|string|max:255',
        ]);

        $keys = [
            'site_name',
            'footer_copyright',
            'footer_address',
            'footer_phone',
            'footer_email',
            'footer_website',
            'pendaftaran_buka',
            'pendaftaran_mulai',
            'pendaftaran_selesai',
        ];

        foreach ($keys as $key) {
            Setting::set($key, (string)($request->input($key) ?? ''));
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil disimpan.');
    }
}