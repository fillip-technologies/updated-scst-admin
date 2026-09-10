<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddClasses;
use App\Models\Attendance;
use App\Models\Result;
use App\Models\School;
use App\Models\Student;
use App\Models\SyllabusTracking;
use App\Models\Teacher;
use App\Models\TeacherAttend;
use App\Models\ViewTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class MonitoringController extends Controller
{
    public function filterMonotering(Request $request)
{
    $dis = $request->district;
    $dropcount = $request->dropout_filter;
    $fromdate = $request->from_date;
    $todate = $request->to_date;
    $passper = $request->pass_percentage;

    $schools = School::with([
        'teacher',
        'student.attendance',
        'attendance',
        'result',
    ])
    ->when($dis, fn($q) => $q->where('district', $dis))
    ->get()
    ->map(function ($school) use ($fromdate, $todate) {

        $students = $school->student->count();
        $teachers = $school->teacher->count();

        $school->student_count = $students;
        $school->teacher_count = $teachers;


        $dropoutStudents = $school->student->filter(function ($student) use ($fromdate, $todate) {

            $attendance = $student->attendance;

            if ($fromdate) {
                $attendance = $attendance->where('date', '>=', $fromdate);
            }

            if ($todate) {
                $attendance = $attendance->where('date', '<=', $todate);
            }

            $absentDays = $attendance->where('status', 'absent')->count();

            return $absentDays >= 30;

        })->count();

        $school->dropout_count = $dropoutStudents;

        $school->dropout_rate = $students > 0
            ? round(($dropoutStudents / $students) * 100, 2)
            : 0;


        $attendance = $school->attendance;

        if ($fromdate) {
            $attendance = $attendance->where('date', '>=', $fromdate);
        }

        if ($todate) {
            $attendance = $attendance->where('date', '<=', $todate);
        }

        $totalAttendance = $attendance->count();
        $present = $attendance->where('status', 'present')->count();

        $school->attendance_rate = $totalAttendance > 0
            ? round(($present / $totalAttendance) * 100, 2)
            : 0;


        $passStudents = $school->student->filter(function ($student) use ($school, $fromdate, $todate) {

            $results = $school->result->where('student_id', $student->id);

            if ($fromdate) {
                $results = $results->where('exam_date', '>=', $fromdate);
            }

            if ($todate) {
                $results = $results->where('exam_date', '<=', $todate);
            }

            if ($results->isEmpty()) {
                return false;
            }

            return $results->every(fn($res) => $res->marks >= 33);

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

        $class = AddClasses::where('school_id',$id)->select('class')->groupBy('class')->orderBy('class','asc')->get();

        return view('modules.school-monitoring.details', compact('school'));

    }


        public function manulareport($id)
        {
            $schoolId = $id;
            $classes = SyllabusTracking::select('class_name')
                ->groupBy('class_name')
                ->orderBy('class_name')
                ->get();
            $lessonPlans = $classes->map(function ($class) {
                $totalTopics = SyllabusTracking::where('class_name', $class->class_name)
                    ->count();
                $completedTopics = ViewTracking::where('school_id',request('school_id'))->where('class_name', $class->class_name)
                    ->where('status', 'completed')
                    ->count();
                return [
                    'class_name'       => $class->class_name,
                    'total_topics'     => $totalTopics,
                    'completed_topics' => $completedTopics,
                    'percentage'       => $totalTopics > 0
                        ? round(($completedTopics * 100) / $totalTopics, 2)
                        : 0,
                ];
            });

                $schoolId = $id;
                $dates = [
                    '2026-05-16',
                    '2026-05-23',
                    '2026-05-30',
                ];

                $weeklyReport = [];

                foreach ($dates as $date) {

                    $results = Result::where('school_id', $schoolId)
                        ->whereDate('created_at', $date)
                        ->get();

                    $total = $results->count();

                    $count81 = $results->whereBetween('marks', [81, 100])->count();
                    $count61 = $results->whereBetween('marks', [61, 80])->count();
                    $count45 = $results->whereBetween('marks', [45, 60])->count();
                    $countBelow = $results->where('marks', '<', 45)->count();

                    $weeklyReport[] = [
                        'date' => Carbon::parse($date)->format('d.m.Y'),
                        '81_100' => $total ? round(($count81 * 100) / $total, 2) : 0,
                        '61_80' => $total ? round(($count61 * 100) / $total, 2) : 0,
                        '45_60' => $total ? round(($count45 * 100) / $total, 2) : 0,
                        'below45' => $total ? round(($countBelow * 100) / $total, 2) : 0,
                    ];
                }
                    return view(
                        'modules.manual-reports.manula-rreport',
                        compact('lessonPlans','weeklyReport')
                    );
        }



           public function manualistutech(Request $request){
            $schoolId = request("school_id");
            $month = $request->month ?? date('m');
            $year = $request->year ?? date('Y');

            $days = Carbon::create($year, $month)->daysInMonth();

            $totalStudents = Student::where('school_id', $schoolId)->count();
            $studentPresent = Attendance::whereYear('date', $year)
                ->whereMonth('date', $month)
                ->where('status', 'Present')
                ->count();
            $averageStudentAttendance = $days > 0
                ? round($studentPresent / $days, 2)
                : 0;

            $studentPercentage = $totalStudents > 0
                ? round(($averageStudentAttendance * 100) / $totalStudents, 2)
                : 0;
            $totalTeachers = Teacher::where('school_id', $schoolId)->count();
            $teacherPresent = TeacherAttend::whereYear('date', $year)
                ->whereMonth('date', $month)
                ->where('status', 'Present')
                ->count();

            $averageTeacherAttendance = $days > 0
                ? round($teacherPresent / $days, 2)
                : 0;

            $teacherPercentage = $totalTeachers > 0
                ? round(($averageTeacherAttendance * 100) / $totalTeachers, 2)
                : 0;

            return view('modules.manual-reports.manula-rreport', compact(
                'totalStudents',
                'averageStudentAttendance',
                'studentPercentage',
                'totalTeachers',
                'averageTeacherAttendance',
                'teacherPercentage'
            ));
    }


}
