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
        $infCampus['feature_1_title'] = $request->feature_1_Title;
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
}
