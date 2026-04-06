<?php

namespace App\Exports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeacherExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Teacher::with('school')
            ->get()
            ->map(function ($teacher) {
                return [
                    'School Name' => $teacher->school->school_name ?? '',
                    'Name' => $teacher->name,
                    'Email' => $teacher->email,
                    'Phone' => $teacher->phone,
                    'Gender' => $teacher->gender,
                    'Address' => $teacher->address,
                    'Designation' => $teacher->designation,
                    'Subject' => $teacher->subject,
                    'Class' => $teacher->class_id,
                    'Joining Date' => $teacher->joining_date,
                    'school_id' => $teacher->school_id,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'School Name',
            'Name',
            'Email',
            'Phone',
            'Gender',
            'Address',
            'Designation',
            'Subject',
            'Class',
            'Joining Date',
            'SchoolID',
        ];
    }
}
