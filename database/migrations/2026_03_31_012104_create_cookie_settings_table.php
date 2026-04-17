<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cookie_settings', function (Blueprint $table) {
            $table->id();

            $table->boolean('enabled')->default(true);
            $table->string('banner_title')->default('We use cookies');

            // ❌ FIX: removed default from TEXT
            $table->text('banner_message');

            $table->string('accept_label')->default('Accept All');
            $table->string('decline_label')->default('Decline');

            $table->boolean('analytics_enabled')->default(false);
            $table->boolean('marketing_enabled')->default(false);
            $table->integer('expiry_days')->default(365);

            $table->boolean('show_on_landing')->default(true);
            $table->boolean('show_on_student_dashboard')->default(false);

            $table->string('privacy_url')->default('/privacy-policy');
            $table->string('terms_url')->default('/terms-and-conditions');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cookie_settings');
    }
};