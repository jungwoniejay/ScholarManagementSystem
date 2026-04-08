<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cookie_settings', function (Blueprint $table) {
            $table->text('privacy_content')->nullable()->after('terms_url');
            $table->text('terms_content')->nullable()->after('privacy_content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cookie_settings', function (Blueprint $table) {
            $table->dropColumn(['privacy_content', 'terms_content']);
        });
    }
};
