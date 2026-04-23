<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            // CTA
            $table->text('cta_desc')->nullable()->change();

            // Features
            $table->text('feature1_desc')->nullable()->change();
            $table->text('feature2_desc')->nullable()->change();
            $table->text('feature3_desc')->nullable()->change();

            // Testimonials
            $table->text('testimonial1_text')->nullable()->change();
            $table->text('testimonial2_text')->nullable()->change();
            $table->text('testimonial3_text')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            $table->text('cta_desc')->nullable()->change();
            $table->text('feature1_desc')->nullable()->change();
            $table->text('feature2_desc')->nullable()->change();
            $table->text('feature3_desc')->nullable()->change();
            $table->text('testimonial1_text')->nullable()->change();
            $table->text('testimonial2_text')->nullable()->change();
            $table->text('testimonial3_text')->nullable()->change();
        });
    }
};
