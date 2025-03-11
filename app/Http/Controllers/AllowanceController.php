<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\AllowanceType;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AllowanceController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware("permission:Allowance View", ["only" => "index"]),
            new Middleware("permission:Allowance Create", ["only" => "create", "store"]),
            new Middleware("permission:Allowance Edit", ["only" => "edit", "update"]),
            new Middleware("permission:Allowance Delete", ["only" => "destroy", "deletebyselection"]),
        ];
    }

    public function index()
    {
        $allowances = Allowance::all();
        return view("Allowance.index", compact("allowances"));
    }


    public function create()
    {
        $allowance_types = AllowanceType::all();
        if ($allowance_types->isEmpty()) {
            Toastr()->info("Allowance Types Are Empty Please Create First");
            return redirect()->route("allowance-type.create");
        }

        return view("Allowance.create", compact("allowance_types"));
    }


    public function store(Request $request)
    {

        $request->validate(
            ['eligibility_type' => 'nullable', 'eligibility_value' =>  'nullable|required_with:eligibility_type']
        );

        $validated_req = $request->validate([
            'allowance_type' => 'required',
            'frequency' => 'required|in:Daily,Monthly,Quarterly,Annually',
            'allowance_amount' => 'required|numeric'
        ]);


        $eligibility = [
            $request->input("eligibility_type") => $request->input("eligibility_value")
        ];

        if (empty(array_key_first($eligibility))) {
            $validated_req["eligibility"] = null;
        } else {
            $validated_req["eligibility"] = json_encode($eligibility);
        }


        $create = Allowance::create($validated_req);
        if ($create) {
            Toastr()->success("Allowance created successfully");
            return redirect()->route('allowance.index');
        } else {
            Toastr()->error("Failed to create allowance");
            return redirect()->back();
        }
    }



    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Allowance not found');
            return redirect()->back();
        }

        $allowance = Allowance::find($id);
        if (empty($allowance)) {
            Toastr()->error('Allowance not found');
            return redirect()->back();
        }

        $allowance_types = AllowanceType::all();
        if ($allowance_types->isEmpty()) {
            Toastr()->info("Allowance Types Are Empty Please Create First");
            return redirect()->route("allowance-type.create");
        }
        return view("Allowance.edit", compact("allowance", "allowance_types"));
    }


    public function update(Request $request, string $id)
    {

        if (empty($id)) {
            Toastr()->error('Allowance not found');
            return redirect()->back();
        }

        $request->validate(
            ['eligibility_type' => 'nullable', 'eligibility_value' =>  'nullable|required_with:eligibility_type']
        );

        $validated_req = $request->validate([
            'allowance_type' => 'required',
            'frequency' => 'required|in:Daily,Monthly,Quarterly,Annually',
            'allowance_amount' => 'required|numeric'
        ]);


        $eligibility = [
            $request->input("eligibility_type") => $request->input("eligibility_value")
        ];

        if (empty(array_key_first($eligibility))) {
            $validated_req["eligibility"] = null;
        } else {
            $validated_req["eligibility"] = json_encode($eligibility);
        }



        $allowance = Allowance::find($id);
        if (empty($allowance)) {
            Toastr()->error('Allowance not found');
            return redirect()->back();
        }

        if ($allowance->update($validated_req)) {
            Toastr()->success('Allowance updated successfully');
            return redirect()->route("allowance.index");
        } else {
            Toastr()->error('Failed to update allowance');
            return redirect()->back();
        }
    }


    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Allowance not found');
            return redirect()->back();
        }

        $allowance = Allowance::find($id);
        if (empty($allowance)) {
            Toastr()->error('Allowance not found');
            return redirect()->back();
        }

        if ($allowance->delete()) {
            Toastr()->success('Allowance deleted successfully');
            return redirect()->route('allowance.index');
        } else {
            Toastr()->error('Failed to delete allowance');
            return redirect()->back();
        }
    }

    public function deletebyselection(Request $request)
    {
        $ids = $request->input("allowance_ids");

        $allowances = Allowance::whereIn('id', $ids)->get();

        if ($allowances->isEmpty()) {
            return response()->json(["status" => false, "message" => "Allowances Not Found"]);
        }

        foreach ($allowances as $allowance) {
            $allowance->delete();
        }

        return response()->json(["status" => true, "message" => "Allowances deleted successfully"]);
    }

    public function alowanceEligbilityData(string $eligibility)
    {
        if (empty($eligibility)) {
            return response()->json([
                'status' => false,
                'message' => 'Selected Eligibility Not Found'
            ]);
        }

        $departments = Department::select(["id", "department_name"])->get()->map(function ($department) {
            return ['id' => $department->id, 'name' => $department->department_name];
        });

        $positions = Position::select(["id", "position_name"])->get()->map(function ($position) {
            return ['id' => $position->id, 'name' => $position->position_name];
        });
        if ($eligibility == "department") {
            return response()->json([
                'status' => true,
                'data' => $departments
            ]);
        } elseif ($eligibility == "position") {
            return response()->json([
                'status' => true,
                'data' => $positions
            ]);
        }


        return response()->json([
            'status' => 'false',
            'message' => 'Invalid Eligibility'
        ]);
    }
}
