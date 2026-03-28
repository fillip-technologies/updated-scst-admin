<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Roll Number',
            'Class',
            'DOB',
            'Gender',
            'Email',
            'Phone',
            'Parent Name',
            'Parent Email',
            'Parent Phone',
            'Parent Relation',
            'School ID',
            'Created At',
            'Updated At',
        ];
    }

   public function collection()
{
    return Student::with('allclass')->get()->map(function ($student) {
        return [
            $student->id,
            $student->name,
            $student->roll_number,
            $student->allclass->name ?? '',
            $student->dob,
            $student->gender,
            $student->email,
            $student->phone,
            $student->parent_name,
            $student->parent_email,
            $student->parent_phone,
            $student->parent_relation,
            $student->school_id,
            $student->created_at,
            $student->updated_at,
        ];
    });
}
}
