<?php

namespace App\Imports\Missions;

use App\Models\ParentEngagementReport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParentEngagementReportImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
     
        return new ParentEngagementReport([
            'district' => $row['district'] ?? null,
            'school_code' => $row['school_code'] ?? null,
            'school_name' => $row['school_name'] ?? null,

            'ptm_conducted_count' => $row['ptms_conducted_last_academic_year_count'] ?? null,

            'parents_invited_last_ptm' => $row['total_parents_invited_last_2_ptm'] ?? null,

            'parents_attended_last_ptm' => $row['total_parents_who_attended_ptms_last_2_ptm'] ?? null,

            'progress_reports_shared' => $row['total_number_of_progress_reports_per_students_shared_with_parents_during_last_academic_year'] ?? null,

            'grievances_received' => $row['total_grievancescomplaints_received_from_parents'] ?? null,

            'grievances_resolved' => $row['number_of_grievances_resolved'] ?? null,

            'committee_active' => $row['community_monitoring_committee_active_yes_no'] ?? null,
        ]);
    }
}



