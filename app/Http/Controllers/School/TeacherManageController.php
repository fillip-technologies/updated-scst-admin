<?php

namespace App\Http\Controllers\School;

use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherManageController extends Controller
{
    public function desplayTeacher()
    {
        $teachers = Teacher::with(['addclass', 'school'])->where('school_id', SchoolLogin()->id)->get();

        return view('modules.school.teacher-attendance.display', compact('teachers'));
    }

    public function editTeacher($id, $schoolId)
    {
        $editdata = Teacher::where('school_id', $schoolId)->where('id', $id)->firstOrFail();

        return view('modules.school.teacher-attendance.edit', compact('editdata'));
    }

    public function SaveTeacher(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'designation' => 'required',
            'address' => 'required',
            'photo' => 'required|file|mimes:jpg,jpeg,png,webp',
            'subject' => 'nullable',
            'class_id' => 'nullable',
            'joining_date' => 'required|date',
            'gender' => 'required',
        ]);
        $uploadphoto = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = $request->name.'.'.$file->getClientOriginalExtension();
            $upload = public_path('teacher');
            $file->move($upload, $filename);
            $uploadphoto = 'teacher/'.$filename;

        }

        $data = [
            'school_id' => $request->school_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'address' => $request->address,
            'photo' => $uploadphoto,
            'subject' => $request->subject,
            'class_id' => $request->class_id,
            'joining_date' => $request->joining_date,
            'gender' => $request->gender,
        ];

        $data = ManageCrud::createdatas(Teacher::class, $data);
        if ($data) {
            return redirect('/school/teacher/list')->with('success', 'Teacher Added SuccessFul');
        } else {
            return redirect('/school/teacher/list')->with('error', 'Somthing went wrong');
        }

    }

    public function UpdateTeacher(Request $request, $id, $schoolId)
    {
        $getteacher = Teacher::where('school_id', $schoolId)
            ->where('id', $id)
            ->firstOrFail();
        $request->validate([
            'school_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'designation' => 'required',
            'address' => 'required',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png,webp',
            'subject' => 'nullable',
            'class_id' => 'nullable',
            'joining_date' => 'required|date',
            'gender' => 'required',
        ]);
        $uploadphoto = null;
        if ($request->hasFile('photo')) {
            if (file_exists(public_path($getteacher->photo))) {
                unlink(public_path($getteacher->photo));
            }
            $file = $request->file('photo');
            $filename = $request->name.'.'.$file->getClientOriginalExtension();
            $upload = public_path('teacher');
            $file->move($upload, $filename);
            $uploadphoto = 'teacher/'.$filename;

        }

        $data = [
            'school_id' => $request->school_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'address' => $request->address,
            'photo' => $uploadphoto,
            'subject' => $request->subject,
            'class_id' => $request->class_id,
            'joining_date' => $request->joining_date,
            'gender' => $request->gender,
        ];

        $data = ManageCrud::updatedata(Teacher::class,$id, $data);
        if ($data) {
            return redirect('/school/teacher/list')->with('success', 'Teacher Update SuccessFul');
        } else {
            return redirect('/school/teacher/list')->with('error', 'Somthing went wrong');
        }
    }

    public function DeleteTeacher($id, $schoolId)
    {
        $getteacher = Teacher::where('school_id', $schoolId)
            ->where('id', $id)
            ->firstOrFail();
        dd($getteacher);
    }

    public function TeacheeExport() {}

    public function TeacherImport() {}
}
