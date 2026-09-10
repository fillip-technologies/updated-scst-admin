<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SyllabusTracking;
use App\Models\ViewTracking;
use Illuminate\Http\Request;

class ViewTrakingController extends Controller
{

 public function tackingList(Request $request)
{
 return view('modules.syllabus-tracking.view_tracking');
}

public function tackingList_view(Request $request)
{
    $query = ViewTracking::with(['school', 'teacher']);

    // District Filter
    if ($request->filled('district')) {
        $query->whereHas('school', function ($q) use ($request) {
            $q->where('district', $request->district);
        });
    }

    // School Filter
    if ($request->filled('school_id')) {
        $query->where('school_id', $request->school_id);
    }

    // Class Filter
    if ($request->filled('class_name')) {
        $query->where('class_name', $request->class_name);
    }

    // Subject Filter
    if ($request->filled('subject')) {
        $query->where('subject', $request->subject);
    }

    // Month Filter
    if ($request->filled('month')) {
        $query->where('month', $request->month);
    }

    // Year Filter
    if ($request->filled('years')) {
        $query->where('years', $request->years);
    }

    // Date Range Filter
    if ($request->filled('from_date') && $request->filled('to_date')) {
        $query->whereBetween('created_at', [
            $request->from_date . ' 00:00:00',
            $request->to_date . ' 23:59:59'
        ]);
    }

    $data = $query->get();

    $schools = $data->groupBy('school_id');

    $finalReport = [];

    foreach ($schools as $schoolId => $schoolRecords) {

        $teachers = $schoolRecords->groupBy('teacher_id');

        $teacherList = [];

        foreach ($teachers as $teacherId => $teacherRecords) {

            $subjects = $teacherRecords->groupBy('subject');

            $subjectList = [];

            foreach ($subjects as $subjectName => $subjectRecords) {

            $totalTopics = $subjectRecords->count();
                $totalTopics = SyllabusTracking::where('class_name', $subjectRecords->first()->class_name)
                ->where('subject_name', $subjectRecords->first()->subject)
                ->count();


                $completed = $subjectRecords->where('status', 'completed')->count();

                $ongoing = $subjectRecords->where('status', 'ongoing')->count();

                $pending = $subjectRecords->where('status', 'pending')->count();

                $percentage = $totalTopics > 0
                    ? round(($completed / $totalTopics) * 100, 2)
                    : 0;

                $subjectList[] = [
                    'subject'       => $subjectName,
                    'total_topics'  => $totalTopics,
                    'completed'     => $completed,
                    'ongoing'       => $ongoing,
                    'pending'       => $pending,
                    'percentage'    => $percentage,
                ];
            }

            $teacherList[] = [
                'teacher_id'  => $teacherId,
                'class_name'=> $teacherRecords->first()->class_name,
                'teacher_name' => optional($teacherRecords->first()->teacher)->name,
                'subjects'     => $subjectList,
            ];
        }

        $finalReport[] = [
            'school_id'   => $schoolId,
            'school_name' => optional($schoolRecords->first()->school)->school_name,
            'teachers'    => $teacherList,
        ];
    }

    return view(
        'modules.syllabus-tracking.view_tracking',
        compact('finalReport')
    );
}
    public function subjectHandel(Request $request)
{
    $request->validate([
        'school_id'  => 'required|integer|exists:schools,id',
        'teacher_id' => 'required|integer|exists:teachers,id',
        'status'     => 'required|in:pending,ongoing,completed',
        'topic_name' => 'nullable|string',
        'remarks'    => 'nullable|string',
        'years'      => 'required|string',
        'month'      => 'required|string',
        'class_name' => 'nullable|string',
        'subject'    => 'required|string',
    ]);
    $tracking = ViewTracking::where('school_id', $request->school_id)
        ->where('teacher_id', $request->teacher_id)
        ->where('subject', $request->subject)
        ->where('topic_name', $request->topic_name)
        ->first();

    if ($tracking) {
         $tracking->status = $request->status;
         $tracking->remarks = $request->remarks;
         $tracking->class_name = $request->class_name;
         $tracking->years = $request->years;
         $tracking->month = $request->month;
        $tracking->save();

    } else {
        $createtracking = new ViewTracking();
        $createtracking->school_id = $request->school_id;
        $createtracking->teacher_id = $request->teacher_id;
        $createtracking->status = $request->status;
        $createtracking->month = $request->month;
        $createtracking->years = $request->years;
        $createtracking->topic_name = $request->topic_name;
        $createtracking->remarks = $request->remarks;
        $createtracking->class_name = $request->class_name;
        $createtracking->subject = $request->subject;
        $createtracking->save();
    }

    return back()->with('success', 'Status Updated Successfully');
}

 public function allInfoTraking(Request $request)
{
    $schoolId  = decrypt($request->school_id);
    $teacherId = decrypt($request->teacher_id);
    $className = decrypt($request->class_name);
    $subject   = decrypt($request->subject);

    $datas = ViewTracking::with(['school', 'teacher'])
        ->where('school_id', $schoolId)
        ->where('teacher_id', $teacherId)
        ->where('class_name', $className)
        ->where('subject', $subject)
        ->first();

    $subjectdata = SyllabusTracking::where('class_name', $datas->class_name)
        ->where('subject_name', $datas->subject)
        ->select('topics_name')
        ->get();


    $totalTopics = $subjectdata->count();

   
    $completed = ViewTracking::where('school_id', $schoolId)
        ->where('teacher_id', $teacherId)
        ->where('class_name', $className)
        ->where('subject', $subject)
        ->where('status', 'Completed')
        ->count();

    // Percentage
    $percentage = $totalTopics > 0
        ? round(($completed / $totalTopics) * 100, 2)
        : 0;

    return view('modules.reports.internal-report.allinforep', compact(
        'datas',
        'subjectdata',
        'totalTopics',
        'completed',
        'percentage'
    ));
}
}
