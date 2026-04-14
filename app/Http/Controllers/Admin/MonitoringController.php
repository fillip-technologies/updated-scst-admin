<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function filterMonotering(Request $request)
    {
        $dis = $request->district;
        $dropcount = $request->dropout_filter;
        $passper = $request->pass_percentage;

        $schools = School::with([
            'teacher',
            'student.attendance',
            'attendance',
            'result',
        ])
            ->when($dis, fn ($q) => $q->where('district', $dis))
            ->get()
            ->map(function ($school) {

                $students = $school->student->count();
                $teachers = $school->teacher->count();

                $school->student_count = $students;
                $school->teacher_count = $teachers;

                $dropoutStudents = $school->student->filter(function ($student) {
                    $absentDays = $student->attendance
                        ->where('status', 'absent')
                        ->count();

                    return $absentDays >= 30;
                })->count();

                $school->dropout_count = $dropoutStudents;

                $school->dropout_rate = $students > 0
                    ? round(($dropoutStudents / $students) * 100, 2)
                    : 0;

                $totalAttendance = $school->attendance->count();
                $present = $school->attendance->where('status', 'present')->count();

                $school->attendance_rate = $totalAttendance > 0
                    ? round(($present / $totalAttendance) * 100, 2)
                    : 0;

                $passStudents = $school->student->filter(function ($student) use ($school) {

                    $results = $school->result->where('student_id', $student->id);

                    if ($results->isEmpty()) {
                        return false;
                    }

                    return $results->every(fn ($res) => $res->marks >= 33);

                })->count();

                $school->pass_percentage = $students > 0
                    ? round(($passStudents / $students) * 100, 2)
                    : 0;

                return $school;

            })

            ->filter(function ($school) use ($dropcount, $passper) {

                if ($dropcount && $school->dropout_rate < $dropcount) {
                    return false;
                }

                if ($passper && $school->pass_percentage < $passper) {
                    return false;
                }

                return true;
            })

            ->values();

        return view('modules.school-monitoring.index', compact('schools'));
    }

    public function detailsMonitering($id)
    {
        $id = decrypt($id);

        $school = School::with([
            'teacher',
            'student.attendance',
            'attendance',
            'result',
        ])->findOrFail($id);


        $students = $school->student->count();
        $teachers = $school->teacher->count();

        $school->student_count = $students;
        $school->teacher_count = $teachers;

        // Dropout Count
        $dropoutStudents = $school->student->filter(function ($student) {
            $absentDays = $student->attendance
                ->where('status', 'absent')
                ->count();

            return $absentDays >= 30;
        })->count();

        $school->dropout_count = $dropoutStudents;

        $school->dropout_rate = $students > 0
            ? round(($dropoutStudents / $students) * 100, 2)
            : 0;

        // Attendance Rate
        $totalAttendance = $school->attendance->count();
        $present = $school->attendance->where('status', 'present')->count();

        $school->attendance_rate = $totalAttendance > 0
            ? round(($present / $totalAttendance) * 100, 2)
            : 0;


        $passStudents = $school->student->filter(function ($student) use ($school) {

            $results = $school->result->where('student_id', $student->id);

            if ($results->isEmpty()) {
                return false;
            }

            return $results->every(fn ($res) => $res->marks >= 33);

        })->count();

        $school->pass_percentage = $students > 0
            ? round(($passStudents / $students) * 100, 2)
            : 0;

           

        return view('modules.school-monitoring.details', compact('school'));
    }
}
