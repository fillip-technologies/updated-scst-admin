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

        $leader = LeaderMessage::find($request->id);

        $oldData = [];
        if ($leader && $leader->minister) {
            $oldData = json_decode($leader->minister, true);
        }

        $storeFile = $oldData['profile'] ?? null;

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

        $leader = LeaderMessage::find($request->id);

        $oldData = [];
        if ($leader && $leader->secretary) {
            $oldData = json_decode($leader->secretary, true);
        }

        $storeFile = $oldData['profile'] ?? null;

        if ($request->hasFile('profile')) {

            if (! empty($oldData['profile']) && file_exists(public_path($oldData['profile']))) {
                unlink(public_path($oldData['profile']));
            }

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

        $leader = LeaderMessage::find($request->id);

        $oldData = [];
        if ($leader && $leader->ias_officer) {
            $oldData = json_decode($leader->ias_officer, true);
        }

        $storeFile = $oldData['profile'] ?? null;

        if ($request->hasFile('profile')) {

            if (! empty($oldData['profile']) && file_exists(public_path($oldData['profile']))) {
                unlink(public_path($oldData['profile']));
            }

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
