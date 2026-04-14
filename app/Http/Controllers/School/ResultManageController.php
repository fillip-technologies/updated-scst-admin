<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\Student;
use App\Models\SubjectAdd;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
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
            'term' => 'required',
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
                            'term' => $request->term ?? null,
                            'is_absent' => isset($data['absent']) ? 1 : 0,
                            'file' => $fileName,
                            'school_id' => $request->school_id,
                            'class_id' => $request->class_id,
                            'teacher_id' => $request->teacher_id,
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
        $allResults = Result::with(['student', 'subject'])
            ->orderBy('student_id')
            ->get()
            ->groupBy('student_id')
            ->map(function ($studentResults) {

                $totalMarks = $studentResults->sum('marks');
                $totalSubjects = $studentResults->count();

                return [
                    'data' => $studentResults,
                    'total_marks' => $totalMarks,
                    'total_subjects' => $totalSubjects,
                ];
            });

        // Manual Pagination
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;

        $currentItems = $allResults->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $results = new LengthAwarePaginator(
            $currentItems,
            $allResults->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );

        return view('modules.manage-result.index', compact('results'));
    }

    public function filterResult(Request $request)
    {
        $schoolID = $request->school_id;
        $teacherID = $request->teacher_id;
        $classID = $request->class_id;
        $term = $request->term;

        $allResults = Result::with(['student', 'subject'])
            ->when($schoolID, fn ($q) => $q->where('school_id', $schoolID))
            ->when($classID, fn ($q) => $q->where('class_id', $classID))
            ->when($teacherID, fn ($q) => $q->where('teacher_id', $teacherID))
            ->when($term, fn ($q) => $q->where('term', $term))
            ->orderBy('student_id')
            ->get()
            ->groupBy('student_id')
            ->map(function ($studentResults) {
                return [
                    'data' => $studentResults,
                    'total_marks' => $studentResults->sum('marks'),
                    'total_subjects' => $studentResults->count(),
                ];
            });


        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;

        $currentItems = $allResults->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $results = new LengthAwarePaginator(
            $currentItems,
            $allResults->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(), 
            ]
        );

        return view('modules.manage-result.index', compact('results'));
    }
}
