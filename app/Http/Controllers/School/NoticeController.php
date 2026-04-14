<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Notices;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function SaveNotice(Request $request)
    {
        $request->validate([
            'notice_title' => 'required|string',
            'notice_description' => 'required|string',
            'notice_category' => 'required|string',
            'notice_publish_date' => 'required|date',
            'notice_badge' => 'required|string',
            'notice_attachment' => 'required|file|mimes:pdf,doc,docx',
            'school_id' => 'required',
        ]);

        $filePath = null;

        if ($request->hasFile('notice_attachment')) {
            $file = $request->file('notice_attachment');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $uploadPath = public_path('notices');

            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $file->move($uploadPath, $filename);
            $filePath = 'notices/'.$filename;
        }

        $noticeData = [
            'notice_title' => $request->notice_title,
            'notice_description' => $request->notice_description,
            'notice_category' => $request->notice_category,
            'notice_publish_date' => $request->notice_publish_date,
            'notice_badge' => $request->notice_badge,
            'notice_attachment' => $filePath,
        ];

        $section = Notices::where('school_id', $request->school_id)->first();

        if (! $section) {
            Notices::create([
                'school_id' => $request->school_id,
                'notice_manage' => json_encode([$noticeData]),
            ]);
        } else {

            $existingData = $section->notice_manage
                ? json_decode($section->notice_manage, true)
                : [];

            $existingData[] = $noticeData;

            $section->update([
                'notice_manage' => json_encode($existingData),
            ]);
        }

        return redirect()->back()->with('success', 'Notice saved successfully');
    }

    public function editNotice($index,$sid){
        $section = Notices::where('school_id', $sid)->first();
        $getdata = json_decode($section->notice_manage);

        $editdata = $getdata[$index];
        return view('modules.school.notices.edit_notice',compact('editdata','index'));
    }

    public function UpdateNotice(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'index' => 'required|integer',
            'notice_title' => 'required|string',
            'notice_description' => 'required|string',
            'notice_category' => 'required|string',
            'notice_publish_date' => 'required|date',
            'notice_badge' => 'required|string',
            'notice_attachment' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $section = Notices::where('school_id', $request->school_id)->first();

        if (! $section) {
            return back()->with('error', 'No data found');
        }

        $data = json_decode($section->notice_manage, true);

        if (! isset($data[$request->index])) {
            return back()->with('error', 'Invalid index');
        }


        if ($request->hasFile('notice_attachment')) {
            $file = $request->file('notice_attachment');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $uploadPath = public_path('notices');

            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $file->move($uploadPath, $filename);
            $filePath = 'notices/'.$filename;

            $data[$request->index]['notice_attachment'] = $filePath;
        }


        $data[$request->index]['notice_title'] = $request->notice_title;
        $data[$request->index]['notice_description'] = $request->notice_description;
        $data[$request->index]['notice_category'] = $request->notice_category;
        $data[$request->index]['notice_publish_date'] = $request->notice_publish_date;
        $data[$request->index]['notice_badge'] = $request->notice_badge;

        $section->update([
            'notice_manage' => json_encode($data),
        ]);

        return redirect()->route('school.website-cms.notices')->with('success', 'Notice updated successfully');
    }

    public function DeleteNotice(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'index' => 'required|integer',
        ]);
        $section = Notices::where('school_id', $request->school_id)->first();
        if (! $section) {
            return back()->with('error', 'No data found');
        }
        $data = json_decode($section->notice_manage, true);
        if (! isset($data[$request->index])) {
            return back()->with('error', 'Invalid index');
        }
        unset($data[$request->index]);
        $data = array_values($data);
        $section->update([
            'notice_manage' => json_encode($data),
        ]);

        return back()->with('success', 'Notice deleted successfully');
    }
}
