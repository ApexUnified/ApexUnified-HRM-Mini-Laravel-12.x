<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\AllowanceType;
use Illuminate\Http\Request;

class AllowanceTypeController extends Controller
{

    public function index()
    {
        $allowance_types = AllowanceType::orderBy("created_at", "DESC")->get();
        return view("setting.AllowanceTypes.index", compact("allowance_types"));
    }


    public function create()
    {
        return view("setting.AllowanceTypes.create");
    }

    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'allowance_type' => 'required',
        ]);

        $create = AllowanceType::create($validated_req);
        if ($create) {
            Toastr()->success('Allowance Type Created Successfully');
            return redirect()->route("allowance-type.index");
        } else {
            Toastr()->error('Failed to create Allowance Type');
            return redirect()->back();
        }
    }


    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Allowance Type not found');
            return redirect()->back();
        }

        if ($id == 1) {
            Toastr()->error('You Cannot Edit This System Reserved Allowance Type ');
            return redirect()->back();
        }

        $allowance_type = AllowanceType::find($id);
        if (empty($allowance_type)) {
            Toastr()->error('Allowance Type not found');
            return redirect()->back();
        }

        return view("setting.AllowanceTypes.edit", compact("allowance_type"));
    }


    public function update(Request $request, string $id)
    {
        if (empty($id)) {
            Toastr()->error('Allowance Type not found');
            return redirect()->back();
        }

        if ($id == 1) {
            Toastr()->error('You Cannot Edit This System Reserved Allowance Type ');
            return redirect()->back();
        }

        $validated_req = $request->validate([
            'allowance_type' => 'required',
        ]);

        $allowanceType = AllowanceType::find($id);
        if (empty($allowanceType)) {
            Toastr()->error('Allowance Type not found');
            return redirect()->back();
        }

        Allowance::where("allowance_type", "=", $allowanceType->allowance_type)->update(["allowance_type" => $request->input("allowance_type")]);
        if ($allowanceType->update($validated_req)) {
            Toastr()->success('Allowance Type updated successfully');
            return redirect()->route('allowance-type.index');
        } else {
            Toastr()->error('Failed to update Allowance Type');
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Allowance Type not found');
            return redirect()->back();
        }

        if ($id == 1) {
            Toastr()->error('You Cannot delete This System Reserved Allowance Type');
            return redirect()->back();
        }

        $allowanceType = AllowanceType::find($id);
        if (empty($allowanceType)) {
            Toastr()->error('Allowance Type not found');
            return redirect()->back();
        }

        if ($allowanceType->delete()) {
            Toastr()->success('Allowance Type deleted successfully');
            return redirect()->route('allowance-type.index');
        } else {
            Toastr()->error('Failed to delete Allowance Type');
            return redirect()->back();
        }
    }


    public function deletebyselection(Request $request)
    {
        $ids = $request->input("allowance_type_ids");

        if (in_array(1, $ids)) {
            return response()->json([
                'status' => false,
                'message' => "Your Selected Types Contains System Reserved Allowance Type Please Remove That Type"
            ]);
        }
        $delete = AllowanceType::whereIn('id', $ids)->delete();
        if ($delete) {
            return response()->json([
                'status' => true,
                'message' => "Allowance Types deleted successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Failed to delete Allowance Types"
            ]);
        }
    }
}
