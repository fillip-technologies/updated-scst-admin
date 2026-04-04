<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Home;
use App\Models\Infrastructure;
use App\Models\MainNotice;
use App\Models\Notices;
use App\Models\Staff;
use Exception;

class HomeSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getHomeSchoolData($school_id)
    {
        $data = Home::where('school_id', $school_id)->first();

        if (! $data) {
            return ErrorResponse(400, 'Home page data not found');
        }

        $data->hero = json_decode($data->hero, true);
        $data->gallery = json_decode($data->gallery, true);
        $data->about = json_decode($data->about, true);
        $data->activities = json_decode($data->activities, true);
        $data->school_at_a_glance = json_decode($data->school_at_a_glance, true);
        $data->infrasture = json_decode($data->infrasture, true);
        $data->quiz = json_decode($data->quiz, true);
        $data->alumni = json_decode($data->alumni, true);
        $data->faq = json_decode($data->faq, true);

        return SuccessResponse(200, 'Home Page all data found', $data);
    }

    public function getInfrastructurData($school_id)
    {
        $data = Infrastructure::where('school_id', $school_id)->first();

        if (! $data) {
            return ErrorResponse(400, 'Infrastructure page data not found');
        }

        $data->hero = json_decode($data->hero, true);
        $data->compus_overview = json_decode($data->compus_overview, true);
        $data->academic_infrastructure = json_decode($data->academic_infrastructure, true);

        return SuccessResponse(200, 'Infrastructure Page all data found', $data);
    }

    public function mainnotice()
    {
        try {
            $allnotice = MainNotice::all();

            return SuccessResponse(200, ' Find All Notices', $allnotice);
        } catch (Exception $e) {
            return ErrorResponse(400, 'Somthing Went Wrong', $e->getMessage());
        }

    }

    public function getStaffData($school_id)
    {
        $data = Staff::where('school_id', $school_id)->first();

        if (! $data) {
            return ErrorResponse(400, 'Staff page data not found');
        }

        $data->leadership = json_decode($data->leadership, true);
        $data->teacher_staff = json_decode($data->teacher_staff, true);

        return SuccessResponse(200, 'Staff Page all data found', $data);
    }

    public function getNoticelData($school_id)
    {
        $data = Notices::where('school_id', $school_id)->first();

        if (! $data) {
            return ErrorResponse(400, 'Notices page data not found');
        }

        $data->notice_manage = json_decode($data->notice_manage, true);

        return SuccessResponse(200, 'Notices Page all data found', $data);
    }
}
