<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NoticeExport;
use App\Helpers\ManageCrud;
use App\Http\Controllers\Controller;
use App\Imports\NoticeImport;
use App\Models\MainNotice;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MainNoticeController extends Controller
{
    public function NoticeCreate(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file'=>'nullable|file',
            'date' => 'required|date',
            'description' => 'required|string',
            'notice_type' => 'required',
        ]);

        $uplaodImage = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $request->title.'.'.$file->getClientOriginalExtension();
            $upload = public_path('notice');
            $file->move($upload, $filename);
            $uplaodImage = 'notice/'.$filename;
        }
        $data = [
            'title' => $request->title,
            'date' => $request->date,
            'file' => $uplaodImage,
            'description' => $request->description,
            'notice_type' => $request->notice_type,
        ];

        $savedata = ManageCrud::createdatas(MainNotice::class, $data);
        if ($savedata) {
            return redirect()->back()->with('success', 'Notice Created SuccessFul');
        } else {
            return redirect()->back()->with('error', 'Notice Created Failed');

        }
    }

    public function NoticeUpdate(Request $request, $id)
    {

        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'notice_badge' => 'required',
            'description' => 'required|string',
            'notice_type' => 'required',
        ]);
        $edidata = MainNotice::findOrFail($id);
        $uplaodImage = $edidata->file;
        if ($request->hasFile('file')) {

            if (file_exists(public_path($edidata->file))) {
                unlink(public_path($edidata->file));
            }
            $file = $request->file('file');
            $filename = $request->name.'.'.$file->getClientOriginalExtension();
            $upload = public_path('notice');
            $file->move($upload, $filename);
            $uplaodImage = 'notice/'.$filename;
        }

        $data = [
            'title' => $request->title,
            'date' => $request->date,
            'notice_badge' => $request->notice_badge,
            'file' => $uplaodImage,
            'description' => $request->description,
            'notice_type' => $request->notice_type,
        ];

        $savedata = ManageCrud::updatedata(MainNotice::class, $id, $data);
        if ($savedata) {
            return redirect()->back()->with('success', 'Notice Update SuccessFul');
        } else {
            return redirect()->back()->with('error', 'Notice Updation Failed');

        }
    }

    public function NoticeEdit($id)
    {
        $notice = MainNotice::findOrFail($id);

    }

    public function NoticeDelete($id)
    {
        $notice = MainNotice::findOrFail($id);
        if ($notice) {
            $notice->delete();

            return redirect()->back()->with('success', 'Notice Delete SuccessFul');
        } else {
            return redirect()->back('error', 'Something Went Wrong');
        }

    }

    public function NoticeExport()
    {
        return Excel::download(new NoticeExport, 'notice.xlsx');
    }

    public function NoticeImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        Excel::import(new NoticeImport, $request->file('file'));

        return back()->with('success', 'Notices Imported Successfully!');
    }
}
