<?php

namespace App\Livewire\Payslip;

use App\Models\Allowance;
use App\Models\AttendancePayDeduction;
use App\Models\Bonus;
use App\Models\Deduction;
use App\Models\Employee;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\OvertimePay;
use App\Models\Payslip;
use App\Models\Setting;
use App\Models\TaxDeduction;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
{


    public $employee_id;
    public $showForm = false;
    public $isDisabled = false;

    // This Property Is For To SHow Selected Allowances For Employee;
    public $eligibleAllowances = [];

    protected $rules = [
        'employee_id' => 'required|exists:employees,id'
    ];


    protected $messages = [
        "employee_id" => "Employee is Required",
        "employee_id.exists" => "Selected Employee Must Be Exists In Database"
    ];


    // These Properties Just For Getting Array From Frontend Start
    public $allowances_arr = [];
    public $tax_deductions_arr = [];
    public $deductions_arr = [];
    public $bonuses_arr = [];
    // These Properties Just For Getting Array From Frontend End


    public $employeeid = 0;
    public $base_salary = 0;
    public $bonus_amount = 0;
    public $allowance_amount = 0;
    public $deduction_amount = 0;
    public $tax_deduction_amount = 0;
    public $overtime_pay = 0;
    public $late_absent_deduction = 0;
    public $loan_deduction = 0;
    public $net_salary = 0;


    public function updated()
    {
        $this->dispatch('refresh-select-picker');
    }

    public function checkEmployee()
    {
        $this->dispatch('refresh-select-picker');
        $this->validate();

        $employee = Employee::find($this->employee_id);
        $total_days_in_month = now()->daysInMonth;

        // Assigning Employee Id To Global Employeeid Property
        $this->employeeid = $employee->id;

        $this_month_attendances = $employee->this_month_total_attendances; // Just For Emergency Now Not Needed

        $this_month_overtimes = $employee->this_month_overtimes;
        $this_month_late_count = $employee->this_month_late_attendances_count;
        $this_month_absent_count = $employee->this_month_absent_attendances_count;



        // Salary Fetched
        $salary = $employee->salary;


        // From Salary Daily Salary Fetched
        $daily_salary = $salary / $total_days_in_month;

        // From Overtime The Pay Of Overtime Overs Fetched And Calculated
        $overtimePay = OvertimePay::first();
        $this_month_overtime_pay = !empty($this_month_overtimes) ?  $this_month_overtimes * $overtimePay->overtime_pay : 0;



        // From Deduction Pay Module Getting Values Of Late Deduction If late count = 1 and days = 1 it means Each Late
        // Will Be deducted As One Day Leave
        $attendanceDeduction = AttendancePayDeduction::first();
        $late_count_threshold = $attendanceDeduction->late_count ?? 3; // Default 3 lates
        $days_deduction_for_lates = $attendanceDeduction->days ?? 1; // Default 1 day for 3 lates

        // Late And Absent Deduction From Attendance Done
        $late_deduction_days = floor($this_month_late_count / $late_count_threshold) * $days_deduction_for_lates;
        $late_deduction = $late_deduction_days * $daily_salary;
        $absent_deduction = $this_month_absent_count * $daily_salary;



        // Loans Deduction (First Check If Any Loan Exists For This Employee)
        $loans = $employee->loan()->where("status", "Active")->get();

        // Initially Deduction Of Loan Amount = 0
        $loan_deduction_amount = 0;

        if ($loans->isNotEmpty()) {
            foreach ($loans as $loan) {

                //  Adding Value In $loan_deduction_amount variable
                $loan_deduction_amount += $loan->adjusted_deduction_amount;
            }
        }

        // Late And Absent Deduction
        $late_absent_deduction_amount = $absent_deduction + $late_deduction;

        // This Is Total Salary After Calculation
        $final_salary = $salary
            - $late_absent_deduction_amount
            - ($loan_deduction_amount ?? 0)
            + ($this_month_overtime_pay ?? 0);



        $allowances = Allowance::all();
        $eligibleAllowancess = $allowances->filter(function ($allowance) use ($employee) {
            $eligibility = json_decode($allowance->eligibility, true);

            $isEligible = false;

            if (isset($eligibility['department'])) {
                $isEligible  = in_array($employee->department_id, $eligibility['department']);
            }

            if (isset($eligibility["position"])) {
                $isEligible = in_array($employee->position_id, $eligibility['position']);
            }


            if (empty($allowance->eligibility)) {
                $isEligible = $allowance->whereNull("eligibility");
            }

            return $isEligible;
        });

        $this->eligibleAllowances = $eligibleAllowancess->values()->toArray();



        // This Property is to Show Net Salary In Payslip Creation Form And Other Properties To SHow 
        $this->base_salary = $salary;
        $this->loan_deduction = $loan_deduction_amount;
        $this->late_absent_deduction = $late_absent_deduction_amount;
        $this->overtime_pay = $this_month_overtime_pay;
        $this->net_salary = $final_salary;
        $this->showForm = true;
        $this->isDisabled = true;



        // dump([
        //     'base_salary' => $this->base_salary,
        //     "allowance" => $this->allowance_amount,
        //     'loan' => $this->loan_deduction,
        //     'late_absent' => $this->late_absent_deduction,
        //     'overtime' => $this->overtime_pay,
        //     'bonus' => $this->bonus_amount,
        //     'deduction' => $this->deduction_amount,
        //     'tax_deduction' => $this->tax_deduction_amount,
        //     'net_salary' => $this->net_salary,
        // ]);
    }


    public function calculateFinalSalary()
    {

        $this->validate([
            'allowances_arr.*' => 'sometimes|exists:allowances,id',
            'bonuses_arr.*' => 'sometimes|exists:bonuses,id',
            'deductions_arr.*' => 'sometimes|exists:deductions,id',
            'tax_deductions_arr.*' => 'sometimes|exists:tax_deductions,id',
        ]);


        if (isset($this->allowances_arr) && count($this->allowances_arr) > 0) {

            // Subtracting Allowance Amount Because Its Calculating Again // Prevent Duplication
            $this->net_salary -= $this->allowance_amount;

            // Reseting The Allowance Amount Property To Be Calculated Again
            $this->allowance_amount = 0;


            $allowances = Allowance::whereIn("id", $this->allowances_arr)->sum("allowance_amount");

            $this->allowance_amount = $allowances;
            $this->net_salary += $allowances;
        } else {
            $this->net_salary -=  $this->allowance_amount;
            $this->allowance_amount = 0;
        }

        if (isset($this->bonuses_arr) && count($this->bonuses_arr) > 0) {

            // Subtracting Bonus Amount Because Its Calculating Again // Prevent Duplication
            $this->net_salary -= $this->bonus_amount;

            // Reseting The Bonus Amount Property To Be Calculated Again
            $this->bonus_amount = 0;

            $bonuses = Bonus::whereIn("id", $this->bonuses_arr)->sum("bonus_amount");

            $this->bonus_amount = $bonuses;
            $this->net_salary += $bonuses;
        } else {
            $this->net_salary -=  $this->bonus_amount;
            $this->bonus_amount = 0;
        }

        if (isset($this->deductions_arr) && count($this->deductions_arr) > 0) {

            // Adding  Deduction Amount Because Its Calculating Again // Prevent Duplication
            $this->net_salary += $this->deduction_amount;

            // Reseting The Deduction Amount Property To Be Calculated Again
            $this->deduction_amount = 0;

            $deductions = Deduction::whereIn("id", $this->deductions_arr)->sum("deduction_amount");
            $this->deduction_amount = $deductions;
            $this->net_salary -= $deductions;
        } else {
            $this->net_salary += $this->deduction_amount;
            $this->deduction_amount = 0;
        }

        if (isset($this->tax_deductions_arr) && count($this->tax_deductions_arr) > 0) {

            // Adding Tax Deduction Amount Because Its Calculating Again // Prevent Duplication
            $this->net_salary += $this->tax_deduction_amount;

            // Reseting The Tax Deduction Amount Property To Be Calculated Again
            $this->tax_deduction_amount = 0;

            $tax_deductions = TaxDeduction::whereIn("id", $this->tax_deductions_arr)->sum("tax_amount");

            $this->tax_deduction_amount = $tax_deductions;
            $this->net_salary -= $tax_deductions;
        } else {
            $this->net_salary += $this->tax_deduction_amount;
            $this->tax_deduction_amount = 0;
        }

        $this->dispatch('refresh-select-picker');
        // dump([
        //     'allowances' => $this->allowances_arr,
        //     'deductions' => $this->deductions_arr,
        //     'tax_deductions' => $this->tax_deductions_arr,
        //     'bonuses' => $this->bonuses_arr,

        //     'allowance_sum' => $this->allowance_amount,
        //     'bonus_sum' => $this->bonus_amount,
        //     'deduction_sum' => $this->deduction_amount,
        //     'tax_deductions_sum' => $this->tax_deduction_amount,
        // ]);
    }




    public function createPayslip()
    {

        $current_month = Carbon::now()->month;
        if (Payslip::where("employee_id", $this->employeeid)->whereMonth("created_at", $current_month)->exists()) {
            $this->dispatch("payslip-already-exists");
        } else {

            if (empty($this->base_salary)) {
                $this->dispatch('refresh-select-picker');
                $this->dispatch("payslip-error-base-salary-not-set");
                return;
            }

            $create = Payslip::create([
                'employee_id' => $this->employeeid,
                'base_salary' => $this->base_salary,
                'bonus' => $this->bonus_amount,
                'allowance' => $this->allowance_amount,
                'deduction' => $this->deduction_amount,
                'tax_deduction' => $this->tax_deduction_amount,
                'overtime' => $this->overtime_pay,
                'attendance_deduction' => $this->late_absent_deduction,
                'loan_deduction' => $this->loan_deduction,
                'net_salary' => $this->net_salary,
                'status' => "pending"
            ]);

            if ($create) {
                $this->dispatch("payslip-created");
                $this->deductLoanAmount();

                $this->isDisabled = false;
                $this->showForm = false;

                $this->reset();
            } else {
                $this->dispatch("payslip-error");
            }
        }

        $this->dispatch('refresh-select-picker');
    }


    protected function deductLoanAmount()
    {
        $loans = Loan::where("employee_id", $this->employeeid)->where("status", "Active")->get();

        foreach ($loans as $loan) {

            $loan->remeaning_loan -= $loan->adjusted_deduction_amount;

            if ($loan->remeaning_loan == $loan->adjusted_deduction_amount) {
                $loan->status = "Completed";
            }


            LoanPayment::create([
                'employee_id' => $loan->employee->id,
                'loan_type' => $loan->loan_type,
                'loan_amount' => $loan->loan_amount,
                'remeaning_loan' => $loan->remeaning_loan,
                'loan_deduction_amount' => $loan->loan_deduction_amount,
                'status' => $loan->status,
                'description' => $loan->description,
            ]);

            $loan->save();
        }
    }

    public function resetEverything()
    {
        $this->reset();
    }

    public function render()
    {

        return view('livewire.payslip.create')->with([
            "employees" => Employee::all(),
            'setting' => Setting::first(),
            'deductions' => Deduction::all(),
            'tax_deductions' => TaxDeduction::all(),
            'bonuses' => Bonus::all(),
            'allowances' => $this->eligibleAllowances
        ]);
    }
}
