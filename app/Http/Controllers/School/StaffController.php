<?php

namespace App\Http\Controllers\School;

use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function SaveLeader(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'leader_name' => 'required|string',
            'leader_designation' => 'required|string',
            'leader_bio' => 'required',
            'leader_image' => 'required|file',
        ]);

        $leaderdata = [];
        $uploadImg = null;

        if ($request->hasFile('leader_image')) {
            $file = $request->file('leader_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $upload = public_path('leaders');
            $file->move($upload, $filename);
            $uploadImg = 'leaders/'.$filename;
        }

        $leaderdata['leader_name'] = $request->leader_name;
        $leaderdata['leader_designation'] = $request->leader_designation;
        $leaderdata['leader_bio'] = $request->leader_bio;
        $leaderdata['leader_image'] = $uploadImg;

        $data = [
            'leadership' => json_encode($leaderdata),
            'school_id' => $request->school_id,
        ];
        ManageCrud::createdatas(Staff::class, $data);

        return redirect()->route('school.website-cms.staff')
            ->with('success', 'Campus section saved successfully');
    }

    public function SaveTeacher(Request $request)
    {
        $request->validate([
            'staff_name' => 'required',
            'staff_subject' => 'required',
            'staff_email' => 'required|email',
            'staff_image' => 'required|file',
            'school_id' => 'required',
        ]);

        $teacherData = [];
        $imageUpload = null;

        if ($request->hasFile('staff_image')) {
            $file = $request->file('staff_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $uploadPath = public_path('teacher');

            // folder create if not exists
            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $file->move($uploadPath, $filename);
            $imageUpload = 'teacher/'.$filename;
        }

        $teacherData = [
            'staff_name' => $request->staff_name,
            'staff_subject' => $request->staff_subject,
            'staff_email' => $request->staff_email,
            'staff_image' => $imageUpload,
        ];

        $section = Staff::where('school_id', $request->school_id)->first();

        if ($section) {

            $teachers = is_array($section->teacher_staff)
                ? $section->teacher_staff
                : json_decode($section->teacher_staff, true);

            $teachers = $teachers ?? [];
            $teachers[] = $teacherData;

            $section->update([
                'teacher_staff' => json_encode($teachers),
            ]);

        } else {

            Staff::create([
                'school_id' => $request->school_id,
                'teacher_staff' => json_encode([$teacherData]),
            ]);
        }

        return redirect()->route('school.website-cms.staff')
            ->with('success', 'Teacher saved successfully');
    }
}
