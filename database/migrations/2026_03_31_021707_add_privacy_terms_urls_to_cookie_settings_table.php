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
            $table->string('privacy_url')->default('/privacy-policy')->after('show_on_student_dashboard');
            $table->string('terms_url')->default('/terms-and-conditions')->after('privacy_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cookie_settings', function (Blueprint $table) {
            $table->dropColumn(['privacy_url', 'terms_url']);
        });
    }
};
