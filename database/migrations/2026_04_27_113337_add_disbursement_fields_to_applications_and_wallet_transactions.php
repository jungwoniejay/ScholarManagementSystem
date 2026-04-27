<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->timestamp('disbursed_at')->nullable()->after('student_responded_at');
            $table->unsignedBigInteger('disbursed_by')->nullable()->after('disbursed_at');
        });

        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->timestamp('approved_at')->nullable()->after('status');
            $table->unsignedBigInteger('approved_by')->nullable()->after('approved_at');
            $table->string('rejection_reason')->nullable()->after('approved_by');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['disbursed_at', 'disbursed_by']);
        });
        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->dropColumn(['approved_at', 'approved_by', 'rejection_reason']);
        });
    }
};
