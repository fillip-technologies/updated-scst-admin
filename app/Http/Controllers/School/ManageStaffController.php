<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Student;

class ManageStaffController extends Controller
{
    public function index()
    {
        echo 'dashboard';
    }

    public function staffDashboard()
    {
        $classes = Student::select('class_id')->where('school_id', SchoolLogin()->id)
            ->groupBy('class_id')
            ->get();

        $data = [];

        foreach ($classes as $class) {

            $total = Student::where('class_id', $class->class_id)->count();

            $present = Student::where('class_id', $class->class_id)
                ->whereHas('attendance', function ($q) {
                    $q->where('status', 'present');
                })
                ->count();

            $absent = Student::where('class_id', $class->class_id)
                ->whereHas('attendance', function ($q) {
                    $q->where('status', 'absent');
                })
                ->count();

            $data[] = [
                'class' => $class->class_id,
                'total' => $total,
                'present' => $present,
                'absent' => $absent,
            ];
        }

        return view('modules.school.dashboard.index', compact('data'));
    }
}
