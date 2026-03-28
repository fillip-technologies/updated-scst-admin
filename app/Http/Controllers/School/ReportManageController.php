<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportManageController extends Controller
{
    public function ReportUpload(Request $request)
    {

        $request->validate([
            'type' => 'required',
            'school_id' => 'required',
            'date' => 'required|date',
            'report_img' => 'required|file',
        ]);
        $uploadImage = null;

        if ($request->hasFile('report_img')) {
            $file = $request->file('report_img');
            $filename = time().$request->type.'.'.$file->getClientOriginalExtension();
            $upload = public_path('Reports');
            $file->move($upload, $filename);
            $uploadImage = 'Reports/'.$filename;
        }

        $data = Report::create([
            'type' => $request->type,
            'date' => $request->date,
            'school_id' => $request->school_id,
            'report_img' => $uploadImage,
        ]);
        if ($data) {
            return back()->with('success', 'Upload Reports SuccessFully');
        } else {
            return back()->with('error', 'Something Went Wrong');
        }

    }

    public function mealReport(Request $request) {}
}
