<?php

namespace App\Http\Controllers\School\Class;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function SaveClass(Request $request){
        $request->validate([
            'school_id'=>'required',
            'class'=>'required',
            'classname'=>'required',
        ]);

        $schoolId = trim($request->school_id);
        

    }
}
