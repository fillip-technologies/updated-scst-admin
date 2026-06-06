<?php

namespace App\Http\Controllers\School;

use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Imports\SyllabusTrackingImport;
use App\Models\AddClasses;
use App\Models\AssingSubject;
use App\Models\School;
use App\Models\SubjectList;
use App\Models\SubTopics;
use App\Models\SyllabusTracking;
use App\Models\Teacher;
use App\Models\ViewTracking;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;

class ManagementSyllabusController extends Controller
{
    public function view_tracking()
    {
        return view('modules.syllabus-tracking.index');
    }

    // public function indexsyllabus()
    // {

    //     return view('modules.school.syllabus.index', compact('school', 'records'));
    // }

    public function createSyllabus()
    {
        $subject = SubjectList::where('school_id', SchoolLogin()->id)->get() ?? [];
        $teachers = Teacher::where('school_id', SchoolLogin()->id)->get() ?? [];
        $classs = AddClasses::where('school_id', SchoolLogin()->id)->get() ?? [];

        return view('modules.school.syllabus.create_syllabus', compact('subject', 'teachers', 'classs'));
    }

    public function storeSyllabus(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
            'school_id' => 'required',
            'topics' => 'required|array|min:1',
            'topics.*' => 'required|string|max:255',
        ]);

        $topics = array_filter($request->topics);

        if (count($topics) == 0) {
            return back()->withErrors([
                'topics' => 'At least one topic is required',
            ])->withInput();
        }

        $subject = SubjectList::create([
            'subject_name' => $request->subject_name,
            'school_id' => $request->school_id,
        ]);

        SubTopics::create([
            'school_id' => $subject->school_id,
            'sublist_id' => $subject->id,
            'topics' => json_encode(array_values($topics)),
        ]);

        return back()->with('success', 'Created Syllabus and Topics');
    }

    public function assingSubject(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'teacher_id' => 'required',
            'class_id' => 'required',
            'sublist_id' => 'required',
            'completion_time' => 'required',
        ]);

        $topicId = SubTopics::where('sublist_id', $request->sublist_id)->value('id');

        if (! $topicId) {
            return back()->with('error', 'Topic not found');
        }
        $data = [
            'school_id' => $request->school_id,
            'teacher_id' => $request->teacher_id,
            'sublist_id' => $request->sublist_id,
            'class_id' => $request->class_id,
            'topics_id' => $topicId,
            'completion_time' => $request->completion_time,
        ];
        $data = ManageCrud::createdatas(AssingSubject::class, $data);
        if ($data) {
            return back()->with('success', 'Assign Subject Successful');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function teachergetSyllabus()
    {
        $teacher = TeacherLog();
        $class = $teacher->staffs->addclass->class;
        $subjectname = ucfirst($teacher->staffs->subject);
        $syllabusData = SyllabusTracking::where('class_name', $class)
            ->where('subject_name', $subjectname)
            ->select('class_name', 'subject_name', 'topics_name')
            ->get();
        $groupedData = $syllabusData->groupBy('class_name');
        $viewstatus = ViewTracking::with(['school:id,school_name','teacher'])->where('teacher_id',$teacher->staff_id)->where('school_id',$teacher->school_id)->get();
        return view('modules.school.staff.assign_subject', compact('groupedData', 'class', 'subjectname','viewstatus'));
    }

    public function subject_status(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required',
            'sublist_id' => 'required',
            'status' => 'required',
        ]);

        $updated = AssingSubject::where('teacher_id', $request->teacher_id)
            ->where('sublist_id', $request->sublist_id)
            ->update([
                'status' => $request->status,
            ]);

        if ($updated) {
            return back()->with('success', 'Status Updated Successfully');
        } else {
            return back()->with('error', 'No record found');
        }

    }

    public function syllabusTraking()
    {
        $subjectdata = SyllabusTracking::select(
            'class_name',
            'subject_name',
            'topics_name'
        )
            ->distinct()
            ->get()
            ->groupBy('class_name');

        if ($subjectdata->isEmpty()) {
            $subjectdata = collect([]);
        }
        $currentPage = request()->get('page', 1);
        $perPage = 5;
        $paginatedData = new LengthAwarePaginator(
            $subjectdata->forPage($currentPage, $perPage),
            $subjectdata->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('modules.syllabus-tracking.add', compact('paginatedData'));
    }

    public function forschool_syllabusTraking()
    {
        $subjectdata = SyllabusTracking::select(
            'class_name',
            'subject_name',
            'topics_name'
        )
            ->distinct()
            ->get()
            ->groupBy('class_name');

        if ($subjectdata->isEmpty()) {
            $subjectdata = collect([]);
        }
        $currentPage = request()->get('page', 1);
        $perPage = 5;
        $paginatedData = new LengthAwarePaginator(
            $subjectdata->forPage($currentPage, $perPage),
            $subjectdata->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('modules.syllabus-tracking.school_syllabus', compact('paginatedData'));
    }

    public function editasyllabus($id, $school_id)
    {
        $assgindata = AssingSubject::with(['class', 'school', 'teacher', 'topic', 'subject'])->where('id', $id)->where('school_id', $school_id)->first();
        $subjectList = SubjectList::findOrFail($assgindata->sublist_id);
        $topicsList = SubTopics::findOrFail($assgindata->topics_id);
        $subject = SubjectList::where('school_id', SchoolLogin()->id)->get() ?? [];
        $teachers = Teacher::where('school_id', SchoolLogin()->id)->get() ?? [];
        $classs = AddClasses::where('school_id', SchoolLogin()->id)->get() ?? [];

        return view('modules.school.syllabus.edit_syllabus', compact('topicsList', 'assgindata', 'subjectList', 'subject', 'teachers', 'classs'));
    }

    public function subject_edit(Request $request, $id)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
            'topics' => 'nullable|array',
        ]);

        $editdata = SubjectList::where('id', $id)
            ->where('school_id', $request->school_id)
            ->first();

        if (! $editdata) {
            return back()->with('error', 'Subject not found');
        }
        $editdata->update([
            'subject_name' => $request->subject_name,
        ]);
        SubTopics::updateOrCreate(
            [
                'sublist_id' => $editdata->id,
                'school_id' => $request->school_id,
            ],
            [
                'topics' => json_encode($request->topics ?? []),
            ]
        );

        return back()->with('success', 'Subject Update data successful');
    }

    public function index_delete(Request $request)
    {

        $index = $request->index;
        $getdata = SubTopics::findOrFail($request->id);
        $topics = json_decode($getdata->topics, true);
        unset($topics[$index]);
        $topics = array_values($topics);
        $getdata->topics = json_encode($topics);
        $getdata->save();

        return response()->json([
            'message' => 'Delete Items',
            'data' => $topics,
        ]);
    }

    public function assingsubject_edit(Request $request, $id)
    {
        $request->validate([
            'teacher_id' => 'required',
            'class_id' => 'required',
            'sublist_id' => 'required',
            'completion_time' => 'required',
        ]);

        $editdata = AssingSubject::where('id', $id)
            ->where('school_id', $request->school_id)
            ->first();

        if (! $editdata) {
            return back()->with('error', 'Record not found');
        }
        $editdata->update([
            'teacher_id' => $request->teacher_id,
            'class_id' => $request->class_id,
            'sublist_id' => $request->sublist_id,
            'completion_time' => $request->completion_time,
        ]);

        return back()->with('success', ' Assgin Subject details Update data successful');

    }

    public function deleteSyllabus(Request $request)
    {
        $record = AssingSubject::findOrFail($request->id);
        $record->delete();

        return response()->json([
            'message' => 'delete data ',
            'data' => $record,
        ]);

    }

    public function addsyllabusTrack(Request $request)
    {

        $request->validate([
            'subject' => 'required',
            'class_name' => 'required',
            'file' => 'required|file|mimes:xlsx,xls,csv',
            'assign_date' => 'nullable|date',
            'completion_date' => 'nullable|date',
        ]);

        Excel::import(
            new SyllabusTrackingImport(
                $request->subject,
                $request->assign_date,
                $request->completion_date,
                $request->class_name
            ),
            $request->file('file')
        );

        return back()->with('success', 'Excel imported successfully : '.' Class : '.$request->class_name.' Subject : '.$request->subject);
    }

    public function getSchoolId()
    {
        $data = School::pluck('id')->toArray();

        return response()->json([
            'message' => 'All School ID',
            'data' => $data,
        ], 200);
    }
}
