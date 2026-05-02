<?php

namespace App\Http\Controllers\School;

use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Models\AddClasses;
use App\Models\AssingSubject;
use App\Models\SubjectAdd;
use App\Models\SubjectList;
use App\Models\SubTopics;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ManagementSyllabusController extends Controller
{
    public function indexsyllabus()
    {

        return view('modules.school.syllabus.index');
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

        $data = [
            'school_id' => $request->school_id,
            'teacher_id' => $request->teacher_id,
            'sublist_id' => $request->sublist_id,
            'class_id' => $request->class_id,
        ];
        $data = ManageCrud::createdatas(AssingSubject::class, $data);
        if ($data) {
            return back()->with('success', 'Assing Subject SuccesFul');
        } else {
            return back()->with('error', 'Something went wrong');

        }

    }
}
