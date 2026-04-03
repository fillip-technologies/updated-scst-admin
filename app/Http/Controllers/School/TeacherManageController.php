<?php

namespace App\Http\Controllers\School;

use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherAttend;
use Illuminate\Http\Request;

class TeacherManageController extends Controller
{
    public function attend_teacher(Request $request)
    {

        $request->validate([
            'leave_type' => 'nullable',
            'status' => 'required',
            'school_id' => 'required',
            'teacher_id' => 'required',
            'date' => 'required|date',
        ]);

        $data = [
            'leave_type' => $request->leave_type,
            'status' => $request->status,
            'school_id' => $request->school_id,
            'teacher_id' => $request->teacher_id,
            'date' => $request->date,
        ];
        $currentdata = TeacherAttend::where('teacher_id', $request->teacher_id)->whereDate('date', $request->date)->first();
        if ($currentdata) {
            $currentdata->update([
                'leave_type' => $request->leave_type,
                'status' => $request->status,
            ]);
        } else {
            ManageCrud::createdatas(TeacherAttend::class, $data);
        }

        return back()->with('success', 'Attendance Saved Successfully');
    }

    public function desplayTeacher()
    {
        $teachers = Teacher::with(['addclass', 'school'])->where('school_id', SchoolLogin()->id)->paginate(8);

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
        $teacher = Teacher::where('school_id', $schoolId)
            ->where('id', $id)
            ->firstOrFail();

        $request->validate([
            'school_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'designation' => 'required',
            'address' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'subject' => 'nullable',
            'class_id' => 'nullable',
            'joining_date' => 'required|date',
            'gender' => 'required',
        ]);

        $uploadphoto = $teacher->photo;

        if ($request->hasFile('photo')) {

            // Delete old photo safely
            if (! empty($teacher->photo) && file_exists(public_path($teacher->photo))) {
                unlink(public_path($teacher->photo));
            }

            $file = $request->file('photo');

            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('teacher'), $filename);

            $uploadphoto = 'teacher/'.$filename;
        }

        $data = [
            'school_id' => $request->school_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'address' => $request->address,
            'photo' => $uploadphoto, // FIXED
            'subject' => $request->subject,
            'class_id' => $request->class_id,
            'joining_date' => $request->joining_date,
            'gender' => $request->gender,
        ];

        $update = ManageCrud::updatedata(Teacher::class, $id, $data);

        if ($update) {
            return redirect('/school/teacher/list')->with('success', 'Teacher Updated Successfully');
        } else {
            return redirect('/school/teacher/list')->with('error', 'Something went wrong');
        }
    }

    public function DeleteTeacher($id, $schoolId)
    {
        $getteacher = Teacher::where('school_id', $schoolId)
            ->where('id', $id)
            ->firstOrFail();
        if ($getteacher) {
            $getteacher->delete();

            return redirect('/school/teacher/list')->with('success', 'Teacher Deleted Successfully');
        } else {
            return redirect('/school/teacher/list')->with('error', 'Something went wrong');
        }
    }

    public function TeacheeExport() {}

    public function TeacherImport() {}
}
