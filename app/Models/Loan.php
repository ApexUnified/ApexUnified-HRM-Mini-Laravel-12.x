<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $guarded = [];



    public function employee()
    {
        return $this->belongsTo(Employee::class, "employee_id", "id");
    }



    public function getAdjustedDeductionAmountAttribute()
    {
        return min($this->remeaning_loan, $this->loan_deduction_amount);
    }
}
