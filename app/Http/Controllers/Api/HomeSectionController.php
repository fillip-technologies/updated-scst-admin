<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getHomeSchoolData($school_id)
    {
        $data = Home::where('school_id', $school_id)->first();

        if (! $data) {
            return ErrorResponse(400,'Home page data not found');
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

        return SuccessResponse(200,'Home Page all data found',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
