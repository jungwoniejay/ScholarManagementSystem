<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {

            // How It Works
            $table->string('step1_title')->default('Create Your Profile');
            $table->string('step1_desc')->default('Sign up and build your academic profile — qualifications, interests, and aspirations — in minutes.');

            $table->string('step2_title')->default('Discover Opportunities');
            $table->string('step2_desc')->default('Browse thousands of scholarships or let our AI instantly match you with the best-fit opportunities.');

            $table->string('step3_title')->default('Apply & Celebrate');
            $table->string('step3_desc')->default('Submit polished applications and track every milestone with confidence until award day arrives.');

            // Testimonials (SAFE: nullable TEXT)
            $table->text('testimonial1_text')->nullable();
            $table->string('testimonial1_name')->default('Sarah Johnson');
            $table->string('testimonial1_role')->default('Graduate Student, MIT');

            $table->text('testimonial2_text')->nullable();
            $table->string('testimonial2_name')->default('Michael Chen');
            $table->string('testimonial2_role')->default('Undergraduate, Stanford');

            $table->text('testimonial3_text')->nullable();
            $table->string('testimonial3_name')->default('Amelia Rodriguez');
            $table->string('testimonial3_role')->default('PhD Candidate, Oxford');
        });
    }

    public function down(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            $table->dropColumn([
                'step1_title','step1_desc',
                'step2_title','step2_desc',
                'step3_title','step3_desc',
                'testimonial1_text','testimonial1_name','testimonial1_role',
                'testimonial2_text','testimonial2_name','testimonial2_role',
                'testimonial3_text','testimonial3_name','testimonial3_role',
            ]);
        });
    }
};