<?php

/**
 * Script untuk test akses admin dashboard
 * Jalankan: php tests/test-admin-access.php
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "\n";
echo "==============================================\n";
echo "  TEST AKSES ADMIN DASHBOARD\n";
echo "==============================================\n\n";

// 1. Cek koneksi database
echo "1. Cek Koneksi Database...\n";
try {
    DB::connection()->getPdo();
    echo "   ✅ Database terhubung\n\n";
} catch (\Exception $e) {
    echo "   ❌ Database tidak terhubung: " . $e->getMessage() . "\n\n";
    exit(1);
}

// 2. Cek tabel users
echo "2. Cek Tabel Users...\n";
try {
    $totalUsers = User::count();
    echo "   ✅ Total users: {$totalUsers}\n\n";
} catch (\Exception $e) {
    echo "   ❌ Error: " . $e->getMessage() . "\n\n";
    exit(1);
}

// 3. Cek admin users
echo "3. Cek Admin Users...\n";
$admins = User::where('role', 'admin')->get();

if ($admins->isEmpty()) {
    echo "   ❌ Tidak ada user admin!\n";
    echo "   💡 Jalankan: php artisan db:seed --class=AdminUserSeeder\n\n";
} else {
    echo "   ✅ Ditemukan {$admins->count()} admin:\n";
    foreach ($admins as $admin) {
        $status = $admin->is_active ? '✅ Aktif' : '❌ Tidak Aktif';
        echo "      - {$admin->name} ({$admin->email}) - {$status}\n";
    }
    echo "\n";
}

// 4. Cek admin aktif
echo "4. Cek Admin Aktif...\n";
$activeAdmins = User::where('role', 'admin')->where('is_active', true)->count();
if ($activeAdmins > 0) {
    echo "   ✅ Ada {$activeAdmins} admin aktif\n\n";
} else {
    echo "   ❌ Tidak ada admin aktif!\n";
    echo "   💡 Jalankan: php artisan admin:check\n\n";
}

// 5. Cek middleware
echo "5. Cek Middleware...\n";
$middlewareAliases = app('Illuminate\Contracts\Http\Kernel')->getMiddlewareGroups();
if (isset($middlewareAliases['web'])) {
    echo "   ✅ Middleware 'web' terdaftar\n";
}
echo "\n";

// 6. Cek routes
echo "6. Cek Routes Admin...\n";
$routes = Route::getRoutes();
$adminRoutes = collect($routes)->filter(function ($route) {
    return str_starts_with($route->uri(), 'admin/');
});

if ($adminRoutes->isNotEmpty()) {
    echo "   ✅ Ditemukan " . $adminRoutes->count() . " admin routes\n";
    $dashboardRoute = $adminRoutes->first(function ($route) {
        return $route->uri() === 'admin/dashboard';
    });
    
    if ($dashboardRoute) {
        echo "   ✅ Route 'admin/dashboard' tersedia\n";
        $middleware = $dashboardRoute->middleware();
        echo "   📋 Middleware: " . implode(', ', $middleware) . "\n";
    }
} else {
    echo "   ❌ Tidak ada admin routes!\n";
}
echo "\n";

// 7. Cek models
echo "7. Cek Models...\n";
try {
    $koperasiCount = \App\Models\Koperasi::count();
    $bantuanCount = \App\Models\Bantuan::count();
    echo "   ✅ Model Koperasi: {$koperasiCount} records\n";
    echo "   ✅ Model Bantuan: {$bantuanCount} records\n";
} catch (\Exception $e) {
    echo "   ⚠️  Warning: " . $e->getMessage() . "\n";
}
echo "\n";

// 8. Kesimpulan
echo "==============================================\n";
echo "  KESIMPULAN\n";
echo "==============================================\n\n";

if ($activeAdmins > 0) {
    echo "✅ Sistem siap digunakan!\n\n";
    echo "Cara Login:\n";
    echo "1. Buka: http://127.0.0.1:8000/login\n";
    echo "2. Gunakan kredensial admin:\n";
    foreach ($admins->where('is_active', true) as $admin) {
        echo "   - Email: {$admin->email}\n";
    }
    echo "3. Setelah login, akses: http://127.0.0.1:8000/admin/dashboard\n\n";
} else {
    echo "❌ Sistem belum siap!\n\n";
    echo "Langkah perbaikan:\n";
    echo "1. Jalankan: php artisan admin:check\n";
    echo "2. Atau: php artisan db:seed --class=AdminUserSeeder\n\n";
}

echo "==============================================\n\n";
