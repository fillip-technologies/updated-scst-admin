<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'teachers';

    protected $fillable = ['school_id', 'name', 'email', 'phone', 'gender', 'address', 'designation', 'subject', 'class_id', 'joining_date', 'photo'];

    public function school()
    {
        return $this->belongsTo(School::class);

    }

    public function addclass()
    {
        return $this->belongsTo(AddClasses::class);
    }

    public function teacherattend()
    {
        return $this->hasMany(TeacherAttend::class);
    }

    public function subject(){
        return $this->hasMany(SubjectAdd::class);
    }

    public function result(){
        return $this->hasMany(Result::class);
    }
}
