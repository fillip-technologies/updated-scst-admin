<?php

namespace App\Imports\Missions;

use App\Models\SchoolInfrastructureReport;
use Maatwebsite\Excel\Concerns\ToModel;

class SchoolInfrastructureReportImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SchoolInfrastructureReport([
            //
        ]);
    }
}
