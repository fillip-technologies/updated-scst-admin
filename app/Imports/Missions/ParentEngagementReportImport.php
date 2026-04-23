<?php

namespace App\Imports\Missions;

use App\Models\ParentEngagementReport;
use Maatwebsite\Excel\Concerns\ToModel;

class ParentEngagementReportImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ParentEngagementReport([
            //
        ]);
    }
}
