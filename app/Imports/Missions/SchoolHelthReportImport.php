<?php

namespace App\Imports\Missions;

use App\Models\SchoolHelthReport;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SchoolHelthReportImport implements ToModel, WithHeadingRow
{
    /**
     * @return Model|null
     */
    public function model(array $row)
    {
        // dd($row);

        return new SchoolHelthReport([
            'district' => $row['district'] ?? null,
            'school_code' => $row['school_code'] ?? null,
            'school_name' => $row['school_name'] ?? null,

            'students_tested_anaemia' => $row['total_students_tested_for_anaemia'] ?? null,

            'anaemic_students_found' => $row['number_of_anaemic_students_found'] ?? null,

            'students_bmi_measured' => $row['total_students_with_bmi_measured'] ?? null,

            'students_normal_bmi' => $row['students_in_normal_bmi_range'] ?? null,

            'health_screening_covered' => $row['total_students_covered_in_health_screening'] ?? null,

            'hospital_visits' => $row['total_hospital_visits_sick_leave'] ?? null,

            'menu_not_followed_count' => $row['no_of_times_menu_was_not_followed_in_last_2_month'] ?? null,

            'food_not_on_time_count' => $row['no_of_times_food_was_not_given_on_time_in_last_2_month'] ?? null,

            'safe_drinking_water' => $row['safe_drinking_water_available_yes_no'] ?? null,

            'kitchen_hygiene_score' => $row['kitchen_hygiene_score_00100_0_based_on_cleanliness'] ?? null,

            'mental_health_sessions' => $row['mental_health_counselling_sessions_conducted'] ?? null,
        ]);
    }
}
