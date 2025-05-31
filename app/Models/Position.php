<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $guarded = [];


    public function jobnature()
    {
        return $this->belongsTo(Jobnature::class, "jobnature_id", "id");
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, "position_id", "id");
    }
}
