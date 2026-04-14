<?php

use App\Models\AddClasses;
use App\Models\School;

if (! function_exists('districts')) {

    function districts()
    {
        return [
            'Araria',
            'Arwal',
            'Aurangabad',
            'Banka',
            'Begusarai',
            'Bhagalpur',
            'Bhojpur',
            'Buxar',
            'Darbhanga',
            'East Champaran',
            'Gaya',
            'Gopalganj',
            'Jamui',
            'Jehanabad',
            'Kaimur',
            'Katihar',
            'Khagaria',
            'Kishanganj',
            'Lakhisarai',
            'Madhepura',
            'Madhubani',
            'Munger',
            'Muzaffarpur',
            'Nalanda',
            'Nawada',
            'Patna',
            'Purnia',
            'Rohtas',
            'Saharsa',
            'Samastipur',
            'Saran',
            'Sheikhpura',
            'Sheohar',
            'Sitamarhi',
            'Siwan',
            'Supaul',
            'Vaishali',
            'West Champaran',
        ];
    }
}

if (! function_exists('category')) {
    function category()
    {
        return ['Boys', 'Girls', 'Co-educational'];
    }
}

if (! function_exists('roll_number')) {
    function roll_number($student_name)
    {
        $letters = [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
            'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
            'U', 'V', 'W', 'X', 'Y', 'Z',
        ];

        $getnamesub = strtoupper(substr($student_name, 0, 2));
        $random_number = random_int(10000, 90000);
        $randomKey = array_rand($letters);
        $randomLetter = $letters[$randomKey];

        return $getnamesub.$random_number.$randomLetter;
    }

}

if (! function_exists('getClass')) {
    function getClass()
    {
        $classes = AddClasses::where('school_id', SchoolLogin()->id ?? TeacherLog()->school_id)->get();

        return $classes;
    }
}

if (! function_exists('academicType')) {
    function academicType()
    {
        return [
            'Student Attendance',
            'Student Marks',
            'Teacher Attendance',
            'Student Leave',
            'Dropout Rate',
            'Meal Attendance',
        ];
    }
}

if (! function_exists('infrastructureType')) {
    function infrastructureType()
    {
        return [
            'Electricity',
            'Toilets',
            'Drinking Water',
            'Building Safety',
            'Network',

        ];
    }
}

if (! function_exists('checkCandition')) {
    function checkCandition()
    {
        return ['Yes', 'No'];
    }
}

if (! function_exists('gender')) {
    function gender()
    {
        return [
            'male',
            'female',
            'other',
        ];
    }
}

if (! function_exists('leaveType')) {
    function leaveType()
    {
        return
        [
            'Sick Leave',
            'Casual Leave',
            'Unpaid Leave',
        ];
    }
}

if (! function_exists('getDisc')) {
    function getDisc()
    {
        $disdata = School::select('id', 'district')->get();

        return $disdata;
    }
}

if (! function_exists('dateRange')) {
    function dateRange()
    {
        return [
            '1' => 'Last 7 Days',
            '2' => 'Last 30 Days',
            '3' => 'This Month',

        ];
    }
}

if (! function_exists('ExamType')) {

    function ExamType()
    {
        return [
            'half' => 'Half Yearly',
            'third' => 'Third Terminal',
            'final' =>'Final'
        ];
    }

}
