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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->string('name');
            $table->string('file_path');
            $table->string('status')->default('pending'); // default status
            $table->dateTime('verified_at')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
            $table->foreign('verified_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
