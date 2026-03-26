<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddClasses extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'add_classes';

    protected $fillable = ['name', 'classs', 'school_id'];

    public function school()
    {
        $this->belongsTo(School::class);
    }

    public function student()
    {
        $this->hasMany(Student::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

}
