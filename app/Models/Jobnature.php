<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobnature extends Model
{
    protected $guarded = [];


    public function position()
    {
        return $this->hasMany(Position::class, "jobnature_id", "id");
    }
}
