<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Overtime;
use App\Models\OvertimePay;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class OvertimeController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware("permission:Overtime View", ["only" => "index"]),
            new Middleware("permission:Overtime Create", ["only" => "create", "store"]),
            new Middleware("permission:Overtime Edit", ["only" => "edit", "update"]),
            new Middleware("permission:Overtime Delete", ["only" => "destroy", "deletebyselection"]),
        ];
    }

    public function index()
    {
        $overtimes = Overtime::latest()->get();

        return view("Overtimes.index", compact("overtimes"));
    }

    public function create()
    {
        $employees = Employee::all();
        $overtime_pay = OvertimePay::first();

        if (empty($overtime_pay)) {
            Toastr()->error("Please Create Overtime Pay For Employee To Assign Overtime");
            return back();
        }

        return view("Overtimes.create", compact("employees", "overtime_pay"));
    }

    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'hours_worked' => 'required|numeric|decimal:0,2',
            'rate_per_hour' => 'required|numeric|decimal:0,2',
        ]);


        $validated_req["total_overtime_pay"] = $validated_req["rate_per_hour"] * $validated_req["hours_worked"];


        if (Overtime::create($validated_req)) {
            Toastr()->success("Overtime Has Been Added Succesfully");
            return redirect()->route("overtime.index");
        } else {
            Toastr()->error("Failed to Added Overtime");
            return back();
        }
    }


    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error("Overtime Id Is Required");
            return back();
        }


        $overtime = Overtime::find($id);

        if (empty($overtime)) {
            Toastr()->error("Overtime Not Found");
            return back();
        }


        $overtime_pay = OvertimePay::first();

        if (empty($overtime_pay)) {
            Toastr()->error("Please Create Overtime Pay For Employee To Assign Overtime");
            return back();
        }


        $employees = Employee::all();
        return view("Overtimes.edit", compact("overtime", "employees", "overtime_pay"));
    }


    public function update(Request $request, string $id)
    {

        $validated_req = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'hours_worked' => 'required|numeric|decimal:0,2',
            'rate_per_hour' => 'required|numeric|decimal:0,2',
        ]);


        $validated_req["total_overtime_pay"] = $validated_req['rate_per_hour'] * $validated_req["hours_worked"];


        $overtime = Overtime::find($id);

        if (empty($overtime)) {
            Toastr()->error("Overtime Not Found");
            return back();
        }


        if ($overtime->update($validated_req)) {
            Toastr()->success("Overtime Has Been Updated Succesfully");
            return redirect()->route("overtime.index");
        } else {
            Toastr()->error("Failed to Update Overtime");
            return back();
        }
    }

    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error("Overtime Id Is Required");
            return back();
        }


        $overtime = Overtime::find($id);

        if (empty($overtime)) {
            Toastr()->error("Overtime Not Found");
            return back();
        }


        if ($overtime->delete()) {
            Toastr()->success("Overtime Has Been Deleted Succesfully");
            return redirect()->route("overtime.index");
        } else {
            Toastr()->error("Failed to Delete Overtime");
            return back();
        }
    }

    public function deletebyselection(Request $request)
    {
        $ids = $request->input("overtime_ids");

        $overtimes = Overtime::whereIn("id", $ids)->get();


        if ($overtimes->isEmpty()) {
            return response()->json(['status' => false, 'message' => "Overtimes Not Found"]);
        }


        foreach ($overtimes as $overtime) {
            $overtime->delete();
        }


        return response()->json(["status" => true, "message" => "Overtimes Has Been Deleted Succesfully"]);
    }
}
