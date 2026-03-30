<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfraReport extends Model
{
    protected $table = 'infra_reports';
    protected $primaryKey = 'id';
    protected $fillable = ['school_id','toilet','electricity','drinking_water','building_safety','network_availability','report_category','district'];

    public function school(){
        return $this->belongsTo(School::class);
    }
}
