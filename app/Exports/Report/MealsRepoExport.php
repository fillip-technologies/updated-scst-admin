<?php

namespace App\Exports\Report;

use App\Models\MealReport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MealsRepoExport implements FromCollection, WithHeadings, WithMapping
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

        return MealReport::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            })
            ->where('school_id', SchoolLogin()->id)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Menu',
            'Meals Type',
            'Report Type',
            'Meal Served',
            
        ];
    }

    public function map($meal): array
    {
        return [
            $meal->date ?? '',
            $meal->menu ?? 0,
            $meal->report_type ?? "",
            $meal->report_category ?? "",
            $meal->remarks ?? '',
        ];
    }
}
