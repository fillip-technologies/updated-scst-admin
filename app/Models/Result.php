<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'marks',
        'is_absent',
        'file',
        'term',
    ];

    // Relationship
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(SubjectAdd::class);
    }
}
