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
            ->with('success', 'Leaders section saved successfully');
    }

    public function SaveTeacher(Request $request)
    {
        $request->validate([
            'staff_name' => 'required|string|max:255',
            'staff_subject' => 'required|string|max:255',
            'staff_email' => 'required|email',
            'staff_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'school_id' => 'required|integer',
        ]);

        $imageUpload = null;

        if ($request->hasFile('staff_image')) {
            $file = $request->file('staff_image');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $uploadPath = public_path('teacher');

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

            $teachers = json_decode($section->teacher_staff, true);

            if (! is_array($teachers)) {
                $teachers = [];
            }

            $teachers[] = $teacherData;

            $section->update([
                'teacher_staff' => json_encode($teachers, JSON_UNESCAPED_UNICODE),
            ]);

        } else {

            Staff::create([
                'school_id' => $request->school_id,
                'teacher_staff' => json_encode([$teacherData], JSON_UNESCAPED_UNICODE),
            ]);
        }

        return redirect()->route('school.website-cms.staff')
            ->with('success', 'Teacher saved successfully');
    }

    public function UpdateLeader(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'leader_name' => 'required',
            'leader_designation' => 'required',
            'leader_bio' => 'required',
        ]);

        $dataget = Staff::where('school_id', $request->school_id)->firstOrFail();

        $editdata = json_decode($dataget->leadership);

        $oldImage = $request->old_image;
        $uploadImage = $oldImage; // ✅ default old image

        if ($request->hasFile('leader_image')) {

            $file = $request->file('leader_image');

            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $destination = public_path('leaders');

            if (! file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $filename);

            if (! empty($oldImage) && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }
            $uploadImage = 'leaders/'.$filename;
        }

        $editdata->leader_name = $request->leader_name;
        $editdata->leader_designation = $request->leader_designation;
        $editdata->leader_bio = $request->leader_bio;
        $editdata->leader_image = $uploadImage;

        $dataget->leadership = json_encode($editdata);
        $dataget->save();

        return redirect()->route('school.website-cms.staff')
            ->with('success', 'Leaders section Updated successfully ✅');
    }

    public function UpdateTeacher(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'index' => 'required|integer',
            'staff_name' => 'required|string|max:255',
            'staff_subject' => 'required|string|max:255',
            'staff_email' => 'required|email|max:255',
        ]);

        $index = $request->index;

        // Get existing staff JSON
        $getdata = Staff::where('school_id', $request->school_id)->first();
        if (! $getdata) {
            return redirect()->back()->with('error', 'Staff data not found');
        }

        $editdata = json_decode($getdata->teacher_staff, true);

        $uploadImg = $editdata[$index]['staff_image'] ?? null;
        if ($request->hasFile('staff_image')) {

            if (! empty($uploadImg) && file_exists(public_path($uploadImg))) {
                unlink(public_path($uploadImg));
            }

            $file = $request->file('staff_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('teacher'), $filename);
            $uploadImg = 'teacher/'.$filename;
        }

        $editdata[$index] = [
            'staff_name' => $request->staff_name,
            'staff_subject' => $request->staff_subject,
            'staff_email' => $request->staff_email,
            'staff_image' => $uploadImg,
        ];

        $getdata->teacher_staff = json_encode($editdata);
        $getdata->save();

        return redirect()->back()->with('success', 'Staff updated successfully');
    }

    public function DeleteTeacher(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'index' => 'required|integer',
        ]);

        $index = $request->index;


        $getdata = Staff::where('school_id', $request->school_id)->first();
        if (! $getdata) {
            return redirect()->back()->with('error', 'Staff data not found');
        }

        $staffData = json_decode($getdata->teacher_staff, true); // decode as associative array

        if (! isset($staffData[$index])) {
            return redirect()->back()->with('error', 'Staff not found at this index');
        }

        if (! empty($staffData[$index]['staff_image']) && file_exists(public_path($staffData[$index]['staff_image']))) {
            unlink(public_path($staffData[$index]['staff_image']));
        }

        array_splice($staffData, $index, 1);

        $getdata->teacher_staff = json_encode($staffData);
        $getdata->save();

        return redirect()->back()->with('success', 'Staff deleted successfully');
    }
}
