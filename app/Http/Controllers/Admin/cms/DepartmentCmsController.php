<?php

namespace App\Http\Controllers\Admin\cms;

use App\Http\Controllers\Controller;
use App\Models\LeaderMessage;
use App\Models\SchemaInitiactive;
use App\Models\StateSection;
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

    public function add_states(Request $request)
    {

        $request->validate([
            'schools_count' => 'required',
            'schools_label' => 'required',
            'students_count' => 'required',
            'students_label' => 'required',
            'teachers_count' => 'required',
            'teachers_label' => 'required',
        ]);

        $data = [
            'schools_count' => $request->schools_count,
            'schools_label' => $request->schools_label,
            'students_count' => $request->students_count,
            'students_label' => $request->students_label,
            'teachers_count' => $request->teachers_count,
            'teachers_label' => $request->teachers_label,
        ];

        StateSection::updateOrCreate(
            ['id' => $request->id],

            [
                'state_section' => json_encode($data),
            ]

        );

        return back()->with('success', 'Add/Update State Data');
    }

    public function add_schema(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tags' => 'required|string',
            'description' => 'required|string',
        ]);
        SchemaInitiactive::create([
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags,
        ]);

        return back()->with('success', 'Add Schema Successful');
    }

    public function editschema($id)
    {
        $editdata = SchemaInitiactive::findOrFail($id);
        $schemas = SchemaInitiactive::orderBy('id', 'desc')->paginate(2);

        return view('modules.department.website-cms.home.schemes', compact('schemas', 'editdata'));
    }

    public function updateschema(Request $request, $id)
    {
        $getdata = SchemaInitiactive::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'tags' => 'required|string',
            'description' => 'required|string',
        ]);

        $getdata->update([
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags,
        ]);

        return back()->with('success', 'Updated Schema Successful');
    }
}
