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
            'school_code' => $row['school_code'] ?? null,
            'school_name' => $row['school_name'] ?? null,

            'adequate_classrooms' => $row['adequate_classrooms_yn'] ?? null,

            'functional_hostel_rooms' => $row['functional_hostel_rooms_yn'] ?? null,

            'functional_toilets' => $row['total_functional_toilets_count'] ?? null,

            'functional_kitchen' => $row['functional_kitchen_yn'] ?? null,

            'dining_hall_available' => $row['dining_hall_available_yn'] ?? null,

            'safe_drinking_water' => $row['safe_drinking_water_purifier_yn'] ?? null,

            'electricity_backup' => $row['electricity_backup_yn'] ?? null,

            'avg_electricity_hours' => $row['average_electricity_hours_per_day'] ?? null,

            'library_functional' => $row['library_functional_yn'] ?? null,

            'playground_available' => $row['playground_available_yn'] ?? null,

            'boundary_wall_intact' => $row['boundary_wall_intact_yn'] ?? null,

            'cctv_functional' => $row['cctv_functional_yn'] ?? null,

            'internet_available' => $row['internet_wi0fi_available_yn'] ?? null,

            'smart_classroom_operational' => $row['smart_classroom_operational_yn'] ?? null,

            'infrastructure_audit_completed' => $row['annual_infrastructure_audit_completed_yn'] ?? null,
        ]);
    }
}
