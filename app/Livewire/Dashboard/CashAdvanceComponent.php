<?php

namespace App\Livewire\Dashboard;

use App\Models\CashAdvance;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CashAdvanceComponent extends Component
{

    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';



    public function rejectCashAdvance($id)
    {
        $cashAdvance = CashAdvance::find($id);

        if (empty($cashAdvance)) {
            $this->dispatch("cash-advance-not-found");
            return;
        }

        if ($cashAdvance->update(["advance_status" => "Rejected"])) {
            $this->dispatch("cash-advance-updated");
        } else {
            $this->dispatch("error-cash-advance");
        }
    }


    public function approveCashAdvance($id)
    {

        $cashAdvance = CashAdvance::find($id);

        if (empty($cashAdvance)) {
            $this->dispatch("cash-advance-not-found");
            return;
        }

        if ($cashAdvance->update(["advance_status" => "Approved"])) {
            $this->dispatch("cash-advance-updated");
        } else {
            $this->dispatch("error-cash-advance");
        }
    }

    public function render()
    {
        return view(
            'livewire.dashboard.cash-advance-component',
            [
                "cash_advances" => CashAdvance::where("advance_status", "=", "Pending")->latest()->paginate(5),
                "setting" => Setting::first()
            ]
        );
    }
}
