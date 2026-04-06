<?php

namespace App\Imports;

use App\Models\Teacher;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TeacherImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        return new Teacher([
            'school_id' => SchoolLogin()->id ?? null,
            'name' => $row['name'] ?? null,
            'email' => $row['email'] ?? null,
            'phone' => $row['phone'] ?? null,
            'gender' => $row['gender'] ?? null,
            'address' => $row['address'] ?? null,
            'designation' => $row['designation'] ?? null,
            'subject' => $row['subject'] ?? null,
            'class_id' => $row['class'] ?? null,
            'joining_date' => isset($row['joining_date'])
           ? (is_numeric($row['joining_date'])
            ? Date::excelToDateTimeObject($row['joining_date'])->format('Y-m-d')
             : Carbon::parse($row['joining_date'])->format('Y-m-d'))
          : null,
        ]);
    }
}
