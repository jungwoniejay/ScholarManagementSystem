<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('landing_page');

        Schema::create('landing_page', function (Blueprint $table) {
            $table->id();

            // Hero
            $table->string('hero_badge')->default('Scholarship Management System');
            $table->string('hero_title')->default('Your Gateway to Educational Excellence');
            $table->text('hero_subtitle')->nullable();

            // Stats
            $table->string('stat1_number')->default('5,000+');
            $table->string('stat1_label')->default('Active Scholarships');
            $table->string('stat2_number')->default('$50M+');
            $table->string('stat2_label')->default('Awarded Annually');
            $table->string('stat3_number')->default('98%');
            $table->string('stat3_label')->default('Success Rate');

            // Features
            $table->string('card_title')->default('Why Choose Us?');
            $table->string('card_subtitle')->default('Everything you need to succeed in one platform');

            $table->string('feature1_icon')->default('🎯');
            $table->string('feature1_title')->default('Smart Matching');
            $table->text('feature1_desc')->nullable();

            $table->string('feature2_icon')->default('📊');
            $table->string('feature2_title')->default('Track Progress');
            $table->text('feature2_desc')->nullable();

            $table->string('feature3_icon')->default('🔔');
            $table->string('feature3_title')->default('Never Miss Deadlines');
            $table->text('feature3_desc')->nullable();

            // CTA
            $table->string('cta_title')->default('Ready to Get Started?');
            $table->text('cta_desc')->nullable();

            // Footer
            $table->string('footer_text')->default('Your gateway to educational excellence and scholarship success.');
            $table->string('footer_site_name')->default('ScholarHub');
            $table->string('footer_tagline')->default('Your gateway to educational excellence and scholarship success.');
            $table->string('footer_copyright')->default('© 2024 ScholarHub. All rights reserved.');
            $table->string('footer_facebook')->default('#');
            $table->string('footer_twitter')->default('#');
            $table->string('footer_linkedin')->default('#');
            $table->string('footer_instagram')->default('#');

            // How It Works
            $table->string('step1_title')->default('Create Your Profile');
            $table->string('step1_desc')->default('Sign up and build your academic profile — qualifications, interests, and aspirations — in minutes.');
            $table->string('step2_title')->default('Discover Opportunities');
            $table->string('step2_desc')->default('Browse thousands of scholarships or let our AI instantly match you with the best-fit opportunities.');
            $table->string('step3_title')->default('Apply & Celebrate');
            $table->string('step3_desc')->default('Submit polished applications and track every milestone with confidence until award day arrives.');

            // Testimonials
            $table->text('testimonial1_text')->nullable();
            $table->string('testimonial1_name')->default('Sarah Johnson');
            $table->string('testimonial1_role')->default('Graduate Student, MIT');

            $table->text('testimonial2_text')->nullable();
            $table->string('testimonial2_name')->default('Michael Chen');
            $table->string('testimonial2_role')->default('Undergraduate, Stanford');

            $table->text('testimonial3_text')->nullable();
            $table->string('testimonial3_name')->default('Amelia Rodriguez');
            $table->string('testimonial3_role')->default('PhD Candidate, Oxford');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_page');
    }
};
