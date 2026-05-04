<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTopics extends Model
{
    protected $table = 'sub_topics';

    protected $primaryKey = 'id';

    protected $fillable = ['sublist_id', 'topics', 'school_id'];

    public function subjecList()
    {
        return $this->hasMany(SubjectList::class);
    }

    public function assingsubject()
    {
        return $this->hasMany(AssingSubject::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    protected $casts = ['topics' => 'array'];
}
