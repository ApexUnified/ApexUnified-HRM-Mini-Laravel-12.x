<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{

    public function index()
    {
        $loans = Loan::orderBy("created_at", "DESC")->get();
        return view("Loans.index", compact("loans"));
    }


    public function create()
    {
        $employees = Employee::all();
        return view("Loans.create", compact("employees"));
    }

    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'loan_type' => 'required',
            'description' => 'nullable',
            'loan_amount' => 'required|numeric',
            'loan_deduction_amount' => 'required|numeric',
            'loan_date' => 'required|date',
            'repayment_date' => 'required|date'
        ], [
            'employee_id.required' => 'Employee Is Required For Creating Loan',
            'employee_id.exists' => "Selected Employee Must be already Exists In The System",

        ]);

        $validated_req["remeaning_loan"] =  $validated_req["loan_amount"];

        $create = Loan::create($validated_req);
        if ($create) {
            Toastr()->success('Loan created successfully');
            return redirect()->route('loan.index');
        } else {
            Toastr()->error('Failed to create loan');
            return redirect()->back();
        }
    }




    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Loan not found');
            return redirect()->back();
        }

        $loan = Loan::find($id);
        if (empty($loan)) {
            Toastr()->error('Loan not found');
            return redirect()->back();
        }

        $employees = Employee::all();
        return view("Loans.edit", compact("loan", "employees"));
    }

    public function update(Request $request, string $id)
    {

        if (empty($id)) {
            Toastr()->error('Loan not found');
            return redirect()->back();
        }

        $validated_req = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'loan_type' => 'required',
            'description' => 'nullable',
            'loan_date' => 'required|date',
            'repayment_date' => 'required|date',
            'loan_amount' => 'required|numeric',
            'loan_deduction_amount' => 'required|numeric',
            'remeaning_loan' => 'nullable',
            'status' => 'required|in:Active,Completed'
        ], [
            'employee_id.required' => 'Employee Is Required For Creating Loan',
            'employee_id.exists' => "Selected Employee Must be  Exists In The System",

        ]);


        if ($validated_req['remeaning_loan'] < 1) {
            $validated_req["status"] = "Completed";
        }

        $loan = Loan::find($id);


        if ($loan->update($validated_req)) {
            Toastr()->success('Loan updated successfully');
            return redirect()->route('loan.index');
        } else {
            Toastr()->error('Failed to update loan');
            return redirect()->back();
        }
    }


    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Loan not found');
            return redirect()->back();
        }

        $loan = Loan::find($id);
        if (empty($loan)) {
            Toastr()->error('Loan not found');
            return redirect()->back();
        }


        if ($loan->delete()) {
            Toastr()->success('Loan deleted successfully');
            return redirect()->route("loan.index");
        } else {
            Toastr()->error('Failed to delete loan');
            return redirect()->back();
        }
    }


    public function deletebyselection(Request $request)
    {
        $ids = $request->input("loan_ids");
        $loans = Loan::whereIn('id', $ids)->get();

        if ($loans->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete loans'
            ]);
        }


        foreach ($loans as $loan) {
            $loan->delete();
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Loans deleted successfully'
        ]);
    }
}
