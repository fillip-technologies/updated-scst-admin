<?php

namespace App\Exports\Report;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StdentRepoExport implements FromCollection, WithHeadings, WithMapping
{
    protected $date_range;
    protected $class;

    public function __construct($date_range, $class)
    {
        $this->date_range = $date_range;
        $this->class = $class;
    }

    public function collection()
    {
        $startDate = $this->date_range[0] ?? null;
        $endDate   = $this->date_range[1] ?? null;

        return Student::with([
            'allclass',
            'school',
            'attendance' => function ($query) use ($startDate, $endDate) {
                if ($startDate && $endDate) {
                    $query->whereBetween('date', [$startDate, $endDate]);
                }
            },
        ])
        ->where('class_id', $this->class)
        ->get();
    }

    public function headings(): array
    {
        return [
            'Student Name',
            'Class',
            'School',
            'Total Present',
            'Total Absent',
            'Dates',
        ];
    }

    public function map($student): array
    {
        $attendance = $student->attendance ?? collect();

        $present = $attendance->where('status', 'present')->count();
        $absent  = $attendance->where('status', 'absent')->count();

        // Get all dates (comma separated)
        $dates = $attendance->pluck('date')->filter()->implode(', ');

        return [
            $student->name ?? '',
            $student->allclass->name ?? '',
            $student->school->school_name ?? '',
            $present,
            $absent,
            $dates,
        ];
    }
}
