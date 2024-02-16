<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];

    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }
}
