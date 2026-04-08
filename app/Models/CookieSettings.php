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
        return self::firstOrCreate(['id' => 1]);
    }
}
?>

