<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectList extends Model
{
    protected $table = 'subject_lists';
    protected $primaryKey = 'id';
    protected $fillable = ['subject_name','school_id'];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function assingsubject(){
        return $this->hasMany(AssingSubject::class);
    }
}
