<?php

namespace App\Http\Controllers\School;

use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherManageController extends Controller
{
    public function SaveTreacher(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg,png,webp',
            'subject' => 'required',
            'joining_date' => 'required|date',
            'education' => 'required',
            'skills' => 'required',
            'certificate' => 'required',
            'gender' => 'required|enum:male,female,other',
        ]);
        $uploadphoto = null;
        $uploadCertificate = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $request->name.'.'.$file->getClientOriginalExtension();
            $upload = public_path('teacher');
            $file->move($upload, $filename);
            $uploadphoto = 'teacher/'.$filename;

        }

        if ($request->hasFile('certificate')) {
            $file = $request->file('certificate');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $upload = public_path('teacher/certificate');
            $file->move($upload, $filename);
            $uploadphoto = 'teacher/certificate/'.$filename;

        }

        $data = [
            'school_id' => $request->school_id,
            'name' => 'required',
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $uploadphoto,
            'subject' => $request->sucbject,
            'joining_date' => $request->joining_date,
            'education' => $request->education,
            'skills' => $request->skills,
            'certificate' => $uploadCertificate,
            'gender' => $request->gender,
        ];

        $data = ManageCrud::createdatas(Teacher::class, $data);
        if ($data) {
            return redirect()->back()->with('success', 'Teacher Added SuccessFul');
        } else {
            return redirect()->back()->with('error', 'Somthing went wrong');
        }

    }

    public function UpdateTeacher(Request $request, $id, $schoolId)
    {
        $getteacher = Teacher::where('school_id', $schoolId)
            ->where('id', $id)
            ->firstOrFail();
        dd($getteacher);
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
