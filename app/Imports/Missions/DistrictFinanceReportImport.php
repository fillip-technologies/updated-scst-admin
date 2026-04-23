<?php

namespace App\Imports\Missions;

use App\Models\DistrictFinanceReport;
use Maatwebsite\Excel\Concerns\ToModel;

class DistrictFinanceReportImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DistrictFinanceReport([
            //
        ]);
    }
}
