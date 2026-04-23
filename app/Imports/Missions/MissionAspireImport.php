<?php

namespace App\Imports\Missions;

use App\Models\MissionAspire;
use Maatwebsite\Excel\Concerns\ToModel;

class MissionAspireImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MissionAspire([
            //
        ]);
    }
}
