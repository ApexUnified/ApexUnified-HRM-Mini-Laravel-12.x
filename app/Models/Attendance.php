<?php

namespace App\Models;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    // public function attendance_checker(){
    //     return $this->hasMany(AttendanceChecker::class,"attendance_id","id");
    // }

    public function getFormatedTimesAttribute()
    {
        return [
            'checkin' => $this->attendance_checkin && strtotime($this->attendance_checkin) ?
                Carbon::parse($this->attendance_checkin)->format('g:i A') :
                $this->attendance_checkin,

            'checkout' => $this->attendance_checkout && strtotime($this->attendance_checkout) ?
                Carbon::parse($this->attendance_checkout)->format('g:i A') :
                $this->attendance_checkout
        ];
    }
}
