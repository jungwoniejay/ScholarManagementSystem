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
        Schema::table('applications', function (Blueprint $table) {
            // Add donor connection
            $table->unsignedBigInteger('donator_id')->nullable()->after('scholarship_id');
            
            // Add AI scoring fields
            $table->decimal('ai_score', 5, 2)->nullable()->after('donator_id');
            $table->integer('ai_rank')->nullable()->after('ai_score');
            
            // Add donor decision fields
            $table->string('donor_status')->default('pending')->after('ai_rank'); // pending, approved, rejected
            $table->dateTime('donor_reviewed_at')->nullable()->after('donor_status');
            $table->text('donor_remarks')->nullable()->after('donor_reviewed_at');
            
            // Add student response fields
            $table->string('student_response')->nullable()->after('donor_remarks'); // accept, decline, null
            $table->dateTime('student_responded_at')->nullable()->after('student_response');
            
            // Add notification tracking
            $table->boolean('notified')->default(false)->after('student_responded_at');
            
            // Add foreign key
            $table->foreign('donator_id')->references('donator_id')->on('donators')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['donator_id']);
            $table->dropColumn([
                'donator_id',
                'ai_score',
                'ai_rank',
                'donor_status',
                'donor_reviewed_at',
                'donor_remarks',
                'student_response',
                'student_responded_at',
                'notified'
            ]);
        });
    }
};