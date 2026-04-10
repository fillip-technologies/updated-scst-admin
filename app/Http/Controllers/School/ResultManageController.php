<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\Student;
use App\Models\SubjectAdd;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ResultManageController extends Controller
{
    public function getdata(Request $request)
    {
        $schoolID = $request->school_id;
        $classID = $request->class_id;
        $teacherID = $request->teacher_id;

        // Subject Data
        $subjectdata = SubjectAdd::query()
            ->when($schoolID, function ($q) use ($schoolID) {
                $q->where('school_id', $schoolID);
            })
            ->when($classID, function ($q) use ($classID) {
                $q->where('class_id', $classID);
            })
            ->when($teacherID, function ($q) use ($teacherID) {
                $q->where('teacher_id', $teacherID);
            })
            ->get();

        $studentdata = Student::where('school_id', $schoolID)
            ->where('class_id', $classID)
            ->get();

        return view('modules.manage-result.upload', compact('studentdata', 'subjectdata'));
    }

    public function Resultstore(Request $request)
    {
       
        $request->validate([
            'results.*.*.marks' => 'nullable|numeric|min:0|max:100',
            'results.*.*.file' => 'nullable|file',
        ]);

        DB::beginTransaction();

        try {

            foreach ($request->results as $studentId => $subjects) {

                foreach ($subjects as $subjectId => $data) {

                    $fileName = null;

                    // ✅ File Upload using move()
                    if (isset($data['file']) && $data['file'] instanceof UploadedFile) {

                        $file = $data['file'];

                        $fileName = time().'_'.$studentId.'_'.$subjectId.'.'.$file->getClientOriginalExtension();

                        $file->move(public_path('uploads/results'), $fileName);
                    }

                    Result::updateOrCreate(
                        [
                            'student_id' => $studentId,
                            'subject_id' => $subjectId,
                        ],
                        [
                            'marks' => $data['marks'] ?? null,
                            'is_absent' => isset($data['absent']) ? 1 : 0,
                            'file' => $fileName,
                            'school_id' => TeacherLog()->school_id ?? SchoolLogin()->id,
                        ]
                    );
                }
            }

            DB::commit();

            return back()->with('success', 'Results saved successfully ✅');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Error: '.$e->getMessage());
        }
    }

    public function ListResult()
    {
        $results = Result::with(['student', 'subject'])
            ->orderBy('student_id')
            ->get()
            ->groupBy('student_id');

        return view('modules.manage-result.index', compact('results'));
    }
}
