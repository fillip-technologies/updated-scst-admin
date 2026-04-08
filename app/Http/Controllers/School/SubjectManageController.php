<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectManageController extends Controller
{
    public function createSubject(Request $request){
       echo  $request->subject;

    }
}
