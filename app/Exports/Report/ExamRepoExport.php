<?php

namespace App\Exports\Report;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExamRepoExport implements FromCollection, WithHeadings, WithMapping
{
    protected $date_range;

    public function __construct($date_range)
    {
        $this->date_range = $date_range;
    }

    public function collection()
    {
        $startDate = $this->date_range[0];
        $endDate   = $this->date_range[1];
        $classID   = $this->date_range[2];
        $examtype  = $this->date_range[3];

        return Result::with(['student', 'addclass', 'subject'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($classID, function ($q) use ($classID) {
                $q->where('class_id', $classID);
            })
            ->when($examtype, function ($q) use ($examtype) {
                $q->where('term', $examtype);
            })
            ->get();


    }


    public function headings(): array
    {
        return [
            'Student Name',
            'Class Name',
            'Subject Name',
            'Marks',
            'Exam Type',
            'Date',
        ];
    }


    public function map($row): array
    {
        return [
            $row->student->name ?? '',
            $row->addclass->class ?? '',
            $row->subject->subjects ?? '',
            $row->marks ?? '',
            $row->term ?? '',
            $row->created_at ? $row->created_at->format('Y-m-d') : '',
        ];
    }
}
