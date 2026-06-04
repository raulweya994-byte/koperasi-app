<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // Pengaturan adalah hak setiap user, tidak perlu permission check
        $user = Auth::user();
        
        // Get current theme settings from user preferences or default
        $currentTheme = $user->theme_preference ?? 'default';
        $currentNavbarTheme = $user->navbar_theme ?? 'dark-blue';
        
        return view('pimpinan.settings.index', compact('currentTheme', 'currentNavbarTheme'));
    }
    
    public function updateTheme(Request $request)
    {
        // Pengaturan adalah hak setiap user, tidak perlu permission check
        $request->validate([
            'theme' => 'required|in:default,blue,green,purple,orange,red',
            'navbar_theme' => 'required|in:dark-blue,navy,teal,purple,dark-gray,green'
        ]);
        
        $user = Auth::user();
        $user->theme_preference = $request->theme;
        $user->navbar_theme = $request->navbar_theme;
        $user->save();
        
        return back()->with('success', 'Tema dashboard dan navbar berhasil diubah!');
    }
}
