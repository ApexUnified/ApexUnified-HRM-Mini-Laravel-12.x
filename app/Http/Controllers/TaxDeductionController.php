<?php

namespace App\Http\Controllers;

use App\Models\TaxDeduction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TaxDeductionController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware("permission:Tax Deduction View", ["only" => "index"]),
            new Middleware("permission:Tax Deduction Create", ["only" => "create", "store"]),
            new Middleware("permission:Tax Deduction Edit", ["only" => "Edit", "update"]),
            new Middleware("permission:Tax Deduction Delete", ["only" => "destroy", "deletebyselection"]),
        ];
    }

    public function index()
    {
        $taxDeductions = TaxDeduction::orderBy("created_at", "DESC")->get();
        return view("TaxDeductions.index", compact("taxDeductions"));
    }


    public function create()
    {
        return view("TaxDeductions.create");
    }


    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'tax_type' => 'required',
            'tax_percentage' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'tax_amount' => 'required|numeric',
            'description' => 'nullable'
        ], [
            'tax_percentage.regex' => "The Interest Field Only Accepts 2 decimal Points"
        ]);


        $create = TaxDeduction::create($validated_req);
        if ($create) {
            Toastr()->success("Tax Deduction added successfully");
            return redirect()->route("tax-deduction.index");
        } else {
            Toastr()->error("Failed To Add Tax Deduction");
            return redirect()->back();
        }
    }




    public function edit(string $id)
    {

        if (empty($id)) {
            Toastr()->error('Tax Deduction not found');
            return redirect()->back();
        }

        $taxDeduction = TaxDeduction::find($id);
        if (empty($taxDeduction)) {
            Toastr()->error('Tax Deduction not found');
            return redirect()->back();
        }
        return view("TaxDeductions.edit", compact("taxDeduction"));
    }


    public function update(Request $request, string $id)
    {

        if (empty($id)) {
            Toastr()->error('Tax Deduction not found');
            return redirect()->back();
        }


        $validated_req = $request->validate([
            'tax_type' => 'required',
            'tax_percentage' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'tax_amount' => 'required|numeric',
            'description' => 'nullable'
        ], [
            'tax_percentage.regex' => "The Interest Field Only Accepts 2 decimal Points"
        ]);


        $taxDeduction = TaxDeduction::find($id);

        if (empty($taxDeduction)) {
            Toastr()->error('Tax Deduction not found');
            return redirect()->back();
        }

        if ($taxDeduction->update($validated_req)) {
            Toastr()->success('Tax Deduction updated successfully');
            return redirect()->route("tax-deduction.index");
        } else {
            Toastr()->error('Failed to update Tax Deduction');
            return redirect()->back();
        }
    }


    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Tax Deduction not found');
            return redirect()->back();
        }

        $taxDeduction = TaxDeduction::find($id);
        if (empty($taxDeduction)) {
            Toastr()->error('Tax Deduction not found');
            return redirect()->back();
        }

        if ($taxDeduction->delete()) {
            Toastr()->success('Tax Deduction deleted successfully');
            return redirect()->route("tax-deduction.index");
        } else {
            Toastr()->error('Failed to delete Tax Deduction');
            return redirect()->back();
        }
    }

    public function deletebyselection(Request $request)
    {
        $ids = $request->input("tax_deduction_ids");
        $taxDeductions = TaxDeduction::whereIn('id', $ids)->get();

        if ($taxDeductions->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => "Failed to delete Tax Deduction"
            ]);
        }


        foreach ($taxDeductions as $taxDeduction) {
            $taxDeduction->delete();
        }

        return response()->json([
            'status' => true,
            'message' => "Tax Deductions deleted successfully"
        ]);
    }
}
