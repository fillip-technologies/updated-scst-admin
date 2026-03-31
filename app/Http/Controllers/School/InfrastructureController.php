<?php

namespace App\Http\Controllers\School;

use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Models\Infrastructure;
use Illuminate\Http\Request;

class InfrastructureController extends Controller
{
    public function Savehero(Request $request)
    {

        $request->validate([
            'infra_hero_image' => 'required|file',
            'infra_hero_title' => 'required|string',
            'infra_hero_subtitle' => 'required|string',
            'infra_breadcrumb' => 'required|string',
        ]);

        $infhero = [];
        $uploadImg = null;

        if ($request->hasFile('infra_hero_image')) {
            $file = $request->file('infra_hero_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $upload = public_path('InfImage');
            $file->move($upload, $filename);
            $uploadImg = 'InfImage/'.$filename;
        }

        $infhero['infra_hero_image'] = $uploadImg;
        $infhero['infra_hero_title'] = $request->infra_hero_title;
        $infhero['infra_hero_subtitle'] = $request->infra_hero_subtitle;
        $infhero['infra_breadcrumb'] = $request->infra_breadcrumb;

        $data = [
            'hero' => json_encode($infhero),
            'school_id' => $request->school_id,
        ];
        ManageCrud::createdatas(Infrastructure::class, $data);

        return redirect()->route('school.website-cms.infrastructure')->with('success', 'Hero Section Created');
    }

    public function SaveCampus(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'campus_overview_title' => 'required',
            'campus_paragraph_1' => 'required',
            'campus_paragraph_2' => 'required',
            'feature_1_title' => 'required',
            'feature_1_description' => 'required',
            'feature_2_title' => 'required',
            'feature_2_description' => 'required',
            'feature_3_title' => 'required',
            'feature_3_description' => 'required',
            'feature_4_title' => 'required',
            'feature_4_description' => 'required',
            'campus_overview_image' => 'required',
        ]);

        $infCampus = [];
        $uploadImg = null;

        if ($request->hasFile('campus_overview_image')) {
            $file = $request->file('campus_overview_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $upload = public_path('CampusImage');
            $file->move($upload, $filename);
            $uploadImg = 'CampusImage/'.$filename;
        }

        $infCampus['campus_overview_title'] = $request->campus_overview_title;
        $infCampus['campus_paragraph_1'] = $request->campus_paragraph_1;
        $infCampus['campus_paragraph_2'] = $request->campus_paragraph_2;
        $infCampus['feature_1_title'] = $request->feature_1_title;
        $infCampus['feature_1_description'] = $request->feature_1_description;
        $infCampus['feature_2_title'] = $request->feature_2_title;
        $infCampus['feature_2_description'] = $request->feature_2_description;
        $infCampus['feature_3_title'] = $request->feature_3_title;
        $infCampus['feature_3_description'] = $request->feature_3_description;
        $infCampus['feature_4_title'] = $request->feature_4_title;
        $infCampus['feature_4_description'] = $request->feature_4_description;
        $infCampus['campus_overview_image'] = $uploadImg;

        $data = ['compus_overview' => json_encode($infCampus)];
        $AccessHome = Infrastructure::where('school_id', $request->school_id)->first();

        if ($AccessHome) {
            ManageCrud::querydataupdate(Infrastructure::class, $request->school_id, $data);
        } else {
            Infrastructure::create([
                'school_id' => $request->school_id,
                'compus_overview' => json_encode($infCampus),
            ]);
        }

        return redirect()->route('school.website-cms.infrastructure')
            ->with('success', 'Campus section saved successfully');
    }

    public function SaveAcademic(Request $request)
    {
        $request->validate([
            'infra_card_image' => 'required|file',
            'infra_card_title' => 'required|string',
            'infra_card_description' => 'required|string',
            'infra_card_link' => 'nullable',
        ]);

        $uploadImage = '';
        if ($request->hasFile('infra_card_image')) {
            $file = $request->file('infra_card_image');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('acadmiImg'), $imageName);
            $uploadImage = 'acadmiImg/'.$imageName;
        }

        $newActivity = [
            'infra_card_title' => $request->infra_card_title,
            'infra_card_description' => $request->infra_card_description,
            'infra_card_link' => $request->infra_card_link,
            'infra_card_image' => $uploadImage,
        ];

        $section = Infrastructure::where('school_id', $request->school_id)->first();

        if ($section) {
            $activities = is_array($section->academic_infrastructure)
                ? $section->academic_infrastructure
                : json_decode($section->academic_infrastructure, true);

            $activities = $activities ?? [];
            $activities[] = $newActivity;
            $section->update([
                'academic_infrastructure' => json_encode($activities),
            ]);

        } else {
            Infrastructure::create([
                'school_id' => $request->school_id,
                'academic_infrastructure' => json_encode([$newActivity]),
            ]);
        }

