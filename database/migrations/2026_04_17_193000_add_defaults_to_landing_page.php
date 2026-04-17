<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            // CTA
            $table->text('cta_desc')->nullable()->default('')->change();

            // Features
            $table->text('feature1_desc')->nullable()->default('')->change();
            $table->text('feature2_desc')->nullable()->default('')->change();
            $table->text('feature3_desc')->nullable()->default('')->change();

            // Testimonials
            $table->text('testimonial1_text')->nullable()->default('')->change();
            $table->text('testimonial2_text')->nullable()->default('')->change();
            $table->text('testimonial3_text')->nullable()->default('')->change();
        });
    }

    public function down(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            $table->text('cta_desc')->nullable()->default(null)->change();
            $table->text('feature1_desc')->nullable()->default(null)->change();
            $table->text('feature2_desc')->nullable()->default(null)->change();
            $table->text('feature3_desc')->nullable()->default(null)->change();
            $table->text('testimonial1_text')->nullable()->default(null)->change();
            $table->text('testimonial2_text')->nullable()->default(null)->change();
            $table->text('testimonial3_text')->nullable()->default(null)->change();
        });
    }
};
