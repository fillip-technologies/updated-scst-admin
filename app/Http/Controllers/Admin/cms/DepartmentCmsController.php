<?php

namespace App\Http\Controllers\Admin\cms;

use App\Http\Controllers\Controller;
use App\Models\LeaderMessage;
use Illuminate\Http\Request;

class DepartmentCmsController extends Controller
{
    public function minister_add(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'designation' => 'required',
        ]);

        $storeFile = null;

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $filename = time().'_'.$file->getClientOriginalName();
            $upload = public_path('leaders');
            $file->move($upload, $filename);
            $storeFile = 'leaders/'.$filename;
        }

        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'profile' => $storeFile,
            'message' => $request->message,
        ];

        LeaderMessage::updateOrCreate(
            ['id' => $request->id],
            [
                'minister' => json_encode($data),
            ]
        );

        return back()->with('success', 'Add/Update Minister Data');
    }

    public function secretary_add(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'designation' => 'required',
        ]);

        $storeFile = null;

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $filename = time().'_'.$file->getClientOriginalName();
            $upload = public_path('secretarys');
            $file->move($upload, $filename);
            $storeFile = 'leaders/'.$filename;
        }

        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'profile' => $storeFile,
            'message' => $request->message,
        ];

        LeaderMessage::updateOrCreate(
            ['id' => $request->id],
            [
                'secretary' => json_encode($data),
            ]
        );

        return back()->with('success', 'Add/Update Secretary Data');

    }

    public function ias_officer_add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
        ]);

        $storeFile = null;

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $filename = time().'_'.$file->getClientOriginalName();
            $upload = public_path('leaders');
            $file->move($upload, $filename);
            $storeFile = 'leaders/'.$filename;
        }

        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'profile' => $storeFile,
            'message' => $request->message,
        ];

        LeaderMessage::updateOrCreate(
            ['id' => $request->id],
            [
                'ias_officer' => json_encode($data),
            ]
        );

        return back()->with('success', 'Add/Update IAS Officer Data');
    }

    public function schema_initiactives() {}
}
