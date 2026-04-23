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
        Schema::create('school_health_reports', function (Blueprint $table) {
           $table->id();

            $table->string('district')->comment('District Name');
            $table->string('school_name')->comment('School Name');

            $table->integer('students_tested_anaemia')
                  ->comment('Total Students Tested for Anaemia');

            $table->integer('anaemic_students_found')
                  ->comment('Number of Anaemic Students Found');

            $table->integer('students_bmi_measured')
                  ->comment('Total Students with BMI Measured');

            $table->integer('students_normal_bmi')
                  ->comment('Students in Normal BMI Range');

            $table->integer('health_screening_covered')
                  ->comment('Total Students Covered in Health Screening');

            $table->integer('hospital_visits')
                  ->comment('Total Hospital Visits / Sick Leave');

            $table->integer('menu_not_followed_count')
                  ->comment('No of times Menu was not followed in last 2 months');

            $table->integer('food_not_on_time_count')
                  ->comment('No of times Food was not given on time in last 2 months');

            $table->boolean('safe_drinking_water')
                  ->comment('Safe Drinking Water Available (Yes/No)');

            $table->integer('kitchen_hygiene_score')
                  ->comment('Kitchen Hygiene Score (0-100 based on cleanliness)');

            $table->integer('mental_health_sessions')
                  ->comment('Mental Health Counselling Sessions Conducted');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_helth_reports');
    }
};
