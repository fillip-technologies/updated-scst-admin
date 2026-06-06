<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SyllabusTracking;
use App\Models\ViewTracking;
use Illuminate\Http\Request;

class ViewTrakingController extends Controller
{
    public function tackingList()
    {
        $tackingList = ViewTracking::with(['school', 'teacher'])->paginate(10);

        return view('modules.syllabus-tracking.view_tracking', compact('tackingList'));
    }

    public function view_tracking_details($school_id, $teacher_id)
    {
        $trackingdetails = ViewTracking::with(['school', 'teacher'])
            ->where('school_id', $school_id)
            ->where('teacher_id', $teacher_id)
            ->firstOrFail();
        $topics = SyllabusTracking::where('class_name', trim($trackingdetails->class_name))
            ->whereRaw('LOWER(TRIM(subject_name)) = ?', [
                strtolower(trim($trackingdetails->subject)),
            ])
            ->pluck('topics_name')
            ->toArray();

        return view(
            'modules.syllabus-tracking.view_tracking_detail',
            compact('trackingdetails','topics')
        );
    }

    public function subjectHandel(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'teacher_id' => 'required',
            'status' => 'required',
            'topic_name' => 'nullable',
            'remarks' => 'nullable',
            'class_name' => 'nullable',
            'subject' => 'required',
        ]);

        $data = ViewTracking::updateOrCreate(
            [
                'school_id' => $request->school_id,
                'teacher_id' => $request->teacher_id,
                'subject' => $request->subject,
                'topic_name' => $request->topic_name,
            ],

            [
                'school_id' => $request->school_id,
                'teacher_id' => $request->teacher_id,
                'status' => $request->status,
                'topic_name' => $request->topic_name,
                'remarks' => $request->remarks,
                'class_name' => $request->class_name,
                'subject' => $request->subject,
            ]

        );

        if ($data) {
            return back()->with('success', 'Status Updated SuccessFully');
        } else {
            return back()->with('error', 'Updation Failed Please Try again');
        }
    }
}
