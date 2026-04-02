<?php

namespace App\Imports;

use App\Models\MainNotice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NoticeImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new MainNotice([
            'title'         => $row['title'],
            'date'          => $row['date'],
            'notice_badge'  => $row['notice_badge'],
            'notice_type'   => $row['notice_type'],
            'description'   => $row['description'],
        ]);
    }
}
