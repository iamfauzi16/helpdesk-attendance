<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function shiftAttendance() {
        return $this->belongsTo(ShiftAttendance::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }
}
