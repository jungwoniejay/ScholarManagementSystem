<?php

namespace App\Providers;

use App\Models\Application;
use App\Models\Course;
use App\Models\Donation;
use App\Models\Donator;
use App\Models\Scholarship;
use App\Models\Student;
use App\Models\User;
use App\Observers\ActivityObserver;
use App\Services\ActivityMonitor;
use Illuminate\Support\ServiceProvider;

class ActivityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ActivityMonitor::class, function ($app) {
            return new ActivityMonitor();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register observers for key models
        $models = [
            User::class,
            Student::class,
            Donator::class,
            Scholarship::class,
            Application::class,
            Donation::class,
            Course::class,
        ];

        foreach ($models as $model) {
            $model::observe(ActivityObserver::class);
        }
    }
}