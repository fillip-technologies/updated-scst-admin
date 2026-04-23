<?php

namespace App\Imports\Missions;

use App\Models\StudentActivityReport;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentActivityReportImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new StudentActivityReport([
            //
        ]);
    }
}
