<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Home;

class WebsiteCmsController extends Controller
{
    public function cmsIndex()
    {
        return view('modules.school.website-cms.index');
    }

    public function cmsHome()
    {
        $homePage = Home::where('school_id',SchoolLogin()->id)->first();
        return view('modules.school.website-cms.home.index',compact('homePage'));
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
        return view('modules.school.website-cms.infrastructure.index');
    }

    public function cmsstaffindex()
    {
        return view('modules.school.staff.index');
    }

    public function cmsnoticeindex()
    {
        return view('modules.school.notices.index');
    }
}
