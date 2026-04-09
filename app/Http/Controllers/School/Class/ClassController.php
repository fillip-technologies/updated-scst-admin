<?php

namespace App\Http\Controllers\School\Class;

use App\Helpers\ManageCrud;
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
            ->paginate(10);

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
                'recorded_by' => SchoolLogin()->id,
            ]);
        }

        return back()->with('success', 'Attendance Saved');
    }

    public function addClass(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'class_name' => 'required',
            'section' => 'nullable',
        ]);

        $data = [
            'name' => 'Class'.$request->class_name,
            'school_id' => $request->school_id,
            'class' => $request->class_name,
        ];

        if ($data) {
            ManageCrud::createdatas(AddClasses::class, $data);

            return back()->with('success', 'Class Created SuccessFul');
        } else {
            return back()->with('error', 'Somwthing Went wrong');
        }
    }

    public function editclass($id)
    {
        $editdata = AddClasses::findOrFail($id);
        $classdata = AddClasses::where('school_id', SchoolLogin()->id  ?? TeacherLog()->school_id)->get();

        return view('modules.school.attendance.create-class', compact('classdata', 'editdata'));
    }

    public function updateClass(Request $request, $id)
    {
        $request->validate([
            'school_id' => 'required',
            'class_name' => 'required',
            'section' => 'nullable',
        ]);

        $getdata = AddClasses::where('school_id', $request->school_id)->where('id', $id)->firstOrFail();

        if ($getdata) {
            $data = [
                'name' => 'Class '.$request->class_name,
                'school_id' => $request->school_id,
                'class' => $request->class_name,
            ];
            if ($data) {
                ManageCrud::updatedata(AddClasses::class, $id, $data);

                return back()->with('success', 'Class Updated SuccessFul');
            } else {
                return back()->with('error', 'Somwthing Went wrong');
            }
        } else {
            return back()->with('success', 'Not Found data');
        }
    }

    public function deleteclass(Request $request, $id)
    {
        $getdata = AddClasses::where('school_id', $request->school_id)->where('id', $id)->firstOrFail();
        if ($getdata) {
            $getdata->delete();
            return back()->with('success', 'Class deleted SuccessFul');
        } else {
            return back()->with('error', 'Somwthing Went wrong');
        }
    }
}
