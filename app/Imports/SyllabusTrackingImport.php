<?php

namespace App\Imports;

use App\Models\SyllabusTracking;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class SyllabusTrackingImport implements ToModel
{
    public $assign_date;

    public $subject;

    public $completion_date;

    public $class_name;

    /**
     * @param  array  $row
     * @return Model|null
     */
    public function __construct($subject, $assign_date, $completion_date, $class_name)
    {
        $this->subject = $subject;
        $this->class_name = $class_name;
        $this->completion_date = $completion_date;
        $this->assign_date = $assign_date;
    }

    public function model(array $row)
    {

        if (empty(array_filter($row))) {
            return null;
        }


        // $exists = SyllabusTracking::where('class_name',$this->class_name)
        //     ->where('subject_name', $this->subject)
        //     ->exists();

        // if ($exists) {
        //     throw new \Exception('Data Already Exist!');
        // }

        return new SyllabusTracking([
            'subject_name' => $this->subject,
            'class_name' => $this->class_name,
            'topics_name' => $row[0] ?? null,
            'completion_date' => $this->completion_date,
            'assign_date' => $this->assign_date,
        ]);
    }
}
