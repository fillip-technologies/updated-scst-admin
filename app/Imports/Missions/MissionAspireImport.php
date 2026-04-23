<?php

namespace App\Imports\Missions;

use App\Models\MissionAspire;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MissionAspireImport implements ToModel, WithHeadingRow
{
    /**
     * @return Model|null
     */
    public function model(array $row)
    {

        return new MissionAspire([

            'district' => trim($row['district']) ?? null,

            'school_name' => trim($row['school_name']) ?? null,

            'school_code' => $row['school_code'] ?? null,

            'total__enrolled_students' => $row['total_students_enrolled_at_start_of_year'] ?? null,

            'dropouts_students' => $row['number_of_students_left_school_during_the_year_dropouts'] ?? null,

            'current_students_enrolled' => $row['current_students_enrolled_4_5'] ?? null,

            'student_attendance_percentage' => $row['student_attendance_percentage_for_the_last_3_months'] ?? null,

            'students_appearing_exams' => $row['total_students_appearing_for_board_exams'] ?? null,

            'students_passed_board_exams' => $row['number_of_students_passed_board_exams'] ?? null,

            'students_first_division' => $row['students_scoring_60_in_board_exam_first_division'] ?? null,

            'students_tested_competency' => $row['number_of_students_tested_for_competency_nipun'] ?? null,

            'students_competency_50' => $row['number_of_students_scoring_50_in_competency_test'] ?? null,

            'students_enrolled_coaching' => $row['students_enrolled_in_jee_neet_clat_other_coaching'] ?? null,

            'students_appearing_competitive' => $row['students_appearing_in_competitive_exams'] ?? null,

            'students_skill_exposure' => $row['students_receiving_vocational_skill_exposure_class_9'] ?? null,
        ]);
    }
}
