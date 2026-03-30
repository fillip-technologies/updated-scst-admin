<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SchoolExport;
use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class SchoolManageController extends Controller
{
    public function AddSchool(Request $request)
    {
        $validatedata = $request->validate([
            'school_logo' => 'nullable|file',
            'school_name' => 'required|string|max:255',
            'school_code' => 'required|string|max:100|unique:schools,school_code',
            'establishment_year' => 'required|digits:4|integer|min:1900|max:'.date('Y'),
            'district' => 'required|string|max:150',
            'category' => 'required',
            'block' => 'required|string|max:150',
            'full_address' => 'required|string',
            'official_email' => 'required|email|max:255',
            'school_phone' => 'required|digits_between:10,15',
            'principle_name' => 'required|string|max:255',
            'principle_contact' => 'required|digits_between:10,15',
            'total_classrooms' => 'required|integer|min:0',
            'total_students_enrolled' => 'required|integer|min:0',
            'total_teachers_sanctioned' => 'required|integer|min:0',
            'hostel_capacity' => 'required|integer|min:0',
            'school_admin_username' => 'required|string|max:100',
            'password' => 'nullable|string|min:6',
            'account_status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('school_logo')) {
            $file = $request->file('school_logo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $uploads = public_path('SchoolLogo');
            if (! file_exists($uploads)) {
                mkdir($uploads, 0777, true);
            }

            $file->move($uploads, $filename);
            $validatedata['school_logo'] = 'SchoolLogo/'.$filename;
        }
        if (! empty($validatedata['password'])) {
            $validatedata['password'] = Hash::make($validatedata['password']);
        }


        $data = ManageCrud::createdatas(School::class, $validatedata);

        User::create([
            'name'=>$data->school_name,
            'username'=>$data->school_admin_username,
            'schoolCode'=>$data->school_code,
            'password'=>$data->password,
            'role'=>'school_admin',
            'school_id'=>$data->id
        ]);
        if ($data) {
            return redirect()->route('admin.school.management')
                ->with('success', 'School Created Successfully');
        }

        return redirect()->route('admin.school.management')
            ->with('error', 'Something Went Wrong');
    }

    public function EditSchool($id)
    {
        $id = decrypt($id);
        $editschl = ManageCrud::singledata(School::class, $id);

        return view('modules.school-management.edit', compact('editschl'));
    }

    public function UpdateSchool(Request $request, $id)
    {
        $validatedata = $request->validate([
            'school_logo' => 'nullable|file',
            'school_name' => 'required|string|max:255',
            'school_code' => 'required|string|max:100',
            'establishment_year' => 'required|digits:4|integer|min:1900|max:'.date('Y'),
            'district' => 'required|string|max:150',
            'category' => 'required',
            'block' => 'required|string|max:150',
            'full_address' => 'required|string',
            'official_email' => 'required|email|max:255',
            'school_phone' => 'required|digits_between:10,15',
            'principle_name' => 'required|string|max:255',
            'principle_contact' => 'required|digits_between:10,15',
            'total_classrooms' => 'required|integer|min:0',
            'total_students_enrolled' => 'required|integer|min:0',
            'total_teachers_sanctioned' => 'required|integer|min:0',
            'hostel_capacity' => 'required|integer|min:0',
            // 'school_admin_username' => 'required|string|max:100',
            // 'password' => 'nullable|string|min:6',
            // 'account_status' => 'required|in:active,inactive',
        ]);
        $id = decrypt($id);
        $dataget = ManageCrud::singledata(School::class, $id);
        if ($request->hasFile('school_logo')) {
            if (file_exists($dataget->school_logo)) {
                unlink(public_path($dataget->school_logo));
            }
            $file = $request->file('school_logo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $uploads = public_path('SchoolLogo');
            $file->move($uploads, $filename);
            $validatedata['school_logo'] = 'SchoolLogo/'.$filename;
        } else {
            $validatedata['school_logo'] = $dataget->school_logo;
        }
        $data = ManageCrud::updatedata(School::class, $id, $validatedata);
        if ($data) {
            return redirect()->route('admin.school.management')
                ->with('success', 'School Updated Successfully');
        }

        return redirect()->route('admin.school.management')
            ->with('error', 'Something Went Wrong');
    }

    public function ViewSchool($id)
    {
        $id = decrypt($id);

        $showschool = ManageCrud::singledata(School::class, $id);

        return view('modules.school-management.show', compact('showschool'));
    }

    public function DeleteSchool($id)
    {
        $id = decrypt($id);
        $datadelete = ManageCrud::deletedata(School::class, $id);
        if ($datadelete) {
            return redirect()->route('admin.school.management')->with('success', 'School Deleted SuccessFul');
        } else {
            return redirect()->route('admin.school.management')->with('success', 'Something Went Wrong');
        }
    }

    public function StatusUpdate(Request $request, $id)
    {
        $id = decrypt($id);
        $school = ManageCrud::singledata(School::class, $id);
        $status = $request->account_status;
        $school->update([
            'account_status' => $status,
        ]);
        return redirect()->route('admin.school.management')
            ->with('success', 'Account Status Updated Successfully');
    }

    public function SchoolExport()
    {
        return Excel::download(new SchoolExport, 'schools.xlsx');
    }
}
