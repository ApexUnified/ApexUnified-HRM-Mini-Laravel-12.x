<?php

namespace App\Http\Controllers;

use App\Models\Jobnature;
use App\Models\JobNatureType;
use Illuminate\Http\Request;

class JobNatureTypeController extends Controller
{

    public function index()
    {
        $jobnature_types = JobNatureType::orderBy("created_at", "DESC")->get();
        return view("setting.JobnatureTypes.index", compact("jobnature_types"));
    }


    public function create()
    {
        return view("setting.JobnatureTypes.create");
    }


    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'jobnature_type' => 'required',
        ]);

        $create =  JobNatureType::create($validated_req);
        if ($create) {
            Toastr()->success("Job Nature Type Created Succesfully");
            return redirect()->route("jobnature-type.index");
        } else {
            Toastr()->error("Failed to Create Job Nature Type");
            return redirect()->back();
        }
    }


    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error("Job Nature Type not found");
            return redirect()->back();
        }

        $jobnature_type = JobNatureType::find($id);
        if (empty($jobnature_type)) {
            Toastr()->error("Job Nature Type not found");
            return redirect()->back();
        }
        return view("setting.JobnatureTypes.edit", compact("jobnature_type"));
    }


    public function update(Request $request, string $id)
    {

        if (empty($id)) {
            Toastr()->error("Job Nature Type not found");
            return redirect()->back();
        }

        $validated_req = $request->validate([
            'jobnature_type' => 'required',
        ]);

        $jobnature_type = JobNatureType::find($id);

        if (empty($jobnature_type)) {
            Toastr()->error("Job Nature Type not found");
            return redirect()->back();
        }

        Jobnature::where("job_nature_type", "=", $jobnature_type->jobnature_type)->update(["job_nature_type" => $request->input('jobnature_type')]);
        if ($jobnature_type->update($validated_req)) {
            Toastr()->success("Job Nature Type updated successfully");
            return redirect()->route("jobnature-type.index");
        } else {
            Toastr()->error("Failed to update Job Nature Type");
            return redirect()->back();
        }
    }


    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error("Job Nature Type not found");
            return redirect()->back();
        }

        $jobnature_type = JobNatureType::find($id);
        if (empty($jobnature_type)) {
            Toastr()->error("Job Nature Type not found");
            return redirect()->back();
        }

        if ($jobnature_type->delete()) {
            Toastr()->success("Job Nature Type deleted successfully");
            return redirect()->route("jobnature-type.index");
        } else {
            Toastr()->error("Failed to delete Job Nature Type");
            return redirect()->back();
        }
    }

    public function deletebyselection(Request $request)
    {
        $ids = $request->input("job_nature_type_ids");
        $jobnature_types = JobNatureType::whereIn('id', $ids)->delete();
        if (!empty($jobnature_types)) {
            return response()->json([
                'status' => true,
                'message' => "Job Nature Types deleted successfully",
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Failed to delete Job Nature Types",
            ]);
        }
    }
}
