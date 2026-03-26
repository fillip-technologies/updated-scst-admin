<?php

namespace App\Http\Controllers\School\Class;

use App\Http\Controllers\Controller;
use App\Models\AddClasses;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function SaveClass(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'class' => 'required',
            'classname' => 'required',
        ]);
        $schoolId = trim($request->school_id);
    }

    public function classFilter(Request $request)
    {
        $request->validate(['class' => 'required', 'school_id' => 'required']);
        $schoolId = $request->school_id;
        if (! $request->class) {
            $classes = AddClasses::all();
            $studentdata = Student::with(['attendance'])->get();
        }
        $classId = $request->class
            ?? session('selected_class')
            ?? AddClasses::where('school_id', $schoolId)->first()->id;
        session(['selected_class' => $classId]);
        $classes = AddClasses::where('school_id', $schoolId)->get();
        $studentdata = Student::with(['attendance' => function ($q) {
            $q->whereDate('date', today());
        }])
            ->where('class_id', $classId)
            ->where('school_id', $schoolId)
            ->get();

        return view('modules.school.attendance.index', compact('classes', 'studentdata'));
    }

    public function updateattendance(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'class_id' => 'required',
            'school_id' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);

        $attendance = Attendance::where('student_id', $request->student_id)
            ->whereDate('date', $request->date)
            ->first();

        if ($attendance) {

            $attendance->update([
                'status' => $request->status,
            ]);
        } else {

            Attendance::create([
                'student_id' => $request->student_id,
                'class_id' => $request->class_id,
                'school_id' => $request->school_id,
                'date' => $request->date,
                'status' => $request->status,
                'recorded_by' => auth()->id(),
            ]);
        }

        return back()->with('success', 'Attendance Saved');
    }
}
