<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZktecoDevice extends Model
{
    protected $guarded = [];


    public function employees(){
        return $this->hasMany(Employee::class,"device_id","id");
    }

}
