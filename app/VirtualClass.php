<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualClass extends Model
{
    //

    public function students(){
        return $this->belongsToMany("App\\Student", 'student_virtual_class', 'virtual_class_id', 'student_id');
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
    public function subject(){
        return $this->belongsTo("App\\Subject", 'subject_id', 'id');
    }
}
