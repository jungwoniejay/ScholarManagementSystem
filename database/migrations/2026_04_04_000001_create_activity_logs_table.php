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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('log_type'); // login, logout, view, create, update, delete, failed_login, suspicious
            $table->string('description');
            $table->string('subject_type')->nullable(); // Model class (e.g., App\Models\Scholarship)
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->text('properties')->nullable(); // JSON data of what changed
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('browser')->nullable();
            $table->string('device')->nullable();
            $table->string('location')->nullable(); // Country/City from IP
            $table->boolean('is_suspicious')->default(false);
            $table->string('suspicion_reason')->nullable();
            $table->timestamp('occurred_at');
            $table->timestamps();

            // Indexes for efficient querying
            $table->index('user_id');
            $table->index('log_type');
            $table->index('is_suspicious');
            $table->index('occurred_at');
            $table->index(['user_id', 'log_type']);
            $table->index(['is_suspicious', 'occurred_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};