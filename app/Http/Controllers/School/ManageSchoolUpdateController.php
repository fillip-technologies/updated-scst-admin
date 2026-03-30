<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class ManageSchoolUpdateController extends Controller
{
    public function UpdateHeroSection(Request $request)
    {
        try {
            $request->validate([
                'bgimage' => 'nullable|file|mimes:jpg,jpeg,png,webp,avif',
                'badge_text' => 'required|string',
                'rating_value' => 'required',
                'school_title' => 'required|string',
                'location_text' => 'required|string',
                'students_count' => 'required',
                'class_range' => 'required',
                'back_button_text' => 'required|string',
                'school_id' => 'required',
            ]);

            $existing = Home::where('school_id', $request->school_id)->first();

            if (! $existing) {
                return back()->with('error', 'Data not found for update');
            }

            $hero = [];

            if ($existing->hero) {
                $hero = json_decode($existing->hero, true);
            }

            if ($request->hasFile('bgimage')) {

                if (! empty($hero['bgimage']) && file_exists(public_path($hero['bgimage']))) {
                    unlink(public_path($hero['bgimage']));
                }

                $file = $request->file('bgimage');
                $filename = time().'_'.rand(111, 999).'.'.$file->getClientOriginalExtension();

                $path = public_path('schoolBgImage');
                if (! file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $file->move($path, $filename);
                $hero['bgimage'] = 'schoolBgImage/'.$filename;
            }

            $hero['badge_text'] = $request->badge_text;
            $hero['rating_value'] = $request->rating_value;
            $hero['school_title'] = $request->school_title;
            $hero['location_text'] = $request->location_text;
            $hero['students_count'] = $request->students_count;
            $hero['class_range'] = $request->class_range;
            $hero['back_button_text'] = $request->back_button_text;

            $existing->update([
                'hero' => json_encode($hero),
            ]);

            return back()->with('success', 'Hero section updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function UpdateAboutSection(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'about_label' => 'required',
            'about_title' => 'required',
            'about_description' => 'required',
            'about_bullet_1' => 'required',
            'about_bullet_2' => 'required',
            'about_bullet_3' => 'required',
            'students_count' => 'required',
            'student_ratio' => 'required',
            'pass_percentage' => 'required',
            'about_image' => 'nullable|file|mimes:jpg,jpeg,png,webp',
        ]);

        $section = Home::where('school_id', $request->school_id)->first();

        if (! $section) {
            return redirect()->back()->with('error', 'Data not found');
        }

        $oldData = json_decode($section->about, true);
        $oldImage = $oldData['about_image'] ?? '';

        $imagePath = $oldImage;

        if ($request->hasFile('about_image')) {

            if ($oldImage && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }

            $file = $request->file('about_image');
            $filename = time().'.'.$file->getClientOriginalExtension();

            $path = public_path('aboutImage');
            if (! file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file->move($path, $filename);
            $imagePath = 'aboutImage/'.$filename;
        }

        $aboutData = [
            'about_label' => $request->about_label,
            'about_title' => $request->about_title,
            'about_description' => $request->about_description,
            'about_bullet_1' => $request->about_bullet_1,
            'about_bullet_2' => $request->about_bullet_2,
            'about_bullet_3' => $request->about_bullet_3,
            'students_count' => $request->students_count,
            'student_ratio' => $request->student_ratio,
            'pass_percentage' => $request->pass_percentage,
            'about_image' => $imagePath,
        ];

        $section->update([
            'about' => json_encode($aboutData),
        ]);

        return redirect()->back()->with('success', 'About updated successfully');
    }

    public function UpdateSchoolAtAGlance(Request $request)
    {
        $request->validate([
            'glance_title' => 'required',
            'glance_subtitle' => 'required',
            'stat_1_value' => 'required',
            'stat_1_label' => 'required',
            'stat_2_value' => 'required',
            'stat_2_label' => 'required',
            'stat_3_value' => 'required',
            'stat_3_label' => 'required',
            'stat_4_value' => 'required',
            'stat_4_label' => 'required',
        ]);

        $section = Home::where('school_id', $request->school_id)->first();

        $glancedata = [
            'glance_title' => $request->glance_title,
            'glance_subtitle' => $request->glance_subtitle,
            'stat_1_value' => $request->stat_1_value,
            'stat_1_label' => $request->stat_1_label,
            'stat_2_label' => $request->stat_2_label,
            'stat_2_value' => $request->stat_2_value,
            'stat_3_value' => $request->stat_3_value,
            'stat_3_label' => $request->stat_3_label,
            'stat_4_value' => $request->stat_4_value,
            'stat_4_label' => $request->stat_4_label,
        ];
        $section->update([
            'school_at_a_glance' => json_encode($glancedata),
        ]);

        return redirect()->route('school.website-cms.home')
            ->with('success', 'Glance section Upadated successfully');

    }

    public function UpdateInfrastructureSection(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'infra_label' => 'required',
            'infra_title' => 'required',
            'infra_description' => 'required',
            'feature1' => 'required',
            'feature2' => 'required',
            'feature3' => 'required',
            'feature4' => 'required',
            'feature5' => 'required',
            'feature6' => 'required',
            'feature7' => 'required',
            'feature8' => 'required',
        ]);
        $section = Home::where('school_id', $request->school_id)->first();

        $fetures = [
            'feature1' => $request->feature1,
            'feature2' => $request->feature2,
            'feature3' => $request->feature3,
            'feature4' => $request->feature4,
            'feature5' => $request->feature5,
            'feature6' => $request->feature6,
            'feature7' => $request->feature7,
            'feature8' => $request->feature8,
        ];
        $infrastructuredata = [
            'infra_label' => $request->infra_label,
            'infra_title' => $request->infra_title,
            'infra_description' => $request->infra_description,
            'allfeatures' => $fetures,
        ];

        $section->update([
            'infrasture' => json_encode($infrastructuredata),
        ]);

        return redirect()->route('school.website-cms.home')
            ->with('success', 'Infrastructure section Upadated successfully');
    }

    public function UpdateActivitiesSection(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'activity_title' => 'required|string',
            'school_id' => 'required',
        ]);

        $school = Home::where('school_id', $request->school_id)->first();
        $activities = json_decode($school->activities, true) ?? [];

        $index = $request->editing_index;

        if (! isset($activities[$index])) {
            return back()->with('error', 'Activity not found');
        }

        if ($request->hasFile('activity_image')) {

            $file = $request->file('activity_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            if (! empty($activities[$index]['image']) && file_exists(public_path($activities[$index]['image']))) {
                unlink(public_path($activities[$index]['image']));
            }

            $activities[$index]['image'] = 'uploads/'.$filename;
        }

        $activities[$index]['title'] = $request->activity_title;

        $school->activities = json_encode($activities);
        $school->save();

        return back()->with('success', 'Activity updated successfully');
    }

    public function DeleteActivity(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'index' => 'required|integer',
        ]);

        $section = Home::where('school_id', $request->school_id)->first();

        if (! $section) {
            return back()->with('error', 'Section not found');
        }

        $activities = is_array($section->activities)
            ? $section->activities
            : json_decode($section->activities, true);

        if (! isset($activities[$request->index])) {
            return back()->with('error', 'Activity not found');
        }

        $imagePath = $activities[$request->index]['image'];
        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        unset($activities[$request->index]);

        $activities = array_values($activities);

        $section->update([
            'activities' => json_encode($activities),
        ]);

        return redirect()->route('school.website-cms.home')
            ->with('success', 'Activity deleted successfully');
    }

    public function UpdateAlumniSection(Request $request)
    {
        $request->validate([
            'index' => 'required|integer',
            'school_id' => 'required|integer',
        ]);

        $index = $request->index;

        $school = Home::where('school_id', $request->school_id)->first();
        if (! $school) {
            return back()->with('error', 'School not found');
        }

        $alumnis = json_decode($school->alumni, true) ?? [];

        if (! isset($alumnis[$index])) {
            return back()->with('error', 'Alumni not found');
        }

        if ($request->hasFile('alumni_photo')) {
            $file = $request->file('alumni_photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $filePath = 'alumniPhoto/'.$filename; // save in public/alumniPhoto

            $file->move(public_path('alumniPhoto'), $filename);

            if (! empty($alumnis[$index]['alumni_photo']) && file_exists(public_path($alumnis[$index]['alumni_photo']))) {
                unlink(public_path($alumnis[$index]['alumni_photo']));
            }

            $alumnis[$index]['alumni_photo'] = $filePath;
        }

        $alumnis[$index]['alumni_name'] = $request->alumni_name ?? $alumnis[$index]['alumni_name'];
        $alumnis[$index]['alumni_details'] = $request->alumni_details ?? $alumnis[$index]['alumni_details'];

        $school->alumni = json_encode($alumnis);
        $school->save();

        return back()->with('success', 'Alumni updated successfully');
    }

    public function DeleteAlumniSection(Request $request)
    {
        $request->validate([
            'index' => 'required|integer',
            'school_id' => 'required|integer',
        ]);

        $index = $request->index;

        $school = Home::where('school_id', $request->school_id)->first();
        if (! $school) {
            return back()->with('error', 'School not found');
        }

        $alumnis = json_decode($school->alumni, true) ?? [];

        if (! isset($alumnis[$index])) {
            return back()->with('error', 'Alumni not found');
        }

        if (! empty($alumnis[$index]['alumni_photo']) && file_exists(public_path($alumnis[$index]['alumni_photo']))) {
            unlink(public_path($alumnis[$index]['alumni_photo']));
        }

        array_splice($alumnis, $index, 1);

        $school->alumni = json_encode($alumnis);
        $school->save();

        return back()->with('success', 'Alumni deleted successfully');
    }

    public function UpdateFaqSection(Request $request)
    {
        $record = Home::where('school_id', $request->school_id)->first();
        $index = $request->faq_index;
        $faqs = json_decode($record->faq, true) ?? [];

        $faqs[$index] = [
            'faq_question' => $request->faq_question,
            'faq_answer' => $request->faq_answer,
        ];
        $record->faq = json_encode($faqs);
        $record->save();

        return back()->with('success', 'FAQ added successfully');
    }

    public function DeleteFaqSection(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'index' => 'required',
        ]);

        $index = $request->index;

        $getdata = Home::where('school_id', $request->school_id)->first();

        $faqs = json_decode($getdata->faq, true) ?? [];
        if (! isset($faqs[$index])) {
            return back()->with('error', 'FAQ not found');
        }

        unset($faqs[$index]);

        $faqs = array_values($faqs);

        $getdata->faq = json_encode($faqs);
        $getdata->save();

        return back()->with('success', 'Faq deleted successfully');
    }
}
