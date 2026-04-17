<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            // Fix schema mismatch: hero_subtitle was deployed as NOT NULL
            // but the original migration defines it as nullable().
            $column = DB::select("
                SELECT IS_NULLABLE
                FROM information_schema.COLUMNS
                WHERE TABLE_SCHEMA = DATABASE()
                  AND TABLE_NAME   = 'landing_page'
                  AND COLUMN_NAME  = 'hero_subtitle'
            ");

            if (!empty($column) && $column[0]->IS_NULLABLE === 'NO') {
                $table->text('hero_subtitle')->nullable()->default(null)->change();
            }
        });

        // Ensure any existing rows with an empty string get a proper NULL
        DB::table('landing_page')
            ->where('hero_subtitle', '')
            ->update(['hero_subtitle' => null]);
    }

    public function down(): void
    {
        Schema::table('landing_page', function (Blueprint $table) {
            $table->text('hero_subtitle')->nullable(false)->change();
        });
    }
};
