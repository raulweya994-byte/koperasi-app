<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Fix pluralisasi bahasa Indonesia
        \Illuminate\Database\Eloquent\Relations\Relation::morphMap([]);
        
        \Illuminate\Support\Str::macro('pluralStudly', function ($value) {
            return $value;
        });

        // Blade directives untuk permission check
        \Blade::if('canAccess', function ($module, $action = 'view') {
            return can_access($module, $action);
        });

        \Blade::if('canView', function ($module) {
            return can_view($module);
        });

        \Blade::if('canCreate', function ($module) {
            return can_create($module);
        });

        \Blade::if('canEdit', function ($module) {
            return can_edit($module);
        });

        \Blade::if('canDelete', function ($module) {
            return can_delete($module);
        });

        \Blade::if('canExport', function ($module) {
            return can_export($module);
        });

        \Blade::if('canApprove', function ($module) {
            return can_approve($module);
        });
    }
}