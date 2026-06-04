<?php

if (!function_exists('setting')) {
    /**
     * Get setting value by key
     */
    function setting($key, $default = null)
    {
        return \App\Models\Setting::get($key, $default);
    }
}

if (!function_exists('app_name')) {
    /**
     * Get application name
     */
    function app_name()
    {
        return setting('app_name', 'DISPERINDAGKOP');
    }
}

if (!function_exists('app_logo')) {
    /**
     * Get application logo URL
     */
    function app_logo()
    {
        $logo = setting('logo', 'logo.png');
        if (file_exists(public_path($logo))) {
            return asset($logo);
        }
        return asset('storage/' . $logo);
    }
}

if (!function_exists('app_logo_login')) {
    /**
     * Get login logo URL
     */
    function app_logo_login()
    {
        $logo = setting('logo_login', 'logo.png');
        if (file_exists(public_path($logo))) {
            return asset($logo);
        }
        return asset('storage/' . $logo);
    }
}

if (!function_exists('app_favicon')) {
    /**
     * Get favicon URL
     */
    function app_favicon()
    {
        $favicon = setting('favicon', 'logo.png');
        if (file_exists(public_path($favicon))) {
            return asset($favicon);
        }
        return asset('storage/' . $favicon);
    }
}

if (!function_exists('theme_color')) {
    /**
     * Get theme color
     */
    function theme_color($type = 'primary')
    {
        $defaults = [
            'primary' => '#1a3a6e',
            'secondary' => '#3b82f6',
            'topbar' => '#c8102e',
            'topbar_secondary' => '#a00d24',
            'sidebar' => '#1a3a6e',
            'success' => '#10b981',
            'warning' => '#f59e0b',
            'danger' => '#ef4444',
        ];
        
        return setting('color_' . $type, $defaults[$type] ?? '#1a3a6e');
    }
}
