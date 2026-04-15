<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use App\Mail\NotificationMail;
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
                'school' => $request->school,
                'principale' => $request->principale,
                'message' => $request->message,
            ];
            Mail::to('developer4.filliptechnologies@gmail.com')->send(new SendMail($data));

            return back()->with('success', 'Email send SuccessFul');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }

   public function notificationsend(Request $request)
{
    $request->validate([
        'subject' => 'required|string',
        'message' => 'required|string',
        'reciver' => 'required',
    ]);


    $recivers = is_array($request->reciver)
        ? $request->reciver
        : [$request->reciver];

    if (is_array($recivers)) {
        foreach ($recivers as $data) {



            $notidata = [
                'message' => $request->message,
                'subject' => $request->subject,
                'reciver' => $data,
            ];

            Mail::to($data)->send(new NotificationMail($notidata));
        }

        return back()->with('success', 'Mail sent successfully ✅');
    } else {


        $notidata = [
            'message' => $request->message,
            'subject' => $request->subject,
            'reciver' => $request->reciver,
        ];

        Mail::to($request->reciver)->send(new NotificationMail($notidata));

        return back()->with('success', 'Mail sent successfully ✅');
    }
}
}
