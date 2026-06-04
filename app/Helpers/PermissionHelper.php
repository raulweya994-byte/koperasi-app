<?php

use App\Models\RolePermission;

if (!function_exists('can_access')) {
    /**
     * Check if current user can access a module with specific action
     *
     * @param string $module
     * @param string $action (view, create, edit, delete, export, approve)
     * @return bool
     */
    function can_access($module, $action = 'view')
    {
        if (!auth()->check()) {
            return false;
        }

        // Admin always has full access
        if (auth()->user()->role === 'admin') {
            return true;
        }

        return RolePermission::hasPermission(auth()->user()->role, $module, $action);
    }
}

if (!function_exists('can_view')) {
    function can_view($module)
    {
        return can_access($module, 'view');
    }
}

if (!function_exists('can_create')) {
    function can_create($module)
    {
        return can_access($module, 'create');
    }
}

if (!function_exists('can_edit')) {
    function can_edit($module)
    {
        return can_access($module, 'edit');
    }
}

if (!function_exists('can_delete')) {
    function can_delete($module)
    {
        return can_access($module, 'delete');
    }
}

if (!function_exists('can_export')) {
    function can_export($module)
    {
        return can_access($module, 'export');
    }
}

if (!function_exists('can_approve')) {
    function can_approve($module)
    {
        return can_access($module, 'approve');
    }
}

if (!function_exists('get_user_permissions')) {
    /**
     * Get all permissions for current user
     *
     * @return \Illuminate\Support\Collection
     */
    function get_user_permissions()
    {
        if (!auth()->check()) {
            return collect();
        }

        if (auth()->user()->role === 'admin') {
            // Admin has all permissions
            return collect(RolePermission::$modules)->mapWithKeys(function ($name, $key) {
                return [$key => [
                    'can_view' => true,
                    'can_create' => true,
                    'can_edit' => true,
                    'can_delete' => true,
                    'can_export' => true,
                    'can_approve' => true,
                ]];
            });
        }

        return RolePermission::getPermissionsForRole(auth()->user()->role);
    }
}
