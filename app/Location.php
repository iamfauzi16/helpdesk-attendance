<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];

    public function shiftAttendance()
    {
        return $this->hasMany(ShiftAttendance::class);
    }
}
