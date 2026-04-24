<?php

namespace App\Http\Controllers;

use App\Helpers\ManageCrud;
use App\Models\AddClasses;
use App\Models\InfraReport;
use App\Models\LeaderMessage;
use App\Models\MainNotice;
use App\Models\Notices;
use App\Models\Report;
use App\Models\SchemaInitiactive;
use App\Models\School;
use App\Models\StateSection;
use App\Models\SubjectAdd;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

use function Symfony\Component\Clock\now;

class HomeController extends Controller
{
    // Home page
    public function homePage()
    {
        // dd(Hash::make('123456'));
        return view('auth.login');
    }

    public function schoolMonitoring()
    {
        return $this->monitoring(request());
    }

    public function monitoring(Request $request)
    {

        $schools = School::with(['teacher', 'student', 'attendance', 'result'])
            ->get()
            ->map(function ($school) {

                // Counts
                $students = $school->student->count();
                $teachers = $school->teacher->count();

                $school->student_count = $students;
                $school->teacher_count = $teachers;

                // Dropout
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

                // Attendance %
                $totalAttendance = $school->attendance->count();
                $present = $school->attendance->where('status', 'present')->count();

                $school->attendance_rate = $totalAttendance > 0
                    ? round(($present / $totalAttendance) * 100, 2)
                    : 0;

                // ✅ PASS STUDENTS LOGIC
                $passStudents = $school->student->filter(function ($student) use ($school) {

                    // is student ke saare results
                    $results = $school->result->where('student_id', $student->id);

                    if ($results->isEmpty()) {
                        return false;
                    }

                    // check sab subjects pass hai ya nahi
                    return $results->every(function ($res) {
                        return $res->marks >= 33;
                    });
                })->count();

                // ✅ PASS %
                $school->pass_percentage = $students > 0
                    ? round(($passStudents / $students) * 100, 2)
                    : 0;

                return $school;
            });


        return view('modules.school-monitoring.index', compact('schools'));
    }

    public function sendNotice(Request $request)
    {
        $validated = $request->validate([
            'school_id' => 'required|exists:schools,id',
            'message' => 'required|string|max:1000',
        ]);

        $notice = Notices::firstOrCreate(
            ['school_id' => $validated['school_id']],
            ['notice_manage' => []]
        );

        $entries = $notice->notice_manage ?? [];
        $entries[] = [
            'notice_title' => 'Administrative Notice',
            'notice_description' => $validated['message'],
            'notice_category' => 'monitoring',
            'notice_publish_date' => now()->toDateString(),
            'notice_badge' => 'Important',
            'created_from' => 'admin_monitoring',
        ];

        $notice->update([
            'notice_manage' => $entries,
        ]);

        return redirect()
            ->route('school.monitoring')
            ->with('success', 'Notice sent successfully.');
    }

    public function schoolManagement()
    {
        $schools = ManageCrud::getAll(School::class);

        return view('modules.school-management.index', compact('schools'));
    }

    public function performance()
    {
        return view('modules.performance-management.index');
    }

    public function allreport()
    {
        $allSchools = School::select('id', 'school_name')->get();
        $reports = Report::with('school')->get();
        $infrReports = InfraReport::with('school')->get();

        return view('modules.reports.index', compact('allSchools', 'reports', 'infrReports'));
    }

    public function createInfrastructure()
    {
        return view('modules.school.infra-info.index');
    }

    public function infraInfo()
    {
        $infrReports = InfraReport::with('school')->where('school_id', SchoolLogin()->id)->get();

        return view('modules.school.infra-info.listing', compact('infrReports'));
    }

    public function editInfraInfo($id)
    {
        $editData = InfraReport::with('school')->findOrFail($id);

        return view('modules.school.infra-info.edit', compact('editData'));
    }

    public function teacherAttendance()
    {
        $teachers = Teacher::with(['teacherattend' => function ($query) {
            $query->whereDate('date', now());
        }])
            ->where('school_id', SchoolLogin()->id)
            ->paginate(8);

        return view('modules.school.teacher-attendance.listing', compact('teachers'));
    }

    public function editTeacherAttendance($id)
    {
        return view('modules.school.teacher-attendance.edit');
    }

    private function applyMonitoringFilters(Collection $schools, Request $request): Collection
    {
        $search = strtolower(trim((string) $request->input('search')));
        $district = strtolower(trim((string) $request->input('district')));
        $status = strtolower(trim((string) $request->input('status_filter')));
        $dropout = $request->filled('dropout_filter') ? (int) $request->input('dropout_filter') : null;
        $performance = $request->filled('performance_filter') ? (float) $request->input('performance_filter') : null;

        return $schools->filter(function (array $school) use ($search, $district, $status, $dropout, $performance) {
            if ($search !== '' && ! str_contains(strtolower($school['name'] . ' ' . $school['district']), $search)) {
                return false;
            }

            if ($district !== '' && strtolower($school['district']) !== $district) {
                return false;
            }

            if ($status !== '' && strtolower($school['reporting_status']) !== $status) {
                return false;
            }

            if ($dropout !== null && $school['dropout_count'] <= $dropout) {
                return false;
            }

            if ($performance !== null && $school['pass_percentage'] >= $performance) {
                return false;
            }

            return true;
        })->values();
    }

