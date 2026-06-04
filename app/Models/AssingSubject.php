<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssingSubject extends Model
{
    protected $table = 'assing_subjects';

    protected $primaryKey = 'id';

    protected $fillable = ['school_id', 'teacher_id', 'topics_id', 'class_id', 'sublist_id','completion_time'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function topic()
    {
        return $this->belongsTo(SubTopics::class, 'topics_id');
    }

    public function class()
    {
        return $this->belongsTo(AddClasses::class);
    }

    public function subject()
    {
        return $this->belongsTo(SubjectList::class, 'sublist_id');
    }
}
