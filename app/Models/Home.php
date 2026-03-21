<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'homes';

    protected $fillable = ['school_id', 'hero', 'gallery', 'about', 'school_at_a_glance', 'infrasture', 'activities', 'quiz', 'alumni', 'faq'];

    protected $casts = [
        'here' => 'array',
        'gallery' => 'array',
        'about' => 'array',
        'school_at_a_glance' => 'array',
        'infrasture' => 'array',
        'activities' => 'array',
        'quiz' => 'array',
        'alumni' => 'array',
        'faq' => 'array',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }
}
