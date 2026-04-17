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
        'step1_title', 'step1_desc',
        'step2_title', 'step2_desc',
        'step3_title', 'step3_desc',
        'testimonial1_text', 'testimonial1_name', 'testimonial1_role',
        'testimonial2_text', 'testimonial2_name', 'testimonial2_role',
        'testimonial3_text', 'testimonial3_name', 'testimonial3_role',
        'footer_text', 'footer_site_name', 'footer_tagline', 'footer_copyright',
        'footer_facebook', 'footer_twitter', 'footer_linkedin', 'footer_instagram',
    ];
}
