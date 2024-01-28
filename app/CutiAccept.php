<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CutiAccept extends Model
{
    protected $guarded = [];

    public function cutiForm()
    {
        return $this->belongsTo(CutiForm::class);
    }
}
