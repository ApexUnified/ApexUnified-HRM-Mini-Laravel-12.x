<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\Attendance;
use App\Models\CashAdvance;
use App\Models\Deduction;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\OverTime;
use App\Models\Payslip;
use App\Models\SalaryCalculation;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ReportController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware("permission:Reports View", ["only" => "attendance_report"]),
            new Middleware("permission:Reports View", ["only" => "loanPayments"]),
        ];
    }
    public function attendance_report(Request $request)
    {

        $attendances = Attendance::query()->latest();


        if ($request->filled("employee_id")) {
            $attendances = $attendances->where("employee_id", $request->input("employee_id"));
        }

        if ($request->filled("from")) {
            $attendances = $attendances->whereDate("attendance_date", ">=", $request->input("from"));
        }



        if ($request->filled("to")) {
            $attendances = $attendances->whereDate("attendance_date", "<=", $request->input("to"));
        }



        $attendances = $attendances->get();
        if ($request->hasAny(["from", "to"]) && $attendances->isEmpty()) {
            Toastr()->info("No Attendance Found ", [], "No Result Found");
        }

        $employees = Employee::all();
        return view("Reports.AttendanceReport.index", compact("attendances", "employees"));
    }




    public function loanPayments(Request $request)
    {

        $request->validate([
            "employee_id" => "nullable|exists:employees,id",
            "from" => "nullable|date|date_format:Y-m-d",
            "to" => "nullable|date|date_format:Y-m-d",
        ]);

        // return $request->all();
        $loanPayments = LoanPayment::query()->latest();

        if ($request->filled("employee_id")) {
            $loanPayments = $loanPayments->where("employee_id", $request->input("employee_id"));
        }


        if ($request->filled("from")) {
            $loanPayments = $loanPayments->whereDate("created_at", ">=", $request->input("from"));
        }

        if ($request->filled("to")) {
            $loanPayments = $loanPayments->whereDate("created_at", "<=", $request->input("to"));
        }


        $loanPayments = $loanPayments->get();

        if ($request->hasAny(["from", "to"]) && $loanPayments->isEmpty()) {
            Toastr()->info("No Loans Found", [], "No Result Found");
        }

        $employees = Employee::all();
        return view("Reports.LoanPayments.index", compact("loanPayments", "employees"));
    }
}
