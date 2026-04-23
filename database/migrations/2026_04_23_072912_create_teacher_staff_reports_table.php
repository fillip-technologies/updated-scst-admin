<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
      public function up()
    {
        Schema::create('teacher_staff_reports', function (Blueprint $table) {
            $table->id();

            $table->string('district')->comment('District Name');
            $table->string('school_name')->comment('School Name');

            $table->integer('sanctioned_teacher_posts')
                  ->comment('Total Sanctioned Teacher Posts');

            $table->integer('teachers_posted_departmental')
                  ->comment('Total Teachers Currently posted (Departmental)');

            $table->integer('teachers_posted_total')
                  ->comment('Total Teachers Currently posted (Edu Dept & Others)');

            $table->integer('vacant_teacher_posts')
                  ->comment('Number of Vacant Teaching Posts');

            $table->integer('teachers_left_last_year')
                  ->comment('Teachers Left school last academic year (Departmental)');

            $table->decimal('teacher_attendance_percentage', 5, 2)
                  ->comment('Teacher attendance percentage for last 3 months');

            $table->integer('teacher_satisfaction_score')
                  ->comment('Teacher Satisfaction score (0-100)');

            $table->boolean('teacher_training_conducted')
                  ->comment('Teachers Development Training Conducted (Yes/No)');

            $table->boolean('teacher_accommodation_available')
                  ->comment('Teachers Accommodation available (Yes/No)');

            $table->boolean('best_teacher_award_given')
                  ->comment('Best Teacher Award Given (Yes/No)');

            $table->boolean('exposure_visit_conducted')
                  ->comment('Exposure / Model School Visit Conducted (Yes/No)');

            $table->integer('sanctioned_non_teaching_posts')
                  ->comment('Sanctioned Non-Teaching Staff Posts');

            $table->integer('filled_non_teaching_posts')
                  ->comment('Filled Non-Teaching Staff Posts');

            $table->integer('vacant_non_teaching_posts')
                  ->comment('Number of Vacant Non-Teaching Staff Posts');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_staff_reports');
    }
};
