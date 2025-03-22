<?php

namespace App\Livewire\Payslip;


use App\Models\Setting;
use Livewire\Component;

class Edit extends Component
{

    public $payslip;

    public $base_salary = 0;
    public $allowance_amount = 0;
    public $overtime_amount = 0;
    public $bonus_amount = 0;
    public $loan_deduction_amount = 0;
    public $late_absent_deduction_amount = 0;
    public $deduction_amount = 0;
    public $tax_deduction_amount = 0;
    public $status;
    public $net_salary = 0;




    protected $rules = [
        "status" => "required|in:Pending,Approved,Paid",
        "allowance_amount" => 'required|numeric|decimal:0,2',
        "overtime_amount" => 'required|numeric|decimal:0,2',
        "bonus_amount" => 'required|numeric|decimal:0,2',
        "loan_deduction_amount" => 'required|numeric|decimal:0,2',
        "late_absent_deduction_amount" => 'required|numeric|decimal:0,2',
        "deduction_amount" => 'required|numeric|decimal:0,2',
        "tax_deduction_amount" => 'required|numeric|decimal:0,2',
    ];

    protected $messages = [
        "status.in" => "Payslip Status Must Be In Between Pending , Approved , Paid",
        "status.required" => "Payslip Status Is Required",
        "allowance_amount.required" => "Allowance Amount Is Required",
        "allowance_amount.numeric" => "Allowance Amount Must Be Numeric",
        "allowance_amount.decimal" => "Allowance Amount Must Be Decimal",
        "overtime_amount.required" => "Overtime Amount Is Required",
        "overtime_amount.numeric" => "Overtime Amount Must Be Numeric",
        "overtime_amount.decimal" => "Overtime Amount Must Be Decimal",
        "bonus_amount.required" => "Bonus Amount Is Required",
        "bonus_amount.numeric" => "Bonus Amount Must Be Numeric",
        "bonus_amount.decimal" => "Bonus Amount Must Be Decimal",
        "loan_deduction_amount.required" => "Loan Deduction Amount Is Required",
        "loan_deduction_amount.numeric" => "Loan Deduction Amount Must Be Numeric",
        "loan_deduction_amount.decimal" => "Loan Deduction Amount Must Be Decimal",
        "late_absent_deduction_amount.required" => "Late & Absent Deduction Amount Is Required",
        "late_absent_deduction_amount.numeric" => "Late & Absent Deduction Amount Must Be Numeric",
        "late_absent_deduction_amount.decimal" => "Late & Absent Deduction Amount Must Be Decimal",
        "deduction_amount.required" => "Deduction Amount Is Required",
        "deduction_amount.numeric" => "Deduction Amount Must Be Numeric",
        "deduction_amount.decimal" => "Deduction Amount Must Be Decimal",
        "tax_deduction_amount.required" => "Tax Deduction Amount Is Required",
        "tax_deduction_amount.numeric" => "Tax Deduction Amount Must Be Numeric",
        "tax_deduction_amount.decimal" => "Tax Deduction Amount Must Be Decimal",
    ];


    public function mount($payslip)
    {
        // Collection  Of Payslip 
        $this->payslip = $payslip;
        // Collection  Of Payslip 
        $this->base_salary += $payslip->base_salary;
        $this->status = $payslip->status;
        $this->allowance_amount = $payslip->allowance;
        $this->overtime_amount = $payslip->overtime;
        $this->bonus_amount = $payslip->bonus;
        $this->loan_deduction_amount = $payslip->loan_deduction;
        $this->late_absent_deduction_amount = $payslip->attendance_deduction;
        $this->deduction_amount = $payslip->deduction;
        $this->tax_deduction_amount = $payslip->tax_deduction;
        $this->net_salary = $payslip->net_salary;
    }

    public function updated()
    {
        $this->dispatch('refresh-select-picker');
    }


    public function updatePayslip()
    {
        $this->dispatch('refresh-select-picker');
        $this->validate();


        $total_net_salary =
            ($this->base_salary)
            + ($this->allowance_amount)
            + ($this->bonus_amount)
            + ($this->overtime_amount)
            - ($this->loan_deduction_amount)
            - ($this->late_absent_deduction_amount)
            - ($this->deduction_amount)
            - ($this->tax_deduction_amount);




        if (
            $this->payslip->update(
                [
                    "status" => $this->status,
                    "allowance" => $this->allowance_amount,
                    "overtime" => $this->overtime_amount,
                    "bonus" => $this->bonus_amount,
                    "loan_deduction" => $this->loan_deduction_amount,
                    "attendance_deduction" => $this->late_absent_deduction_amount,
                    "deduction" => $this->deduction_amount,
                    "tax_deduction" => $this->tax_deduction_amount,
                    "net_salary" => $total_net_salary
                ]
            )
        ) {
            $this->dispatch("payslip-updated");
        } else {
            $this->dispatch("payslip-updating-error");
        }

        $this->dispatch("refresh-select-picker");
    }

    public function render()
    {
        return view('livewire.payslip.edit')->with([
            "setting" => Setting::first(),
        ]);
    }
}
