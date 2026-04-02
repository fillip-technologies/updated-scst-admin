<?php

namespace App\Exports;

use App\Models\MainNotice;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NoticeExport implements FromCollection, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return MainNotice::select(
            'title',
            'date',
            'notice_badge',
            'notice_type',
            'description',
            'created_at',
            'updated_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Title',
            'Date',
            'Notice Badge',
            'Notice Type',
            'Description',
            'Created At',
            'Updated At',
        ];
    }
}
