<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddClasses extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'add_classes';

    protected $fillable = ['name', 'class', 'school_id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

     public function teacher()
    {
        return $this->hasMany(Teacher::class);
    }

    public function subject(){
        return $this->hasMany(SubjectAdd::class);
    }

}