        return redirect()->route('school.website-cms.infrastructure')
            ->with('success', 'Academic Infrastructure section saved successfully');
    }

    public function Updatehero(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'infra_hero_image' => 'nullable|image',
            'infra_hero_title' => 'required',
            'infra_hero_subtitle' => 'required',
            'infra_breadcrumb' => 'required',
        ]);

        $getHero = Infrastructure::where('school_id', $request->school_id)->first();

        $editdata = json_decode(stripslashes($getHero->hero));

        if ($request->hasFile('infra_hero_image')) {

            if (! empty($editdata->infra_hero_image) && file_exists(public_path($editdata->infra_hero_image))) {
                unlink(public_path($editdata->infra_hero_image));
            }

            $file = $request->file('infra_hero_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $uploadPath = public_path('InfImage');
            $file->move($uploadPath, $filename);
            $editdata->infra_hero_image = 'InfImage/'.$filename;
        }

        $editdata->infra_hero_title = $request->infra_hero_title;
        $editdata->infra_hero_subtitle = $request->infra_hero_subtitle;
        $editdata->infra_breadcrumb = $request->infra_breadcrumb;

        $getHero->hero = json_encode($editdata);
        $getHero->save();

        return back()->with('success', 'Hero Section Updated Successfully');
    }

    public function UpdateCampus(Request $request)
    {
        $request->validate([
            'campus_overview_title' => 'required',
            'campus_paragraph_1' => 'required',
            'campus_paragraph_2' => 'required',
            'feature_1_title' => 'nullable',
            'feature_1_description' => 'required',
            'feature_2_title' => 'required',
            'feature_2_description' => 'required',
            'feature_3_title' => 'required',
            'feature_3_description' => 'required',
            'feature_4_title' => 'required',
            'feature_4_description' => 'required',
            'campus_overview_image' => 'nullable|image',
        ]);

        $getdata = Infrastructure::where('school_id', $request->school_id)->first();

        $compausedit = json_decode(stripslashes($getdata->compus_overview));

        $uploadImg = $compausedit->campus_overview_image ?? null;

        if ($request->hasFile('campus_overview_image')) {

            if (! empty($compausedit->campus_overview_image) && file_exists(public_path($compausedit->campus_overview_image))) {
                unlink(public_path($compausedit->campus_overview_image));
            }

            $file = $request->file('campus_overview_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $uploadPath = public_path('CampusImage');
            $file->move($uploadPath, $filename);

            $uploadImg = 'CampusImage/'.$filename;
        }

        $compausedit->campus_overview_title = $request->campus_overview_title;
        $compausedit->campus_paragraph_1 = $request->campus_paragraph_1;
        $compausedit->campus_paragraph_2 = $request->campus_paragraph_2;
        $compausedit->feature_1_title = $request->feature_1_title;
        $compausedit->feature_1_description = $request->feature_1_description;
        $compausedit->feature_2_title = $request->feature_2_title;
        $compausedit->feature_2_description = $request->feature_2_description;
        $compausedit->feature_3_title = $request->feature_3_title;
        $compausedit->feature_3_description = $request->feature_3_description;
        $compausedit->feature_4_title = $request->feature_4_title;
        $compausedit->feature_4_description = $request->feature_4_description;
        $compausedit->campus_overview_image = $uploadImg;
        $getdata->compus_overview = json_encode($compausedit);
        $getdata->save();

        return redirect()->route('school.website-cms.infrastructure')
            ->with('success', 'Campus section Updated successfully');
    }

    public function UpdateAcademic(Request $request)
    {
        $request->validate([
            'infra_card_title' => 'required|string|max:255',
            'infra_card_description' => 'required|string',
            'infra_card_link' => 'nullable|string',
            'infra_index' => 'required|integer',
        ]);

        $model = Infrastructure::where('school_id', $request->school_id)->first();

        $data = json_decode($model->academic_infrastructure, true) ?? [];

        $index = $request->infra_index;

        $oldImage = $request->old_infra_image;

        if ($request->hasFile('infra_card_image')) {

            $file = $request->file('infra_card_image');
            $name = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('acadmiImg');

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $file->move($destinationPath, $name);

            if (! empty($oldImage) && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }

            $imagePath = 'acadmiImg/'.$name;

        } else {

            $imagePath = $oldImage;
        }

        $data[$index] = [
            'infra_card_title' => $request->infra_card_title,
            'infra_card_description' => $request->infra_card_description,
            'infra_card_link' => $request->infra_card_link,
            'infra_card_image' => $imagePath,
        ];

        $model->academic_infrastructure = json_encode($data);
        $model->save();

        return back()->with('success', 'Infrastructure Updated Successfully ✅');
    }

    public function deleteAcademic(Request $request)
    {
        $request->validate([
            'infra_index' => 'required|integer',
            'school_id' => 'required',
        ]);

        $model = Infrastructure::where('school_id', $request->school_id)->first();

        $data = json_decode($model->academic_infrastructure, true) ?? [];

        $index = $request->infra_index;

        if (! isset($data[$index])) {
            return back()->with('error', 'Item not found');
        }
        $image = $data[$index]['infra_card_image'] ?? null;

        if ($image && file_exists(public_path($image))) {
            unlink(public_path($image));
        }

        // 🔥 remove item
        unset($data[$index]);

        $data = array_values($data);

        $model->academic_infrastructure = json_encode($data);
        $model->save();

        return back()->with('success', 'Deleted successfully ✅');
    }
}
