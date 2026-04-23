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
}
