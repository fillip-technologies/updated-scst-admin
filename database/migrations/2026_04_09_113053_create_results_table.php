<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('subject_id');

            // Data
            $table->integer('marks')->nullable();
            $table->boolean('is_absent')->default(false);
            $table->string('file')->nullable();

            $table->timestamps();

            // Foreign Keys
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

            // Prevent duplicate entry (1 subject per student)
            $table->unique(['student_id', 'subject_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('results');
    }
};
