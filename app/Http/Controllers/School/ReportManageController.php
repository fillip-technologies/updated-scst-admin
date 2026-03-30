<?php

namespace App\Http\Controllers\School;

use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Models\InfraReport;
use App\Models\MealReport;
use App\Models\Report;
use App\Models\School;
use Illuminate\Http\Request;

class ReportManageController extends Controller
{
    public function ReportUpload(Request $request)
    {

        $request->validate([
            'district' => 'required',
            'report_type' => 'required',
            'school_id' => 'required',
            'date' => 'required|date',
            'report_img' => 'required|file',
        ]);
        $uploadImage = null;

        if ($request->hasFile('report_img')) {
            $file = $request->file('report_img');
            $filename = time().$request->type.'.'.$file->getClientOriginalExtension();
            $upload = public_path('Reports');
            $file->move($upload, $filename);
            $uploadImage = 'Reports/'.$filename;
        }

        $data = Report::create([
            'date' => $request->date,
            'district' => $request->district,
            'school_id' => $request->school_id,
            'report_type' => $request->report_type,
            'report_category' => 'academic',
            'report_img' => $uploadImage,
        ]);
        if ($data) {
            return back()->with('success', 'Upload Reports SuccessFully');
        } else {
            return back()->with('error', 'Something Went Wrong');
        }

    }

    public function mealReport(Request $request)
    {
        $request->validate([
            'meal_type' => 'required',
            'school_id' => 'required',
            'report_type' => 'required',
            'district' => 'required',
            'reportimage' => 'required|file',
            'menu' => 'required',
        ]);

        $uploadmeals = null;

        if ($request->hasFile('reportimage')) {
            $file = $request->file('reportimage');
            $filaname = time().'.'.$file->getClientOriginalExtension();
            $upload = public_path('mealImage');
            $file->move($upload, $filaname);
            $uploadmeals = 'mealImage/'.$filaname;
        }

        $data = [
            'school_id' => $request->school_id,
            'district' => $request->district,
            'report_img' => $uploadmeals,
            'report_type' => $request->report_type,
            'report_category' => 'academic',
            'menu' => $request->menu,
            'date' => now()->format('Y-m-d H:i:s'),
        ];

        ManageCrud::createdatas(MealReport::class, $data);

        return back()->with('success', 'Meal Reports Uploade SuccessFully');
    }

    public function showallReport(Request $request)
    {

        $request->validate([
            'district' => 'required',
            'school_id' => 'required',
            'report_category' => 'required',
            'report_type' => 'required',
        ]);

        $category = trim($request->report_category);
        $school_id = trim($request->school_id);
        $type = trim($request->report_type);
        $district = trim($request->district);
        $allSchools = School::select('id', 'school_name')->get();
        $reportData = Report::with('school')->where('report_category', $category)
            ->where('school_id', $school_id)
            ->where('report_type', $type)
            ->where('district', $district)
            ->get();

        $mealData = MealReport::with('school')->where('report_category', $category)
            ->where('school_id', $school_id)
            ->where('report_type', $type)
            ->where('district', $district)
            ->get();

        $infrReports = InfraReport::with('school')->where('report_category', $category)
            ->where('school_id', $school_id)
            ->where('district', $district)
            ->get();
        $reports = $reportData->merge($mealData);

        return view('modules.reports.index', compact('reports', 'allSchools', 'infrReports'));

    }

    public function infrReportSave(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'school_id' => 'required',
            'toilets' => 'required',
            'electricity' => 'required',
            'district' => 'required',
            'drinking_water' => 'required',
            'building_safety' => 'required',
            'network' => 'required',
        ]);

        $data = [
            'school_id' => $request->school_id,
            'toilet' => $request->toilets,
            'report_category' => 'infrastructure',
            'district' => $request->district,
            'electricity' => $request->electricity,
            'drinking_water' => $request->drinking_water,
            'building_safety' => $request->building_safety,
            'network_availability' => $request->network,
        ];
        if ($data) {
            ManageCrud::createdatas(InfraReport::class, $data);

            return redirect()->route('school.infra.info')->with('success', 'Uploaded Infrastructure Info SuccessFully');
        } else {
            return redirect()->route('school.infra.info')->with('error', 'Something Went Wrong');
        }

    }
}
