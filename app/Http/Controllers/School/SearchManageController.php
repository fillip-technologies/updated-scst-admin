<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\AddClasses;
use App\Models\Student;
use Illuminate\Http\Request;

class SearchManageController extends Controller
{
    public function attendanceSerach(Request $request)
    {
        $school_id = SchoolLogin()->id ?? TeacherLog()->school_id;
        $date = $request->date;
        $classes = AddClasses::where('school_id', $school_id)->get();

        $studentdata = Student::where('school_id', $school_id)
            ->with(['attendance' => function ($q) use ($date) {
                $q->whereDate('date', $date)->orderBy('date');
            }])
            ->paginate(10);

        return view('modules.school.attendance.index', compact('classes', 'studentdata'));
    }
}
