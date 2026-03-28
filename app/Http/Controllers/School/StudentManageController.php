<?php

namespace App\Http\Controllers\School;

use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Models\AddClasses;
use App\Models\Student;
use Illuminate\Http\Request;

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

         return redirect()->route('school.student')->with('success', 'Student Admission Successfully');

    }

    public function getallStudent()
    {
        $studentdata = Student::with(['allclass'])->get();
        $classes = AddClasses::all();

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

        return redirect()->route('school.student')->with('success', 'Student Updated Successfully');
    }

    public function studentDelete($id){
          $id = trim($id);
          ManageCrud::deletedata(Student::class,$id);
          return redirect()->route('school.student')->with('success', 'Student deleted Successfully');

    }
}
