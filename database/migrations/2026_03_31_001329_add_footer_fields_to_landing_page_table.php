<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            $table->string('footer_site_name')->default('ScholarHub')->after('footer_text');
            $table->string('footer_tagline')->default('Your gateway to educational excellence and scholarship success.')->after('footer_site_name');
            $table->string('footer_copyright')->default('© 2024 ScholarHub. All rights reserved.')->after('footer_tagline');
            $table->string('footer_facebook')->default('#')->after('footer_copyright');
            $table->string('footer_twitter')->default('#')->after('footer_facebook');
            $table->string('footer_linkedin')->default('#')->after('footer_twitter');
            $table->string('footer_instagram')->default('#')->after('footer_linkedin');
        });
    }

    public function down(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            $table->dropColumn(['footer_site_name', 'footer_tagline', 'footer_copyright', 'footer_facebook', 'footer_twitter', 'footer_linkedin', 'footer_instagram']);
        });
    }
};
