<?php

namespace App\Models;

use App\Models\Allowance;
use App\Models\Attendance;
use App\Models\CashAdvance;
use App\Models\Deduction;
use App\Models\Department;
use App\Models\JobNature;
use App\Models\Leave;
use App\Models\Loan;
use App\Models\OverTime;
use App\Models\Payslip;
use App\Models\Schedule;
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
}
