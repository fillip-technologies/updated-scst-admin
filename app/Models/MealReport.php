<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealReport extends Model
{
    protected $table = 'meal_reports';
    protected $primaryKey = 'id';
    protected $fillable = ['school_id','reportname','date','report_img','menu','district','report_type'];

    public function school(){
        return $this->belongsTo(School::class);
    }
}
