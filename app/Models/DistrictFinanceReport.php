<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistrictFinanceReport extends Model
{
   protected $table = 'district_finance_reports';

    protected $fillable = [
        'school_code',
        'school_id',
        'district',
        'budget_allocated',
        'budget_utilised',
        'audit_status',
        'reports_due',
        'reports_submitted_on_time',
        'last_submission_date',
        'dashboard_updated',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }
}
