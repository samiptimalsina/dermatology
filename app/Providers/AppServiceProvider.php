<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Use Tailwind-friendly pagination
        Paginator::useTailwind();

        // Share global site settings with ALL views
        View::composer('*', function ($view) {
            try {
                $globalSettings = SiteSetting::getAll();
                $view->with('globalSettings', $globalSettings);
            } catch (\Exception $e) {
                // Fail silently during migrations/setup
                $view->with('globalSettings', collect());
            }
        });
    }
}
