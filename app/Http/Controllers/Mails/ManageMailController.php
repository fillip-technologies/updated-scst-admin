<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ManageMailController extends Controller
{
    public function sentNotification(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string',
            ]);
            $data = [
                'school'=>$request->school,
                'principale'=> $request->principale,
                'message' => $request->message,
            ];
            Mail::to('developer4.filliptechnologies@gmail.com')->send(new SendMail($data));
            return back()->with('success','Email send SuccessFul');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}
