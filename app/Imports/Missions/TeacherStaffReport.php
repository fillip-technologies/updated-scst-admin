<?php

namespace App\Imports\Missions;

use App\Models\TeacherStaffReport;
use Maatwebsite\Excel\Concerns\ToModel;

class TeacherStaffReport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TeacherStaffReport([
            //
        ]);
    }
}
