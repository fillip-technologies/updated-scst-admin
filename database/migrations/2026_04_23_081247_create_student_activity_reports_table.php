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
        Schema::create('student_activity_reports', function (Blueprint $table) {
            $table->id();

            $table->string('district')->comment('District Name');
            $table->string('school_name')->comment('School Name');

            $table->integer('total_students')
                ->comment('Total number of students');

            $table->integer('students_cocurricular')
                ->comment('Students participating in co-curricular activities (Debate, Quiz, Arts)');

            $table->integer('students_sports')
                ->comment('Students participating in sports');

            $table->integer('students_district_state_sports')
                ->comment('Students representing school in district/state sports');

            $table->integer('career_guidance_sessions')
                ->comment('Career Guidance Sessions Conducted This Year');

            $table->integer('eligible_vocational_students')
                ->comment('Eligible Students for Vocational Training (Class 9+)');

            $table->integer('enrolled_vocational_students')
                ->comment('Students enrolled in Vocational/Skill Training');

            $table->integer('eligible_competitive_students')
                ->comment('Eligible Students for Competitive Exam Coaching (Class 11-12)');

            $table->integer('enrolled_competitive_students')
                ->comment('Students enrolled in Competitive Exam Coaching');

            $table->integer('students_appearing_competitive')
                ->comment('Students appearing in Competitive Exams (JEE/NEET/SSC etc.)');

            $table->boolean('annual_talent_festival')
                ->comment('Annual Talent Festival Conducted (Yes/No)');

            $table->integer('debate_events_count')
                ->comment('Debate / Public Speaking Events Held');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_activity_reports');
    }
};
