<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'reports';

    protected $fillable = ['school_id', 'type', 'report_img','date'];

    public function school()
    {
        $this->belongsTo(School::class);
    }
}
