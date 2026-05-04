<?php

namespace App\Http\Controllers\School;

use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Models\AddClasses;
use App\Models\AssingSubject;
use App\Models\SubjectList;
use App\Models\SubTopics;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ManagementSyllabusController extends Controller
{
    public function indexsyllabus()
    {
        $school = SchoolLogin();

        $records = AssingSubject::with(['class', 'school', 'teacher', 'subject', 'topic'])
            ->where('school_id', $school->id)
            ->get();
        // dd($records);

        return view('modules.school.syllabus.index', compact('school', 'records'));
    }

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

        $records = AssingSubject::with(['class', 'school', 'teacher', 'topic', 'subject'])->where('teacher_id', TeacherLog()->staff_id ?? 0)->get();

        return view('modules.school.syllabus.assing_details', compact('records', 'teacher'));
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
}
