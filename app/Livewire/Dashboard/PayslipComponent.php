<?php

namespace App\Livewire\Dashboard;

use App\Models\Payslip;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PayslipComponent extends Component
{

    use WithPagination, WithoutUrlPagination;

    // protected $paginationTheme = 'bootstrap';

    protected $listeners = ["deletePayslip"];


    public function deletePayslip($id)
    {
        $payslip = Payslip::find($id);

        if (empty($payslip)) {
            $this->dispatch("payslip-not-found");
            return;
        }



        if ($payslip->delete()) {
            $this->dispatch("payslip-deleted");
        } else {
            $this->dispatch("error-deleting-payslip");
        }
    }

    public function updatePayslipStatus($id)
    {

        $payslip = Payslip::find($id);

        if (empty($payslip)) {
            $this->dispatch("payslip-not-found");
            return;
        }


        if ($payslip->update(["status" => "Approved"])) {
            $this->dispatch("payslip-updated");
        } else {
            $this->dispatch("error-updating-payslip");
        }
    }

    public function render()
    {
        return view('livewire.dashboard.payslip-component', [
            'payslips' => Payslip::where("status", "=", "Pending")->latest()->paginate(5),
            "setting" => Setting::first()
        ]);
    }
}
