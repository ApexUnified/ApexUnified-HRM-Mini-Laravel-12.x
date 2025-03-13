<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DeductionController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware("permission:Deduction View", ["only" => "index"]),
            new Middleware("permission:Deduction Create", ["only" => "create", "store"]),
            new Middleware("permission:Deduction Edit", ["only" => "Edit", "update"]),
            new Middleware("permission:Deduction Delete", ["only" => "destroy", "deletebyselection"]),
        ];
    }

    public function index()
    {
        $deductions = Deduction::orderBy("created_at", "DESC")->get();
        return view("Deductions.index", compact("deductions"));
    }

    public function create()
    {
        return view("Deductions.create");
    }

    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'deduction_type' => 'required',
            'deduction_amount' => 'required|numeric',
            'description' => 'nullable',
        ]);


        $create = Deduction::create($validated_req);
        if ($create) {
            Toastr()->success("Deduction added successfully");
            return redirect()->route("deduction.index");
        } else {
            Toastr()->error("Failed To Add Deduction");
            return redirect()->back();
        }
    }



    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Deduction not found');
            return redirect()->back();
        }

        $deduction = Deduction::find($id);
        if (empty($deduction)) {
            Toastr()->error('Deduction not found');
            return redirect()->back();
        }

        return view("Deductions.edit", compact("deduction"));
    }


    public function update(Request $request, string $id)
    {
        if (empty($id)) {
            Toastr()->error('Deduction not found');
            return redirect()->back();
        }

        $validated_req = $request->validate([
            'deduction_type' => 'required',
            'deduction_amount' => 'required|numeric',
            'description' => 'nullable',
        ]);

        $deduction = Deduction::find($id);
        if (empty($deduction)) {
            Toastr()->error('Deduction not found');
            return redirect()->back();
        }

        if ($deduction->update($validated_req)) {
            Toastr()->success('Deduction updated successfully');
            return redirect()->route("deduction.index");
        } else {
            Toastr()->error('Failed to update deduction');
            return redirect()->back();
        }
    }


    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Deduction not found');
            return redirect()->back();
        }

        $deduction = Deduction::find($id);
        if (empty($deduction)) {
            Toastr()->error('Deduction not found');
            return redirect()->back();
        }

        if ($deduction->delete()) {
            Toastr()->success('Deduction deleted successfully');
            return redirect()->route("deduction.index");
        } else {
            Toastr()->error('Failed to delete deduction');
            return redirect()->back();
        }
    }
    public function deletebyselection(Request $request)
    {
        $ids = $request->input("deduction_ids");

        $deductions = Deduction::whereIn("id", $ids)->get();

        if ($deductions->isEmpty()) {
            return response()->json(["status" => false, "message" => "Deductions Not Found"]);
        }


        foreach ($deductions as $deduction) {
            $deduction->delete();
        }

        return response()->json([
            "status" => true,
            "message" => "Deductions deleted successfully"
        ]);
    }
}
