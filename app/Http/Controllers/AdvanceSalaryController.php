<?php

namespace App\Http\Controllers;

use App\Models\AdvanceSalary;
use App\Models\Employee;
use Illuminate\Http\Request;

class AdvanceSalaryController extends Controller
{

    public function index()
    {
        $advance_salaries = AdvanceSalary::orderBy("created_at", "DESC")->get();
        return view("AdvanceSalaries.index", compact("advance_salaries"));
    }


    public function create()
    {
        $employees = Employee::all();
        return view("AdvanceSalaries.create", compact("employees"));
    }


    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'advance_salary_date' => 'required|date',
            'advance_salary_reason' => 'required',
            'advance_salary_amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'nullable'
        ], [
            'employee_id.required' => "Employee is Required",
            'employee_id.exists' => "Selected Employee Must be Exists In The System",
            'advance_amount.regex' => "The Amount Field Only Accepts 2 decimal Points"
        ]);


        $create = AdvanceSalary::create($validated_req);
        if ($create) {
            Toastr()->success('Advance Salary Created Successfully');
            return redirect()->route("advance-salary.index");
        } else {
            Toastr()->error('Failed to create Advance Salary');
            return redirect()->back();
        }
    }



    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Advance Salary not found');
            return redirect()->back();
        }
        $advance_salary = AdvanceSalary::find($id);
        if (empty($advance_salary)) {
            Toastr()->error('Advance Salary not found');
            return redirect()->back();
        }

        $employees = Employee::all();
        return view("AdvanceSalaries.edit", compact("advance_salary", "employees"));
    }

    public function update(Request $request, string $id)
    {
        if (empty($id)) {
            Toastr()->error('Advance Salary not found');
            return redirect()->back();
        }

        $validated_req = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'advance_salary_date' => 'required|date',
            'advance_salary_reason' => 'required',
            'advance_salary_amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'advance_salary_status' => 'required|in:Pending,Approved,Rejected,Disbused,Settled',
            'description' => 'nullable'
        ], [
            'employee_id.required' => "Employee is Required",
            'employee_id.exists' => "Selected Employee Must be Exists In The System",
            'advance_amount.regex' => "The Amount Field Only Accepts 2 decimal Points"
        ]);

        $advance_salary = AdvanceSalary::find($id);
        if (empty($advance_salary)) {
            Toastr()->error('Advance Salary not found');
            return redirect()->back();
        }

        if ($advance_salary->update($validated_req)) {
            Toastr()->success('Advance Salary updated successfully');
            return redirect()->route("advance-salary.index");
        } else {
            Toastr()->error('Failed to update Advance Salary');
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Advance Salary not found');
            return redirect()->back();
        }
        $advance_salary = AdvanceSalary::find($id);
        if (empty($advance_salary)) {
            Toastr()->error('Advance Salary not found');
            return redirect()->back();
        }

        if ($advance_salary->delete()) {
            Toastr()->success('Advance Salary deleted successfully');
            return redirect()->route('advance-salary.index');
        } else {
            Toastr()->error('Failed to delete Advance Salary');
            return redirect()->back();
        }
    }

    public function deletebyselection(Request $request)
    {
        $ids = $request->input("advance_salary_ids");
        $advance_salaries = AdvanceSalary::whereIn('id', $ids)->get();

        if ($advance_salaries->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => "Advance Salaries not found"
            ]);
        }

        $delete = AdvanceSalary::whereIn('id', $ids)->delete();

        if ($delete) {
            return response()->json([
                'status' => true,
                'message' => "Advance Salaries deleted successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Failed to delete Advance Salaries"
            ]);
        }
    }
}
