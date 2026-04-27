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
use App\Models\DistrictFinanceReport;
use App\Models\MissionAspire;
use App\Models\ParentEngagementReport;
use App\Models\SchoolHelthReport;
use App\Models\SchoolInfrastructureReport;
use App\Models\StudentActivityReport;
use App\Models\TeacherStaffReport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
            $reports = MissionAspire::orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.academic_excellenc', compact('reports'));
        } elseif ($mission == 2) {
            $reports = SchoolHelthReport::orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.school_helth', compact('reports'));
        } elseif ($mission == 3) {
            $reports = TeacherStaffReport::orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.teacher_staff', compact('reports'));
        } elseif ($mission == 4) {
            $reports = SchoolInfrastructureReport::orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.school_infra', compact('reports'));
        } elseif ($mission == 5) {
            $reports = StudentActivityReport::orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.student_activity', compact('reports'));
        } elseif ($mission == 6) {
            $reports = ParentEngagementReport::orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.parent_engagement', compact('reports'));
        } else {
            $reports = DistrictFinanceReport::orderBy('id', 'desc')->get();

            return view('modules.missionaspire.filter-tabs.financial_report', compact('reports'));
        }

    }
}
