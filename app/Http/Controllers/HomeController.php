<?php

namespace App\Http\Controllers;

use App\Helpers\ManageCrud;
use App\Models\Notices;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    // Home page
    public function homePage()
    {
        // User::create([
        //     'name'=>'Admin',
        //     'username'=>'admin@gmail.com',
        //     'password'=>Hash::make('admin@123'),
        //     'role'=>'admin'
        // ]);
        return view('auth.login');

    }

    public function schoolMonitoring()
    {
        return $this->monitoring(request());
    }

    public function monitoring(Request $request)
    {
        $schools = School::query()->get()->map(function (School $school) {
            $studentsCount = (int) ($school->total_students_enrolled ?? 0);
            $teachersCount = (int) ($school->total_teachers_sanctioned ?? 0);
            $dropoutCount = (int) ($school->dropout_count ?? 0);
            $passPercentage = (float) ($school->pass_percentage ?? 0);
            $attendancePercentage = (float) ($school->attendance_percentage ?? 0);
            $reportingStatus = $school->reporting_status ?? $this->deriveReportingStatus($school);
            $lastReportTime = $school->last_report_time ?? now()->subMinutes(($school->id ?? 1) * 7)->format('Y-m-d H:i:s');
            $issuesCount = (int) ($school->issues_count ?? ($dropoutCount > 0 ? 1 : 0));
            $stockInfo = $this->extractStockInfo($school);
            $issues = $this->buildIssues($school, $dropoutCount, $passPercentage, $attendancePercentage, $reportingStatus);

            return [
                'id' => $school->id,
                'name' => $school->school_name,
                'district' => $school->district,
                'students_count' => $studentsCount,
                'teachers_count' => $teachersCount,
                'dropout_count' => $dropoutCount,
                'pass_percentage' => $passPercentage,
                'attendance_percentage' => $attendancePercentage,
                'reporting_status' => $reportingStatus,
                'issues_count' => $issuesCount ?: count($issues),
                'last_report_time' => $lastReportTime,
                'issues' => $issues,
                'stock_info' => $stockInfo,
                'report_url' => route('show.school', encrypt($school->id)),
            ];
        });

        $schools = $this->applyMonitoringFilters($schools, $request);

        $stats = [
            'schools' => $schools->count(),
            'reporting' => $schools->where('reporting_status', 'on_time')->count(),
            'dropout' => $schools->sum('dropout_count'),
            'pass_percentage' => round((float) $schools->avg('pass_percentage'), 1),
            'delayed' => $schools->where('reporting_status', 'delayed')->count(),
            'not_reported' => $schools->where('reporting_status', 'not_reported')->count(),
        ];

        $alerts = $this->buildAlerts($schools);

        return view('modules.school-monitoring.index', compact('schools', 'stats', 'alerts'));
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
        return view('modules.school-management.index',compact('schools'));
    }

    public function performance()
    {
        return view('modules.performance-management.index');
    }

    public function getReportsData()
    {
    }

    public function infraInfo()
    {
        return view('modules.school.infra-info.index');
    }

    public function storeInfraInfo()
    {
        return redirect()
            ->route('school.infra.info')
            ->with('success', 'Infrastructure info submitted successfully.');
    }

    public function editInfraInfo()
    {
        return view('modules.school.infra-info.edit');
    }

    public function updateInfraInfo()
    {
        return redirect()
            ->route('school.infra.edit')
            ->with('success', 'Infrastructure info updated successfully.');
    }

    private function applyMonitoringFilters(Collection $schools, Request $request): Collection
    {
        $search = strtolower(trim((string) $request->input('search')));
        $district = strtolower(trim((string) $request->input('district')));
        $status = strtolower(trim((string) $request->input('status_filter')));
        $dropout = $request->filled('dropout_filter') ? (int) $request->input('dropout_filter') : null;
        $performance = $request->filled('performance_filter') ? (float) $request->input('performance_filter') : null;

        return $schools->filter(function (array $school) use ($search, $district, $status, $dropout, $performance) {
            if ($search !== '' && ! str_contains(strtolower($school['name'].' '.$school['district']), $search)) {
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
}
