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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('roll_number')->unique();
              $table->unsignedBigInteger('class_id');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();


            $table->string('parent_name');
            $table->string('parent_email')->nullable();
            $table->string('parent_phone');
            $table->string('parent_relation')->nullable();

            $table->timestamps();


            $table->foreign('class_id')->references('id')->on('add_classes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
