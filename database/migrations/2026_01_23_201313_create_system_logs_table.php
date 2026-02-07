<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemLogsTable extends Migration
{
    public function up(): void
    {
        Schema::create('system_logs', function (Blueprint $table) {
            $table->id();
            $table->string('log_type');        // e.g., Application Logs, AI Decision Logs
            $table->unsignedBigInteger('related_id')->nullable(); // ID of related entity
            $table->unsignedBigInteger('user_id')->nullable();    // Who performed it
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_logs');
    }
}
