<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAttend extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['school_id','status','leave_type','reason','teacher_id','date'];
    protected $table = "teacher_attends";


    public function school(){
        return $this->belongsTo(School::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
