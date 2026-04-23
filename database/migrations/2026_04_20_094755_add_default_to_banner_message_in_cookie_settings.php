<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cookie_settings', function (Blueprint $table) {
            $table->text('banner_message')->change();
        });
    }

    public function down(): void
    {
        Schema::table('cookie_settings', function (Blueprint $table) {
            $table->text('banner_message')->change();
        });
    }
};
