<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_logs', function (Blueprint $table) {
            $table->id();
            $table->string('log_type'); // e.g., Application Logs, Approval History
            $table->unsignedBigInteger('related_id')->nullable(); // ID of related entity
            $table->unsignedBigInteger('user_id')->nullable(); // admin/user who did the action
            $table->text('description')->nullable();
            $table->timestamps(); // includes created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_logs');
    }
};
