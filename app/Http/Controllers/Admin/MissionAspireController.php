<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\Missions\DistrictFinanceReportImport;
use App\Imports\Missions\MissionAspireImport;
use App\Imports\Missions\ParentEngagementReportImport;
use App\Imports\Missions\SchoolHelthReportImport;
use App\Imports\Missions\SchoolInfrastructureReportImport;
use App\Imports\Missions\StudentActivityReportImport;
use App\Imports\Missions\TeacherStaffReportImport;
use Illuminate\Http\Request;
use App\Models\DistrictFinanceReport;
use App\Models\MissionAspire;
use App\Models\ParentEngagementReport;
use App\Models\SchoolHelthReport;
use App\Models\SchoolInfrastructureReport;
use App\Models\StudentActivityReport;
use App\Models\TeacherStaffReport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;


class MissionAspireController extends Controller
{
    public function mission_aspire()
    {
        return view('modules.missionaspire.MissionAspire');
    }

    public function uploadMissionAspire(Request $request)
    {
   
        $request->validate([
            'mission_section' => 'required',
            'upload_file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        try {

            if ($request->mission_section === '1') {
                Excel::import(new MissionAspireImport, $request->file('upload_file'));
            } elseif ($request->mission_section === '2') {
                Excel::import(new SchoolHelthReportImport, $request->file('upload_file'));
            } elseif ($request->mission_section === '3') {
                Excel::import(new TeacherStaffReportImport, $request->file('upload_file'));
            } elseif ($request->mission_section === '4') {
                Excel::import(new SchoolInfrastructureReportImport, $request->file('upload_file'));
            } elseif ($request->mission_section === '5') {
                Excel::import(new StudentActivityReportImport, $request->file('upload_file'));
            } elseif ($request->mission_section === '6') {
                Excel::import(new ParentEngagementReportImport, $request->file('upload_file'));
            } else {
                Excel::import(new DistrictFinanceReportImport, $request->file('upload_file'));
            }

            return back()->with('success', 'File uploaded and data imported successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: '.$e->getMessage());
        }
    }
    
    public function list_mission()
    {
        return view('modules.missionaspire.listing_mission');
    }

     public function listofmission(Request $request)
    {
        $mission = trim($request->mission);
        if ($mission == 1) {
            $reports = MissionAspire::where('school_id', $request->school_id)->orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.academic_excellenc', compact('reports'));
        } elseif ($mission == 2) {
            $reports = SchoolHelthReport::where('school_id', $request->school_id)->orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.school_helth', compact('reports'));
        } elseif ($mission == 3) {
            $reports = TeacherStaffReport::where('school_id', $request->school_id)->orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.teacher_staff', compact('reports'));
        } elseif ($mission == 4) {
            $reports = SchoolInfrastructureReport::where('school_id', $request->school_id)->orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.school_infra', compact('reports'));
        } elseif ($mission == 5) {
            $reports = StudentActivityReport::where('school_id', $request->school_id)->orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.student_activity', compact('reports'));
        } elseif ($mission == 6) {
            $reports = ParentEngagementReport::where('school_id', $request->school_id)->orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.parent_engagement', compact('reports'));
        } else {
            $reports = DistrictFinanceReport::where('school_id', $request->school_id)->orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.financial_report', compact('reports'));
        }

    }
    
    
    public function searchMission(Request $request)
    {

        $request->validate([
            'district' => 'required',
            'mission_aspire' => 'required',
            'school' => 'required',
        ]);
        $reports = [];
        $datacolum = [] ?? null;
        $district = trim($request->district);
        $schoolId = trim($request->school);
        $missionAspire = trim($request->mission_aspire);
        if ($missionAspire == 1) {
            if (! empty($missionAspire) && ! empty($schoolId) && ! empty($district)) {
                $reports = MissionAspire::with('school')->where('district', $district)->where('school_id', $schoolId)->get();
                $datacolum = Schema::getColumnListing('mission_aspires');
            }
        } elseif ($missionAspire == 2) {
            if (! empty($missionAspire) && ! empty($schoolId) && ! empty($district)) {
                $reports = SchoolHelthReport::with('school')->where('district', $district)->where('school_id', $schoolId)->get();
                $datacolum = Schema::getColumnListing('school_health_reports');
            }
        } elseif ($missionAspire == 3) {
            if (! empty($missionAspire) && ! empty($schoolId) && ! empty($district)) {
                $reports = TeacherStaffReport::with('school')->where('district', $district)->where('school_id', $schoolId)->get();
                $datacolum = Schema::getColumnListing('teacher_staff_reports');
            }
        } elseif ($missionAspire == 4) {
            if (! empty($missionAspire) && ! empty($schoolId) && ! empty($district)) {
                $reports = SchoolInfrastructureReport::with('school')->where('district', $district)->where('school_id', $schoolId)->get();
                $datacolum = Schema::getColumnListing('school_infrastructure_reports');
            }
        } elseif ($missionAspire == 5) {
            if (! empty($missionAspire) && ! empty($schoolId) && ! empty($district)) {
                $reports = StudentActivityReport::with('school')->where('district', $district)->where('school_id', $schoolId)->get();
                $datacolum = Schema::getColumnListing('student_activity_reports');
            }
        } elseif ($missionAspire == 6) {
            if (! empty($missionAspire) && ! empty($schoolId) && ! empty($district)) {
                $reports = ParentEngagementReport::with('school')->where('district', $district)->where('school_id', $schoolId)->get();
                $datacolum = Schema::getColumnListing('parent_engagement_reports');
            }
        } else {
            if (! empty($missionAspire) && ! empty($schoolId) && ! empty($district)) {
                $reports = DistrictFinanceReport::with('school')->where('district', $district)->where('school_id', $schoolId)->get();
                $datacolum = Schema::getColumnListing('district_finance_reports');
            }
        }

        return view('modules.missionaspire.index', compact('datacolum', 'reports'));

    }
}
