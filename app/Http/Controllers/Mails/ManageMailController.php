<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use App\Mail\NotificationMail;
use App\Mail\SendMail;
use App\Models\School;
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


        if ($request->reciver === 'All Schools' || $request->reciver === "District Coordinators") {

            $schooldata = School::pluck('official_email')->filter();

            foreach ($schooldata as $data) {

                $notidata = [
                    'message' => $request->message,
                    'subject' => $request->subject,
                    'reciver' => $data,
                ];

                Mail::to($data)->queue(new NotificationMail($notidata));
            }

            return back()->with('success', 'Mail sent to all schools ✅');
        }

        $recivers = is_array($request->reciver)
            ? $request->reciver
            : [$request->reciver];

        foreach ($recivers as $data) {

            if (! filter_var($data, FILTER_VALIDATE_EMAIL)) {
                continue;
            }

            $notidata = [
                'message' => $request->message,
                'subject' => $request->subject,
                'reciver' => $data,
            ];

            Mail::to($data)->queue(new NotificationMail($notidata));
        }

        return back()->with('success', 'Mail sent successfully ✅');
    }
}
