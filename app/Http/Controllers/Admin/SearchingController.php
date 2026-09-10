<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\MealReport;
use App\Models\Result;
use App\Models\TeacherAttend;
use Illuminate\Http\Request;

class SearchingController extends Controller
{
    public function viewspacificdata(Request $request)
{
    $schoolId = $request->query('school_id');
    $classID = $request->query('class_id');
    $date     = $request->query('date');
    $report   = $request->query('report');

    if ($report == 'Meal Attendance') {

        $reports = MealReport::with('school')
            ->when($schoolId, function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId);
            })
            ->when($date, function ($query) use ($date) {
                $query->whereDate('date', $date);
            })
            ->paginate(5)
            ->appends($request->query());

        return view('modules.reports.internal-report.meal_attendance', compact('reports'));
    }

    elseif ($report == 'Student Marks') {
        $reports = Result::with(['school', 'student', 'subject', 'teacher', 'addclass'])
            ->when($schoolId, function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId);
            })
            ->when($classID, function ($query) use ($classID) {
                $query->where('class_id', $classID);
            })
            ->paginate(5)
            ->appends($request->query());

        return view('modules.reports.internal-report.result', compact('reports'));
    }

    elseif ($report == 'Teacher Attendance') {

        $reports = TeacherAttend::with(['school', 'teacher'])
            ->when($schoolId, function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId);
            })
            ->when($date, function ($query) use ($date) {
                $query->whereDate('date', $date);
            })
            ->paginate(5)
            ->appends($request->query());

        return view('modules.reports.internal-report.teacher_attendance', compact('reports'));
    }

    else {

        $reports = Attendance::with(['student', 'allclass', 'school'])
            ->when($schoolId, function ($query) use ($schoolId) {
                $query->where('recorded_by', $schoolId);
            })
            ->when($date, function ($query) use ($date) {
                $query->whereDate('date', $date);
            })
            ->when($classID, function ($query) use ($classID) {
                $query->where('class_id', $classID);
            })
            ->paginate(5)
            ->appends($request->query());

        return view('modules.reports.internal-report.student_attendance', compact('reports'));
    }
}



public function studentAttendence(Request $request){
    $tearms = $request->query('terms');
    $data= $request->query('search');

    
}
}
