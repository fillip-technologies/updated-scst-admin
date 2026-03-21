<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = ['school_id', 'leadership', 'teacher_staff'];

    protected $table = 'staff';

    protected $casts = ['leadership' => 'array', 'teacher_staff' => 'array'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
