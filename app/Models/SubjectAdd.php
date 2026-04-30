<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectAdd extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'subject_adds';

    protected $fillable = ['sunject_name','school_id'];

    public function topic()
    {
        return $this->hasMany(SubTopics::class);
    }

    public function assingsubject()
    {
        return $this->hasMany(AssingSubject::class);
    }

    public function school(){
        return $this->belongsTo(School::class);
    }
}
