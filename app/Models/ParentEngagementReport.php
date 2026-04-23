<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentEngagementReport extends Model
{

    protected $table = 'parent_engagement_reports';

    protected $fillable = [
        'district',
        'school_name',
        'ptm_conducted_count',
        'parents_invited_last_ptm',
        'parents_attended_last_ptm',
        'progress_reports_shared',
        'grievances_received',
        'grievances_resolved',
        'committee_active',
    ];
}
