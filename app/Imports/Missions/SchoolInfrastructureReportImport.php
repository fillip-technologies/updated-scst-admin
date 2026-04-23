<?php

namespace App\Imports\Missions;

use App\Models\SchoolInfrastructureReport;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SchoolInfrastructureReportImport implements ToModel, WithHeadingRow
{
    /**
     * @return Model|null
     */
    public function model(array $row)
    {
        return new SchoolInfrastructureReport([
            'district' => $row['district'] ?? null,

            'school_name' => $row['school_name'] ?? null,

            'adequate_classrooms' => $row['adequate_classrooms_y_n'] ?? null,

            'functional_hostel_rooms' => $row['functional_hostel_rooms_y_n'] ?? null,

            'functional_toilets' => $row['total_functional_toilets_count'] ?? null,

            'functional_kitchen' => $row['functional_kitchen_y_n'] ?? null,

            'dining_hall_available' => $row['dining_hall_available_y_n'] ?? null,

            'safe_drinking_water' => $row['safe_drinking_water_purifier_y_n'] ?? null,

            'electricity_backup' => $row['electricity_backup_y_n'] ?? null,

            'avg_electricity_hours' => $row['average_electricity_hours_per_day'] ?? null,

            'library_functional' => $row['library_functional_y_n'] ?? null,

            'playground_available' => $row['playground_available_y_n'] ?? null,

            'boundary_wall_intact' => $row['boundary_wall_intact_y_n'] ?? null,

            'cctv_functional' => $row['cctv_functional_y_n'] ?? null,

            'internet_available' => $row['internet_wi_fi_available_y_n'] ?? null,

            'smart_classroom_operational' => $row['smart_classroom_operational_y_n'] ?? null,

            'infrastructure_audit_completed' => $row['annual_infrastructure_audit_completed_y_n'] ?? null,
        ]);
    }
}
