<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolInfrastructureReport extends Model
{
    protected $table = 'school_infrastructure_reports';

    protected $fillable = [
        'district',
        'school_name',
        'adequate_classrooms',
        'functional_hostel_rooms',
        'functional_toilets',
        'functional_kitchen',
        'dining_hall_available',
        'safe_drinking_water',
        'electricity_backup',
        'avg_electricity_hours',
        'library_functional',
        'playground_available',
        'boundary_wall_intact',
        'cctv_functional',
        'internet_available',
        'smart_classroom_operational',
        'infrastructure_audit_completed',
    ];
}
