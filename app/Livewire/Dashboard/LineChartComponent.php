<?php

namespace App\Livewire\Dashboard;

use App\Models\AdvanceSalary;
use App\Models\Attendance;
use App\Models\CashAdvance;
use App\Models\Employee;
use App\Models\Loan;
use App\Models\Overtime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class LineChartComponent extends Component
{

    use WithPagination, WithoutUrlPagination;

    protected $listeners = ["updateSearch", "loadAllEmployees" => "loadAllEmployees"];

    public $search = null;

    public $allMonths;
    public $employees = [];
    public $isLoaded = false;

    public $employee_id;

    public $attendances = [];
    public $overtimes = [];
    public $loans = [];
    public $cash_advances = [];
    public $advance_salaries = [];





    public function updatedEmployeeId()
    {
        $this->attendances = [];
        $this->overtimes = [];
        $this->loans = [];
        $this->cash_advances = [];
        $this->advance_salaries = [];

        $this->dispatch("refresh-select-picker");
        $this->loadChartData();


        $this->dispatch("chart-update", [
            [
                "attendances" => $this->attendances ?? [],
                "overtimes" => $this->overtimes ?? [],
                "loans" => $this->loans ?? [],
                "cash_advances" => $this->cash_advances ?? [],
                "advance_salaries" => $this->advance_salaries ?? [],
            ]
        ]);
    }

    public function mount()
    {

        $this->employee_id = !Auth::user()->hasRole("admin") ? Auth::id() : null;

        $allMonths = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->format('F');
        });
        $this->allMonths = $allMonths;

        $this->loadChartData();

        $this->employees = Employee::latest()->limit(20)->get();
    }


    private function loadChartData()
    {
        // Attendances
        $attendances = Attendance::when($this->employee_id, function ($query) {
            return $query->where("employee_id", $this->employee_id);
        })
            ->selectRaw("MONTH(attendance_date) as month, COUNT(*) as total")
            ->groupBy("month")
            ->orderBy("month")
            ->pluck("total", "month");


        $this->attendances = $attendances = collect(range(1, 12))->mapWithKeys(function ($month) use ($attendances) {
            return [
                Carbon::create()->month($month)->format('F') => $attendances[$month] ?? 0
            ];
        });


        // Overtimes
        $overtimes = Overtime::when($this->employee_id, function ($query) {
            return $query->where("employee_id", $this->employee_id);
        })
            ->selectRaw("MONTH(created_at) as month , COUNT(*) as total")
            ->groupBy("month")
            ->orderBy("month")
            ->pluck("total", "month");

        $this->overtimes = $overtimes = collect(range(1, 12))->mapWithKeys(function ($month) use ($overtimes) {
            return [
                Carbon::create()->month($month)->format('F') => $overtimes[$month] ?? 0
            ];
        });


        // Loans
        $loans = Loan::when($this->employee_id, function ($query) {
            return $query->where("employee_id", $this->employee_id);
        })
            ->selectRaw("MONTH(loan_date) as month, COUNT(*) as total")
            ->groupBy("month")
            ->orderBy("month")
            ->pluck("total", "month");

        $this->loans = $loans = collect(range(1, 12))->mapWithKeys(function ($month) use ($loans) {
            return [
                Carbon::create()->month($month)->format("F") => $loans[$month] ?? 0
            ];
        });



        $cash_advances = CashAdvance::when(!empty($this->employee_id), function ($query) {
            return $query->where("employee_id", $this->employee_id);
        })
            ->selectRaw("MONTH(advance_date) as month , COUNT(*) as total")
            ->groupBy("month")
            ->orderBy("month")
            ->pluck("total", "month");

        $this->cash_advances = $cash_advances = collect(range(1, 12))->mapWithKeys(function ($month) use ($cash_advances) {
            return [
                Carbon::create()->month($month)->format('F') => $cash_advances[$month] ?? 0
            ];
        });




        $advance_salaries = AdvanceSalary::when(!empty($this->employee_id), function ($query) {
            return $query->where("employee_id", $this->employee_id);
        })
            ->selectRaw("MONTH(advance_salary_date) as month , COUNT(*) as total")
            ->groupBy("month")
            ->orderBy("month")
            ->pluck("total", "month");

        $this->advance_salaries = $advance_salaries = collect(range(1, 12))->mapWithKeys(function ($month) use ($advance_salaries) {
            return [
                Carbon::create()->month($month)->format('F') => $advance_salaries[$month] ?? 0
            ];
        });
    }


    public function loadAllEmployees()
    {
        $this->employees = [];
        $this->employees = Employee::all();
        $this->isLoaded = true;
        $this->dispatch("refresh-select-picker");
    }


    public function render()
    {
        return view('livewire.dashboard.line-chart-component');
    }
}
