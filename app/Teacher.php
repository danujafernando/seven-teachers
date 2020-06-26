<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    public function vitual_class(){
        return $this->hasOne(VirtualClass::class);
    }
}
