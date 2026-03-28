<?php

namespace App\Http\Controllers\School;

use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Models\MealReport;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportManageController extends Controller
{
    public function ReportUpload(Request $request)
    {
       

        $request->validate([
            'type' => 'required',
            'district'=>'required',
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
            'type' => $request->type,
            'date' => $request->date,
            'district' =>$request->district,
            'school_id' => $request->school_id,
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
            'district'=>'required',
            'reportimage'=>'required|file',
            'menu' => 'required',
        ]);

        $uploadmeals = null;

        if($request->hasFile('reportimage')){
            $file = $request->file('reportimage');
            $filaname = time().'.'.$file->getClientOriginalExtension();
            $upload = public_path('mealImage');
            $file->move($upload,$filaname);
            $uploadmeals = "mealImage/".$filaname;
        }

        $data = [
            'reportname'=>$request->meal_type,
            'school_id'=>$request->school_id,
            'district' =>$request->district,
            'report_image' => $uploadmeals,
            'menu'=>$request->menu,
            'date'=> now()->format('Y-m-d H:i:s')
        ];

        ManageCrud::createdatas(MealReport::class,$data);
         return back()->with('success', 'Meal Reports Uploade SuccessFully');
    }
}
