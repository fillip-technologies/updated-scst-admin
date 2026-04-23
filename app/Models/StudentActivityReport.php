<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentActivityReport extends Model
{

    protected $table = 'student_activity_reports';

    protected $fillable = [
        'district',
        'school_name',
        'total_students',
        'students_cocurricular',
        'students_sports',
        'students_district_state_sports',
        'career_guidance_sessions',
        'eligible_vocational_students',
        'enrolled_vocational_students',
        'eligible_competitive_students',
        'enrolled_competitive_students',
        'students_appearing_competitive',
        'annual_talent_festival',
        'debate_events_count',
    ];
}
