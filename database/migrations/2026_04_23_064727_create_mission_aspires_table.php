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
        Schema::create('mission_aspires', function (Blueprint $table) {
            $table->id()->comment('Primary key ID');

            $table->string('district')
                ->comment('District name (e.g., Patna, Gaya)');

            $table->string('school_name')
                ->comment('Name of the school');

            $table->integer('total_enrolled_students')
                ->nullable()
                ->comment('Total number of students enrolled');

            $table->integer('dropouts_students')
                ->nullable()
                ->comment('Total number of dropout students');

            $table->integer('current_students_enrolled')
                ->nullable()
                ->comment('Currently active students');

            $table->decimal('student_attendance_percentage', 5, 2)
                ->nullable()
                ->comment('Attendance percentage of students');

            $table->integer('students_passed_board_exams')
                ->nullable()
                ->comment('Students who passed board exams');

            $table->integer('students_tested_competency')
                ->nullable()
                ->comment('Students tested for competency');

            $table->integer('students_enrolled_coaching')
                ->nullable()
                ->comment('Students enrolled in coaching');

            $table->integer('students_appearing_exams')
                ->nullable()
                ->comment('Students appearing in exams');

            $table->integer('students_skill_exposure')
                ->nullable()
                ->comment('Students exposed to skill programs');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_aspires');
    }
};
