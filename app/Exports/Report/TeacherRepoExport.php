<?php

namespace App\Exports\Report;

use App\Models\Teacher;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TeacherRepoExport implements FromCollection, WithHeadings, WithMapping
{
    protected $date_range;

    public function __construct($date_range)
    {
        $this->date_range = $date_range;
    }

    public function collection()
    {
        $startDate = $this->date_range[0] ?? null;
        $endDate   = $this->date_range[1] ?? null;

        return Teacher::with([
            'teacherattend' => function ($query) use ($startDate, $endDate) {
                if ($startDate && $endDate) {
                    $query->whereBetween('date', [$startDate, $endDate]);
                }
            }
        ])
        ->where('school_id', SchoolLogin()->id)
        ->get();
    }

    public function headings(): array
    {
        return [
            'Teacher Name',
            'Total Present',
            'Total Absent',
            'Dates',
        ];
    }

    public function map($teacher): array
    {
        $attendance = $teacher->teacherattend ?? collect();

        $present = $attendance->where('status', 'present')->count();
        $absent  = $attendance->where('status', 'absent')->count();

        $dates = $attendance->pluck('date')->filter()->implode(', ');

        return [
            $teacher->name ?? '',
            $present,
            $absent,
            $dates,
        ];
    }
}
