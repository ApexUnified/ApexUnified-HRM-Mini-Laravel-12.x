<?php

namespace App\Models;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = [];

    public function employees() {
        return $this->hasMany(Employee::class, 'employee_schedule', 'id');
    }




    public function getFormattedTimesAttribute()
    {
        return [
            'checkin' => Carbon::parse($this->checkin)->format('g:i A'),
            'checkout' => Carbon::parse($this->checkout)->format('g:i A')
        ];
    }

}
