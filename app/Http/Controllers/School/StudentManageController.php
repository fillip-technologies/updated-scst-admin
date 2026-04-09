<?php

namespace App\Http\Controllers\School;

use App\Exports\StudentExport;
use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\AddClasses;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentManageController extends Controller
{
    public function createStudent(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'class_id' => 'required',
            'school_id' => 'required',
            'dob' => 'required|date',
            'gender' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'parent_name' => 'required',
            'parent_email' => 'required|email',
            'parent_phone' => 'required',
            'parent_relation' => 'required',
        ]);
        $roll_number = roll_number($request->name);
        $data = [
            'name' => $request->name,
            'roll_number' => $roll_number, // direct use
            'class_id' => $request->class_id,
            'school_id' => $request->school_id,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'parent_name' => $request->parent_name,
            'parent_email' => $request->parent_email,
            'parent_phone' => $request->parent_phone,
            'parent_relation' => $request->parent_relation,
        ];

        ManageCrud::createdatas(Student::class, $data);

        return back()->with('success', 'Student Admission Successfully');

    }

    public function getallStudent()
    {
        $studentdata = Student::with(['allclass'])->where('school_id',SchoolLogin()->id ?? TeacherLog()->school_id)->paginate(10);
        $classes = AddClasses::where('school_id',SchoolLogin()->id ?? TeacherLog()->school_id)->get();

        return view('modules.school.school-management.index', compact('studentdata', 'classes'));

    }

    public function studentCreate()
    {
        return view('modules.school.school-management.create');
    }

    public function bulkUploadStudent()
    {
        return view('modules.school.school-management.bulk-upload');
    }

    public function studentEdit($id)
    {
        $id = trim($id);
        $editStud = Student::with('allClass')->where('id', $id)->first();

        return view('modules.school.school-management.edit', compact('editStud'));
    }

    public function StudentUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'class_id' => 'required',
            'school_id' => 'required',
            'dob' => 'required|date',
            'gender' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'parent_name' => 'required',
            'parent_email' => 'required|email',
            'parent_phone' => 'required',
            'parent_relation' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'class_id' => $request->class_id,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'parent_name' => $request->parent_name,
            'parent_email' => $request->parent_email,
            'parent_phone' => $request->parent_phone,
            'parent_relation' => $request->parent_relation,
        ];

        ManageCrud::updatedata(Student::class, $id, $data);

        return back()->with('success', 'Student Updated Successfully');
    }

    public function studentDelete($id)
    {
        $id = trim($id);
        ManageCrud::deletedata(Student::class, $id);

        return back()->with('success', 'Student deleted Successfully');

    }

    public function studentclassFilter(Request $request)
    {
        $request->validate([
            'class' => 'required',
            'school_id' => 'required',
        ]);

        $schoolId = $request->school_id;
        $classId = $request->class
            ?? session('selected_class')
            ?? AddClasses::where('school_id', $schoolId)->first()->id;

        session(['selected_class' => $classId]);
        $classes = AddClasses::where('school_id', $schoolId)->get();
        $studentdata = Student::with('allclass')
            ->where('class_id', $classId)
            ->paginate(10);

        return view('modules.school.school-management.index', compact('studentdata', 'classes'));
    }

    public function exportStudent()
    {
        return Excel::download(new StudentExport, 'student.xlsx');
    }

    public function importStudent(Request $request)
    {
        $request->validate([
            // 'class' => 'required',
            'upload_file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new StudentImport, $request->file('upload_file'));

        return back()->with('success', 'Students Imported Successfully');

    }
}
