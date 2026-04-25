<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            $table->text('feature1_detail')->nullable()->after('feature1_desc');
            $table->text('feature2_detail')->nullable()->after('feature2_desc');
            $table->text('feature3_detail')->nullable()->after('feature3_desc');
        });
    }

    public function down(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            $table->dropColumn(['feature1_detail', 'feature2_detail', 'feature3_detail']);
        });
    }
};
