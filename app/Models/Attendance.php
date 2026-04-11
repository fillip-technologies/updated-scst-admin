<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'class_id', 'date', 'status', 'remarks', 'recorded_by',
    ];

    protected $primaryKey = 'id';

    protected $table = 'attendances';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


    public function allclass()
    {
        return $this->belongsTo(AddClasses::class);
    }

    public function school(){
        return $this->belongsTo(School::class,'recorded_by');
    }
}
