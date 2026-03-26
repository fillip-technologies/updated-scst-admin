<?php

namespace App\Http\Controllers\School;

use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class StudentManageController extends Controller
{
    public function createStudent(Request $request)
    {


            $request->validate([
                'name' => 'required|string',
                'class_id' => 'required',
                'school_id'=>'required',
                'dob' => 'required|date',
                'gender' => 'required|in:male,female,other',
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
                'school_id'=>$request->school_id,
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
}
