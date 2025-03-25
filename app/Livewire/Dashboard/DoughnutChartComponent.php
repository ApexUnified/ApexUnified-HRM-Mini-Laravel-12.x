<?php

namespace App\Livewire\Dashboard;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DoughnutChartComponent extends Component
{

    public $employees = [];
    public $isLoaded = false;

    public $employee_id;
    public $period = "All";

    public $late_attendances = [];
    public $absent_attendances = [];
    public $early_attendances = [];


    protected $listeners = ["loadAllEmployeesFromDoughnut"];

    public function mount()
    {
        $this->employee_id = !Auth::user()->hasRole("admin") ? Auth::id() : null;
        $this->loadChartData();
        $this->employees = Employee::latest()->limit(20)->get();
    }


    public function updatedEmployeeId()
    {

        $this->late_attendances = [];
        $this->absent_attendances = [];
        $this->early_attendances = [];

        $this->loadChartData();


        $this->dispatch("update-doughnut-chart", [
            [
                "late_attendances" => $this->late_attendances ?? [],
                "absent_attendances" => $this->absent_attendances ?? [],
                "early_attendances" => $this->early_attendances ?? []
            ]
        ]);

        $this->dispatch("refresh-select-picker");
    }

    public function updatedPeriod()
    {
        $this->late_attendances = [];
        $this->absent_attendances = [];

        $this->loadChartData();


        $this->dispatch("update-doughnut-chart", [
            [
                "late_attendances" => $this->late_attendances ?? [],
                "absent_attendances" => $this->absent_attendances ?? [],
                "early_attendances" => $this->early_attendances ?? [],
            ]
        ]);

        $this->dispatch("refresh-select-picker");
    }

    public function loadChartData()
    {
        $late_attendances = Attendance::when($this->period == "1", function ($query) {
            return $query->whereMonth("attendance_date", Carbon::now());
        })
            ->when($this->period == "3", function ($query) {
                return $query->whereBetween("attendance_date", [Carbon::now()->subMonths(3), Carbon::now()]);
            })


            ->when($this->period == "6", function ($query) {
                return $query->whereBetween("attendance_date", [Carbon::now()->subMonths(6), Carbon::now()]);
            })

            ->when($this->period == "12", function ($query) {
                return $query->whereBetween("attendance_date", [Carbon::now()->subMonths(12), Carbon::now()]);
            })


            ->when(!empty($this->employee_id), function ($query) {
                return $query->where("employee_id", $this->employee_id);
            })
            ->where("attendance_status", "=", "Late")->count();




        $absent_attendances = Attendance::when($this->period == "1", function ($query) {
            return $query->whereMonth("attendance_date", Carbon::now()->month);
        })
            ->when($this->period == "3", function ($query) {
                return $query->whereBetween("attendance_date", [Carbon::now()->subMonths(3), Carbon::now()]);
            })


            ->when($this->period == "6", function ($query) {
                return $query->whereBetween("attendance_date", [Carbon::now()->subMonths(6), Carbon::now()]);
            })

            ->when($this->period == "12", function ($query) {
                return $query->whereBetween("attendance_date", [Carbon::now()->subMonths(12), Carbon::now()]);
            })

            ->when(!empty($this->employee_id), function ($query) {
                return $query->where("employee_id", $this->employee_id);
            })->where("attendance_status", "=", "Absent")->count();





        $early_attendances = Attendance::when($this->period == "1", function ($query) {
            return $query->whereMonth("attendance_date", Carbon::now()->month);
        })

            ->when($this->period == "3", function ($query) {
                return $query->whereBetween("attendance_date", [Carbon::now()->subMonths(3), Carbon::now()]);
            })


            ->when($this->period == "6", function ($query) {
                return $query->whereBetween("attendance_date", [Carbon::now()->subMonths(6), Carbon::now()]);
            })

            ->when($this->period == "12", function ($query) {
                return $query->whereBetween("attendance_date", [Carbon::now()->subMonths(12), Carbon::now()]);
            })

            ->when(!empty($this->employee_id), function ($query) {
                return $query->where("employee_id", $this->employee_id);
            })->where("attendance_status", "=", "Early")->count();




        $this->late_attendances = $late_attendances;
        $this->absent_attendances = $absent_attendances;
        $this->early_attendances = $early_attendances;
    }



    public function loadAllEmployeesFromDoughnut()
    {
        $this->employees = [];
        $this->employees = Employee::all();
        $this->isLoaded = true;
        $this->dispatch("refresh-select-picker");
    }

    public function render()
    {
        return view('livewire.dashboard.doughnut-chart-component');
    }
}
