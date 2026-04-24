<?php

namespace App\Imports\Missions;

use App\Models\StudentActivityReport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentActivityReportImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        return new StudentActivityReport([
            'district' => $row['district'] ?? null,
            'school_code' => $row['school_code'] ?? null,
            'school_name' => $row['school_name'] ?? null,

            'total_students' => $row['total_no_of_students'] ?? null,

            'students_cocurricular' => $row['number_of_students_participating_in_co_curricular_activities_debate_quiz_arts'] ?? null,

            'students_sports' => $row['students_participating_in_sports'] ?? null,

            'students_district_state_sports' => $row['number_of_students_representing_school_in_districtstate_sports'] ?? null,

            'career_guidance_sessions' => $row['career_guidance_sessions_conducted_this_year_number'] ?? null,

            'eligible_vocational_students' => $row['eligible_students_for_vocational_training_class_9'] ?? null,

            'enrolled_vocational_students' => $row['number_of_students_enrolled_in_vocational_skill_training'] ?? null,

            'eligible_competitive_students' => $row['eligible_students_for_competitive_exam_coaching_class_11_12'] ?? null,

            'enrolled_competitive_students' => $row['students_enrolled_in_competitive_exam_coaching'] ?? null,

            'students_appearing_competitive' => $row['number_of_students_appearing_in_competitive_exams_jeeneetssc_etc'] ?? null,

            'annual_talent_festival' => $row['annual_talent_festival_conducted_yes_no'] ?? null,

            'debate_events_count' => $row['debate_public_speaking_events_held_count'] ?? null,
        ]);
    }
}












