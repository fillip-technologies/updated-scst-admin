<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infrastructure extends Model
{
protected $table = 'infrastructures';
protected $fillable = ['school_id','hero','compus_overview','academic_infrastructure'];
protected $primaryKey = 'id';


protected $casts = ['hero'=>'array','compus_overview'=>'array','academic_infrastructure'=>'array'];

public function school(){
        return $this->belongsTo(School::class);
    }
}
