<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ["name", "address", "latitude", "longtitude"];



    public function departments()
    {
        return $this->hasMany(Department::class, 'branch_id', 'id');
    }
}
