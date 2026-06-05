<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyllabusTracking extends Model
{
    protected $table = "syllabus_trackings";
    protected $primaryKey = 'id';

    protected $fillable = ['class_name','school_id','subject_name','topics_name','assign_date','completion_date'];

    public function addclass(){
        return $this->belongsTo(AddClasses::class);
    }

    public function school(){
        return $this->belongsTo(School::class);
    }
}