    private function buildAlerts(Collection $schools): array
    {
        $alerts = [];

        $notReported = $schools->where('reporting_status', 'not_reported')->count();
        $delayed = $schools->where('reporting_status', 'delayed')->count();
        $highDropout = $schools->where('dropout_count', '>', 0)->count();
        $lowPerformance = $schools->where('pass_percentage', '<', 60)->count();

        if ($notReported > 0) {
            $alerts[] = [
                'label' => "{$notReported} schools not reported",
                'filter' => 'not_reported',
                'type' => 'critical',
            ];
        }

        if ($delayed > 0) {
            $alerts[] = [
                'label' => "{$delayed} schools delayed today",
                'filter' => 'delayed',
                'type' => 'warning',
            ];
        }

        if ($highDropout > 0) {
            $alerts[] = [
                'label' => "{$highDropout} schools with dropout issues",
                'filter' => 'dropout',
                'type' => 'warning',
            ];
        }

        if ($lowPerformance > 0) {
            $alerts[] = [
                'label' => "{$lowPerformance} schools below 60% pass rate",
                'filter' => 'performance',
                'type' => 'info',
            ];
        }

        if ($alerts === []) {
            $alerts[] = [
                'label' => 'No active alerts right now',
                'filter' => 'all',
                'type' => 'info',
            ];
        }

        return $alerts;
    }

    private function deriveReportingStatus(School $school): string
    {
        $statuses = ['on_time', 'delayed', 'not_reported'];

        return $statuses[$school->id % 3];
    }

    private function buildIssues(
        School $school,
        int $dropoutCount,
        float $passPercentage,
        float $attendancePercentage,
        string $reportingStatus
    ): array {
        $issues = [];

        if ($reportingStatus === 'not_reported') {
            $issues[] = 'Daily report pending submission.';
        }

        if ($reportingStatus === 'delayed') {
            $issues[] = 'Reporting received later than expected.';
        }

        if ($dropoutCount > 0) {
            $issues[] = "Dropout count is {$dropoutCount}.";
        }

        if ($passPercentage > 0 && $passPercentage < 60) {
            $issues[] = 'Pass percentage is below the review threshold.';
        }

        if ($attendancePercentage > 0 && $attendancePercentage < 75) {
            $issues[] = 'Attendance is below the review threshold.';
        }

        if ($issues === []) {
            $issues[] = 'No critical issues reported.';
        }

        return $issues;
    }

    private function extractStockInfo(School $school): array
    {
        if (! Schema::hasTable('infrastructures')) {
            return [
                'books' => 'Data not available',
                'meals' => 'Data not available',
            ];
        }

        $infrastructure = $school->infrastructure()->first();
        $academic = data_get($infrastructure, 'academic_infrastructure', []);

        return [
            'books' => data_get($academic, 'books', 'Data not available'),
            'meals' => data_get($academic, 'meals', 'Data not available'),
        ];
    }

    //
    public function createClass()
    {

        $classdata = AddClasses::where('school_id', SchoolLogin()->id ?? TeacherLog()->school_id)->get();

        return view('modules.school.attendance.create-class', compact('classdata'));
    }

    public function createTeacher()
    {
        return view('modules.school.teacher-attendance.create-teacher');
    }

    // Admin
    public function notices()
    {
        $notices = MainNotice::all();

        return view('modules.notices.index', compact('notices'));
    }

    public function createNotice()
    {
        return view('modules.notices.create');
    }

    public function store(Request $request)
    {

        return redirect()->route('admin.notices.index');
    }

    // ================= RESULT MODULE =================

    public function manageResult()
    {
        $studentdata = null;
        $subjectdata = null;

        return view('modules.manage-result.upload', compact('studentdata', 'subjectdata'));
    }

    // Upload Page
    public function createResult()
    {

        return view('modules.school.manage-result.upload');
    }

    public function storeResult()
    {

        return redirect()->back();
    }

    public function editResult($id)
    {
        return view('modules.school.manage-result.upload');
    }

    public function updateResult($id)
    {
        return redirect()->back();
    }

    public function deleteResult($id)
    {
        return redirect()->back();
    }

    // 🔹 EDIT PAGE
    public function editManageResult($id)
    {
        return view('modules.manage-result.edit');
    }

    // Subjects
    public function subjects()
    {
        $subject = SubjectAdd::where('teacher_id', TeacherLog()->staff_id)->where('school_id', TeacherLog()->school_id)->where('class_id', getClassID())->get();

        return view('modules.subjects.index', compact('subject'));
    }

    public function notifications(){
        return view('modules.notifications.index');
    }

    public function leader(Request $request)
    {
        $type = $request->get('type', 'minister');
        $allleaders = LeaderMessage::first();

        return view('modules.department.website-cms.home.leader', compact('type','allleaders'));
    }

    public function editLeader(Request $request)
    {
        $type = $request->get('type', 'minister');

        return view('modules.department.website-cms.home.edit-leader', compact('type'));
    }

    public function stats()
    {
        $states = StateSection::orderBy('id','desc')->first();
        return view('modules.department.website-cms.home.stats',compact('states'));
    }

    public function editStats()
    {
        return view('modules.department.website-cms.home.edit-stats');
    }

    public function schemes()
    {
        $schemas = SchemaInitiactive::orderBy('id','desc')->paginate(2);
        $editdata = null;
        return view('modules.department.website-cms.home.schemes',compact('schemas','editdata'));
    }

    public function createScheme()
    {
        return view('modules.department.website-cms.home.create-scheme');
    }

    public function editSchemes()
    {
        return view('modules.department.website-cms.home.edit-schemes');
    }

    public function admin_profile(){
        return view('modules.dashboard.profile');
    }

    public function school_profile(){
        return view('modules.school.dashboard.school_profile');
    }
}
