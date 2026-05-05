<?php

namespace App\Imports;

use App\Models\AddClasses;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StudentImport implements ToModel ,WithHeadingRow
{
    /**
     * @return Model|null
     */
   public function model(array $row)
{
    $classId = optional(
        AddClasses::where('name', $row['class'])->first()
    )->id;

    $rollnumber = roll_number($row['name']);

    $dob = null;

    if (!empty($row['dob'])) {
        if (is_numeric($row['dob'])) {

            $dob = Date::excelToDateTimeObject($row['dob'])->format('Y-m-d');
        } else {

            $dob = Carbon::parse($row['dob'])->format('Y-m-d');
        }
    }

    return new Student([
        'name' => $row['name'] ?? null,
        'roll_number' => $rollnumber,
        'class_id' => $classId,
        'dob' => $dob, // ✅ FIXED
        'gender' => $row['gender'] ?? null,
        'email' => $row['email'] ?? null,
        'phone' => $row['phone'] ?? null,
        'parent_name' => $row['parent_name'] ?? 'N/A',
        'parent_email' => $row['parent_email'] ?? null,
        'parent_phone' => $row['parent_phone'] ?? null,
        'parent_relation' => $row['parent_relation'] ?? null,
        'school_id' => SchoolLogin()->id ?? null,
    ]);
}
}
