<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notices extends Model
{
    protected $primaryKey = 'id';
    protected $table='notices';
    protected $fillable = ['notice_manage','school_id'];
    protected $casts = ['notice_manage'=>'array'];
    public function school(){
        return $this->belongsTo(School::class);
    }
}
