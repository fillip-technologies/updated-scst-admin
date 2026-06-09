<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewTracking extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'view_trackings';

    protected $fillable = ['class_name', 'subject', 'topic_name', 'school_id', 'teacher_id', 'status', 'remarks','progress','month','year'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
