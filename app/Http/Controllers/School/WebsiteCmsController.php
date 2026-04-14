<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\AddClasses;
use App\Models\Home;
use App\Models\Infrastructure;
use App\Models\Notices;
use App\Models\Staff;
use App\Models\Student;

class WebsiteCmsController extends Controller
{
    public function schoolDashboard()
    {

        $classes = Student::select('class_id')->where('school_id',SchoolLogin()->id)
            ->groupBy('class_id')
            ->get();

        $data = [];

        foreach ($classes as $class) {

            $total = Student::where('class_id', $class->class_id)->count();

            $present = Student::where('class_id', $class->class_id)
                ->whereHas('attendance', function ($q) {
                    $q->where('status', 'present');
                })
                ->count();

            $absent = Student::where('class_id', $class->class_id)
                ->whereHas('attendance', function ($q) {
                    $q->where('status', 'absent');
                })
                ->count();

            $data[] = [
                'class' => $class->class_id,
                'total' => $total,
                'present' => $present,
                'absent' => $absent,
            ];
        }

        return view('modules.school.dashboard.index', compact('data'));
    }

    public function cmsIndex()
    {
        return view('modules.school.website-cms.index');
    }

    public function cmsHome()
    {
        $homePage = Home::where('school_id', SchoolLogin()->id)->first();

        // dd($homePage);
        return view('modules.school.website-cms.home.index', compact('homePage'));
    }

    public function cmshero()
    {
        return view('modules.school.website-cms.home.hero');
    }

    public function cmsgallery()
    {
        return view('modules.school.website-cms.home.gallery');
    }

    public function cmsabout()
    {
        return view('modules.school.website-cms.home.about');
    }

    public function cmsglance()
    {
        return view('modules.school.website-cms.home.glance');
    }

    public function cmsinfrastructure()
    {
        return view('modules.school.website-cms.home.infrastructure');
    }

    public function cmsactivities()
    {
        return view('modules.school.website-cms.home.activities');
    }

    public function cmsquiz()
    {
        return view('modules.school.website-cms.home.quiz');
    }

    public function cmsalumni()
    {
        return view('modules.school.website-cms.home.alumni');
    }

    public function cmsfaq()
    {
        return view('modules.school.website-cms.home.faq');
    }

    public function cmsinfrastructureindex()
    {
        $infradatas = Infrastructure::where('school_id', SchoolLogin()->id)->first();

        return view('modules.school.website-cms.infrastructure.index', compact('infradatas'));
    }

    public function cmsstaffindex()
    {
        $staffdata = Staff::where('school_id', SchoolLogin()->id)->first();

        return view('modules.school.staff.index', compact('staffdata'));
    }

    public function cmsnoticeindex()
    {
      $notice = Notices::where('school_id', SchoolLogin()->id)->first();
      $notices = json_decode($notice->notice_manage);
     return view('modules.school.notices.index', compact('notices'));
    }

    public function attandence()
    {
        $school_id = SchoolLogin()->id ?? TeacherLog()->school_id;

        $classes = AddClasses::where('school_id', $school_id)->get();

        $studentdata = Student::where('school_id', $school_id)
            ->with(['attendance' => function ($q) {
                $q->whereDate('date', now());
            }])
            ->paginate(10);

        return view('modules.school.attendance.index', compact('classes', 'studentdata'));
    }

    public function academics()
    {
        return view('modules.school.academics.index');
    }

    public function mealreporting()
    {
        return view('modules.school.meal-reporting.index');
    }

    public function reports()
    {

        return view('modules.school.reports.index');
    }
}
