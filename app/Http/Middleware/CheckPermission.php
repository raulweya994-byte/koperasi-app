<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\RolePermission;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $module
     * @param  string  $action
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $module, $action = 'view')
    {
        // Admin always has full access
        if (auth()->user()->role === 'admin') {
            return $next($request);
        }

        $userRole = auth()->user()->role;
        
        // Check if user has permission
        $hasPermission = RolePermission::hasPermission($userRole, $module, $action);

        if (!$hasPermission) {
            // Redirect with error message
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengakses fitur ini. Hubungi Administrator untuk mendapatkan akses.');
        }

        return $next($request);
    }
}
