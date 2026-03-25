<?php

namespace App\Http\Controllers\School;

use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class ManageSchoolController extends Controller
{
    public function getHomepagedata()
    {
        $schoolId = SchoolLogin()->id;
        $homepagedata = Home::where('school_id', $schoolId)->first();
    }

    public function SaveHeroSection(Request $request)
    {

        try {
            $request->validate([
                'bgimage' => 'required|file',
                'badge_text' => 'required|string',
                'rating_value' => 'required',
                'school_title' => 'required|string',
                'location_text' => 'required|string',
                'students_count' => 'required',
                'class_range' => 'required',
                'back_button_text' => 'required|string',
            ]);
            $hero = [];
            $bgfile = '';
            if ($request->hasFile('bgimage')) {
                $file = $request->file('bgimage');
                $filename = time().'.'.$file->getClientOriginalExtension();
                $upload = public_path('schoolBgImage');

                if (! file_exists($upload)) {
                    mkdir($upload, 0777, true);
                }
                $file->move($upload, $filename);
                $bgfile = 'schoolBgImage/'.$filename;
            }
            $hero['bgimage'] = $bgfile;
            $hero['badge_text'] = $request->badge_text;
            $hero['rating_value'] = $request->rating_value;
            $hero['school_title'] = $request->school_title;
            $hero['location_text'] = $request->location_text;
            $hero['students_count'] = $request->students_count;
            $hero['class_range'] = $request->class_range;
            $hero['back_button_text'] = $request->back_button_text;
            $data = [
                'school_id' => $request->school_id,
                'hero' => json_encode($hero),
            ];
            ManageCrud::createdatas(Home::class, $data);

            return back()->with('success', 'Hero section saved successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong', $e->getMessage());
        }
    }

    // public function SaveGallerySection(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'school_id' => 'required',
    //             'gallery_card_image' => 'required|file|mimes:jpg,jpeg,png,webp',
    //             'gallery_card_title' => 'required|string',
    //             'gallery_card_subtitle' => 'required|string',
    //         ]);

    //         $gallaryImage = '';

    //         // Upload Image
    //         if ($request->hasFile('gallery_card_image')) {
    //             $file = $request->file('gallery_card_image');
    //             $filename = time().'.'.$file->getClientOriginalExtension();
    //             $uploadPath = public_path('GalleryImage');

    //             if (! file_exists($uploadPath)) {
    //                 mkdir($uploadPath, 0777, true);
    //             }

    //             $file->move($uploadPath, $filename);
    //             $gallaryImage = 'GalleryImage/'.$filename;
    //         }

    //         $newGallary = [
    //             'gallery_card_image' => $gallaryImage,
    //             'gallery_card_title' => $request->gallery_card_title,
    //             'gallery_card_subtitle' => $request->gallery_card_subtitle,
    //         ];

    //         $section = Home::where('school_id', $request->school_id)->first();

    //         if ($section) {

    //             $gallery = json_decode($section->gallery, true) ?? [];
    //             $gallery[] = $newGallary;

    //             $section->update([
    //                 'gallery' => json_encode($gallery),
    //             ]);

    //         } else {

    //             Home::create([
    //                 'school_id' => $request->school_id,
    //                 'gallery' => json_encode([$newGallary]),
    //             ]);
    //         }

    //         return redirect()->back()->with('success', 'Gallery added successfully');

    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Something went wrong');
    //     }
    // }

    public function SaveGallerySection(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'gallery_card_image' => 'required|file|mimes:jpg,jpeg,png,webp',
            'gallery_card_title' => 'required|string',
            'gallery_card_subtitle' => 'required|string',
        ]);

        $imagePath = '';
        if ($request->hasFile('gallery_card_image')) {
            $file = $request->file('gallery_card_image');
            $filename = time().'.'.$file->getClientOriginalExtension();

            $path = public_path('GalleryImage');
            if (! file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file->move($path, $filename);
            $imagePath = 'GalleryImage/'.$filename;
        }

        $newData = [
            'gallery_card_image' => $imagePath,
            'gallery_card_title' => $request->gallery_card_title,
            'gallery_card_subtitle' => $request->gallery_card_subtitle,
        ];

        $section = Home::where('school_id', $request->school_id)->first();

        if (! $section) {

            Home::create([
                'school_id' => $request->school_id,
                'gallery' => json_encode([$newData]),
            ]);
        } else {

            $gallery = json_decode($section->gallery, true);

            if (! is_array($gallery)) {
                $gallery = [];
            }

            $gallery[] = $newData;

            $section->update([
                'gallery' => json_encode($gallery),
            ]);
        }

        return redirect()->back()->with('success', 'Gallery saved successfully');
    }

    public function SaveAboutSection(Request $request)
    {
        $request->validate([
            'about_label' => 'required',
            'about_title' => 'required',
            'about_description' => 'required',
            'about_bullet_1' => 'required',
            'about_bullet_2' => 'required',
            'about_bullet_3' => 'required',
            'students_count' => 'required',
            'student_ratio' => 'required',
            'pass_percentage' => 'required',
            'about_image' => 'required',
        ]);

        $uploadImage = '';
        $aboutData = [];

        if ($request->hasFile('about_image')) {
            $file = $request->file('about_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $upload = public_path('aboutImage');
            $file->move($upload, $filename);
            $uploadImage = 'aboutImage'.'/'.$filename;
        }

        $aboutData['about_label'] = $request->about_label;
        $aboutData['about_title'] = $request->about_title;
        $aboutData['about_description'] = $request->about_description;
        $aboutData['about_bullet_1'] = $request->about_bullet_1;
        $aboutData['about_bullet_2'] = $request->about_bullet_2;
        $aboutData['about_bullet_3'] = $request->about_bullet_3;
        $aboutData['students_count'] = $request->students_count;
        $aboutData['student_ratio'] = $request->student_ratio;
        $aboutData['pass_percentage'] = $request->pass_percentage;
        $aboutData['about_image'] = $uploadImage;
        $data = [
            'about' => json_encode($aboutData),
        ];

        $AccessHome = Home::where('school_id', $request->school_id)->first();
        if ($AccessHome) {
            ManageCrud::querydataupdate(Home::class, $request->school_id, $data);
        } else {
            Home::create([
                'school_id' => $request->school_id,
                'about' => json_encode($aboutData),
            ]);
        }

        return redirect()->route('school.website-cms.home')
            ->with('success', 'About section saved successfully');

    }

    public function SaveSchoolAtAGlance(Request $request)
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
        $glancedata = [];
        $glancedata['glance_title'] = $request->glance_title;
        $glancedata['glance_subtitle'] = $request->glance_subtitle;
        $glancedata['stat_1_value'] = $request->stat_1_value;
        $glancedata['stat_1_label'] = $request->stat_1_label;
        $glancedata['stat_2_label'] = $request->stat_2_label;
        $glancedata['stat_2_value'] = $request->stat_2_value;
        $glancedata['stat_3_value'] = $request->stat_3_value;
        $glancedata['stat_3_label'] = $request->stat_3_label;
        $glancedata['stat_4_value'] = $request->stat_4_value;
        $glancedata['stat_4_label'] = $request->stat_4_label;
        $data = ['school_at_a_glance' => json_encode($glancedata)];
        $AccessHome = Home::where('school_id', $request->school_id)->first();
        if ($AccessHome) {
            ManageCrud::querydataupdate(Home::class, $request->school_id, $data);
        } else {
            Home::create([
                'school_id' => $request->school_id,
                'about' => json_encode($glancedata),
            ]);
        }

        return redirect()->route('school.website-cms.home')
            ->with('success', 'Glance section saved successfully');

    }

    public function SaveInfrastructureSection(Request $request)
    {
        $request->validate([
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
        $infrastructuredata = [];
        $fetures = [];
        $fetures['feature1'] = $request->feature1;
        $fetures['feature2'] = $request->feature2;
        $fetures['feature3'] = $request->feature3;
        $fetures['feature4'] = $request->feature4;
        $fetures['feature5'] = $request->feature5;
        $fetures['feature6'] = $request->feature6;
        $fetures['feature7'] = $request->feature7;
        $fetures['feature8'] = $request->feature8;
        $infrastructuredata['infra_label'] = $request->infra_label;
        $infrastructuredata['infra_title'] = $request->infra_title;
        $infrastructuredata['infra_description'] = $request->infra_description;
        $infrastructuredata['allfeatures'] = $fetures;

        $data = ['infrasture' => json_encode($infrastructuredata)];
        $AccessHome = Home::where('school_id', $request->school_id)->first();
        if ($AccessHome) {
            ManageCrud::querydataupdate(Home::class, $request->school_id, $data);
        } else {
            Home::create([
                'school_id' => $request->school_id,
                'about' => json_encode($infrastructuredata),
            ]);
        }

        return redirect()->route('school.website-cms.home')
            ->with('success', 'Infrastructure section saved successfully');
    }

    public function SaveActivitiesSection(Request $request)
    {
        $request->validate([
            'activity_image' => 'required|file',
            'activity_title' => 'required',
            'school_id' => 'required',
        ]);

        $uploadImage = '';
        if ($request->hasFile('activity_image')) {
            $file = $request->file('activity_image');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $imageName);
            $uploadImage = 'uploads/'.$imageName;
        }

        $newActivity = [
            'title' => $request->activity_title,
            'image' => $uploadImage,
        ];

        $section = Home::where('school_id', $request->school_id)->first();

        if ($section) {
            $activities = is_array($section->activities)
                ? $section->activities
                : json_decode($section->activities, true);

            $activities = $activities ?? [];
            $activities[] = $newActivity;
            $section->update([
                'activities' => json_encode($activities),
            ]);

        } else {
            Home::create([
                'school_id' => $request->school_id,
                'activities' => json_encode([$newActivity]),
            ]);
        }

        return redirect()->route('school.website-cms.home')
            ->with('success', 'Activities section saved successfully');
    }

    public function SaveQuizSection(Request $request)
    {

        $request->validate([
            'quiz_status' => 'required',
            'quiz_image' => 'required',
            'quiz_button_text' => 'required',
            'quiz_title' => 'required',
            'quiz_description' => 'required',
        ]);

        $uploadImage = '';
        if ($request->hasFile('quiz_image')) {
            $file = $request->file('quiz_image');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('quizImage'), $imageName);
            $uploadImage = 'quizImage/'.$imageName;
        }

        $newQuiz = [
            'quiz_status' => $request->quiz_status,
            'quiz_image' => $uploadImage,
            'quiz_button_text' => $request->quiz_button_text,
            'quiz_title' => $request->quiz_title,
            'quiz_description' => $request->quiz_description,
        ];

        $section = Home::where('school_id', $request->school_id)->first();

        if ($section) {
            $quizdata = is_array($section->quiz)
                ? $section->quiz
                : json_decode($section->quiz, true);

            $quizdata = $quizdata ?? [];
            $quizdata[] = $newQuiz;
            $section->update([
                'quiz' => json_encode($quizdata),
            ]);

        } else {
            Home::create([
                'school_id' => $request->school_id,
                'quiz' => json_encode([$newQuiz]),
            ]);
        }

        return redirect()->route('school.website-cms.home')
            ->with('success', 'Activities section saved successfully');
    }

    public function SaveAlumniSection(Request $request)
    {

        $request->validate([
            'alumni_photo' => 'required|file',
            'alumni_name' => 'required',
            'alumni_details' => 'required',
        ]);

        $uploadImage = '';
        if ($request->hasFile('alumni_photo')) {
            $file = $request->file('alumni_photo');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('alumniPhoto'), $imageName);
            $uploadImage = 'alumniPhoto/'.$imageName;
        }
        $newAlumni = [
            'alumni_name' => $request->alumni_name,
            'alumni_photo' => $uploadImage,
            'alumni_details' => $request->alumni_details,
        ];

        $section = Home::where('school_id', $request->school_id)->first();

        if ($section) {
            $alumnidata = is_array($section->alumni)
                ? $section->alumni
                : json_decode($section->alumni, true);

            $alumnidata = $alumnidata ?? [];
            $alumnidata[] = $newAlumni;
            $section->update([
                'alumni' => json_encode($alumnidata),
            ]);

        } else {
            Home::create([
                'school_id' => $request->school_id,
                'alumni' => json_encode([$newAlumni]),
            ]);
        }

        return redirect()->route('school.website-cms.home')
            ->with('success', 'Alumni section saved successfully');

    }

    public function SaveFaqSection(Request $request)
    {

        $request->validate([
            'faq_question' => 'required',
            'faq_answer' => 'required',

        ]);

        $newFaq = [
            'faq_question' => $request->faq_question,
            'faq_answer' => $request->faq_answer,
        ];

        $section = Home::where('school_id', $request->school_id)->first();

        if ($section) {
            $faqdata = is_array($section->faq)
                ? $section->faq
                : json_decode($section->faq, true);

            $faqdata = $faqdata ?? [];
            $faqdata[] = $newFaq;
            $section->update([
                'faq' => json_encode($faqdata),
            ]);

        } else {
            Home::create([
                'school_id' => $request->school_id,
                'faq' => json_encode([$newFaq]),
            ]);
        }

        return redirect()->route('school.website-cms.home')
            ->with('success', 'FAQ section saved successfully');

    }
}
