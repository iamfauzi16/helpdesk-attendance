<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShiftAttendance extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }
}
