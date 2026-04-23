<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionAspire extends Model
{
    protected $table = 'mission_aspires';

    protected $primaryKey = 'id';

    protected $fillable = ['school_code','district', 'school_name', 'total__enrolled_students', 'dropouts_students', 'current_students_enrolled', 'student_attendance_percentage', ' students_passed_board_exams', 'students_tested_competency ', 'students_enrolled_coaching', 'students_appearing_exams', 'students_skill_exposure '];
}
