<?php

namespace App\Exports;

use App\Models\School;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SchoolExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return School::select(
            'school_name',
            'school_code',
            'establishment_year',
            'district',
            'block',
            'full_address',
            'official_email',
            'school_phone',
            'principle_name',
            'principle_contact',
            'total_classrooms',
            'total_students_enrolled',
            'total_teachers_sanctioned',
            'hostel_capacity',
            'school_admin_username',
            'password'
        )->get();
    }

    public function headings(): array
    {
        return [
            'School Name',
            'School Code',
            'Establishment Year',
            'District',
            'Block',
            'Full Address',
            'Official Email',
            'School Phone',
            'Principal Name',
            'Principal Contact',
            'Total Classrooms',
            'Total Students Enrolled',
            'Total Teachers Sanctioned',
            'Hostel Capacity',
            'School Admin Username',
            'Password'
        ];
    }


}
