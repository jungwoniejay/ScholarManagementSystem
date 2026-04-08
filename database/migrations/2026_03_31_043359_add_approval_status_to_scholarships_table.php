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
        Schema::table('scholarships', function (Blueprint $table) {
            // Add approval status for admin workflow
            $table->string('approval_status')->default('pending')->after('status'); // pending, approved, rejected
            $table->unsignedBigInteger('donator_id')->nullable()->after('approval_status');
            $table->dateTime('approved_at')->nullable()->after('donator_id');
            $table->text('admin_remarks')->nullable()->after('approved_at');
            
            // Add foreign key
            $table->foreign('donator_id')->references('donator_id')->on('donators')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->dropForeign(['donator_id']);
            $table->dropColumn([
                'approval_status',
                'donator_id',
                'approved_at',
                'admin_remarks',
            ]);
        });
    }
};