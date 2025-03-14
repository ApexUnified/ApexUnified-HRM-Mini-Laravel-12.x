<?php

namespace App\Models;

use App\Models\Attendance;
use App\Models\CashAdvance;
use App\Models\Department;
use App\Models\Loan;
use App\Models\Overtime;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }



    public function device()
    {
        return $this->belongsTo(ZktecoDevice::class, "device_id", "id");
    }


    public function getSchedulesAttribute()
    {

        if (empty($this->employee_schedule)) {
            return collect();
        }

        $scheduleIds = explode(',', $this->employee_schedule);
        return Schedule::whereIn('id', $scheduleIds)->get();
    }




    public function overtimes()
    {
        return $this->hasMany(Overtime::class, "employee_id", "id");
    }


    public function getThisMonthOvertimeAttribute()
    {
        $current_month = Carbon::now()->month;
        $overtimes = $this->overtimes()->whereMonth("created_at", $current_month)->get();

        return $overtimes;
    }



    public function loan()
    {
        return $this->hasMany(Loan::class, 'employee_id', 'id');
    }

    public function cashAdvances()
    {
        return $this->hasMany(CashAdvance::class, 'employee_id', 'id');
    }


    public function advanceSalary()
    {
        return $this->hasMany(AdvanceSalary::class, "employee_id", "id");
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'employee_id', 'id');
    }



    public function position()
    {
        return $this->belongsTo(Position::class, "position_id", "id");
    }

    public function loanPayments()
    {
        return $this->hasMany(LoanPayment::class, "employee_id", "id");
    }


    public function casts(): array
    {
        return [
            "documents" => "array",
            'cnic' => "array",
            "family_member_details" => "array",
            "joining_date"  => "date:Y-m-d",

        ];
    }
}
