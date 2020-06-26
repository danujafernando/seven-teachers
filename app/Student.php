<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    //
    public function vitual_classes(){
        return $this->belongsToMany('App\\VirtualClass', 'student_virtual_class', 'student_id', 'virtual_class_id');
    }
}
