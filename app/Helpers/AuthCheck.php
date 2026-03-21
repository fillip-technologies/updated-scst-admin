<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('SchoolLogin')) {
    function SchoolLogin()
    {
        $schooldata = Auth::user();
        if ($schooldata && $schooldata->role === 'school_admin') {
            return $schooldata->school;
        }

        return null;
    }
}

if (! function_exists('AdminLogin')) {
    function AdminLogin()
    {
        $admin = Auth::user();
        if ($admin && $admin->role === 'admin') {
            return $admin;
        }

        return null;
    }
}
