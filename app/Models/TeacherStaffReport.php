<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherStaffReport extends Model
{
    protected $table = 'teacher_staff_reports';

    protected $fillable = [
        'district',
        'school_name',
        'sanctioned_teacher_posts',
        'teachers_posted_departmental',
        'teachers_posted_total',
        'vacant_teacher_posts',
        'teachers_left_last_year',
        'teacher_attendance_percentage',
        'teacher_satisfaction_score',
        'teacher_training_conducted',
        'teacher_accommodation_available',
        'best_teacher_award_given',
        'exposure_visit_conducted',
        'sanctioned_non_teaching_posts',
        'filled_non_teaching_posts',
        'vacant_non_teaching_posts',
    ];
}
