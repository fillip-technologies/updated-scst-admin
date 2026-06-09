<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\School;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SchoolApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $schooldata = School::select('school_logo', 'school_name', 'school_code', 'establishment_year', 'district', 'block', 'full_address', 'official_email', 'school_phone', 'category', 'principle_name', 'principle_contact', 'total_classrooms', 'total_students_enrolled', 'total_teachers_sanctioned', 'hostel_capacity', 'school_admin_username')->get();

            return SuccessResponse(200, 'All School Data Find', $schooldata);
        } catch (Exception $e) {
            return ErrorResponse(400, 'Data Not Found', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ecryptionKey()
    {
        try {

            $path = storage_path('keys/public.pem');

            if (! file_exists($path)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Public key file not found',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'public_key' => file_get_contents($path),
            ]);

        } catch (\Throwable $e) {

            Log::error('Public Key Error', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Unable to load public key',
            ], 500);
        }
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
