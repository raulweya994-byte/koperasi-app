<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

if (!function_exists('get_pimpinan_theme')) {
    /**
     * Get theme settings for Pimpinan user from users table
     */
    function get_pimpinan_theme()
    {
        if (!Auth::check() || Auth::user()->role !== 'pimpinan') {
            return null;
        }
        
        $user = Auth::user();
        
        // Dashboard theme colors mapping - 4 CARDS
        $dashboardThemes = [
            'default' => [
                'card1' => '#14b8a6', // Teal
                'card2' => '#22c55e', // Green
                'card3' => '#eab308', // Yellow
                'card4' => '#ef4444'  // Red
            ],
            'blue' => [
                'card1' => '#3b82f6', // Blue
                'card2' => '#06b6d4', // Cyan
                'card3' => '#0ea5e9', // Sky
                'card4' => '#1e40af'  // Blue Dark
            ],
            'green' => [
                'card1' => '#10b981', // Emerald
                'card2' => '#14b8a6', // Teal
                'card3' => '#22c55e', // Green
                'card4' => '#16a34a'  // Green Dark
            ],
            'purple' => [
                'card1' => '#8b5cf6', // Violet
                'card2' => '#a855f7', // Purple
                'card3' => '#c084fc', // Purple Light
                'card4' => '#7c3aed'  // Violet Dark
            ],
            'orange' => [
                'card1' => '#f97316', // Orange
                'card2' => '#fb923c', // Orange Light
                'card3' => '#fdba74', // Orange Lighter
                'card4' => '#ea580c'  // Orange Dark
            ],
            'red' => [
                'card1' => '#ef4444', // Red
                'card2' => '#f87171', // Red Light
                'card3' => '#fca5a5', // Red Lighter
                'card4' => '#dc2626'  // Red Dark
            ],
        ];
        
        // Navbar theme colors mapping
        $navbarThemes = [
            'dark-blue' => '#1a3a6e',
            'navy' => '#1e3a8a',
            'teal' => '#0d9488',
            'purple' => '#7c3aed',
            'dark-gray' => '#374151',
            'green' => '#059669',
        ];
        
        $themePreference = $user->theme_preference ?? 'default';
        $navbarTheme = $user->navbar_theme ?? 'dark-blue';
        
        $dashboardColors = $dashboardThemes[$themePreference] ?? $dashboardThemes['default'];
        $navbarColor = $navbarThemes[$navbarTheme] ?? $navbarThemes['dark-blue'];
        
        return [
            'sidebar_color' => $navbarColor,
            'navbar_color' => $navbarColor,
            'primary_color' => $dashboardColors['card1'],
            'accent_color' => $dashboardColors['card4'],
            'text_color' => '#ffffff',
            'hover_color' => '#1abc9c',
            'card1_color' => $dashboardColors['card1'],
            'card2_color' => $dashboardColors['card2'],
            'card3_color' => $dashboardColors['card3'],
            'card4_color' => $dashboardColors['card4'],
        ];
    }
}

if (!function_exists('pimpinan_theme_color')) {
    /**
     * Get specific theme color for Pimpinan
     */
    function pimpinan_theme_color($key)
    {
        $theme = get_pimpinan_theme();
        
        if (!$theme) {
            return null;
        }
        
        $colorMap = [
            'sidebar' => $theme['sidebar_color'] ?? '#2c3e50',
            'navbar' => $theme['navbar_color'] ?? '#34495e',
            'primary' => $theme['primary_color'] ?? '#3498db',
            'accent' => $theme['accent_color'] ?? '#e74c3c',
            'text' => $theme['text_color'] ?? '#ffffff',
            'hover' => $theme['hover_color'] ?? '#1abc9c',
            'card1' => $theme['card1_color'] ?? '#14b8a6',
            'card2' => $theme['card2_color'] ?? '#22c55e',
            'card3' => $theme['card3_color'] ?? '#eab308',
            'card4' => $theme['card4_color'] ?? '#ef4444',
        ];
        
        return $colorMap[$key] ?? null;
    }
}


if (!function_exists('pimpinan_theme_color')) {
    /**
     * Get specific theme color for Pimpinan
     */
    function pimpinan_theme_color($key)
    {
        $theme = get_pimpinan_theme();
        
        if (!$theme) {
            return null;
        }
        
        $colorMap = [
            'sidebar' => $theme['sidebar_color'] ?? '#2c3e50',
            'navbar' => $theme['navbar_color'] ?? '#34495e',
            'primary' => $theme['primary_color'] ?? '#3498db',
            'accent' => $theme['accent_color'] ?? '#e74c3c',
            'text' => $theme['text_color'] ?? '#ffffff',
            'hover' => $theme['hover_color'] ?? '#1abc9c',
        ];
        
        return $colorMap[$key] ?? null;
    }
}
