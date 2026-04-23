<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\AiRule;
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

        // Auto-insert default AI rules if table is empty
        try {
            if (AiRule::count() === 0) {
                $defaults = [
                    ['key' => 'weight_gpa',                'value' => '40'],
                    ['key' => 'weight_financial_need',     'value' => '30'],
                    ['key' => 'weight_personal_statement', 'value' => '20'],
                    ['key' => 'weight_enrollment_year',    'value' => '10'],
                    ['key' => 'min_gpa',                   'value' => '2.00'],
                    ['key' => 'auto_reject_below_gpa',     'value' => '1.50'],
                    ['key' => 'gpa_excellent_threshold',   'value' => '3.50'],
                    ['key' => 'gpa_good_threshold',        'value' => '2.75'],
                    ['key' => 'auto_shortlist_score',      'value' => '80'],
                    ['key' => 'auto_reject_score',         'value' => '30'],
                    ['key' => 'auto_review_score',         'value' => '50'],
                    ['key' => 'preferred_enrollment_year', 'value' => '1,2'],
                    ['key' => 'max_enrollment_year',       'value' => '4'],
                    ['key' => 'allowed_courses',           'value' => 'all'],
                    ['key' => 'min_statement_words',       'value' => '50'],
                    ['key' => 'require_documents',         'value' => 'true'],
                    ['key' => 'min_documents',             'value' => '1'],
                    ['key' => 'score_label_high',          'value' => '75'],
                    ['key' => 'score_label_medium',        'value' => '50'],
                ];
                foreach ($defaults as $rule) {
                    AiRule::create($rule);
                }
            }
        } catch (\Exception $e) {
            // Silently fail if table doesn't exist yet
        }
    }
}
