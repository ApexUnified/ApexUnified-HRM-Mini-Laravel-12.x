<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payslip;
use Illuminate\Http\Request;

class PayslipController extends Controller
{

    public function index(Request $request)
    {
        $request->validate([
            'employee_id' => "nullable|exists:employees,id",
            'payslip_filter_from' => 'nullable|date_format:Y-m-d',
            'payslip_filter_to' => 'nullable|date_format:Y-m-d'
        ]);


        $payslips = Payslip::query()->latest();

        if ($request->filled("employee_id")) {
            $payslips = $payslips->where("employee_id", $request->input("employee_id"));
        }

        if ($request->filled("payslip_filter_from")) {
            $payslips = $payslips->whereDate("created_at", ">=", $request->input("payslip_filter_from"));
        }

        if ($request->filled("payslip_filter_to")) {
            $payslips = $payslips->whereDate("created_at", "<=", $request->input("payslip_filter_to"));
        }


        $payslips = $payslips->get();

        if ($request->hasAny(["employee_id", "payslip_filter_from", "payslip_filter_to"]) && $payslips->isEmpty()) {
            Toastr()->info("No Paylsips Found", [], "No Results Found :(");
        }

        $employees = Employee::all();
        return view("Payroll.Payslip.index", compact("payslips", "employees"));
    }


    public function create()
    {
        return view("Payroll.Payslip.create");
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        if (empty($id)) {
            Toastr()->error("Payslip Not Found");
            return back();
        }


        $payslip = Payslip::find($id);
        if (empty($payslip)) {
            Toastr()->error("Payslip Not Found");
            return back();
        }


        return view("Payroll.Payslip.show", compact("payslip"));
    }

    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error("Payslip Not Found");
            return back();
        }


        $payslip = Payslip::find($id);
        if (empty($payslip)) {
            Toastr()->error("Payslip Not Found");
            return back();
        }


        $employees = Employee::all();

        return view("Payroll.Payslip.edit", compact("payslip", "employees"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error("Payslip Not Found");
            return back();
        }


        $payslip = Payslip::find($id);
        if (empty($payslip)) {
            Toastr()->error("Payslip Not Found");
            return back();
        }

        if ($payslip->delete()) {
            Toastr()->success("Payslip Has Been Deleted Successfully");
            return redirect()->route("payslip.index");
        }
    }


    public function deletebyselection(Request $request)
    {
        $ids = $request->input("payslip_ids");


        $payslips = Payslip::whereIn("id", $ids)->get();

        if ($payslips->isEmpty()) {
            return response()->json(["status", false, "message" => "Payslips Not Found"]);
        }


        foreach ($payslips as $payslip) {
            $payslip->delete();
        }


        return response()->json(["status" => true, "message" => "Payslips Has Been Deleted Succesfully"]);
    }
}
