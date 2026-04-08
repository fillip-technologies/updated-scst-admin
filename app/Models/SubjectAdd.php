<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectAdd extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'subject_adds';

    protected $fillable = ['school_id', 'teacher_id', 'class_id', 'subject'];

    public function allclass()
    {
        return $this->belongsTo(AddClasses::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
