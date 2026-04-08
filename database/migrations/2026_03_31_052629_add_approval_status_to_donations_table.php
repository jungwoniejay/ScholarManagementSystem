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
        Schema::table('donations', function (Blueprint $table) {
            // Add approval status for admin funding approval workflow
            $table->string('approval_status')->default('pending')->after('amount'); // pending, approved, rejected
            $table->dateTime('approved_at')->nullable()->after('approval_status');
            $table->text('admin_remarks')->nullable()->after('approved_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn([
                'approval_status',
                'approved_at',
                'admin_remarks',
            ]);
        });
    }
};