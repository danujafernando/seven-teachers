<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    public function vitual_class(){
        return $this->hasOne(VirtualClass::class);
    }
}
