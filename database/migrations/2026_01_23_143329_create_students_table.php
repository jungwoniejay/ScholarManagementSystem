<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();

            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->date('date_of_birth')->nullable();

            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->integer('enrollment_year')->nullable();
            $table->string('course', 100)->nullable();

            $table->decimal('gpa', 3, 2)->nullable(); // max 4.00
            $table->string('status', 50)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
