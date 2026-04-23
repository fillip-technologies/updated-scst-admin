<?php

namespace App\Imports\Missions;

use App\Models\DistrictFinanceReport;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DistrictFinanceReportImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return Model|null
     */
    public function model(array $row)
    {
        return new DistrictFinanceReport([
            'district' => $row['district'] ?? null,

            'budget_allocated' => $row['total_budget_allocated_rs'] ?? null,

            'budget_utilised' => $row['total_budget_utilised_rs'] ?? null,

            'audit_status' => $row['audit_compliance_status_compliant_pending_non_compliant'] ?? null,

            'reports_due' => $row['reports_due_this_period_count'] ?? null,

            'reports_submitted_on_time' => $row['reports_submitted_on_time_count'] ?? null,

            'last_submission_date' => $row['last_report_submission_date'] ?? null,

            'dashboard_updated' => $row['digital_dashboard_updated_yes_no'] ?? null,
        ]);
    }
}

