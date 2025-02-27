<?php

namespace App\Http\Controllers;

use App\Models\Jobnature;
use App\Models\JobNatureType;
use Illuminate\Http\Request;

class JobNatureController extends Controller
{

    public function index()
    {
        $jobNatures = Jobnature::all();

        return view("Jobnature.index", compact("jobNatures"));
    }

    public function create()
    {
        $jobnature_types = JobNatureType::all();
        if ($jobnature_types->isEmpty()) {
            Toastr()->info('Job Nature Type not found Please Create Job Nature Type First Before Creating Job Nature');
            return redirect()->route("jobnature-type.create");
        }
        return view("Jobnature.create", compact("jobnature_types"));
    }

    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'job_nature_type' => 'required|exists:job_nature_types,jobnature_type',
            'description' => 'nullable',
        ]);

        $create = Jobnature::create($validated_req);

        if ($create) {
            Toastr()->success('Job Nature created successfully');
            return redirect()->route("jobnature.index");
        } else {
            Toastr()->error('Failed to create Job Nature');
            return redirect()->back();
        }
    }





    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Job Nature not found');
            return redirect()->back();
        }

        $jobNature = Jobnature::find($id);
        if (empty($jobNature)) {
            Toastr()->error('Job Nature not found');
            return redirect()->back();
        }

        $jobnature_types = JobNatureType::all();
        if ($jobnature_types->isEmpty()) {
            Toastr()->info('Job Nature Type not found Please Create Job Nature Type First Before Creating Job Nature');
            return redirect()->route("jobnature-type.create");
        }
        return view("Jobnature.edit", compact("jobNature", "jobnature_types"));
    }

    public function update(Request $request, string $id)
    {
        if (empty($id)) {
            Toastr()->error('Job Nature not found');
            return redirect()->back();
        }

        $validated_req = $request->validate([
            'job_nature_type' => 'required|exists:job_nature_types,jobnature_type',
            'description' => 'nullable',
        ]);


        $jobNature = Jobnature::find($id);
        if (empty($jobNature)) {
            Toastr()->error('Job Nature not found');
            return redirect()->back();
        }

        if ($jobNature->update($validated_req)) {
            Toastr()->success('Job Nature updated successfully');
            return redirect()->route("jobnature.index");
        } else {
            Toastr()->error('Failed to update Job Nature');
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Job Nature not found');
            return redirect()->back();
        }

        $jobNature = Jobnature::find($id);
        if (empty($jobNature)) {
            Toastr()->error('Job Nature not found');
            return redirect()->back();
        }

        if ($jobNature->delete()) {
            Toastr()->success('Job Nature has been deleted');
            return redirect()->route("jobnature.index");
        }
    }


    public function deletebyselection(Request $request)
    {

        $ids = $request->input("job_nature_ids");

        $jobNatures = Jobnature::whereIn("id", $ids)->get();

        if ($jobNatures->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No Job Nature Found For Selected IDs'
            ]);
        }


        foreach ($jobNatures as $jobNature) {
            $jobNature->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Selected Job Natures have been deleted'
        ]);
    }
}
