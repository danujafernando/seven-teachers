<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

    public function virtual_class(){

        return $this->belongsTo(Payment::class);
    }
}
