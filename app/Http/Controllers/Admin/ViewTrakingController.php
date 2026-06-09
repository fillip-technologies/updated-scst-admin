<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SyllabusTracking;
use App\Models\ViewTracking;
use Illuminate\Http\Request;

class ViewTrakingController extends Controller
{
    // public function tackingList()
    // {
    //     $latestIds = ViewTracking::selectRaw('MAX(id) as id')
    //         ->groupBy('school_id', 'teacher_id')
    //         ->pluck('id');

    //     $tackingList = ViewTracking::with([
    //         'school:id,school_name,district',
    //         'teacher:id,name,subject,class_id,photo',
    //         'teacher.addclass:id,class',
    //     ])
    //         ->whereIn('id', $latestIds)
    //         ->latest()
    //         ->paginate(10);

    //     return view(
    //         'modules.syllabus-tracking.view_tracking',
    //         compact('tackingList')
    //     );
    // }

    public function tackingList()
    {
        $schoolId = 91;
        $subject = 'Hindi';
        $className = '4';

        $trackingdetails = ViewTracking::with(['school', 'teacher'])
            ->where('school_id', $schoolId)
            ->where('subject', $subject)
            ->where('class_name', $className)
            ->select(
                'school_id',
                'teacher_id',
                'subject',
                'class_name'
            )
            ->groupBy(
                'school_id',
                'teacher_id',
                'subject',
                'class_name'
            )
            ->get();

     
        $topics = SyllabusTracking::where('class_name', $className)
            ->where('subject_name', $subject)
            ->pluck('topics_name')
            ->toArray();

        $totalTopics = count($topics);

        // Completed
        $completedTopics = $trackingdetails
            ->where('status', 'completed')
            ->count();

        // Ongoing
        $ongoingTopics = $trackingdetails
            ->whereIn('status', ['ongoing', 'in_progress'])
            ->count();

        // Pending
        $pendingTopics = max(
            0,
            $totalTopics - ($completedTopics + $ongoingTopics)
        );

        // Percentage
        $completionPercentage = $totalTopics > 0
            ? round(($completedTopics / $totalTopics) * 100, 2)
            : 0;

        return view(
            'modules.syllabus-tracking.view_tracking',
            compact(
                'trackingdetails',
                'topics',
                'totalTopics',
                'completedTopics',
                'ongoingTopics',
                'pendingTopics',
                'completionPercentage'
            )
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
