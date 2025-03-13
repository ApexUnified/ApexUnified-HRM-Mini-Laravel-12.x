<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\Attendance;
use App\Models\CashAdvance;
use App\Models\Deduction;
use App\Models\Leave;
use App\Models\Loan;
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
            // new Middleware("permission:Reports View", ["only" => "leave_report"]),
            // new Middleware("permission:Reports View", ["only" => "deduction_report"]),
            // new Middleware("permission:Reports View", ["only" => "overtime_report"]),
            // new Middleware("permission:Reports View", ["only" => "cash_advance_report"]),
        ];
    }
    public function attendance_report(Request $request)
    {

        $attendances = Attendance::query();

        if (!empty($request->from) && !empty($request->to)) {
            $fromDate = Carbon::parse($request->from)->format("Y-m-d");
            $toDate = Carbon::parse($request->to)->endOfDay()->format("Y-m-d H:i:s");
            $attendances = $attendances->whereBetween("attendance_date", [$fromDate, $toDate]);
        } else if (!empty($request->from)) {
            $fromDate = Carbon::parse($request->from)->format("Y-m-d");
            $attendances = Attendance::whereDate("attendance_date", $fromDate);
        } else if (!empty($request->to)) {
            $toDate = Carbon::parse($request->to)->format("Y-m-d");
            $attendances = Attendance::whereDate("attendance_date", $toDate);

        }

        $attendances = $attendances->orderBy("created_at", "DESC")->get();
        if ($attendances->isEmpty()) {
            Toastr()->error("No Attendance Found ", [], "No Result Found");
        }
        return view("reports.attendance_report", compact("attendances"));
    }

    }
