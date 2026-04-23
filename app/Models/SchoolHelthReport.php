<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolHelthReport extends Model
{
    protected $table = 'school_health_reports';

    protected $fillable = [
        'district',
        'school_name',
        'students_tested_anaemia',
        'anaemic_students_found',
        'students_bmi_measured',
        'students_normal_bmi',
        'health_screening_covered',
        'hospital_visits',
        'menu_not_followed_count',
        'food_not_on_time_count',
        'safe_drinking_water',
        'kitchen_hygiene_score',
        'mental_health_sessions',
    ];
}
