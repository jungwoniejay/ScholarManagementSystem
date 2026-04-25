<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            $table->string('feature1_link_label')->default('Learn more')->after('feature1_desc');
            $table->string('feature1_link_url')->default('#')->after('feature1_link_label');
            $table->string('feature2_link_label')->default('Learn more')->after('feature2_desc');
            $table->string('feature2_link_url')->default('#')->after('feature2_link_label');
            $table->string('feature3_link_label')->default('Learn more')->after('feature3_desc');
            $table->string('feature3_link_url')->default('#')->after('feature3_link_label');
        });
    }

    public function down(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            $table->dropColumn([
                'feature1_link_label', 'feature1_link_url',
                'feature2_link_label', 'feature2_link_url',
                'feature3_link_label', 'feature3_link_url',
            ]);
        });
    }
};
