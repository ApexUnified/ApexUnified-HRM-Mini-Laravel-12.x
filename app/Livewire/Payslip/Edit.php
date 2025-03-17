<?php

namespace App\Livewire\Payslip;


use App\Models\Setting;
use Livewire\Component;

class Edit extends Component
{

    public $payslip;




    public $allowance_amount = 0;
    public $overtime_amount = 0;
    public $bonus_amount = 0;
    public $loan_deduction_amount = 0;
    public $late_absent_deduction_amount = 0;
    public $deduction_amount = 0;
    public $tax_deduction_amount = 0;
    public $net_salary = 0;



    public $status;


    protected $rules = [
        "status" => "required|in:Pending,Approved,Paid"
    ];

    protected $messages = [
        "status.in" => "Payslip Status Must Be In Between Pending , Approved , Paid",
        "status.required" => "Payslip Status Is Required"
    ];


    public function mount($payslip)
    {
        // Collection  Of Payslip 
        $this->payslip = $payslip;
        // Collection  Of Payslip 


        $this->allowance_amount = $payslip->allowance;
        $this->overtime_amount = $payslip->overtime;
        $this->bonus_amount = $payslip->bonus;
        $this->loan_deduction_amount = $payslip->loan_deduction;
        $this->late_absent_deduction_amount = $payslip->attendance_deduction;
        $this->deduction_amount = $payslip->deduction;
        $this->tax_deduction_amount = $payslip->tax_deduction;
        $this->net_salary = $payslip->net_salary;
    }


    public function updatePayslip()
    {
        $this->validate();

        if ($this->payslip->update(["status" => $this->status])) {
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
