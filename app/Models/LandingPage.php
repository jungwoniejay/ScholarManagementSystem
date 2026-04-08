<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $table = 'landing_page';

    protected $fillable = [
        'hero_badge', 'hero_title', 'hero_subtitle',
        'stat1_number', 'stat1_label',
        'stat2_number', 'stat2_label',
        'stat3_number', 'stat3_label',
        'card_title', 'card_subtitle',
        'feature1_icon', 'feature1_title', 'feature1_desc',
        'feature2_icon', 'feature2_title', 'feature2_desc',
        'feature3_icon', 'feature3_title', 'feature3_desc',
        'cta_title', 'cta_desc',
        'footer_text', 'footer_site_name', 'footer_tagline', 'footer_copyright',
        'footer_facebook', 'footer_twitter', 'footer_linkedin', 'footer_instagram',
    ];
}
