<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';

    protected $primaryKey = 'id';

    protected $fillable = ['school_id', 'name', 'email', 'phone', 'address', 'image', 'subject', 'joining_date', 'education', 'skills', 'certificate', 'gender'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
