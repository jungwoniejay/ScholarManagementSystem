<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('scholarship_id');
            $table->string('status')->default('pending');
            $table->dateTime('applied_at');
            $table->dateTime('reviewed_at')->nullable();
            $table->decimal('awarded_amount', 10, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('scholarship_id')->references('id')->on('scholarships')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
