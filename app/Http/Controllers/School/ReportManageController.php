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
    $category  = trim($request->report_category);
    $school_id = trim($request->school_id);
    $type      = trim($request->report_type);
    $district  = trim($request->district);
    $from_date = $request->from_date;
    $to_date   = $request->to_date;


    if ($category == 'academic') {

        $reports = Report::query()
            ->when($district, fn($q) => $q->where('district', $district))
            ->when($school_id, fn($q) => $q->where('school_id', $school_id))
            ->when($type, fn($q) => $q->where('report_type', 'LIKE', "%{$type}%"))
            ->when($from_date, fn($q) => $q->whereDate('date', $from_date))
            ->get();

    }


    elseif ($category == 'infrastructure') {

        $reports = InfraReport::with('school')
            ->when($school_id, fn($q) => $q->where('school_id', $school_id))
            ->when($district, fn($q) => $q->where('district', $district))
            ->when($from_date && $to_date, function ($q) use ($from_date, $to_date) {
                $q->whereBetween('created_at', [$from_date, $to_date]);
            })
            ->get();

    }


    elseif (!empty($district)) {

    $schools = School::where('district', $district)->get();

    $reports = $schools->map(function ($school) use ($from_date, $to_date) {

        return (object)[
            'school_name' => $school->school_name,

            'student_attendance' => Report::where('school_id', $school->id)
                ->where('report_type', 'Student Attendance')
                ->when($from_date, fn($q) => $q->whereDate('date', $from_date))
                ->count(),

            'student_marks' => Report::where('school_id', $school->id)
                ->where('report_type', 'Student Marks')
                ->when($from_date, fn($q) => $q->whereDate('date', $from_date))
                ->count(),

            'teacher_attendance' => Report::where('school_id', $school->id)
                ->where('report_type', 'Teacher Attendance')
                ->when($from_date, fn($q) => $q->whereDate('date', $from_date))
                ->count(),

            'meal_attendance' => Report::where('school_id', $school->id)
                ->where('report_type', 'Meal Attendance')
                ->when($from_date, fn($q) => $q->whereDate('date', $from_date))
                ->count(),

            'infrastructure' => InfraReport::where('school_id', $school->id)
                ->when($from_date && $to_date, function ($q) use ($from_date, $to_date) {
                    $q->whereBetween('created_at', [$from_date, $to_date]);
                })
                ->count(),
        ];
    });
}

    else {
        $reports = collect();
    }

    return view('modules.reports.index', compact('reports', 'category','district'));
}

    public function infrReportSave(Request $request)
    {

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

    public function infrReportUpdate(Request $request, $id)
    {
        $request->validate([
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

        $updated = ManageCrud::updatedata(InfraReport::class, $id, $data);

        if ($updated) {
            return redirect()->route('school.infra.info')
                ->with('success', 'Updated Infrastructure Info Successfully');
        } else {
            return redirect()->route('school.infra.info')
                ->with('error', 'Something Went Wrong');
        }

    }
}
