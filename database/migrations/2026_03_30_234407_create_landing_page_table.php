<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('landing_page', function (Blueprint $table) {
            $table->id();

            // Hero
            $table->string('hero_badge')->default('Scholarship Management System');
            $table->string('hero_title')->default('Your Gateway to Educational Excellence');

            // ❌ FIX: removed TEXT default
            $table->text('hero_subtitle');

            // Stats
            $table->string('stat1_number')->default('5,000+');
            $table->string('stat1_label')->default('Active Scholarships');
            $table->string('stat2_number')->default('$50M+');
            $table->string('stat2_label')->default('Awarded Annually');
            $table->string('stat3_number')->default('98%');
            $table->string('stat3_label')->default('Success Rate');

            // Features card
            $table->string('card_title')->default('Why Choose Us?');
            $table->string('card_subtitle')->default('Everything you need to succeed in one platform');

            $table->string('feature1_icon')->default('🎯');
            $table->string('feature1_title')->default('Smart Matching');
            $table->string('feature1_desc')->default('AI-powered system matches you with scholarships that fit your profile perfectly');

            $table->string('feature2_icon')->default('📊');
            $table->string('feature2_title')->default('Track Progress');
            $table->string('feature2_desc')->default('Monitor all your applications in real-time with our intuitive dashboard');

            $table->string('feature3_icon')->default('🔔');
            $table->string('feature3_title')->default('Never Miss Deadlines');
            $table->string('feature3_desc')->default('Automated reminders keep you on track with every application deadline');

            // CTA card
            $table->string('cta_title')->default('Ready to Get Started?');

            // ❌ FIX: removed TEXT default
            $table->text('cta_desc');

            // Footer
            $table->string('footer_text')->default('Your gateway to educational excellence and scholarship success.');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_page');
    }
};