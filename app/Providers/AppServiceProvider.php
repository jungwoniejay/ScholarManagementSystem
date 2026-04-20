<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\CookieSettings;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Share cookie settings with all views
        View::composer('*', function ($view) {
            try {
                $view->with('cookieSettings', CookieSettings::getSettings());
            } catch (\Exception $e) {
                $view->with('cookieSettings', new CookieSettings());
            }
        });
    }
}
