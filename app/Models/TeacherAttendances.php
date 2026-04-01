<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAttendances extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'teacher_attendances';
    protected  $fillable = ['school_id','teacher_id','status','leave_type','reasion'];

    public function school(){
        return $this->belongsTo(School::class);
    }
}
