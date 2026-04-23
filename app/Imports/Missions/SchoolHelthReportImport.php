<?php

namespace App\Imports\Missions;

use App\Models\SchoolHelthReport;
use Maatwebsite\Excel\Concerns\ToModel;

class SchoolHelthReportImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SchoolHelthReport([
            //
        ]);
    }
}
