<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeaderMessage;
use App\Models\SchemaInitiactive;
use App\Models\StateSection;
use Illuminate\Http\Request;

class DepartmentCmsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function leaderMessage()
    {
        try {
            $data = LeaderMessage::orderBy('id', 'desc')->first();

            $data->minister = json_decode($data->minister) ?? null;
            $data->secretary = json_decode($data->secretary) ?? null;
            $data->ias_officer = json_decode($data->ias_officer) ?? null;
            if (! empty($data)) {
                return SuccessResponse(200, 'Leader Massage Here', $data);
            }
        } catch (\Exception $e) {
            return ErrorResponse(400, 'Data Not found', $e->getMessage());
        }
    }

    public function stateList()
    {
        try {
            $data = StateSection::orderBy('id', 'desc')->first();
            $data->state_section = json_decode($data->state_section) ?? null;
            if (! empty($data)) {
                return SuccessResponse(200, 'State Listing Here', $data);
            }
        } catch (\Exception $e) {
            return ErrorResponse(400, 'Data Not found', $e->getMessage());
        }
    }

    public function schemaList()
    {
        try {
            $data = SchemaInitiactive::orderBy('id', 'desc')->first();

            $data->minister = json_decode($data->state_section) ?? null;
            if (! empty($data)) {
                return SuccessResponse(200, 'Schema Listing Here', $data);
            }
        } catch (\Exception $e) {
            return ErrorResponse(400, 'Data Not found', $e->getMessage());
        }
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
