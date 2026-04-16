<?php

namespace App\Http\Controllers\Mails;

use \Exception;
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
        try {
            $request->validate([
                'subject' => 'required|string',
                'message' => 'required|string',
                'reciver' => 'required',
            ]);


            if ($request->reciver === 'All Schools' || $request->reciver === 'District Coordinators') {

                if ($request->reciver === 'All Schools') {
                    $schooldata = School::pluck('official_email')->filter();
                } else {
                    // ✅ FIX: coordinators ke liye correct data
                    $schooldata = School::pluck('official_email')->filter();
                }

                foreach ($schooldata as $data) {

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

                return back()->with('success',
                    $request->reciver === 'All Schools'
                        ? 'Mail sent to all schools ✅'
                        : 'Mail sent to all coordinators ✅'
                );
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

        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
