<?php

namespace App\Http\Controllers;

use App\Helpers\ManageCrud;
use App\Models\SubjectAdd;
use Illuminate\Http\Request;

class SubjectManageController extends Controller
{
    public function createSubject(Request $request)
    {
        // $request->validate([
        //     'subject' => 'required|string',
        //     'teacher_id' => 'required',
        //     'class_id' => 'required',
        // ]);
        $data = [
            'school_id' => 3,
            'teacher_id' => 17,
            'class_id' => 8,
            'subjects' => $request->subject,
        ];

        if ($data) {
            ManageCrud::createdatas(SubjectAdd::class, $data);

            return back()->with('success', 'Subject Add SuccessFul');
        } else {
            return back()->with('error', 'Something went wrong');
        }

    }

    public function deleteSubject($id)
    {
        $data = SubjectAdd::findOrFail($id);
        if ($data) {
            $data->delete();

            return back()->with('success', 'Subject Deleted');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }
}
