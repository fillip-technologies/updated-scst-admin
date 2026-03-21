<?php

namespace App\Http\Controllers;

class RandomController extends Controller
{
    public function student()
    {
        return view('admin.listings.student');
    }

    public function teacher() {
        return view('admin.listings.teacher');
    }

    public function hotels() {
        return view('admin.listings.hotel');
    }

    public function notice() {
        return view('admin.listings.notice');
    }

    public function attendance() {
        return view ('admin.listings.attendance');
    }

    public function library() {
        return view('admin.listings.library');
    }

    public function parents() {
        return view('admin.listings.parents');
    }

    public function fee_managements() {
        return view('admin.listings.fee_management');
    }

    public function school() {
        return view('admin.listings.school');
    }


}
