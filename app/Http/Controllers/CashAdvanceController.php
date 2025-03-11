<?php

namespace App\Http\Controllers;

use App\Models\CashAdvance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CashAdvanceController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware("permission:Cash Advance View", ["only" => "index"]),
            new Middleware("permission:Cash Advance Create", ["only" => "create", "store"]),
            new Middleware("permission:Cash Advance Edit", ["only" => "Edit", "update"]),
            new Middleware("permission:Cash Advance Delete", ["only" => "destroy", "deletebyselection"]),
        ];
    }

    public function index()
    {
        $cash_advances = CashAdvance::orderBy("created_at", "DESC")->get();
        return view("Cash_Advances.index", compact("cash_advances"));
    }


    public function create()
    {
        $employees = Employee::all();
        return view("Cash_Advances.create", compact("employees"));
    }


    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'advance_date' => 'required|date',
            'advance_type' => 'required',
            'advance_amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'nullable'
        ], [
            'employee_id.required' => "Employee is Required",
            'employee_id.exists' => "Selected Employee Must be Exists In The System",
            'advance_amount.regex' => "The Amount Field Only Accepts 2 decimal Points"
        ]);

        $create = CashAdvance::create($validated_req);
        if ($create) {
            Toastr()->success('Cash Advance Created Successfully');
            return redirect()->route("cash-advance.index");
        } else {
            Toastr()->error('Failed to create Cash Advance');
            return redirect()->back();
        }
    }


    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Cash Advance not found');
            return redirect()->back();
        }
        $cash_advance = CashAdvance::find($id);
        if (empty($cash_advance)) {
            Toastr()->error('Cash Advance not found');
            return redirect()->back();
        }
        $employees = Employee::all();
        return view("Cash_Advances.edit", compact("cash_advance", "employees"));
    }


    public function update(Request $request, string $id)
    {

        if (empty($id)) {
            Toastr()->error('Cash Advance not found');
            return redirect()->back();
        }

        $validated_req = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'advance_date' => 'required|date',
            'advance_type' => 'required',
            'advance_amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'advance_status' => 'required|in:Pending,Approved,Rejected,Disbused,Settled',
            'description' => 'nullable'
        ], [
            'employee_id.required' => "Employee is Required",
            'employee_id.exists' => "Selected Employee Must be Exists In The System",
            'advance_amount.regex' => "The Amount Field Only Accepts 2 decimal Points"
        ]);

        $cash_advance = CashAdvance::find($id);

        if (empty($cash_advance)) {
            Toastr()->error('Cash Advance not found');
            return redirect()->back();
        }

        if ($cash_advance->update($validated_req)) {
            Toastr()->success('Cash Advance updated successfully');
            return redirect()->route("cash-advance.index");
        } else {
            Toastr()->error('Failed to update cash advance');
            return redirect()->back();
        }
    }


    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Cash Advance not found');
            return redirect()->back();
        }
        $cash_advance = CashAdvance::find($id);
        if (empty($cash_advance)) {
            Toastr()->error('Cash Advance not found');
            return redirect()->back();
        }

        if ($cash_advance->delete()) {
            Toastr()->success('Cash Advance deleted successfully');
            return redirect()->route('cash-advance.index');
        } else {
            Toastr()->error('Failed to delete cash advance');
            return redirect()->back();
        }
    }

    public function deletebyselection(Request $request)
    {
        $ids = $request->input("cash_advance_ids");
        $delete = CashAdvance::whereIn('id', $ids)->get();



        if ($delete->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete cash advances'
            ]);
        }

        foreach ($delete as $cashAdvance) {
            $cashAdvance->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Cash Advances deleted successfully'
        ]);
    }
}
