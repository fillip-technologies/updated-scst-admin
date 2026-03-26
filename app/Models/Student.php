<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'roll_number',
        'class_id',
        'dob',
        'gender',
        'email',
        'phone',
        'parent_name',
        'parent_email',
        'parent_phone',
        'parent_relation',
    ];

    protected $primaryKey = 'id';

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function allclass()
    {
        return $this->belongsTo(AddClasses::class);
    }
}
