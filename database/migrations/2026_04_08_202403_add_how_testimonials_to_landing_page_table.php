<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            // How It Works
            $table->string('step1_title')->default('Create Your Profile')->after('cta_desc');
            $table->string('step1_desc')->default('Sign up and build your academic profile — qualifications, interests, and aspirations — in minutes.')->after('step1_title');
            $table->string('step2_title')->default('Discover Opportunities')->after('step1_desc');
            $table->string('step2_desc')->default('Browse thousands of scholarships or let our AI instantly match you with the best-fit opportunities.')->after('step2_title');
            $table->string('step3_title')->default('Apply & Celebrate')->after('step2_desc');
            $table->string('step3_desc')->default('Submit polished applications and track every milestone with confidence until award day arrives.')->after('step3_title');
            // Testimonials
            $table->text('testimonial1_text')->default('ScholarHub completely transformed my approach to funding my education. I received three scholarship offers totaling $15,000 for my master\'s program.')->after('step3_desc');
            $table->string('testimonial1_name')->default('Sarah Johnson')->after('testimonial1_text');
            $table->string('testimonial1_role')->default('Graduate Student, MIT')->after('testimonial1_name');
            $table->text('testimonial2_text')->default('The matching algorithm is remarkable. It surfaced scholarships perfectly aligned with my engineering background.')->after('testimonial1_role');
            $table->string('testimonial2_name')->default('Michael Chen')->after('testimonial2_text');
            $table->string('testimonial2_role')->default('Undergraduate, Stanford')->after('testimonial2_name');
            $table->text('testimonial3_text')->default('From first login to award notification, ScholarHub guided me through every step of the process.')->after('testimonial2_role');
            $table->string('testimonial3_name')->default('Amelia Rodriguez')->after('testimonial3_text');
            $table->string('testimonial3_role')->default('PhD Candidate, Oxford')->after('testimonial3_name');
        });
    }

    public function down(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            $table->dropColumn([
                'step1_title','step1_desc','step2_title','step2_desc','step3_title','step3_desc',
                'testimonial1_text','testimonial1_name','testimonial1_role',
                'testimonial2_text','testimonial2_name','testimonial2_role',
                'testimonial3_text','testimonial3_name','testimonial3_role',
            ]);
        });
    }
};
