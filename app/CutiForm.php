<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CutiForm extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cutiAccept()
    {
        return $this->hasOne(CutiAccept::class);
    }
}
