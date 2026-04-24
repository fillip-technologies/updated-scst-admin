<?php

namespace App\Imports\Missions;

use App\Models\TeacherStaffReport;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeacherStaffReportImport implements ToModel, WithHeadingRow
{
    /**
     * @return Model|null
     */
    public function model(array $row)
    {
    
        return new TeacherStaffReport([
            'district' => $row['district'] ?? null,
            'school_code' => $row['school_code'] ?? null,
            'school_name' => $row['school_name'] ?? null,

            'sanctioned_teacher_posts' => $row['total_sanctioned_teacher_posts'] ?? null,

            'teachers_posted_departmental' => $row['total_teachers_currently_posted_departmental'] ?? null,

            'teachers_posted_total' => $row['total_teachers_currently_posted_edu_dept_others'] ?? null,

            'vacant_teacher_posts' => $row['number_of_vacant_teaching_posts'] ?? null,

            'teachers_left_last_year' => $row['teachers_left_school_last_academic_year_departmental'] ?? null,

            'teacher_attendance_percentage' => $row['teacher_attendance_percentage_for_the_last_3_months'] ?? null,

            'teacher_satisfaction_score' => $row['teacher_satisfaction_based_on_internal_survey_of_housing_salary_etc_0_100'] ?? null,

            'teacher_training_conducted' => $row['teachers_development_training_conducted_yesno'] ?? null,

            'teacher_accommodation_available' => $row['teachers_accomodation_available_yesno'] ?? null,

            'best_teacher_award_given' => $row['best_teacher_award_given_yes_no'] ?? null,

            'exposure_visit_conducted' => $row['exposure_model_school_visit_conducted_yes_no'] ?? null,

            'sanctioned_non_teaching_posts' => $row['sanctioned_non_teaching_staff_posts'] ?? null,

            'filled_non_teaching_posts' => $row['filled_non_teaching_staff_posts'] ?? null,

            'vacant_non_teaching_posts' => $row['number_of_vacant_non_teaching_staff_posts'] ?? null,
        ]);
    }
}


