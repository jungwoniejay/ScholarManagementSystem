<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CookieSettings extends Model
{
    protected $table = 'cookie_settings';

    protected $fillable = [
        'enabled',
        'banner_title',
        'banner_message',
        'accept_label',
        'decline_label',
        'analytics_enabled',
        'marketing_enabled',
        'expiry_days',
        'show_on_landing',
        'show_on_student_dashboard',
        'privacy_url',
        'terms_url',
        'privacy_content',
        'terms_content',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'analytics_enabled' => 'boolean',
        'marketing_enabled' => 'boolean',
        'show_on_landing' => 'boolean',
        'show_on_student_dashboard' => 'boolean',
        'expiry_days' => 'integer',
    ];

    public static function getSettings()
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'enabled'                   => true,
                'banner_title'              => 'We use cookies',
                'banner_message'            => 'We use cookies to improve your experience on our site.',
                'accept_label'              => 'Accept All',
                'decline_label'             => 'Decline',
                'analytics_enabled'         => false,
                'marketing_enabled'         => false,
                'expiry_days'               => 365,
                'show_on_landing'           => true,
                'show_on_student_dashboard' => false,
                'privacy_url'               => '/privacy-policy',
                'terms_url'                 => '/terms-and-conditions',
            ]
        );
    }
}
?>

