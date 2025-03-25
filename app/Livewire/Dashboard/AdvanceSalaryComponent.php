<?php

namespace App\Livewire\Dashboard;

use App\Models\AdvanceSalary;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AdvanceSalaryComponent extends Component
{
    use WithPagination, WithoutUrlPagination;



    public function rejectAdvanceSalary($id)
    {
        $advanceSalary = AdvanceSalary::find($id);

        if (empty($advanceSalary)) {
            $this->dispatch("advance-salary-not-found");
            return;
        }


        if ($advanceSalary->update(["advance_salary_status" => "Rejected"])) {
            $this->dispatch("advance-salary-updated");
        } else {
            $this->dispatch("advance-salary-not-updated");
        }
    }


    public function approveAdvanceSalary($id)
    {
        $advanceSalary = AdvanceSalary::find($id);

        if (empty($advanceSalary)) {
            $this->dispatch("advance-salary-not-found");
            return;
        }


        if ($advanceSalary->update(["advance_salary_status" => "Approved"])) {
            $this->dispatch("advance-salary-updated");
        } else {
            $this->dispatch("advance-salary-not-updated");
        }
    }
    public function render()
    {
        return view('livewire.dashboard.advance-salary-component', [
            "setting" => Setting::first(),
            "advance_salaries" => AdvanceSalary::where("advance_salary_status", "Pending")->latest()->paginate(5)
        ]);
    }
}
