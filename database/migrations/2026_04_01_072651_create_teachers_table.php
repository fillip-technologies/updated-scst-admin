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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            $table->string('image')->nullable();

            $table->string('subject')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('education')->nullable();
            $table->text('skills')->nullable();
            $table->string('certificate')->nullable();


            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
